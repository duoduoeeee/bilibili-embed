<?php
header("Referer: https://api.bilibili.com");
require_once ('jinkela.php');

$service = isset($_GET['svc']) ? $_GET['service']: 'video'; //video, t, user
$resource = isset($_GET['res']) ? $_GET['res']: '7248433';

if($service === 'video') {
  $vars = parseVideoArchive($resource);
}
else if($service === 't') {
  $vars = parseBilibiliTweet($resource);
}
else if($service === 'user') {
  $vars = parseBilibiliUser($resource);
}
else {
  $vars = faultTolerance();
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body class="embed">
  <div class="card" style="width: 20rem; max-width=100%;">
    <img class="card-img-top" src="<?= $var ?>">
</body>
</html>
