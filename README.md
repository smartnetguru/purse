<p align="center">
  <a href="http://phyramid.github.io/purse/">
    <img src="http://phyramid.github.io/purse/images/logo-bar-small.png"/>
  </a>
</p>
============================

Purse is a modern web framework for PHP inspired by Sinatra. It has several major features:
* Routes
* Environments
* MVC
* Jade
* Stylus

It aims to make developing web applications with PHP (using modern, clean paradigms) as easy as in Ruby or Node.js. Purse was initially developed for internal use at [Phyramid](http://phyramid.com).

Suggestions (including for new features) are very welcome. If you have any, open an issue or contact me.

## Installation
The installation process requires [Composer](https://getcomposer.org/).
* `git clone https://github.com/Phyramid/purse`
* `cd purse`
* `composer install`
* `npm install -g gulp`
* `npm install`
* Set your webserver to serve `purse/public`

## Features

### Routes
Add routes in `public/index.php`.
```php
$purse->get('/example', function(&$view) {
  $view = 'example';

  return array(
    'baseURL' => BASE_URL
  );
});
```
You should specify the view you want to load (`$view`) and the variables you want to pass to it (`return array(...)`).

Purse supports the four main HTTP methods: GET, POST, PUT, DELETE.
```php
$purse->get('/example', function(&$view) {
$purse->post('/example', function(&$view) {
$purse->put('/example', function(&$view) {
$purse->delete('/example', function(&$view) {
```

For a 404 route, just make a route with '404' as the path. Make sure you write it last, though, because if you don't, it will match first and disregard all routes after it.
```php
$purse->get('404', function(&$view) {
  $view = 'example';

  return array(
    'baseURL' => BASE_URL
  );
});
```

### MVC & Jade
Views are in `app/views/`. `default.jade` is included by default as the main view/template which other views derive from. To add a new view, just create `app/views/example.jade`:
```jade
extends default

block content
  .content.grid
    p Hi. Your content goes here.

block scripts
  script(type="text/javascript", src="js/example.js")
```

### Stylus & Gulp
Stylus files are in `app/stylus/`. To compile these files and watch for changes, run `gulp`. Any stylesheets you add into `app/stylus/` are compiled automagically into `public/stylesheets/`.

### Environments
Environments allow you to define per-host information, such as base URLs and debug information. Here's an example environment:

```php
'venus' => array(
  'baseURL' => '/projects/purse'
  'debug' => true
)
```

This is mainly for development purposes and ensures that every host running the app both has the proper URL path (so that resources don't break if you're running on a more complex path, or a path that isn't "/") and either displays errors or doesn't (and any other debug stuff you may require) as needed.

Environments are optional, and you define them when instantiating Purse in public/index.php:

```php
$purse = new Purse\Purse(array(
  'paths' => require(__DIR__ . '/../paths.php'),
  'environments' => array(
    'your-hostname' => array(
      'baseURL' => 'your-url',
      'debug' => true
    )
  )
));
```

### Additional classes
##### Database
This class provides a getPDOHandle() method which returns a PDO handle constructed from the given parameters (hostname, database, username and password).

## To-do / roadmap
A comprehensive to-do list can be found on the [issues page](https://github.com/Phyramid/purse/issues). A roadmap will be added if needed, but there are too few issues for now.

## Credits

Purse is lovingly built by [vladh](http://vladh.net) and [petrut](http://petrutoader.com) at [Phyramid](http://phyramid.com).

#### Additional thanks

##### People
* [The contributors](https://github.com/Phyramid/purse/graphs/contributors)
* [/r/php](http://reddit.com/r/php)
* [Rick Ross](http://www.godforgivesidont.com/)

##### Libraries
* [jade-php](https://github.com/ronan-gloo/jade-php)
* [normalize.css](http://necolas.github.io/normalize.css/)
* [prismjs](http://prismjs.com/)
