<?php

require __DIR__ . '/../vendor/autoload.php';

$purse = new Purse\Purse(array(
  'paths' => require(__DIR__ . '/../paths.php'),
  'environments' => array(
    'your-hostname' => array(
      'baseURL' => 'your-url',
      'debug' => true
    )
  )
));

$purse->get('/', function(&$view) {
  $view = 'index';
});

$purse->get('404', function(&$view) {
  $view = '404';
});
