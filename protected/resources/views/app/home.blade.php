@extends('app.layouts.default')

@section('title', 'Export your Monzo transactions to QIF')

@section('content')

      <div class="row">
	    <div class="col-md-10 col-md-offset-1">
          <p>Welcome to the Monzo QIF Exporter.</p>
          <p>To get started, <a href="/accounts">choose a Monzo account</a> to view transactions. <strong>Currently, <a href="https://github.com/rubenarakelyan/monzo-qif-exporter/issues/1">this can only be used by the app creator</a>, so you'll need to host your own copy of the site.</strong></p>
	    </div>
      </div>

@stop
