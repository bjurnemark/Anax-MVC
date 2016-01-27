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
$di->set('MyCommentController', function() use ($di) {
    $controller = new Bjurnemark\Comment\MyCommentController();
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

// Add pages with comments
$app->router->add('linux', function() use ($app) {
    $app->theme->setTitle("Linux");

    // Add the base view/content for this page
    $content = $app->fileContent->get('linux.md');
    $content = $app->textFilter->doFilter($content, 'markdown');
    $app->views->add('comment/index', [
        'content' => $content,
    ]);

    // Run MyCommentController/viewByKeyAction (adds comments-view)
    $app->dispatcher->forward([
        'controller' => 'my_comment',
        'action'     => 'view_by_key',
        'params'     => ['linux'],
    ]);

    // Add the comment form view
    $app->views->add('comment/form', [
        'mail'      => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
        'page_id'   => 'linux',
    ]);
});

$app->router->add('ramverk', function() use ($app) {
    $app->theme->setTitle("Ramverk");

    // Add the base view/content for this page
    $content = $app->fileContent->get('ramverk.md');
    $content = $app->textFilter->doFilter($content, 'markdown');
    $app->views->add('comment/index', [
        'content' => $content,
    ]);

    // Run MyCommentController/viewByKeyAction (adds comments-view)
    $app->dispatcher->forward([
        'controller' => 'my_comment',
        'action'     => 'view_by_key',
        'params'     => ['ramverk'],
    ]);

    // Add the comment form view
    $app->views->add('comment/form', [
        'mail'      => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
        'page_id'   => 'ramverk',
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