@extends('app.layouts.default')

@section('title', 'List of your Mondo transactions')

@section('content')

      <div class="row">
	    <div class="col-md-12">
          @if ($transactions === null)
          <p>There are no transactions to display.</p>
          @else
          <table class="table table-hover">
	        <thead>
	          <tr>
		        <th>Transaction description</th>
		        <th>Amount</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($transactions as $transaction)
	          <tr>
		        <td>{{ $transaction->description }}</td>
		        <td>{{ $transaction->amount / 100 }} {{ $transaction->currency }}</td>
	          </tr>
	          @endforeach
	        </tbody>
          </table>
          <p><a href="/transactions/download?account_id={{ $account_id }}">Download transactions (QIF)</a></p>
          @endif
	    </div>
      </div>

@stop
