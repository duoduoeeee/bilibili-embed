# bilibili-embed

embed bilibili video info, user info or user timeline feed on your own webpage

What is Embedding? [繁體中文](http://www.wibibi.com/info.php?tid=443) | [English](https://dev.twitter.com/web/embedded-tweets)

**Attention** This project is under development

This project implements the following open source software:

- [iframeResizer](https://davidjbradshaw.github.io/iframe-resizer/).
- [Bootstrap](https://getbootstrap.com).

## 1.1gb "marblue"

- tweets are now somehow working all properly. i didn't change anything = =
- adding short video identification badge to tweet cards.

now all bilibili tweets **except retweets** are recognised properly by the card plugin.

## 1.1ga "mh"

changes:

- Fixed a bug causing iframes occasionally refuse to update heights of themselves
- Fixed a bug causing users being redirected to the api json file instead of the details page when embedding a bangumi

It is suggested that all users download this version.

Known bugs:

- bilibili tweets are not recognised correctly. Looking into the issue.
- **It is confirmed that my embed tool is incompatible with a Typecho plugin [EditorMD](https://github.com/DT27/EditorMD/). Do not enable that plugin if you use Typecho as your blog system.**

## 1.1g "hanser"

changes:

- Fixing a bug causing embeds not automatically adjusting their heights when there are multiple embeds on a same webpage
- following up api changes of bilibili that causes user avatars and headers image not loading

## How to use

To install, you have to put everything inside this project in your webroot. you will need an Apache or Nginx powered web server.

To embed cards to foreign pages, simply open up the `index.html` file and copy&paste the corresponding urls into that big input bar and the embed code should automatically appear below. Copy all the code provided and paste it in your blog.

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

- [ ] Fix Bugs
- [x] Add some more info to cards, like authorized account, gender and grade information, etc. to fully populate the cards.
- [ ] Add preview below the input bar just like twitter does
- [ ] Add more info to bangumi cards
- [ ] Let words on cards support truncating and line-breaking
