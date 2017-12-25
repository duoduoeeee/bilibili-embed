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
<meta name="referrer" content="no-referrer" />
<meta content="noindex" name="robots" />
<script type="application/javascript" src="//localhost/iframeResizer.contentWindow.min.js"></script>

<style>
  body.embed {
    background: transparent;
    margin: 0;
    padding-bottom:0;
  }
</style>
</head>
<body class=embed>
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
<div class="card" style="width:100%; height:auto;" onclick="window.open(\'' .$out_href. '\');">
  <img class="card-img-top" src="' .$out_media. '">
  <div class="card-body">
    <strong class="card-title">' .$out_title. '</strong>
    <p class="card-text">' .$out_desc. '</p>
    <div style="color:gray">
      <span><img src="category.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_category. '</span>
      <span><img src="danmaku.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_danmu. '</span>
      <span><img src="comment.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_reply. '</span>
      <span><img src="coin.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_coin. '</span>
      <span class="float-right"><img src="bilibili.svg" style="width:20px; height:auto;"></span>
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
  $out_bodyAssetTitle = $vars[10];

  echo '
<div class="card" style="width:100%; height:auto;" onclick="window.open(\'' .$out_href. '\');">';
  if(!empty($out_bodyAsset)) {
    echo '<img class="card-img-top" src="' .$out_bodyAsset. '">';
  }
  echo '<div class="card-body">
          <div class="media">
            <img class="mr-3 rounded-circle" style="width:64px; height:64px;" src=' .$out_avatar. '>
            <div class="media-body">
              <strong class="mt-0">' .$out_name. '</strong>
              <div style="color:grey; margin-top:-0.5rem;">'
              .$out_time
              .'</div>';
              if(!empty($out_tbody)) {
                echo $out_tbody;
              }
              if (!empty($out_bodyAssetTitle || $out_bodyAssetDesc)) {
                echo '
                  <div class="card">
                    <strong class="card-title">'
                    .$out_bodyAssetTitle
                    .'</strong>'
                    .'<p class="card-text">'
                    .$out_bodyAssetDesc
                    .'</p>
                  </div>';
                }
               echo '
                  <div style="color:gray">
                    <span><img src="like.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_like. '</span>
                    <span><img src="comment.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_reply. '</span>
                    <span><img src="fwd.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_fwd. '</span>
                    <span class="float-right"><img src="bilibili.svg" style="width:20px; height:auto;"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
';
}

else if($service === 'user') {
  $vars = parseBilibiliUser($resource);
  $out_href = $vars[0];
  $out_name = $vars[1];
  $out_media = $vars[2];
  $out_avatar = $vars[3];
  $out_attention = $vars[4];
  $out_fans = $vars[5];
  $out_signature = $vars[6];

  echo '
  <div class="card" style="width:100%; height:auto;" onclick="window.open(\'' .$out_href. '\');">
    <img class="card-img-top" src="' .$out_media. '">
    <div class="card-body">
      <div class="media">
        <img class="mr-3 rounded-circle" style="width:64px; height:64px;" src=' .$out_avatar. '>
        <div class="media-body">
        <strong class="mt-0">' .$out_name. '</strong>
        <p>'.$out_signature. '</p>
          <div style="color:gray">
          <span><img src="follow.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_attention. '</span>
          <span><img src="follower.svg" style="width:20px; height:auto; margin-right:0.5em;"></span><span style="margin-right:0.5rem;">' .$out_fans. '</span>
          <span class="float-right"><img src="bilibili.svg" style="width:20px; height:auto;"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
';
}

else {
  echo '
  <div class="card" style="width:100%; height:auto;" onclick="window.open(\'https://acg.tv/308040\');">
    <div class="card-body">
      <strong class="card-title">卡片被洛天依吃掉了 QAQ</strong>
      <p class="card-text">小笼包 叉烧包</p>
      <p class="card-text">奶黄芝麻豆沙包</p>
      <p class="card-text">大肉包 菜包</p>
      <p class="card-text">还有灌汤包</p>
      <p class="card-text">吃在人 命在天</p>
      <p class="card-text">亘古滔滔转眼间</p>
      <p class="card-text">唯席上 千年丰盛永不变</p>
      <span class="float-right"><img src="bilibili.svg" style="width:20px; height:auto;"></span>
    </div>
  </div>
  ';
}

echo '
</body>
</html>
';
?>
