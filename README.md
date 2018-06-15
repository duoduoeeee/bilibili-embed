# bilibili-embed

embed bilibili video info, user info or user timeline feed on your own webpage

What is Embedding? [繁體中文](http://www.wibibi.com/info.php?tid=443) | [English](https://dev.twitter.com/web/embedded-tweets)

This project implements the following open source software:

- [iframeResizer](https://davidjbradshaw.github.io/iframe-resizer/).
- [Bootstrap](https://getbootstrap.com).

## How to use

It is as simple as putting everything in your webroot and open up the `index.html` file in your browser.

By far this service recognises the following types of URLs:

- Normal Videos (like https://www.bilibili.com/video/av20204904)
- Shortlinks (like https://acg.tv/20204904)
- Bilibili user spaces (like https://space.bilibili.com/655181)
- Bilibili tweets (like https://t.bilibili.com/128245374112555223, retweets not supported)
- Bangumis (like https://www.bilibili.com/bangumi/play/ep103878)

The page will automatically generate respective embed codes for your convenience. Copy and use them in your blog or something

**Attention** This project is under development by far considering possible random API changes by bilibili itself. If you encounter issues please let me know here right on GitHub. Besides, due to api limitations we are unable to parse information directly from a details page of a bangumi. Still looking for workarounds.

## 1.1gc "Shimo"

changes:

- fixed some bugs relating to bangumi card presentation. yeah bilibili has changed its api again.

come on and stop changing your %%%%%% apis!!

it is recommended that all users update to this version.

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

## Known Bugs

- Some types of Bilibili tweets are not yet supported, including retweeted tweets, tweets including short videos.

## Todo list

[] Fix Bugs
[x] Add some more info to cards, like authorized account, gender and grade information, etc. to fully populate the cards.
[] Add support for retweets
[] Add support for column articles
[] Add support for music
[] Add blurry background effect to cards
