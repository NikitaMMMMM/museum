<!DOCTYPE html>
<html lang="ru">

<head>
	@yield('head')
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
	@include('partials.site-header')
	

	<main class="container">
		@yield('content')
	</main>
	
	@yield('footer')

	@yield('scripts')
</body>

</html>