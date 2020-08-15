<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="/css/i.css">
	<link rel="stylesheet" type="text/css" href="/css/m.css">
	<style type="text/css">
		body {
			display: flex;
			min-height: 100vh;
			flex-direction: column;
		}

		main {
			flex: 1 0 auto;
		}

		i[t3rem] {
			font-size: 3rem !important;
		}

		a.brand-logo i.material-icons {
			position: relative;
			left: 7px;
		}

		h3[main-header]{
			font-weight: 200;
		}

		h3 {
			font-weight: 200;
		}

		h4[main-header]{
			font-weight: 350;
		}
		h5[main-header] {
			font-weight: 400;
		}

		a[data-target="slide-out"] {
			cursor: pointer;
		}
	</style>
	@yield('head')
</head>
<body>
	<header>
		<nav class=" purple darken-2">
			<div class="nav-wrapper container">
				<a data-target="slide-out" class="sidenav-trigger">
					<i class="material-icons">menu</i>
				</a>

				<a href="/" 
					class="brand-logo tooltipped" 
					data-position="bottom" 
					data-tooltip="Go to home page"
				>
					<i class="material-icons" t3rem>home</i>
				</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a class="tooltipped" 
							href="/search"
							data-tooltip="Search for a potential fraudulent address">
							<i class="material-icons left">search</i>Search</a></li>
					<li><a class="tooltipped" 
							href="/report"
							data-tooltip="Report a fraudulent address">
							<i class="material-icons left">warning</i>Report</a></li>
					<!-- <li><a href="collapsible.html">JavaScript</a></li> -->
					@yield('header')
				</ul>
			</div>
		</nav>

  <ul id="slide-out" class="sidenav">
    <li><a href="/search"><i class="material-icons">search</i>Search</a></li>
    <li><a href="/report"><i class="material-icons">warning</i>Report</a></li>
  </ul>


	</header>
	<main>
		<div class="container">
		<div class="row">
		<div class="col s12">
			@yield('main')
		</div>
		</div>
		</div>
	</main>
	<footer class="page-footer purple darken-2">@yield('footer')

		<div class="container">
			<div class="row">
				<div class="col s6">
					<h5 class="white-text">Useful links</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="{{ route('about') }}">About</a></li>
						<li><a class="grey-text text-lighten-3" href="{{ route('report') }}">Report address</a></li>
						<li><a class="grey-text text-lighten-3" rel="nofollow" target="_blank" href="https://github.com/tgbv/crypto-scam/blob/beta/README.md#privacy-statement-and-terms-of-service">Privacy & ToS</a></li>
					</ul>
				</div>
				<div class="col s6">
					<h5 class="white-text">Resources</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" rel="nofollow" target="_blank" href="https://github.com/tgbv/crypto-scam/blob/beta/README.md#api-reference">API reference</a></li>
						<li><a class="grey-text text-lighten-3" rel="nofollow" target="_blank" href="https://github.com/tgbv/crypto-scam">Github</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer-copyright purple darken-3">
			<div class="container">
				© 2020 Crypto Scam contributors
				<a class="grey-text text-lighten-4 right" rel="nofollow" href="https://github.com/tgbv/crypto-scam/blob/beta/license.txt" target="_blank">MIT</a>
			</div>
		</div>

	</footer>

	@yield('a_footer')
	<!-- <script type="text/javascript" src="/js/j.js"></script> -->
	<script src="/js/qr-scanner.umd.min.js"></script>
	<script src="/js/m.js"></script>
	<script type="text/javascript">
		QrScanner.WORKER_PATH = '/js/qr-scanner-worker.min.js';

		var _ = function(e){
			return document.getElementById(e)
		};

		/*
		*	credits: https://stackoverflow.com/a/33928558
		*/
		var copyToClipboard = function(text) {
		    if (window.clipboardData && window.clipboardData.setData) {
		        // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
		        return clipboardData.setData("Text", text);

		    }
		    else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
		        var textarea = document.createElement("textarea");
		        textarea.textContent = text;
		        textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in Microsoft Edge.
		        document.body.appendChild(textarea);
		        textarea.select();
		        try {
		            return document.execCommand("copy");  // Security exception may be thrown by some browsers.
		        }
		        catch (ex) {
		            console.warn("Copy to clipboard failed.", ex);
		            return false;
		        }
		        finally {
		            document.body.removeChild(textarea);
		        }
		    }
		};

		/*
		*	fetches a QR code from file and returns content as string
		*/
		var scanQrCode = function(elem){
			return QrScanner.scanImage(elem.files[0])
						.then(res=>res)
						.catch(res=>{
							M.toast({html: 'Could not read QR code. Please upload an image with a better quality.'})
						})
		};

		(()=>{
			M.Sidenav.init(document.querySelectorAll('.sidenav'));
			M.Modal.init(document.querySelectorAll('.modal'));
			M.Materialbox.init(document.querySelectorAll('.materialboxed'));
			M.Tooltip.init(document.querySelectorAll('.tooltipped'));

			@if($errors->any())
				@foreach($errors->all() as $error)
					M.toast({
						html: "{{ $error }}",
						displayLength: 10000,
					});
				@endforeach
			@endif
		})();

		@yield('script')
	</script>
</body>
</html>