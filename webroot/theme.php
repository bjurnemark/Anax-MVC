<?php
/**
 * Frontcontroller for the grid-theme
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';

// Use clean URL:s
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Set the navbar
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar-grid.php');

// Set the theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');

// Add routes
$app->router->add('theme', function() use ($app) {
    $app->theme->setTitle("Testa att bygga ett tema");
    $app->views->addString("<h1>Ett nytt tema</h1> <p>Testsidor för att bygga ett tema</p>", 'main');

});

$app->router->add('theme/grid-regioner', function() use ($app) {

    $app->theme->addStylesheet('css/anax-grid/regions_demo.css');
    $app->theme->setTitle("Regioner");

    $app->views->addString('Den här sidan sätter bakgrundsfärgen till grå (#ddd) för de dynamiska regionerna. Syftet är att visa hur de reagerar responsivt. Även headern är responsiv m.a.p. font-storlekar.', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3');
});


$app->router->add('theme/grid-typography', function() use ($app) {

    $app->theme->addStylesheet('css/anax-grid/h-grid.css');
    $app->theme->setTitle("Typografi");

    $pContent  = $app->fileContent->get('paragraph.html');
    $main      = $app->fileContent->get('main.html');
    $side      = $app->fileContent->get('side.html');


    $app->views->addString('Vissa element saknar innehåll och ska därför inte synas. Det gäller featured-3 och triptych-3', 'flash')
               ->addString($pContent, 'featured-1')
               ->addString($pContent, 'featured-2')
               ->addString($main, 'main')
               ->addString($side, 'sidebar')
               ->addString($pContent, 'triptych-1')
               ->addString($pContent, 'triptych-2');
});

$app->router->add('theme/grid-font-awesome', function() use ($app) {

    $app->theme->setTitle("Testa font-awesome");

    $content = $app->fileContent->get('font-awesome.html');
    $sidebar = $app->fileContent->get('font-awesome-side.html');

    $app->views->addString($content, 'main');
    $app->views->addString($sidebar, 'sidebar');
});

$app->router->handle();
$app->theme->render();
