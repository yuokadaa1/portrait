<html lang="ja">
<!DOCTYPE HTML>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" /> -->
  <link href="css/bootstrap.min.css" rel="stylesheet"><!--Bootstrap theme(Starter)-->
  <link href="css/flat-ui.min.css" rel="stylesheet"><!--Bootstrap theme(Starter)-->
  <link href="css/starter-template.css" rel="stylesheet"><!--Bootstrap theme(Starter)-->
  <link rel="shortcut icon" href="{{ url('/') }}/dist/img/favicon.ico">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  @yield('styles')
  <!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet"> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css" rel="stylesheet">

</head>
<body>

<!--=================================================
Navbar
==================================================-->

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
  <!-- スマートフォンサイズで表示されるメニューボタンとテキスト -->
  <div class="navbar-header">
  <!-- タイトルなどのテキスト -->
  <a class="navbar-brand" href="#">@yield('title')</a>
  </div>
  </div>
</nav>

<div class="container" style="margin-top: 40px;">
  @yield('content')
</div><!-- /.container -->

<footer class="footer">
  <div class="container">
  <p class="text-muted">@yield('title')</p>
  </div>
</footer>

<!-- Bootstrap core JavaScript
  ================================================== -->
<!-- <script src="{{ url('/') }}/dist/js/vendor/jquery.min.js"></script> -->
<script src="/js/jquery.min.js"></script>
<script src="/js/video.js"></script>
<script src="/js/flat-ui.min.js"></script>

<script src="/js/prettify.js"></script>
<script src="/js/application.js"></script>

@yield('scripts')
</body>
</html>
