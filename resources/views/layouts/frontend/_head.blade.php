<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>{{isset($title)?$title:config('app.name')}}</title>

<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="Porto - Bootstrap eCommerce Template">
<meta name="author" content="SW-THEMES">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('assets/frontend/assets/images/icons/dailydeals.ico') }}">

<!-- Plugins CSS File -->
<link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/bootstrap.min.css') }}">

<!-- Main CSS File -->
<link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/style.min.css') }}">
