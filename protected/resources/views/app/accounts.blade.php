@extends('app.layouts.default')

@section('title', 'List of your Mondo accounts')

@section('content')

      <div class="row">
	    <div class="col-md-10 col-md-offset-1">
          @if ($accounts === null)
          <p>There are no accounts to display.</p>
          @else
          <table class="table table-hover">
	        <thead>
	          <tr>
		        <th>Account description</th>
		        <th>Created</th>
		        <th></th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($accounts as $account)
	          <tr>
		        <td>{{ $account->description }}</td>
		        <td>{{ (new \DateTime($account->created))->format('j F Y') }}</td>
		        <td><a href="/transactions?account_id={{ $account->id }}">Choose</a></td>
	          </tr>
	          @endforeach
	        </tbody>
          </table>
          @endif
	    </div>
      </div>

@stop
