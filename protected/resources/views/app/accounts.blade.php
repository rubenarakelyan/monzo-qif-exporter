@extends('app.layouts.default')

@section('title', 'List of your Mondo accounts')

@section('content')

@if ($accounts === null)
<p>There are no accounts to display.</p>
@else
<table>
	<tr>
		<th>Account description</th>
		<th>Created</th>
		<th></th>
	</tr>
	@foreach ($accounts as $account)
	<tr>
		<td>{{ $account->description }}</td>
		<td>{{ $account->created }}</td>
		<td><a href="/transactions?account_id={{ $account->id }}">Choose</a></td>
	</tr>
	@endforeach
</table>
@endif

@stop
