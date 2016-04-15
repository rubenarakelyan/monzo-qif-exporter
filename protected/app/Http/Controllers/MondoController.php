<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MondoController extends Controller
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

    // Redirect to Mondo for authentication
    public function redirectToMondoAuth(Request $request)
    {
	    // Set up configuration
	    $client_id = config('services.mondo.client_id');
	    $redirect_uri = urlencode(config('services.mondo.redirect_uri'));
	    $state = md5(uniqid(mt_rand(), true));
	    
	    // Save the random state variable in the session to check later
	    $request->session()->put('mondo_auth_state', $state);
	    
	    // Decide where to redirect to
	    $request->session()->put('mondo_auth_redirect_to', $request->input('redirect_to', config('app.url')));
	    
	    // Redirect to Mondo for authentication
	    return redirect('https://auth.getmondo.co.uk/?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&response_type=code&state='.$state);
    }
    
    // Get data back from Mondo for authentication
    public function redirectFromMondoAuth(Request $request)
    {
	    // Set up configuration
	    $client_id = config('services.mondo.client_id');
	    $client_secret = config('services.mondo.client_secret');
	    $redirect_uri = urlencode(config('services.mondo.redirect_uri'));
	    
	    // Get configuration from Mondo
	    $code = $request->input('code');
	    $state = $request->input('state');
	    
	    if ($state === $request->session()->pull('mondo_auth_state'))
	    {
		    // Send the code to Mondo to get an access token
		    $now = time();
		    
		    $curl = curl_init();
		    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/oauth2/token');
		    curl_setopt($curl, CURLOPT_POST, true);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curl, CURLOPT_POSTFIELDS, ['grant_type' => 'authorization_code', 'client_id' => $client_id, 'client_secret' => $client_secret, 'redirect_uri' => $redirect_uri, 'state' => $state]);
		    $response = curl_exec($curl);
		    curl_close($curl);
		    
		    // Decode the response from Mondo
		    $response = json_decode($response);
		    
		    // Save Mondo variables to the session
		    $response->session()->put('mondo_access_token', $response->access_token);
		    $response->session()->put('mondo_access_token_expiry', $now + $response->expires_in);
		    $response->session()->put('mondo_refresh_token', $response->refresh_token);
		    $response->session()->put('mondo_user_id', $response->user_id);
		    
		    // Redirect back to where we came from
		    return redirect(config('app.url').$request->session()->pull('mondo_auth_redirect_to'));
	    }
	    else
	    {
		    // Redirect back to home page
		    return redirect('/');
	    }
    }
    
    // Redirect to Mondo for re-authentication
    public function redirectToMondoRefresh(Request $request)
    {
	    // Set up configuration
	    $client_id = config('services.mondo.client_id');
	    $client_secret = config('services.mondo.client_secret');
	    $refresh_token = $response->session()->get('mondo_refresh_token');
	    
		// Send the code to Mondo to get an access token
	    $now = time();
	    
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/oauth2/token');
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_RETURN_TRANSFER, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, ['grant_type' => 'refresh_token', 'client_id' => $client_id, 'client_secret' => $client_secret, 'refresh_token' => $refresh_token]);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    
	    // Decode the response from Mondo
	    $response = json_decode($response);
	    
	    // Save Mondo variables to the session
	    $response->session()->put('mondo_access_token', $response->access_token);
	    $response->session()->put('mondo_access_token_expiry', $now + $response->expires_in);
	    $response->session()->put('mondo_refresh_token', $response->refresh_token);
	    $response->session()->put('mondo_user_id', $response->user_id);
	    
	    // Redirect back to where we came from
	    return redirect(config('app.url').$request->input('redirect_to'));
    }
    
    // Get a list of accounts from Mondo
    public function getAccounts(Request $request)
    {
	    // Get the list of accounts
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/accounts');
	    curl_setopt($curl, CURLOPT_RETURN_TRANSFER, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$response->session()->get('mondo_access_token')]);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    
	    // Decode the response from Mondo
	    $response = json_decode($response);
	    
	    return view('app.accounts', ['accounts' => $response]);
    }
    
    // Get a list of transactions from Mondo
    public function getTransactions(Request $request)
    {
	    $account_id = $request->input('account_id');
	    
	    // Get the list of transactions
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/transactions?account_id='.$account_id);
	    curl_setopt($curl, CURLOPT_RETURN_TRANSFER, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$response->session()->get('mondo_access_token')]);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    
	    // Decode the response from Mondo
	    $response = json_decode($response);
	    
	    return view('app.transactions', ['account_id' => $account_id, 'transactions' => $transactions]);
    }
    
    // Download a list of transactions from Mondo in QIF format
    public function downloadTransactions(Request $request)
    {
	    $account_id = $request->input('account_id');
	    
	    // Get the list of transactions
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, 'https://api.getmondo.co.uk/transactions?account_id='.$account_id);
	    curl_setopt($curl, CURLOPT_RETURN_TRANSFER, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$response->session()->get('mondo_access_token')]);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    
	    // Decode the response from Mondo
	    $response = json_decode($response);
	    
	    return view('app.transactions-qif', ['account_id' => $account_id, 'transactions' => $transactions]);
    }
}
