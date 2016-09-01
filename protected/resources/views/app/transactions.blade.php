@extends('app.layouts.default')

@section('title', 'List of your Monzo transactions')

@section('content')

      <div class="row">
	    <div class="col-md-10 col-md-offset-1 text-right">
		  <form action="/transactions" method="get" class="form-inline">
			<input type="hidden" name="account_id" value="{{ $account_id }}">
			<div class="form-group">
		      <div class="input-group input-daterange" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                <input type="text" name="from" value="{{ $first_transaction_date }}" class="form-control input-sm" style="width:150px">
                <span class="input-group-addon">to</span>
                <input type="text" name="to" value="{{ $last_transaction_date }}" class="form-control input-sm" style="width:150px">
              </div>
	        </div>
	        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
		  </form>
	    </div>
      </div>
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
		        <th class="text-right">Balance</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($transactions as $transaction)
	          <tr>
		        <td>@if (!empty($transaction->merchant->logo)) <img src="{{ $transaction->merchant->logo }}" width="30" height="30" alt=""> @endif</td>
		        <td>{{ (new \DateTime($transaction->created))->setTimezone(new \DateTimeZone('Europe/London'))->format('j M Y H:i') }}</td>
		        <td>@if (!empty($transaction->merchant->name)) {{ $transaction->merchant->name }} @else {{ $transaction->description }} @endif</td>
		        <td class="text-right @if (($transaction->amount / 100) < 0) debit @else credit @endif">{{ Currency::withPrefix(abs($transaction->amount / 100), $transaction->currency, 2) }}</td>
		        <td class="text-right">{{ Currency::withPrefix(abs($transaction->account_balance / 100), $transaction->currency, 2) }}</td>
	          </tr>
	          @endforeach
	        </tbody>
          </table>
          <a href="/transactions/download?account_id={{ $account_id }}&amp;type=qif{{ $date_filter_local }}" class="btn btn-default"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download transactions (QIF)</a>
          <a href="/transactions/download?account_id={{ $account_id }}&amp;type=csv{{ $date_filter_local }}" class="btn btn-default"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download transactions (CSV)</a>
          @endif
	    </div>
      </div>

@stop
