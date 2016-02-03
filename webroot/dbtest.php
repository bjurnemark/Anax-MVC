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

// Connect to the database
$db = new \Mos\Database\CDatabaseBasic();
$options = require "config_mysql.php";
$db->setOptions($options);
$db->connect();

// Add routes
$app->router->add('', function() use ($app, $db) {
    $app->theme->setTitle("Test database");

    $db->select()
        ->from('Category');
    $db->execute();

    // Get the result
    $res = $db->fetchAll();


    $content = "<pre>" . print_r($res, 1) . "</pre>";

    $app->views->add('me/page', [
        'content' => $content,
    ]);
});

$app->router->handle();
$app->theme->render();
