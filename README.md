# bilibili-embed

embed bilibili video info, user info, bangumi info or user timeline feed on your own webpage

What is Embedding? [繁體中文](http://www.wibibi.com/info.php?tid=443) | [English](https://dev.twitter.com/web/embedded-tweets)

This project implements the following open source software:

- [iframeResizer](https://davidjbradshaw.github.io/iframe-resizer/).
- [Bootstrap](https://getbootstrap.com).

**Note** This project is not yet compatible with IE and Microsoft Edge

Use my service: <https://badges.duoee.cn>

## 1.1f "linsis"

changes:

- Now you may embed bangumi information with my service.
- Fixed a bug which causes iframes not automatically updating height of themselves

## 0.9a Public Beta

changes:

- Added bilibili badges including vip state and identity verification.
- fixing a bug causing metadata not showing up at the bottom of the embed.
- fixing a bug causing tweets including short videos not recognised.

## 0.9 Public Beta

In this version we have fixed a bunch of bugs, finally making the software usable.

By far you may embed the following resources from Bilibili:

- Videos: you'll need that AV number (formally named `aid`, like `https://www.bilibili.com/av15519586`).
- Users: You have to provide that `mid` (like the number included in this URL: https://space.bilibili.com/282994).
- Bilibili Tweets (**experimental.** See the "Known Bugs" section): the UID of that tweet (like the number included in this URL: `https://t.bilibili.com/65280612388150762`).

## How to use

To install, you have to put everything inside this project in your webroot. you will need an Apache or Nginx powered web server.

**Important** Before you begin, you ought to modify these lines:

- `generate.js:62` modify the iframe src as well as the script src so that it suits your own instance

To embed cards to foreign pages, simply copy and paste the URL of your resource (starting with `http` or `https` of course) in the big input box on `index.html` and the embed code will appear below automatically.

## Request Formats

- Videos: `https://www.bilibili.com/video/av8086541`
- Animes: `https://www.bilibili.com/bangumi/play/ep115184`
- Users: `https://space.bilibili.com/282994`
- Tweet: `https://t.bilibili.com/65280612388150762`

## Known Bugs

## Todo list

- Fix Bugs
- If you want something else more interesting on the card please let me know by posting on the issues page.
