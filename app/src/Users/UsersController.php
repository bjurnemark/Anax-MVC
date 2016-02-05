<?php

namespace Bjurnemark\Users;

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
        $this->users = new \Bjurnemark\Users\User();
        $this->users->setDI($this->di);

        $baseUrl = $this->url->create('users');
        $this->actionUrls = [
            'view'       => $baseUrl . '/id/',
            'edit'       => $baseUrl . '/update/',
            'softDelete' => $baseUrl . '/soft-delete/',
            'unDelete'   => $baseUrl . '/un-delete/',
            'delete'     => $baseUrl . '/delete/',
            'activate'   => $baseUrl . '/activate/',
            'deactivate' => $baseUrl . '/deactivate/',
        ];
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


        $this->theme->setTitle("Visa alla användare");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Visa alla användare",
            'urls' => $this->actionUrls,
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
        if (!isset($id)) {
            $this->di->theme->setTitle("Felmeddelande");
            $this->di->views->add('users/page', [
                'title' => "Felmeddelande",
                'content' => "<p>Inget id satt</p>"
            ]);
            return;
        }

        $user = $this->users->find($id);

        $this->theme->setTitle("Visa användare");
        $this->views->add('users/details', [
            'user' => $user,
        ]);
    }

    /**
     * Add new user.
     *
     * @return void
     */
    public function addAction()
    {
        // Display form to add user
        $form = $this->form->create([], [

            'name' => [
                'type'        => 'text',
                'label'       => 'Namn:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'text',
                'label'       => 'E-post:',
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'acronym' => [
                'type'        => 'text',
                'label'       => 'Användar-id:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'password' => [
                'type'        => 'password',
                'label'       => 'Lösenord:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => function () {
                    $now = gmdate('Y-m-d H:i:s');

                    $userSaved = $this->users->save([
                        'acronym' => $this->form->Value('acronym'),
                        'email' => $this->form->Value('email'),
                        'name' => $this->form->Value('name'),
                        'password' => password_hash($this->form->Value('password'), PASSWORD_DEFAULT),
                        'created' => $now,
                        'active' => $now,
                    ]);

                    if($userSaved) {
                        $url = $this->url->create('users/id/' . $this->users->id);
                        $this->response->redirect($url);
                        return true;
                    }
                    // TODO: Should have some error handling here
                }
            ],
        ]);
        $form->check();

        $this->di->theme->setTitle("Lägg till användare");
        $this->di->views->add('users/page', [
            'title' => "Lägg till användare",
            'content' => $form->getHTML()
        ]);
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
            $this->di->theme->setTitle("Felmeddelande");
            $this->di->views->add('users/page', [
                'title' => "Felmeddelande",
                'content' => "<p>Inget id satt</p>"
            ]);
            return;
        }

        $this->users->delete($id);

        $url = $this->url->create('users/list');
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
            $this->di->theme->setTitle("Felmeddelande");
            $this->di->views->add('users/page', [
                'title' => "Felmeddelande",
                'content' => "<p>Inget id satt</p>"
            ]);
            return;
        }

        $now = gmdate('Y-m-d H:i:s');

        $user = $this->users->find($id);

        $user->deleted = $now;
        $user->save();

        $url = $this->url->create('users/list');
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
            $this->di->theme->setTitle("Felmeddelande");
            $this->di->views->add('users/page', [
                'title' => "Felmeddelande",
                'content' => "<p>Inget id satt</p>"
            ]);
            return;
        }

        $user = $this->users->find($id);

        $user->deleted = null;
        $user->save();

        $url = $this->url->create('users/list/');
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

        $this->theme->setTitle("Aktiva användare");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Aktiva användare",
            'urls' => $this->actionUrls,
        ]);
    }


    /**
     * Update a user.
     *
     * @param int $id of user to edit
     *
     * @return void
     */
    public function updateAction($id = null)
    {
        if (!isset($id)) {
            $this->di->theme->setTitle("Felmeddelande");
            $this->di->views->add('users/page', [
                'title' => "Felmeddelande",
                'content' => "<p>Inget id satt</p>"
            ]);
            return;
        }

        $user = $this->users->find($id);

        // Display form to edit user
        $form = $this->form->create([], [

            'name' => [
                'type'        => 'text',
                'label'       => 'Namn:',
                'value'       => $user->name,
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'text',
                'label'       => 'E-post:',
                'value'       => $user->email,
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => function () {
                    $now = gmdate('Y-m-d H:i:s');

                    $userSaved = $this->users->save([
                        'id' => $this->users->id,
                        'email' => $this->form->Value('email'),
                        'name' => $this->form->Value('name'),
                        'updated' => $now,
                    ]);

                    if($userSaved) {
                        $url = $this->url->create('users/id/' . $this->users->id);
                        $this->response->redirect($url);
                        return true;
                    }
                    // TODO: Should have some error handling here
                }
            ],
        ]);
        $form->check();

        $this->di->theme->setTitle("Redigera användare");
        $this->di->views->add('users/page', [
            'title' => "Redigera användare",
            'content' => $form->getHTML()
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
