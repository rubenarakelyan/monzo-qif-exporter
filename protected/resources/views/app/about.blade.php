@extends('app.layouts.default')

@section('title', 'About Mondo QIF Exporter')

@section('content')

      <div class="row">
	    <div class="col-md-10 col-md-offset-1">
		  <h3>What is Mondo QIF Exporter?</h3>
          <p>Mondo QIF Exporter is a simple tool that allows anyone with a <a href="https://getmondo.co.uk/" target="_blank">Mondo</a> pre-paid card to export their transactions as a <abbr title="Quicken Interchange Format" class="initialism">QIF</abbr> file. QIF files can be imported into many accounting applications, including <a href="http://www.quicken.com" target="_blank">Intuit Quicken</a>, <a href="https://www.microsoft.com/en-GB/download/details.aspx?id=20738" target="_blank">Microsoft Money</a>, <a href="http://gnucash.org" target="_blank">GnuCash</a> and <a href="https://www.iggsoftware.com/banktivity/" target="_blank">Banktivity</a>.</p>
          <p>The tool also offers a <abbr title="Comma-Separated Values" class="initialism">CSV</abbr> file download option for maximum compatibility, and if you wish to import the data into a spreadsheet application.</p>
          <h3>Is it safe for me to give you my account details?</h3>
          <p>Yes. Mondo has a secure API that this tool uses to retrieve your transactions. When you first visit and click through to the accounts page, you will be redirected to Mondo's site, where you can give permission for this tool to get your transactions. This permission only lasts a few hours before a new one is required.</p>
          <p>This tool does not have any database attached to it, and your transactions are never stored on the server - they are retrieved from Mondo every time they are required. The only thing that is stored is the token that we get when you give us permission.</p>
          <p>The full source code for this tool is available on <a href="https://github.com/rubenarakelyan/mondo-qif-exporter" target="_blank">GitHub</a>, where it can be inspected.</p>
          <h3>Contact</h3>
          <p>Would you like to suggest a new feature, or have you found a bug? Open an <a href="https://github.com/rubenarakelyan/mondo-qif-exporter/issues" target="_blank">issue</a> on GitHub and I'll take a look.</p>
          <h3>To Do</h3>
          <ul>
	        <li>Show pages when there are many transactions</li>
	        <li>Allow downloading only a subset of transactions</li>
          </ul>
	    </div>
      </div>

@stop
