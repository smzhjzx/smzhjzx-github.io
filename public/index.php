<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;

try {

    $appDir = "../app/";
    $publicDir = "../public/";

    // Register an autoLoader
    $loader = new Loader();
    $loader->registerDirs(array(
        $appDir . "controllers/",
        $appDir . "models/"
    ))->register();

    // Create a DI
    $di = new FactoryDefault();

    // Setup the view component
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    // Setup a base URI so that all generated URIs include the project folder
    $di->set('url', function () {
        $url = new Url();
        $url->setBaseUri('smzhjzx');
        return $url;
    });

    // Handle the request
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo "PhalconException: " . $e->getMessage();
}