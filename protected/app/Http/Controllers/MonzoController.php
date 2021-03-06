<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonzoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // Redirect to Monzo for authentication
    public function redirectToMonzoAuth(Request $request)
    {
	    // Set up configuration
	    $client_id = config('services.monzo.client_id');
	    $redirect_uri = urlencode(config('services.monzo.redirect_uri'));
	    $state = md5(uniqid(mt_rand(), true));
	    
	    // Save the random state variable in the session to check later
	    $request->session()->put('monzo_auth_state', $state);
	    
	    // Decide where to redirect to
	    $request->session()->put('monzo_auth_redirect_to', $request->input('redirect_to', '/'));
	    
	    // Redirect to Monzo for authentication
	    return redirect('https://auth.getmondo.co.uk/?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&response_type=code&state='.$state);
    }
    
    // Get data back from Monzo for authentication
    public function redirectFromMonzoAuth(Request $request)
    {
	    // Set up configuration
	    $client_id = config('services.monzo.client_id');
	    $client_secret = config('services.monzo.client_secret');
	    $redirect_uri = urlencode(config('services.monzo.redirect_uri'));
	    
	    // Get configuration from Monzo
	    $code = $request->input('code');
	    $state = $request->input('state');
	    
	    if ($state === $request->session()->pull('monzo_auth_state'))
	    {
		    // Send the code to Monzo to get an access token
		    $now = time();
		    
		    $curl = curl_init();
		    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/oauth2/token');
		    curl_setopt($curl, CURLOPT_POST, true);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=authorization_code&client_id='.$client_id.'&client_secret='.urlencode($client_secret).'&redirect_uri='.$redirect_uri.'&code='.$code);
		    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
		    $response = curl_exec($curl);
		    curl_close($curl);
		    
		    // Decode the response from Monzo
		    $response = json_decode($response);
		    
		    // Save Monzo variables to the session
		    $request->session()->put('monzo_access_token', $response->access_token);
		    $request->session()->put('monzo_access_token_expiry', $now + $response->expires_in);
		    $request->session()->put('monzo_refresh_token', $response->refresh_token);
		    $request->session()->put('monzo_user_id', $response->user_id);
		    
		    // Redirect back to where we came from
		    return redirect(config('app.url').$request->session()->pull('monzo_auth_redirect_to'));
	    }
	    else
	    {
		    // Redirect back to home page
		    return redirect('/');
	    }
    }
    
    // Redirect to Monzo for re-authentication
    public function redirectToMonzoRefresh(Request $request)
    {
	    // Set up configuration
	    $client_id = config('services.monzo.client_id');
	    $client_secret = config('services.monzo.client_secret');
	    $refresh_token = $request->session()->get('monzo_refresh_token');
	    
		// Send the code to Monzo to get an access token
	    $now = time();
	    
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/oauth2/token');
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=refresh_token&client_id='.$client_id.'&client_secret='.urlencode($client_secret).'&refresh_token='.$refresh_token);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    
	    // Decode the response from Monzo
	    $response = json_decode($response);
	    
	    // Save Monzo variables to the session
	    $request->session()->put('monzo_access_token', $response->access_token);
	    $request->session()->put('monzo_access_token_expiry', $now + $response->expires_in);
	    $request->session()->put('monzo_refresh_token', $response->refresh_token);
	    $request->session()->put('monzo_user_id', $response->user_id);
	    
	    // Redirect back to where we came from
	    return redirect(config('app.url').$request->input('redirect_to'));
    }
    
    // Get a list of accounts from Monzo
    public function getAccounts(Request $request)
    {
	    if (empty($request->session()->get('monzo_access_token')))
	    {
		    // Redirect to Monzo auth
		    return redirect('/r/to-monzo-auth?redirect_to=/accounts');
	    }
	    
	    // Get the list of accounts
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/accounts');
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$request->session()->get('monzo_access_token')]);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    
	    // Decode the response from Monzo
	    $response = json_decode($response);
	    
	    return view('app.accounts', ['accounts' => $response->accounts]);
    }
    
    // Get a list of transactions from Monzo
    public function getTransactions(Request $request)
    {
	    if (empty($request->session()->get('monzo_access_token')))
	    {
		    // Redirect to Monzo auth
		    return redirect('/r/to-monzo-auth?redirect_to=/transactions');
	    }
	    
	    $account_id = $request->input('account_id');
	    
	    if (empty($account_id))
	    {
		    // Redirect to home page
		    return redirect('/');
	    }
	    
	    // Get any date filters
	    $date_filter_utc = '';
	    $date_filter_local = '';
	    
	    if ($request->has('from'))
	    {
		    $date_filter_utc .= '&since='.(new \DateTime($request->input('from'), (new \DateTimeZone('Europe/London'))))->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d').'T00:00:00Z';
		    $date_filter_local .= '&amp;from='.$request->input('from');
	    }
	    
	    if ($request->has('to'))
	    {
		    $date_filter_utc .= '&before='.(new \DateTime($request->input('to'), (new \DateTimeZone('Europe/London'))))->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d').'T00:00:00Z';
		    $date_filter_local .= '&amp;to='.$request->input('to');
	    }
	    
	    // Get the list of transactions
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/transactions?account_id='.$account_id.'&expand[]=merchant'.$date_filter_utc);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$request->session()->get('monzo_access_token')]);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    
	    // Decode the response from Monzo
	    $response = json_decode($response);
	    
	    $today = (new \DateTime())->setTimezone(new \DateTimeZone('Europe/London'))->format('Y-m-d');
	    $first_transaction_date = (!empty($response->transactions[0]->created) ? (new \DateTime($response->transactions[0]->created))->setTimezone(new \DateTimeZone('Europe/London'))->format('Y-m-d') : $today);
	    $last_transaction_date = (!empty($response->transactions[count($response->transactions) - 1]->created) ? (new \DateTime($response->transactions[count($response->transactions) - 1]->created))->setTimezone(new \DateTimeZone('Europe/London'))->format('Y-m-d') : $today);
	    
	    return view('app.transactions', ['account_id' => $account_id, 'transactions' => $response->transactions, 'first_transaction_date' => $first_transaction_date, 'last_transaction_date' => $last_transaction_date, 'date_filter_local' => $date_filter_local]);
    }
    
    // Download a list of transactions from Monzo in QIF format
    public function downloadTransactions(Request $request)
    {
	    if (empty($request->session()->get('monzo_access_token')))
	    {
		    // Redirect to Monzo auth
		    return redirect('/r/to-monzo-auth?redirect_to=/transactions/download');
	    }
	    
	    $account_id = $request->input('account_id');
	    
	    if (empty($account_id) || !in_array($request->input('type'), ['qif', 'csv']))
	    {
		    // Redirect to home page
		    return redirect('/');
	    }
	    
	    // Get any date filters
	    $date_filter_utc = '';
	    
	    if ($request->has('from'))
	    {
		    $date_filter_utc .= '&since='.(new \DateTime($request->input('from'), (new \DateTimeZone('Europe/London'))))->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d').'T00:00:00Z';
	    }
	    
	    if ($request->has('to'))
	    {
		    $date_filter_utc .= '&before='.(new \DateTime($request->input('to'), (new \DateTimeZone('Europe/London'))))->setTimezone(new \DateTimeZone('UTC'))->format('Y-m-d').'T00:00:00Z';
	    }
	    
	    // Get the list of transactions
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/transactions?account_id='.$account_id.$date_filter_utc);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$request->session()->get('monzo_access_token')]);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    
	    // Decode the response from Monzo
	    $response = json_decode($response);
	    
	    if ($request->input('type') === 'csv')
	    {
		    return response()->view('app.transactions-csv', ['account_id' => $account_id, 'transactions' => $response->transactions])->header('Content-Type', 'text/csv')->header('Content-Disposition', 'attachment; filename=transactions.csv');
	    }
	    else
	    {
		    return response()->view('app.transactions-qif', ['account_id' => $account_id, 'transactions' => $response->transactions])->header('Content-Type', 'application/qif')->header('Content-Disposition', 'attachment; filename=transactions.qif');
	    }
    }
}
