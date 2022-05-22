<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company Stock</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link type="text/css"  rel="stylesheet" href="{{asset('css/custom.css')}}">
    @yield('addstyle')
</head>
<body>
<div class="container">
    @yield('content')
</div>
<script type="text/javascript">
    var url = "{{ url("/") }}"
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    @yield('addscript')
</body>
</html>
