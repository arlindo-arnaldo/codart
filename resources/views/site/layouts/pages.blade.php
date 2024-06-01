
<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>Reporter - @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="This is meta description">
	<meta name="author" content="Themefisher">
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="/site-assets/plugins/bootstrap/bootstrap.min.css">

	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="/site-assets/css/style.css">
</head>

<body>

@include('site.includes.header')

<main>
    @yield('content')    
</main>


@include('site.includes.footer')

<!-- # JS Plugins -->
<script src="/site-assets/plugins/jquery/jquery.min.js"></script>
<script src="/site-assets/plugins/bootstrap/bootstrap.min.js"></script>

<!-- Main Script -->
<script src="/site-assets/js/script.js"></script>

</body>
</html>