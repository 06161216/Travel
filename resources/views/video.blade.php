<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.webrtc.ecl.ntt.com/skyway-4.4.3.js"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <title>ビデオチャット</title>
</head>
<body>
 <video id="my-video" width="200px" autoplay muted playsinline></video>
 <p id="my-id"></p>
 <input id="their-id"></input>
 <button id="make-call">発信</button><br>
 <video id="their-video" width="800px" autoplay muted playsinline></video>
 <!--<div id="app"></div>-->
</body>
</html>