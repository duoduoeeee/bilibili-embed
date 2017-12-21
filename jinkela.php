<?php

function parseVideoArchive($resid) {
  $requestURL = 'https://api.bilibili.com/x/article/archives?ids=' .$resid. '&jsonp=jsonp';
  $biliRawDocument = file_get_contents($requestURL);
  $ObjectBiliRawDocument = json_decode($biliRawDocument);

  $resHTMLObject = 'https://www.bilibili.com/video/av' .$resid. '/';
  $resCoverObject = $ObjectBiliRawDocument -> data -> $resid -> pic;
  $resTitleObject = $ObjectBiliRawDocument -> data -> $resid -> title;
  $resViewsObject = $ObjectBiliRawDocument -> data -> $resid -> stat -> view;
  $resCommentObject = $ObjectBiliRawDocument -> data -> $resid -> stat -> reply;
  $resCoinObject = $ObjectBiliRawDocument -> data -> $resid -> stat -> coin;
  $resDanmuObject = $ObjectBiliRawDocument -> data -> $resid -> stat -> danmaku;
  $resCategoryObject = $ObjectBiliRawDocument -> data -> $resid -> tname;
  $resArticleDescObject = $ObjectBiliRawDocument -> data -> $resid -> desc;

  return array($resHTMLObject,
                $resCoverObject,
                $resTitleObject,
                $resViewsObject,
                $resCommentObject,
                $resCoinObject,
                $resDanmuObject,
                $resCategoryObject,
                $resArticleDescObject);
}

/***
转换时间的代码来自这里
http://blog.sina.com.cn/s/blog_5fd841bf0100u3gn.html
***/

function transTime($time) {
    $rtime = date("m-d H:i",$time);
    $htime = date("H:i",$time);

    $time = time() - $time;

    if ($time < 60) {
        $str = '刚刚';
    }
    elseif ($time < 60 * 60) {
        $min = floor($time/60);
        $str = $min.'分钟前';
    }
    elseif ($time < 60 * 60 * 24) {
        $h = floor($time/(60*60));
        $str = $h.'小时前 '.$htime;
    }
    elseif ($time < 60 * 60 * 24 * 3) {
        $d = floor($time/(60*60*24));
        if($d==1)
           $str = '昨天 '.$rtime;
        else
           $str = '前天 '.$rtime;
    }
    else {
        $str = $rtime;
    }
    return $str;
}

function parseBilibiliTweet($resid) {
  $requestURL = 'https://api.vc.bilibili.com/dynamic_svr/v1/dynamic_svr/get_dynamic_detail?dynamic_id=' .$resid;
  $biliRawDocument = file_get_contents($requestURL);
  $ObjectBiliRawDocument = json_decode($biliRawDocument);

  $resHTMLObject = 'https://t.bilibili.com/' .$resid;
  $resNameObject = $ObjectBiliRawDocument -> data -> card -> desc -> user_profile -> info -> uname;
  $resAvatarObject = $ObjectBiliRawDocument -> data -> card -> desc -> user_profile -> info -> face;
  //时间得处理成友好的格式输出（总不能把时间戳直接输出去吧）
  $resTimestampObject = $ObjectBiliRawDocument -> data -> card -> desc -> timestamp;
  $resTimeObject = transTime($resTimestampObject);
  //很友好了现在
  $resForwardObject = $ObjectBiliRawDocument -> data -> card -> desc -> repost;
  $resLikeObject = $ObjectBiliRawDocument -> data -> card -> desc -> like;
  $resCommentRawDocument = file_get_contents('https://api.bilibili.com/x/v2/reply?jsonp=jsonp&oid=' .$resid. '&type=17');
  $processResCommentRawDocument = json_decode($resCommentRawDocument);
  if(!empty($processResCommentRawDocument -> data)) {
    $resCommentObject = $processResCommentRawDocument -> data -> page -> count;
  }
  else{
    $resCommentObject = 0;
  }
  //处理动态内容，要去掉转义字符以及引号
  $resTweetObject = $ObjectBiliRawDocument -> data -> card -> card;
  /***Processing REGEX operation of $resTweetObject***/
  $patterns_tweet = array();
    $patterns_tweet[0] = '/\\\/';
    $patterns_tweet[1] = '/^"/';
    $patterns_tweet[2] = '/"$/';
  $replacements_tweet = array();
    $replacements_tweet[0] = '';
    $replacements_tweet[1] = '';
    $replacements_tweet[2] = '';
  ksort($patterns_tweet);
  ksort($replacements_tweet);
  $resTweetProcess = preg_replace($patterns_tweet, $replacements_tweet, $resTweetObject); //real json format
  $ObjectResTweet = json_decode($resTweetProcess);
  var_dump($ObjectResTweet);
  //输出的时候如果有视频卡片、专栏文章卡片、短视频卡片或者图片的话要显示。
  //下面是一些判断用的变量

  if(!empty($ObjectResTweet -> aid)) { //是视频
    $resTweetBodyObject = $ObjectResTweet -> dynamic; //大卡片内容
    $resTweetBodyAsset = $ObjectResTweet -> pic; //大卡片头图
    $resTweetBodyAssetTitle = $ObjectResTweet -> title; //小卡片标题
    $resTweetBodyAssetDesc = $ObjectResTweet -> desc; //小卡片内容
  }
  else if (!empty($ObjectResTweet -> words)) { //是专栏文章
    $resTweetBodyObject = '';
    $resTweetBodyAsset = $ObjectResTweet -> banner_url;
    $resTweetBodyAssetTitle = $ObjectResTweet -> title;
    $resTweetBodyAssetDesc = $ObjectResTweet -> summary;
  }
  else if (!empty($ObjectResTweet -> item -> pictures_count)) { //是图片
    $resTweetBodyObject = $ObjectResTweet -> item -> description;
    $resTweetBodyAsset = $ObjectResTweet -> item -> pictures[0] -> img_src;
    $resTweetBodyAssetTitle = '';
    $resTweetBodyAssetDesc = '';
  }
  else if (!empty($ObjectResTweet -> item -> cover -> video_size)) { //是短视频
    $resTweetBodyObject = $ObjectResTweet -> item -> cover -> description;
    $resTweetBodyAsset = $ObjectResTweet -> item -> cover -> default;
    $resTweetBodyAssetTitle = '';
    $resTweetBodyAssetDesc = '';
  }
  else {
    $resTweetBodyObject = '获取动态详情失败。';
    $resTweetBodyAsset = '';
    $resTweetBodyAssetTitle = '';
    $resTweetBodyAssetDesc = '目前，我们尚不支持插入转发的内容。';
  }
  return array($resHTMLObject,
                $resNameObject,
                $resAvatarObject,
                $resTimeObject,
                $resForwardObject,
                $resLikeObject,
                $resCommentObject,
                $resTweetBodyObject,
                $resTweetBodyAsset,
                $resTweetBodyAssetDesc,
                $resTweetBodyAssetTitle);
}

function parseBilibiliUser($resid) {
  $requestURL = 'https://api.bilibili.com/cardrich?mid=' .$resid;
  $biliRawDocument = file_get_contents($requestURL);
  $ObjectBiliRawDocument = json_decode($biliRawDocument);

  $resHTMLObject = 'https://space.bilibili.com/' .$resid;
  $resUnameObject = $ObjectBiliRawDocument -> data -> card -> name;
  $resBGCoverObject = $ObjectBiliRawDocument -> data -> space -> s_img;
  /***Processing REGEX of $resBGCoverObject***/
  $patterns_bgcover = array();
    $patterns_bgcover[0] = '/^http:/';
  $replacements_bgcover = array();
    $replacements_bgcover[0] = 'https:';
  ksort($patterns_bgcover);
  ksort($replacements_bgcover);
  $resBGCoverObjectSecure = preg_replace($patterns_bgcover, $replacements_bgcover, $resBGCoverObject);
  /***处理完毕***/
  $resAvatarObject = $ObjectBiliRawDocument -> data -> card -> face;
  /***Processing REGEX of $resAvatarObject***/
  $patterns_avatar = array();
    $patterns_avatar[0] = '/^http:/';
  $replacements_avatar = array();
    $replacements_avatar[0] = 'https:';
  ksort($patterns_avatar);
  ksort($replacements_avatar);
  $resAvatarObjectSecure = preg_replace($patterns_avatar, $replacements_avatar, $resAvatarObject); //同上
  /***处理完毕***/
  $resAttentionObject = $ObjectBiliRawDocument -> data -> card -> friend;
  $resFansObject = $ObjectBiliRawDocument -> data -> card -> fans;
  $resSignatureObject = $ObjectBiliRawDocument -> data -> card -> sign;

  return array($resHTMLObject,
                $resUnameObject,
                $resBGCoverObjectSecure,
                $resAvatarObjectSecure,
                $resAttentionObject,
                $resFansObject,
                $resSignatureObject);
}

function faultTolerance() {

}

?>
