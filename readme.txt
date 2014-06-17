=== Plugin Name ===
Contributors: Ipstenu
Donate link: http://halfelf.org/plugins/fonticode
Tags: font icons, shortcode, genericons, font awesome
Requires at least: 3.9
Tested up to: 3.9
Stable tag: 1.0
License: MIT

A fonticode is a shortcode for WordPress for your font icons!

== Description ==

Theme or plugin included Font Icons like Font Awesome or Genericons? No visual editor friendly way to add them into your posts? Tired of switching to HTML mode just to paste in some weird i or span code?

Not anymore! Enter THE FONTICODE! Shortcodes for font icons you've already got!

<strong>Usage</strong>

To use is simple:

`[ficon family=FontAwesome icon=twitter color=blue size=2x]`

The 'Family' should be the name of the font family, so for example Font Awesome uses `font-family: 'FontAwesome';` and thus you should use FontAwesome. Don't worry, the code tries to be smart, so if you accidently put in 'fontawesome' or even 'fontAwesome' it'll be okay.

<strong>Supported Font Families</strong>

* [Font Awesome](http://fontawesome.io/)
* [Genericons](http://genericons.com/)
* [Dashicons](https://melchoyce.github.io/dashicons/)
* [Glyphicons](http://glyphicons.com/)
* [Octicons](http://octicons.github.com/)

If you want more fonts included, please provide the following:

* A link to the font family (like http://genericons.com )
* An example of the HTML used (like `<span class="genericon genericon-send-to-phone"></span>`)

Just leave a comment in the support forums.

== Installation ==

No special instructions.


== FAQ ==

= What fonts are included? =

None.

This plugin <em>DOES NOT</em> add in the font families for you. It just makes a shortcode work.

= Why don't Entypo or TheNounProject work? =

Because they use unicode, like `&#128101;` which uses a totally different span insertion. This requires a great deal of rejiggering on the display end for my case, and I'm just not willing to code it yet. If you can, I'm happy to consider adding it.

= Why does it not work for all families? =

They have different CSS classes and they're not all the same as the font family name, so I have to check for them and display what I get. Let me know which one I'm missing and, if I can, I'll add it.

= Can I add my own font families? =

Not yet. Patches welcome! I've not had the time to sit and suss out how to do that in a sane way, since not everyone calls the fonts logically in their CSS. 

= Would you add in this font family? =

Probably. I looked for the popular ones I knew that put the examples in an obvious place. So what I'd need from you would be:

# A link to the font family (like http://genericons.com )
# An example of the HTML used (like `<span class="genericon genericon-send-to-phone"></span>`)

You would not believe how hard it is to find that second one for a lot of fonts!

= Dashicons is included in WP, so that works out of the box, right? =

No. 

It has to be enqueued on the front end. Read [Adding dashicons in WordPress](http://wpsites.net/web-design/adding-dashicons-in-wordpress/) for how to do that. For what it's worth, Dashicons <em>are not</em> meant to be on the front facing part of your site, do they may get weird.

= I have an idea for a new icon! Can you add it? =

No.

I can't design worth a bean, and I don't make any, so you have to actually contact the font icon designers on your own. Personally I'm waiting for Joen or Mel to make me that unicorn in Genericons.

= Glyphicons isn't GPL compatible! =

Part of it is, part of it isn't, but since this plugin doesn't include the fonts, it doesn't matter.

= Is this a replacement for Genericon'd? =

Of course not! Though it now means if you're using, say, TwentyFourteen, you don't need Genericon'd anymore.

= What's the deal with the header image? =

It's a Manticore. Manticore. Fonticore? No? Okay. Sorry. I thought it was funny.