<?php

namespace Anax\Users;

/**
 * Model for Users.
 *
 */
class User extends \Anax\MVC\CDatabaseModel
{

    public function createTable() {
        parent::createTable(
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
        );
    }

    public function insertBaseData(){
        $this->db->insert(
            $this->getSource(),
            ['acronym', 'email', 'name', 'password', 'created', 'active']
        );

        $now = gmdate('Y-m-d H:i:s');

        $this->db->execute([
            'admin',
            'admin@dbwebb.se',
            'Administrator',
            password_hash('admin', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

        $this->db->execute([
            'doe',
            'doe@dbwebb.se',
            'John/Jane Doe',
            password_hash('doe', PASSWORD_DEFAULT),
            $now,
            $now
        ]);
    }
}
