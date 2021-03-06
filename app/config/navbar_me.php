<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',

    // Here comes the menu structure
    'items' => [

        'home'  => [
            'text'  => 'Hem',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Om Stefan'
        ],

        'redovisning'  => [
            'text'  => 'Redovisning',
            'url'   => $this->di->get('url')->create('redovisning'),
            'title' => 'Redovisning'
        ],

        // Heading menu item for submenu
        'discuss'  => [
            'text'  => 'Diskussions-sidor',
            'url'   => $this->di->get('url')->create('discuss'),
            'title' => 'Diskussions-sidor för olika ämnen',

            // Here we add the submenu, with individual pages
            'submenu' => [

                'items' => [

                    'linux'  => [
                        'text'  => 'Linux',
                        'url'   => $this->di->get('url')->create('linux'),
                        'title' => 'Linux'
                    ],

                    'frameworks'  => [
                        'text'  => 'Ramverk',
                        'url'   => $this->di->get('url')->create('ramverk'),
                        'title' => 'Ramverk eller ramvärk'
                    ],
                ],
            ],
        ],

        'theme'  => [
            'text'  => 'Tema',
            'url'   => $this->di->get('url')->create('theme'),
            'title' => 'Tema'
        ],

        'db-models'  => [
            'text'  => 'DB/Modeller',
            'url'   => $this->di->get('url')->create('db-models'),
            'title' => 'Databasdrivna modeller',

            'submenu' => [

                'items' => [

                    'list'  => [
                        'text'  => 'Alla användare',
                        'url'   => $this->di->get('url')->create('users/list'),
                        'title' => 'Alla användare'
                    ],

                    'add'  => [
                        'text'  => 'Lägg till användare',
                        'url'   => $this->di->get('url')->create('users/add'),
                        'title' => 'Lägg till användare'
                    ],

                    'active'  => [
                        'text'  => 'Aktiva användare',
                        'url'   => $this->di->get('url')->create('users/active'),
                        'title' => 'Aktiva användare'
                    ],

                    'inactive'  => [
                        'text'  => 'Inaktiva användare',
                        'url'   => $this->di->get('url')->create('users/inactive'),
                        'title' => 'Inaktiva användare'
                    ],

                    'trash'  => [
                        'text'  => 'Papperskorgen',
                        'url'   => $this->di->get('url')->create('users/in-trash'),
                        'title' => 'Papperskorgen'
                    ],

                    'setup' => [
                        'text'  => 'Återställ databasen',
                        'url'   => $this->di->get('url')->create('users/setup'),
                        'title' => 'Återställ databasen'
                    ],
                ],
            ],
        ],

        'package'  => [
            'text'  => 'Paket',
            'url'   => $this->di->get('url')->create('package/index'),
            'title' => 'Paket'
        ],


        'source'  => [
            'text'  => 'Källkod',
            'url'   => $this->di->get('url')->create('source'),
            'title' => 'Källkod'
        ],
    ],



    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];
