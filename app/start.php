<?php

use Slim\Slim;
use Slim\Views\TwigExtension;
use Slim\Middleware;

$purifier = new HTMLPurifier(HTMLPurifier_Config::createDefault());

function clearRequest(&$requestVariable, HTMLPurifier $purifier)
{
  foreach ($requestVariable as $key => $value) {
    if (is_array($requestVariable[$key])) {
      clearRequest($requestVariable[$key], $purifier);
    } else {
      $requestVariable[$key] = $purifier->purify($value);
    }
  }
}

clearRequest($_POST, $purifier);
clearRequest($_GET, $purifier);
unset($purifier);

// testing
//var_dump($_GET);
//exit();


require ROOT . '/app/dbloader.php';

/*
|--------------------------------------------------------------------------
| Create Slim Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Slim application instance
| which serves as the "glue" for all the components of RedSlim.
|
*/

// Instantiate application
$app = new Slim(require_once ROOT . '/app/config/app.php');
$app->setName('RedSlim');


// For native PHP session
session_cache_limiter(false);
session_start();

// For encrypted cookie session
/*
$app->add(
  new SessionCookie(
    array(
      'expires'     => '20 minutes',
      'path'        => '/',
      'domain'      => null,
      'secure'      => false,
      'httponly'    => false,
      'name'        => 'app_session_name',
      'secret'      => md5('appsecretkey'),
      'cipher'      => MCRYPT_RIJNDAEL_256,
      'cipher_mode' => MCRYPT_MODE_CBC
    )
  )
);
*/

/*
 * SET some globally available view data
 */
$resourceUri = $_SERVER['REQUEST_URI'];
$rootUri = $app->request()->getRootUri();
$assetUri = $rootUri;
$app->view()->appendData(
  array(
    'app'         => $app,
    'rootUri'     => $rootUri,
    'assetUri'    => $assetUri,
    'resourceUri' => $resourceUri
  )
);

foreach (glob(ROOT . '/app/controllers/*.php') as $router) {
  include $router;
}

// Disable fluid mode in production environment
$app->configureMode(
  SLIM_MODE_PRO, function () use ($app) {
    // note, transactions will be auto-committed in fluid mode
    R::freeze(true);
  }
);

/*
|--------------------------------------------------------------------------
| Configure Twig
|--------------------------------------------------------------------------
|
| The application uses Twig as its template engine. This script configures
| the template paths and adds some extensions.
|
*/

$view = $app->view();
$view->parserOptions = array(
  'debug'       => true,
  'cache'       => false,
  //'cache' => ROOT . '/app/storage/cache/twig',
  'auto_reload' => true,
  //'strict_variables' => true
);

$view->parserExtensions = array(
  new TwigExtension(),
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
