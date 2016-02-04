<?php

namespace Anax\Users;

/**
 * A controller for users and admin related events.
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);
    }


    /**
     * Create and initialize the database table.
     *
     * @return void
     */
    public function setupAction() {
        $this->users->createTable(
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

        $this->add('admin', 'Administrator');
        $this->add('doe', 'John/Jane Doe');

        $url = $this->url->create('users/list/');
        $this->response->redirect($url);
    }


    /**
     * List all users.
     *
     * @return void
     */
    public function listAction()
    {
        $all = $this->users->findAll();

        $this->theme->setTitle("List all users");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "View all users",
        ]);
    }

    /**
     * List user with id.
     *
     * @param int $id of user to display
     *
     * @return void
     */
    public function idAction($id = null)
    {
        $user = $this->users->find($id);

        $this->theme->setTitle("View user with id");
        $this->views->add('users/view', [
            'user' => $user,
            'title' => "View user with id = $id",
        ]);
    }

    /**
     * Add new user.
     *
     * @param string $acronym of user to add.
     *
     * @return void
     */
    public function addAction($acronym = null)
    {
        if (!isset($acronym)) {
            die("Missing acronym");
        }

        $this->add($acronym);

        $url = $this->url->create('users/id/' . $this->users->id);
        $this->response->redirect($url);
    }


    /**
     * Delete user.
     *
     * @param integer $id of user to delete.
     *
     * @return void
     */
    public function deleteAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $this->users->delete($id);

        // TODO: Remove list if I add a default route to frontcontroller
        // TODO: Remove dbtest.php when rewrite is OK
        $url = $this->url->create('dbtest.php/users/list');
        $this->response->redirect($url);
    }


    /**
     * Delete (soft) user.
     *
     * @param integer $id of user to delete.
     *
     * @return void
     */
    public function softDeleteAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $now = gmdate('Y-m-d H:i:s');

        $user = $this->users->find($id);

        $user->deleted = $now;
        $user->save();

        // TODO: Remove dbtest.php when rewrite is OK
        $url = $this->url->create('dbtest.php/users/id/' . $id);
        $this->response->redirect($url);
    }

    /**
     * Undelete user.
     *
     * @param integer $id of user to undelete.
     *
     * @return void
     */
    public function unDeleteAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $user = $this->users->find($id);

        $user->deleted = null;
        $user->save();

        // TODO: Remove dbtest.php when rewrite is OK
        $url = $this->url->create('dbtest.php/users/id/' . $id);
        $this->response->redirect($url);
    }

    /**
     * List all active and not deleted users.
     *
     * @return void
     */
    public function activeAction()
    {
        $all = $this->users->query()
            ->where('active IS NOT NULL')
            ->andWhere('deleted is NULL')
            ->execute();

        $this->theme->setTitle("Users that are active");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Users that are active",
        ]);
    }


    /**
     * Utility for adding a  new user.
     *
     * @param string $acronym of user to add.
     * TODO: ADD PARAMS
     *
     * @return void
     */
    protected function add($acronym, $name = null, $password = null)
    {
        $name = isset($name) ? $name : $acronym;
        $password = isset($password) ? $password : $acronym;
        $now = gmdate('Y-m-d H:i:s');

        // Note: Use create to handle multiple calls. (Otherwise $id will be
        // set and subsequent calls will do update instead of insert.)
        $this->users->create([
            'acronym ' => $acronym,
            'email'    => $acronym . '@mail.se',
            'name'     => 'Mr/Mrs ' . $name,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created'  => $now,
            'active'   => $now,
        ]);
    }
}
