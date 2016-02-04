<?php
/**
 * Frontcontroller for database tests
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';

// Use clean URL:s
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Set the navbar
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Set the theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');




// Add routes

// Setup database tables
$app->router->add('setup', function() use ($app) {

});



$app->router->handle();
$app->theme->render();
