@extends('layouts.default')

@section('title', 'List of your Mondo transactions')

@section('content')

@if ($transactions === null)
<p>There are no transactions to display.</p>
@else
<table>
	<tr>
		<th>Transaction description</th>
		<th>Amount</th>
	</tr>
	@foreach ($transactions as $transaction)
	<tr>
		<td>{{ $transaction->description }}</td>
		<td>{{ $transaction->amount / 100 }} {{ $transaction->currency }}</td>
	</tr>
	@endforeach
</table>

<p><a href="/transactions/download?account_id={{ $account_id }}">Download transactions (QIF)</a></p>
@endif

@stop
