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
    $controller = new Bjurnemark\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

// Add a controller for users
$di->set('UsersController', function() use ($di) {
    $controller = new Bjurnemark\Users\UsersController();
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

$app->router->add('discuss', function() use ($app) {
    $app->theme->setTitle("Diskussions-sidor");

    $content = $app->fileContent->get('diskussion.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    $content .= "<p><a href='" . $app->url->create('comment/setup') . "'>Återställ kommentarer</a></p>";
    $content .= "<p><a href='" . $app->url->create('linux')   . "'>Sida med kommentarer om Linux</a></p>";
    $content .= "<p><a href='" . $app->url->create('ramverk') . "'>Sida med kommentarer om ramverk</a></p>";

    $app->views->add('default/blankpage', [
        'content' => $content,
    ]);
});

// Add pages with comments
$app->router->add('linux', function() use ($app) {
    $app->theme->setTitle("Linux");

    // Add the base view/content for this page
    $content = $app->fileContent->get('linux.md');
    $content = $app->textFilter->doFilter($content, 'markdown');
    $app->views->add('default/blankpage', [
        'content' => $content,
    ]);

    // Run CommentController/viewByKeyAction (adds comments-view)
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view_by_key',
        'params'     => ['linux'],
    ]);

    // Add a form for adding comments
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'add',
        'params'     => ['linux'],
    ]);
});

$app->router->add('ramverk', function() use ($app) {
    $app->theme->setTitle("Ramverk");

    // Add the base view/content for this page
    $content = $app->fileContent->get('ramverk.md');
    $content = $app->textFilter->doFilter($content, 'markdown');
    $app->views->add('default/blankpage', [
        'content' => $content,
    ]);

    // Run CommentController/viewByKeyAction (adds comments-view)
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view_by_key',
        'params'     => ['ramverk'],
    ]);

    // Add a form for adding comments
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'add',
        'params'     => ['ramverk'],
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

// Display debug info
$app->router->add('debug', function() use ($app) {
    $app->theme->setTitle("Debugging information");

    $content = "<p>This page can be used as a utility to display debug info or links.</p>";

    $app->views->add('default/blankpage', [
        'content' => $content,
    ]);
});

// Route to overview page for db-models functionality
$app->router->add('db-models', function () use ($app) {

    $app->theme->setTitle("Testa databasdrivna modeller");

    $app->views->add('me/links', [
        'title' => "Testa databasdrivna modeller",
        'content' => "<p>Länkar till några routes som finns för att testa databasdrivna modeller.</p>" .
                     "<p>Routes som är beroende av ett användar-id (<code>id, update, soft-delete/un-delete, " .
                     "activate/deactivate, delete</code>) kan testas från sidan " .
                     "<a href='" . $app->url->create('users/list'). "'>Alla användare</a>.",
        'pagelinks' => [
            [
                'href' => $app->url->create('users/list'),
                'text' => "Alla användare",
            ],
            [
                'href' => $app->url->create('users/add'),
                'text' => "Lägg till användare",
            ],
            [
                'href' => $app->url->create('users/active'),
                'text' => "Aktiva, ej raderade, användare",
            ],
            [
                'href' => $app->url->create('users/inactive'),
                'text' => "Inaktiva användare",
            ],
            [
                'href' => $app->url->create('users/in-trash'),
                'text' => "Papperskorgen",
            ],
            [
                'href' => $app->url->create('users/setup'),
                'text' => "Återställ databasen",
            ],
        ],
    ]);
});

$app->router->handle();
$app->theme->render();
