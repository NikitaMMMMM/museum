<!DOCTYPE html>
<html lang="ru">
<head>
  @section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @show
</head>
<body>
  @section('header')
    @include('partials.site-header')
  @show

  @yield('content')

  @section('footer')
    @include('partials.site-footer')
  @show

  @section('scripts')
    <script src="js/app.js"></script>
  @show
</body>
</html>

