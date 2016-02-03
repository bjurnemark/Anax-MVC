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

// Add database as a service
$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
    $db->connect();
    return $db;
});

// Add a controller for users
$di->set('UsersController', function() use ($di) {
    $controller = new Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});


// Add routes

// Setup database tables
$app->router->add('setup', function() use ($app) {

    $app->db->dropTableIfExists('user')->execute();

    $app->db->createTable(
        'user',
        [
            'id'       => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym'  => ['varchar(20)', 'unique', 'not null'],
            'email'    => ['varchar(80)'],
            'name'     => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'created'  => ['datetime'],
            'updated'  => ['datetime'],
            'deleted'  => ['datetime'],
            'active'   => ['datetime'],
        ]
    )->execute();

    $app->db->insert(
            'user',
            ['acronym', 'email', 'name', 'password', 'created', 'active']
        );

        $now = gmdate('Y-m-d H:i:s');

        $app->db->execute([
            'admin',
            'admin@dbwebb.se',
            'Administrator',
            password_hash('admin', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

        $app->db->execute([
            'doe',
            'doe@dbwebb.se',
            'John/Jane Doe',
            password_hash('doe', PASSWORD_DEFAULT),
            $now,
            $now
        ]);
});



$app->router->handle();
$app->theme->render();
