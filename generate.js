function processInput(inputtext){

//some lovable regex
var patternVideo = new RegExp(".+/av[0-9]{5,}"); //是视频
var patternVideoShort = new RegExp(".*acg\.tv\/[0-9]{5,}"); //是短链接式视频（形如“acg.tv/xxxxx”）
var patternT = new RegExp(".*t\.bilibili\.com\/[0-9]{10,}"); //是动态
var patternUser = new RegExp(".*space\.bilibili\.com\/[0-9]{5,}"); //是用户
var patternBangumiFalse = new RegExp(".*bangumi\.bilibili\.com\/anime\/[0-9]+"); //无法解释的番剧地址
var patternVideoShort = new RegExp(".+acg\.tv\/[0-9]{5,}") //是短链接式视频（形如“acg.tv/xxxxx”）
var patternT = new RegExp(".*t\.bilibili\.com\/[0-9]{10,}"); //是动态
var patternUser = new RegExp(".+space\.bilibili\.com\/[0-9]{5,}"); //是用户
var patternBangumiFalse = new RegExp(".+bangumi\.bilibili\.com\/anime\/[0-9]+"); //无法解释的番剧地址
var patternBangumi = new RegExp(".*www\.bilibili\.com\/bangumi\/play\/ep[0-9]+"); //正常的番剧地址

var isvideo = patternVideo.test(inputtext);
var issvideo = patternVideoShort.test(inputtext);
var istweet = patternT.test(inputtext);
var isuser = patternUser.test(inputtext);
var isnotbangumi = patternBangumiFalse.test(inputtext);
var isbangumi = patternBangumi.test(inputtext);

//to determine whether the regex ran successfully
if (isvideo === true || issvideo === true) { //是视频
  var svc = "video";
  var uid = inputtext.match(/\d{5,}/);
}

else if (istweet === true) { //是动态
  var svc = "t";
  var uid = inputtext.match(/\d{5,}/);
}

else if (isuser === true) { //是用户
  var svc = "user";
  var uid = inputtext.match(/\d{5,}/);
}

else if (isnotbangumi === true) { //是无法解释的番剧地址
  var svc = "bg";
}

else if (isbangumi === true) { //是番剧地址
  var svc = "bg";
  var uid = inputtext.match(/\d+/);
}

else { //gg
  var svc = '';
  var uid = '';
}

if (svc && uid) {
console.log(svc);
console.log(uid);
}

if (svc.replace(/(^\s*)|(\s*$)/g, "") === "bg" && !uid) {
  var preOutput = "It seems that you are attempting to embed a bangumi. Please try to embed one by entering any episode of that anime and copy&paste that address here so that it could be recognised correctly.";
}

else if (svc.replace(/(^\s*)|(\s*$)/g, "").length !=0 && uid[0].length !=0) {
var preOutput = "<iframe src=\"//badges.duoee.cn/embed.php?svc=" + svc + "&res=" + uid[0] +"\" id=\"jinkela\" scrolling=\"no\" style=\"width:30em; max-width:100%;\" frameBorder=\"0\"></iframe>" + '\n' +
"<script type=\"application/javascript\" src=\"//badges.duoee.cn/iframeResizer.min.js\"></script>" +'\n' +
"<script>iFrameResize([{log:false},{inPageLinks:true}], jinkela || iframe)</script>"
}


else {
  var preOutput = "Invalid URL. Try again.";
}
//绘制 html
return preOutput;
}
