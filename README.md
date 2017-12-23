# bilibili-embed

embed bilibili video info, user info or user timeline feed on your own webpage

What is Embedding? [繁體中文](http://www.wibibi.com/info.php?tid=443) | [English](https://dev.twitter.com/web/embedded-tweets)

**Attention** This project is under development

## 0.9 Public Beta

In this version we have fixed a bunch of bugs, finally making the software usable.

This project implements the following open source software:

- [iframeResizer](https://davidjbradshaw.github.io/iframe-resizer/).
- [Bootstrap](https://getbootstrap.com).

By far you may embed the following resources from Bilibili:

- Videos: you'll need that AV number (formally named `aid`, like `https://www.bilibili.com/av15519586`).
- Users: You have to provide that `mid` (like the number included in this URL: https://space.bilibili.com/282994).
- Bilibili Tweets (**experimental.** See the "Known Bugs" section): the UID of that tweet (like the number included in this URL: `https://t.bilibili.com/65280612388150762`).

## How to use

To install, you have to put everything inside this project in your webroot. you will need an Apache or Nginx powered web server.

To embed cards to foreign pages, simply put the following html stuff:

```HTML
<iframe src="//localhost/embed.php?svc=t&res=65271275128197802" id="jinkela" scrolling="no" style="width:30em; max-width:100%;" frameBorder="0"></iframe>
<script type="application/javascript" src="//localhost/iframeResizer.min.js"></script>
<script>iFrameResize([{log:false},{inPageLinks:true}], jinkela || iframe)</script>
```

- The iframe src should be your request. See below for available request formats.
- Replace `localhost` with domain or hostname of your own instance.

## Request Formats

- Videos: `https://example.com/embed.php?svc=video&res=15519586`
- Users: `https://example.com/embed.php?svc=user&res=282994`
- Tweet: `https://example.com/embed.php?svc=t&res=65280612388150762`

## Known Bugs

- Some types of Bilibili tweets are not yet supported, including retweeted tweets, tweets including short videos.

## Todo list

- Fix Bugs
- Add some more info to cards, like authorized account, gender and grade information, etc. to fully populate the cards.
