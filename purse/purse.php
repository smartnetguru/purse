<?php namespace Purse; use Jade;

// Purse time.
require_once(path('purse/database.php'));

class Purse {
  private $route;
  private $matchedRoute;
  public function __construct() {
    $this->route = $this->getRouteFromUrl();
    $this->registerJade();
    $this->matchedRoute = false;
  }
  private function getRouteFromUrl() {
    // The following code is adapted from the Slim framework (thank you!)
    if (strpos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) === 0) {
      $scriptName = $_SERVER['SCRIPT_NAME']; //Without URL rewrite
    } else {
      $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']) ); //With URL rewrite
    }
    $pathInfo = substr_replace($_SERVER['REQUEST_URI'], '', 0, strlen($scriptName));
    if (strpos($pathInfo, '?') !== false) {
      $pathInfo = substr_replace($pathInfo, '', strpos($pathInfo, '?')); //query string is not removed automatically
    }
    $scriptName = rtrim($scriptName, '/');
    $pathInfo = '/' . ltrim($pathInfo, '/');
    return $pathInfo;
  }
  private function registerJade() {
    spl_autoload_register(function($class) {
      if (strstr($class, 'Jade')) {
        include(path($GLOBALS['paths']['libraries-jade'] . '/' .
          str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php'));
      }
    });
  }

  public function action($path, \Closure $callback) {
    $jade = new Jade\Jade;
    $vars = $callback($view) ?: [];

    if (($path == $this->route || $path == '404') && !$this->matchedRoute) {
      $this->matchedRoute = true;
      
      if ($path == '404') {
        header('HTTP/1.0 404 Not Found');
      }

      $jade->render(path($GLOBALS['paths']['views'] . '/' . $view . '.jade'), $vars);
    }
  }
}
