<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Mondo QIF Exporter</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
	<div class="container">
      <nav class="navbar navbar-default">
	    <div class="container-fluid">
		  <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#global-navbar-collapse" aria-expanded="false">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Mondo QIF Exporter</a>
		  </div>
		  <div class="collapse navbar-collapse" id="global-navbar-collapse">
			<ul class="nav navbar-nav">
			  <li><a href="/">Home</a></li>
			  <li><a href="/accounts">Accounts</a></li>
			</ul>
		  </div>
	    </div>
      </nav>
      @yield('content')
	</div>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap-3.3.6.min.js"></script>
  </body>
</html>
