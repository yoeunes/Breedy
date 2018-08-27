<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
	<!-- Meta Information -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title', config('app.name'))</title>

	<!-- Fonts -->
	<link href='https://fonts.gooxgleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'
				type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

	<!-- CSS -->
	@if(!Request::is('register'))
		<link href="{{ mix(Spark::usesRightToLeftTheme() ? 'css/app-rtl.css' : 'css/app.css') }}" rel="stylesheet">
	@endif

	<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
	<link rel="stylesheet" href="{{ mix('css/styles.css') }}">

	<!-- Scripts -->

	@yield('scripts', '')
	@yield('scripts-more')
	<script src="https://unpkg.com/element-ui/lib/index.js"></script>
	<!-- Global Spark Object -->
	<script>
      window.Spark = <?php echo json_encode(array_merge(
          Spark::scriptVariables(), []
      )); ?>;
	</script>
	<!-- Global App Object -->
	<script>
      window.Laravel = <?php echo json_encode(array_merge(
          \App\Configuration\ParamsScriptVariables::scriptVariables(), []
      )); ?>
	</script>

</head>
<body class="@yield('custom-class')">
<div id="spark-app" v-cloak>
	<!-- Navigation -->
@if (Auth::check())
	@include('spark::nav.user')
@else
	{{--@include('spark::nav.guest')--}}
@endif

<!-- Main Content -->
	<el-container class="">
		@if (Auth::check() && Auth::user()->hasTeams())
			@if(str_contains(Request::url(), 'settings') == true )
				@include('aside-without-router')
			@else
				@include('aside')
			@endif
		@endif
		@yield('content')
	</el-container>

	<!-- Application Level Modals -->
	@if (Auth::check())
		@include('spark::modals.notifications')
		@include('spark::modals.support')
		@include('spark::modals.session-expired')
	@endif
</div>

<!-- JavaScript -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="/js/sweetalert.min.js"></script>
</body>
</html>
