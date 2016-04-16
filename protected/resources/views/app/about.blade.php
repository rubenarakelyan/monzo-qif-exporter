@extends('app.layouts.default')

@section('title', 'About Mondo QIF Exporter')

@section('content')

      <div class="row">
	    <div class="col-md-10 col-md-offset-1">
          <p>Mondo QIF Exporter is a simple tool that allows anyone with a <a href="https://getmondo.co.uk/" target="_blank">Mondo</a> pre-paid card to export their transactions as a <abbr title="Quicken Interchange Format" class="initialism">QIF</abbr> file. QIF files can be imported into many accounting applications, including <a href="http://www.quicken.com" target="_blank">Intuit Quicken</a>, <a href="https://www.microsoft.com/en-GB/download/details.aspx?id=20738" target="_blank">Microsoft Money</a>, <a href="http://gnucash.org" target="_blank">GnuCash</a> and <a href="https://www.iggsoftware.com/banktivity/" target="_blank">Banktivity</a>.</p>
          <p>The tool also offers a <abbr title="Comma-Separated Values" class="initialism">CSV</abbr> file download option for maximum compatibility, and if you wish to import the data into a spreadsheet application.</p>
          <p>Would you like to suggest a new feature, or have you found a bug? Open an <a href="https://github.com/rubenarakelyan/mondo-qif-exporter/issues" target="_blank">issue</a> on GitHub and I'll take a look.</p>
	    </div>
      </div>

@stop
