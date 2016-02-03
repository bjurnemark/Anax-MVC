<?php
/**
 * Frontcontroller for the CForms exercise
 *
 */

 // Get environment & autoloader.
 require __DIR__.'/config.php';

 // Create services and inject into the app.
 $di  = new \Anax\DI\CDIFactoryDefault();       // TODO: Subclass and add CForm
 $di->set('form', '\Mos\HTMLForm\CForm');

 $di->set('FormController', function () use ($di) {
    $controller = new \Anax\HTMLForm\FormController();
    $controller->setDI($di);
    return $controller;
});

 $app = new \Anax\MVC\CApplicationBasic($di);

// Use clean URL:s
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Set the navbar
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Set the theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

// Test form route
$app->router->add('test1', function () use ($app) {

    // Start a session to persist data
    $app->session();

    $form = $app->form->create([], [
        'name' => [
            'type'        => 'text',
            'label'       => 'Name of contact person:',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'email' => [
            'type'        => 'text',
            'required'    => true,
            'validation'  => ['not_empty', 'email_adress'],
        ],
        'phone' => [
            'type'        => 'text',
            'required'    => true,
            'validation'  => ['not_empty', 'numeric'],
        ],
        'submit' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
                $form->AddOutput("<p><b>Name: " . $form->Value('name') . "</b></p>");
                $form->AddOutput("<p><b>Email: " . $form->Value('email') . "</b></p>");
                $form->AddOutput("<p><b>Phone: " . $form->Value('phone') . "</b></p>");
                $form->saveInSession = true;
                return true;
            }
        ],
        'submit-fail' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
                return false;
            }
        ],
    ]);

    $callbackSuccess = function ($form) use ($app) {
        // What to do if the form was submitted?
        $form->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $app->redirectTo();
    };

    $callbackFail = function ($form) use ($app) {
            // What to do when form could not be processed?
            $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
            $app->redirectTo();
    };

    // Check the status of the form
    $form->check($callbackSuccess, $callbackFail);

    $app->theme->setTitle("Welcome to Anax");
    $app->views->add('default/page', [
        'title' => "Try out a form using CForm",
        'content' => $form->getHTML()
    ]);
});
$app->router->handle();
$app->theme->render();
