<?php
/**
 * Frontcontroller for the me-site
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

// Add the comment controller to the DI
$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

// Add routes
$app->router->add('', function() use ($app) {
    $app->theme->setTitle("Om Stefan");

    $content = $app->fileContent->get('me.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline  = $app->fileContent->get('byline.md');
    $byline  = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
        'content' => $content,
        'byline'  => $byline,
    ]);
});

$app->router->add('redovisning', function() use ($app) {
    $app->theme->setTitle("Redovisning");

    $content = $app->fileContent->get('redovisning.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline  = $app->fileContent->get('byline.md');
    $byline  = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
        'content' => $content,
        'byline'  => $byline,
    ]);

});

// Add a page with comments
$app->router->add('linux', function() use ($app) {
    $app->theme->setTitle("Linux");

    $content = $app->fileContent->get('linux.md');
    $content = $app->textFilter->doFilter($content, 'markdown');

    $app->views->add('comment/index', [
        'content' => $content,
    ]);

    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
    ]);

    $app->views->add('comment/form', [
        'mail'      => null,
        'web'       => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
    ]);
});

$app->router->add('source', function() use ($app) {
    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");

    $source = new \Mos\Source\CSource([
        'secure_dir' => '..',
        'base_dir' => '..',
        'add_ignore' => ['.htaccess'],
    ]);

    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
});

$app->router->handle();
$app->theme->render();
