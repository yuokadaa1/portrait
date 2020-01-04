<html lang="ja">
<!DOCTYPE HTML>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title')</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- bootstrap.css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <!-- bootstrap.jsの使用にはjquery.jsが必須（jqueryが先） -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  @yield('styles')

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

@yield('scripts')
</body>
</html>
