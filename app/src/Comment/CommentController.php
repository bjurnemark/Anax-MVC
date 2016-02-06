<?php

namespace Bjurnemark\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->comments = new \Bjurnemark\Comment\Comment();
        $this->comments->setDI($this->di);
    }


    /**
     * Create and initialize the database table.
     *
     * @return void
     */
    public function setupAction() {
        $this->comments->createTable(
            [
                'id'       => ['integer', 'primary key', 'not null', 'auto_increment'],
                'page_id'  => ['varchar(80)'],
                'name'     => ['varchar(80)'],
                'email'    => ['varchar(80)'],
                'content'  => ['varchar(255)'],
                'created'  => ['datetime'],
                'updated'  => ['datetime'],
                'ip'       => ['varchar(20)']
            ]
        );

        $testData = [
            [
                'page_id'  => 'ramverk',
                'name'     => 'Adam',
                'email'    => 'adam@mail.se',
                'content'  => 'Jag gillar äpplen',
            ],
            [
                'page_id'  => 'ramverk',
                'name'     => 'Bertil',
                'email'    => 'bertil@mail.se',
                'content'  => 'Berra säger hej',
            ],
            [
                'page_id'  => 'linux',
                'name'     => 'Linus',
                'email'    => 'linus@linux.com',
                'content'  => 'Kernel hacking 4-ever. Management by fear!',
            ],
            [
                'page_id'  => 'linux',
                'name'     => 'Richard',
                'email'    => 'rs@gnu.org',
                'content'  => 'Det heter GNU/Linux!!!',
            ],
            [
                'page_id'  => 'linux',
                'name'     => 'Bill',
                'email'    => 'wg@microsoft.com',
                'content'  => 'Har ni provat Windows 10? Det är jättebra!',
            ],
        ];

        foreach ($testData as $comment) {
            $this->add($comment);
        }

        $url = $this->url->create('discuss');
        $this->response->redirect($url);
    }


    /**
     * View comments for a given key.
     *
     * @param string $key the selection of comments to view
     * @return void
     */
    public function viewByKeyAction($key=null)
    {
        $set = $this->comments->query()
            ->where("page_id = ?")
            ->orderBy("updated ASC")
            ->execute([$key]);

        $this->views->add('comment/comments', [
            'comments' => $set,
        ]);
    }



    /**
     * Add a comment.
     *
     * @return void
     */
    public function addAction($page_id)
    {
        // Display form to add comment
        $form = $this->form->create([
            'id'     => 'formAddComment',
            'legend' => 'Lägg till kommentar',
        ],
        [

            'page_id' => [
                'type'        => 'hidden',
                'value'       => $page_id,
            ],
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
                'content' => [
                'type'        => 'text',
                'label'       => 'Kommentar:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
                'ip' => [
                'type'        => 'hidden',
                'value'       => $this->request->getServer('REMOTE_ADDR'),
            ],
                'submit' => [
                'type'      => 'submit',
                'callback'  => function () {
                    $now = gmdate('Y-m-d H:i:s');

                    $commentSaved = $this->comments->save([
                        'page_id' => $this->form->Value('page_id'),
                        'name' => $this->form->Value('name'),
                        'email' => $this->form->Value('email'),
                        'content' => $this->form->Value('content'),
                        'ip' => $this->form->Value('ip'),
                        'created' => $now,
                        'updated' => $now,
                    ]);

                    if($commentSaved) {
                        $this->response->redirect($this->request->getPost('redirect'));
                        return true;
                    }
                // Should have some error handling here
                }
            ],
        ]);
        $form->check();

        $this->di->theme->setTitle("Lägg till kommentar");
        $this->di->views->add('default/blankpage', [
            'title' => "Lägg till kommentar",
            'content' => $form->getHTML()
        ]);
    }


    /**
     * Delete a specific comment.
     *
     * @param string $id the comment to delete
     * @return void
     */
    public function deleteAction($id)
    {
        $this->comments->delete($id);
        $this->response->redirect($this->request->getServer('HTTP_REFERER'));
    }


    /**
     * Update a comment.
     *
     * @param int $id of comment to edit
     *
     * @return void
     */
    public function updateAction($id = null)
    {
        if (!isset($id)) return;

        $comment = $this->comments->find($id);

        // Display form to edit comment
        $form = $this->form->create(
        [
            'id'     => 'formEditComment',
            'legend' => 'Redigera kommentar',
        ],
        [
            'name' => [
                'type'        => 'text',
                'label'       => 'Namn:',
                'value'       => $comment->name,
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'text',
                'label'       => 'E-post:',
                'value'       => $comment->email,
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'content' => [
                'type'        => 'text',
                'label'       => 'Kommentar:',
                'value'       => $comment->content,
                'required'    => true,
                'validation'  => ['not_empty'],
            ],

            'submit' => [
                'type'      => 'submit',
                'callback'  => function () {
                    $now = gmdate('Y-m-d H:i:s');

                    $commentSaved = $this->comments->save([
                        'id' => $this->comments->id,
                        'name' => $this->form->Value('name'),
                        'email' => $this->form->Value('email'),
                        'content' => $this->form->Value('content'),
                        'updated' => $now,
                    ]);

                    if($commentSaved) {
                        $url = $this->url->create($this->comments->page_id);
                        $this->response->redirect($url);
                        return true;
                    }
                    // Should have some error handling here
                }
            ],
        ]);
        $form->check();

        $this->di->theme->setTitle("Redigera användare");
        $this->di->views->add('default/blankpage', [
            'title' => "Redigera användare",
            'content' => $form->getHTML()
        ]);
    }


    /**
     * Utility for adding testdata.
     *
     * @param array $comment the comment to add
     *
     * @return void
     */
    protected function add($comment)
    {
        // Randomize the times
        $time = time() - rand(1, 36000);
        $now = gmdate('Y-m-d H:i:s', $time);

        // Note: Use create to handle multiple calls. (Otherwise $id will be
        // set and subsequent calls will do update instead of insert.)
        $this->comments->create([
            'page_id'  => $comment['page_id'],
            'name'     => $comment['name'],
            'email'    => $comment['email'],
            'content'  => $comment['content'],
            'created'  => $now,
            'updated'  => $now,
            'ip'       => '82.44.147.' . rand(0, 255)
        ]);
    }

}
