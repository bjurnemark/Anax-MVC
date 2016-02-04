<?php

namespace Anax\DI;

/**
 * Anax base class implementing Dependency Injection / Service Locator
 * of the services used by the framework, using lazy loading.
 *
 * In addition to the default DIFactory, this adds servies for
 *      Forms
 *      Databases
 *
 */
class CDIFactoryExtended extends CDIFactoryDefault
{
   /**
     * Construct.
     *
     */
    public function __construct()
    {
        parent::__construct();

        // Add forms service
        $this->set('form', '\Mos\HTMLForm\CForm');

        // Add databas service
        $this->setShared('db', function() {
            $db = new \Mos\Database\CDatabaseBasic();
            $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
            $db->connect();
            return $db;
        });
    }
}
