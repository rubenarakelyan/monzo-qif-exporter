@extends('app.layouts.default')

@section('title', 'List of your Mondo transactions')

@section('content')

      <div class="row">
	    <div class="col-md-10 col-md-offset-1">
          @if ($transactions === null)
          <p>There are no transactions to display.</p>
          @else
          <table class="table table-hover table-vertical-align">
	        <thead>
	          <tr>
		        <th></th>
		        <th>Date/Time</th>
		        <th>Merchant</th>
		        <th class="text-right">Amount</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($transactions as $transaction)
	          <tr>
		        <td>@if (!empty($transaction->merchant->logo)) <img src="{{ $transaction->merchant->logo }}" width="30" height="30" alt=""> @endif</td>
		        <td>{{ (new \DateTime($transaction->created))->format('j M Y H:i') }}</td>
		        <td>@if (!empty($transaction->merchant->name)) {{ $transaction->merchant->name }} @else {{ $transaction->description }} @endif</td>
		        <td class="text-right @if (($transaction->amount / 100) < 0) debit @else credit @endif">{{ Currency::withPrefix(abs($transaction->amount / 100), $transaction->currency, 2) }}</td>
	          </tr>
	          @endforeach
	        </tbody>
          </table>
          <a href="/transactions/download?account_id={{ $account_id }}" class="btn btn-default"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download transactions (QIF)</a>
          @endif
	    </div>
      </div>

@stop
