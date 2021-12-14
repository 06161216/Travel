{{--<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
	<div id="main"></div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>--}}
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Rectチャット</title>
    /*chromeなどのタブに表示する名前の設定*/
  </head>
  <body>
    <div id="root"></div>
    <script src="{{ asset('js/app.js') }}"></script>
    /*webapckによって作成されたbundle.jsが読み込まれる。*/
　　/*つまり、src/以下のファイルで書いたcomponentが反映される*/
  </body>
</html>