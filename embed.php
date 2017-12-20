<?php
header("Referer: https://api.bilibili.com");
require_once ('jinkela.php');

$service = isset($_GET['svc']) ? $_GET['svc']: 'video'; //video, t, user
$resource = isset($_GET['res']) ? $_GET['res']: '7248433';

//基本操作
echo '
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body class="embed">
';
?>

<?php
if($service === 'video') {
  $vars = parseVideoArchive($resource);
  $out_href = $vars[0];
  $out_media = $vars[1];
  $out_title = $vars[2];
  $out_views = $vars[3];
  $out_reply = $vars[4];
  $out_coin = $vars[5];
  $out_danmu = $vars[6];
  $out_category = $vars[7];
  $out_desc = $vars[8];

  echo '
<div class="card" style="width: 20rem; max-width=100%;" onclick="window.open(\'' .$out_href. '\');">
  <img class="card-img-top" src="' .$out_media. '">
  <div class="card-body">
    <h6 class="card-title">' .$out_title. '</h6>
    <p class="card-text"><strong>' .$out_title. '</strong></p>
    <div style="color:gray">
      <span>分区</span><span style="margin-right:0.5rem;">' .$out_category. '</span>
      <span>弹幕</span><span style="margin-right:0.5rem;">' .$out_danmu. '</span>
      <span>评论</span><span style="margin-right:0.5rem;">' .$out_reply. '</span>
      <span>硬币</span><span style="margin-right:0.5rem;">' .$out_coin. '</span>
    </div>
  </div>
</div>
';
}

else if($service === 't') {
  $vars = parseBilibiliTweet($resource);
  $out_href = $vars[0];
  $out_name = $vars[1];
  $out_avatar = $vars[2];
  $out_time = $vars[3];
  $out_fwd = $vars[4];
  $out_like = $vars[5];
  $out_reply = $vars[6];
  $out_tbody = $vars[7];
  $out_bodyAsset = $vars[8];
  $out_bodyAssetDesc = $vars[9];

  echo '
<div class="card" style="width: 20rem; max-width=100%;" onclick="window.open(\'' .$out_href. '\');">';
  if(!empty($out_bodyAsset)) {
    echo '<img class="card-img-top" src="' .$out_media. '">';
  }
  echo '<div class="card-body">
          <div class="media">
            <img class="mr-3 rounded-circle" style="width:64px; height:64px;" src=' .$out_avatar. '>
            <div class="media-body">
              <h6 class="mt-0">' .$out_name. '></h6>
              <div style="color:grey; margin-top:-0.5rem;">'
              .$out_time;
            if(){} //徽章判定
        echo '</div>'
          .$out_desc
      .'</div>
        </div>
        </div>
        </div>';
}

else if($service === 'user') {
  $vars = parseBilibiliUser($resource);
}
else {
  $vars = faultTolerance();
}

echo '
</body>
</html>
';
