<?php

namespace Purse;
use Jade;

// Purse time.
require_once(path('purse/database.php'));

class Purse {
  /**
   * @var mixed|string
   */
  private $route;
  /**
   * @var bool
   */
  private $matchedRoute;

  public function __construct() {
      $this->route = $this->getRouteFromUrl();
      $this->registerJade();
      $this->matchedRoute = false;
  }

  /**
   * @return mixed|string
   */
  private function getRouteFromUrl() {
    // The following code is adapted from the Slim framework (thank you!)
    if (strpos($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']) === 0) {
      // Without URL rewrite
      $scriptName = $_SERVER['SCRIPT_NAME'];
    } else {
      // With URL rewrite
      $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    }
    $pathInfo = substr_replace($_SERVER['REQUEST_URI'], '', 0, strlen($scriptName));
    if (strpos($pathInfo, '?') !== false) {
      // Query string is not removed automatically
      $pathInfo = substr_replace($pathInfo, '', strpos($pathInfo, '?'));
    }
    $scriptName = rtrim($scriptName, '/');
    $pathInfo = '/' . ltrim($pathInfo, '/');
    return $pathInfo;
  }

  private function registerJade() {
    spl_autoload_register(function ($class) {
      if (strstr($class, 'Jade')) {
        include(path($GLOBALS['paths']['libraries-jade'] . '/' .
          str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php'));
      }
    });
  }

  /**
   * @param $path
   * @param callable $callback
   */
  public function get($path, \Closure $callback) {
    return $this->action($path, 'GET', $callback);
  }

  /**
   * @param $path
   * @param callable $callback
   */
  public function post($path, \Closure $callback) {
    return $this->action($path, 'POST', $callback);
  }

  /**
   * @param $path
   * @param callable $callback
   */
  public function put($path, \Closure $callback) {
    return $this->action($path, 'PUT', $callback);
  }

  /**
   * @param $path
   * @param callable $callback
   */
  public function delete($path, \Closure $callback) {
    return $this->action($path, 'DELETE', $callback);
  }

  /**
   * @param $path
   * @param $method
   * @param callable $callback
   * @throws \Exception
   */
  private function action($path, $method, \Closure $callback) {
    $jade = new Jade\Jade;
    $vars = $callback($view) ?: [];

    if (
      !$this->matchedRoute &&
      $method == $_SERVER['REQUEST_METHOD'] &&
      ($path == $this->route || $path == '404')
    ) {
      $this->matchedRoute = true;

      if ($path == '404') {
        header('HTTP/1.0 404 Not Found');
      }

      $jade->render(path($GLOBALS['paths']['views'] . '/' . $view . '.jade'), $vars);
    }
  }
}
