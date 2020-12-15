<?php

// prevent string injection attacks
function sanitize_string($str) {
  $str = str_replace("'", '', $str);
  $str = str_replace("\n", '', $str);
  $str = str_replace("<", '', $str);
  return $str;
}

$next = $_GET['next'];
if ($next) {
  $next = sanitize_string($next);
}

// waiting time in seconds
$time_left = 3;
if (isset($_GET['time'])) {
  $time_left = intval($_GET['time']);
}

$title = 'Odota...';
if (isset($_GET['title'])) {
  $title = sanitize_string($_GET['title']);
}

// favicon, png
$icon64 = null;
if (isset($_GET['icon64'])) {
  $icon64 = sanitize_string($_GET['icon64']);
}

// apple touch icon (png), used icon for homescreen
$icon180 = null;
if (isset($_GET['icon180'])) {
  $icon180 = sanitize_string($_GET['icon180']);
}
?>
<!doctype html>
<html lang="fi">
  <head>
    <meta charset="utf-8">
    <style>
      body {
        background-color: white;
        margin: 0;
        width: 100%;
        text-align: center;
        font-family: "Roboto", "Open Sans", "Segoe UI", Tahoma, sans-serif;
      }

      #stop {
        color: #ddd;
        user-select: none;
        cursor: pointer;
      }

      #stopped {
        display: none;
      }
    </style>
    <title><?php echo $title; ?></title>

    <?php if ($icon64): ?>
      <link rel="icon" type="image/png" sizes="64x64" href="<?php echo $icon64; ?>" />
    <?php endif; ?>

    <?php if ($icon180): ?>
      <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $icon180; ?>" />
    <?php endif; ?>
  </head>

  <?php if ($next): ?>
    <body onload="run()">
      <div id="running">
        <h1>ODOTA...<br><span id="counter"></span></h1>
        <div onclick="stop()" id="stop">PYSÄYTÄ</div>
      </div>

      <div id="stopped">
        <h1>PYSÄYTETTY</h1>
        <p>Voit nyt lisätä tämän sivun aloitusnäyttöön.</p>
      </div>

  <?php else: ?>
    <body>
      <h2>Virhe: anna next-parametri</h2>
  <?php endif; ?>

    <script>
      var timeoutHandle;
      var intervalHandle;
      var counter;
      var timeLeft = <?php echo $time_left; ?>

      function draw() {
        if (timeLeft > 0) {
          counter.innerHTML = '' + timeLeft;
        } else {
          counter.innerHTML = '0';
        }
      }

      function tick() {
        timeLeft--;
        draw();
      }

      function redirect() {
        document.location.href = '$next';
      }

      function stop() {
        document.getElementById('running').style.display = 'none';
        document.getElementById('stopped').style.display = 'block';
        clearTimeout(timeoutHandle);
        clearInterval(intervalHandle);
      }

      function run() {
        counter = document.getElementById('counter');
        timeoutHandle = setTimeout(redirect, <?php echo $time_left * 1000; ?>);
        draw();
        intervalHandle = setInterval(tick, 1000);
      }
    </script>
  </body>
</html>
