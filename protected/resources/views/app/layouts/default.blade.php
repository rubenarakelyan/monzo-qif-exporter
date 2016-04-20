<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Mondo QIF Exporter</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script>
	    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-74204106-2', 'auto');
		ga('send', 'pageview');
	</script>
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
			<a class="navbar-brand" href="/">Mondo QIF Exporter</a>
		  </div>
		  <div class="collapse navbar-collapse" id="global-navbar-collapse">
			<ul class="nav navbar-nav">
			  <li><a href="/">Home</a></li>
			  <li><a href="/accounts">Accounts</a></li>
			  <li><a href="/about">About</a></li>
			</ul>
		  </div>
	    </div>
      </nav>
      @yield('content')
      <footer>
	    <div class="row">
		  <div class="col-md-10 col-md-offset-1">
			<p class="small"><span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type">Mondo QIF Exporter</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="https://ruben.am/" property="cc:attributionName" rel="cc:attributionURL" target="_blank">Ruben Arakelyan</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.</p>
		  </div>
	    </div>
      </footer>
	</div>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap-3.3.6.min.js"></script>
    <script src="js/bootstrap-datepicker-1.5.1.min.js"></script>
  </body>
</html>
