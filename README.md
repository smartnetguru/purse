<p align="center">
  <a href="http://phyramid.github.io/purse/">
    <img src="http://phyramid.github.io/purse/images/logo-bar-small.png"/>
  </a>
</p>
============================

Purse is a modern web framework for PHP inspired by Sinatra. It has several major features:
* Routes
* MVC
* Jade
* Stylus
* Grunt (with live updating)

It aims to make developing web applications with PHP (using modern, clean paradigms) as easy as in Ruby or NodeJS. Purse was initially developed for internal use at [Phyramid](http://phyramid.com).

Suggestions (including for new features) are very welcome. If you have any, open an issue or contact me.

## Installation
* `git clone https://github.com/vladh/purse`
* `cd purse`
* `npm install -g grunt-cli`
* `npm install`
* Set your webserver to serve `purse/public`

## Features

### Routes
Add routes in `public/index.php`.
```php
$purse->action('/example', function(&$view) {
  $view = 'example';

  return array(
    'baseURL' => BASE_URL
  );
});
```
You should specify the view you want to load (`$view`) and the variables you want to pass to it (`return array(...)`).

### MVC & Jade
Views are in `views/`. `default.jade` is included by default as the main view/template which other views derive from. To add a new view, just create `views/example.jade`:
```jade
extends default

block content
  #content.grid
    p Hi. Your content goes here.

block scripts
  script(type="text/javascript", src="js/example.js")
```

### Stylus & Grunt
Stylus files are in `views/stylus/`. To compile these files, run `grunt watch`. By default, `views/stylus/screen.styl` compiles into `public/stylesheets/screen.css`. You can add more stylesheets in `Gruntfile.js`:
```javascript
stylus: {
  compile: {
    options: {
    },
    files: {
      'public/stylesheets/example.css': ['views/stylus/example.styl']
    }
  }
},
```

### Additional files
##### purse/database.php
This file provides a getPDOHandle() function which returns a PDO handle constructed from the `DB_` variables in the same file.

## To-do / roadmap
A comprehensive to-do list can be found on the [issues page](https://github.com/Phyramid/purse/issues). A roadmap will be added if needed, but there are too few issues for now.

## Credits

Purse is lovingly built by [vladh](http://vladh.net) and [petrut](http://petrutoader.com) at [Phyramid](http://phyramid.com).

Additional thanks:
* [jade-php](https://github.com/ronan-gloo/jade-php)
* [normalize.css](http://necolas.github.io/normalize.css/)
* [prismjs](http://prismjs.com/)
* [Rick Ross](http://www.godforgivesidont.com/)
