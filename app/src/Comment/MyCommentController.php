<?php

namespace Bjurnemark\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class MyCommentController extends \Phpmvc\Comment\CommentController
{



    /**
     * View comments for a given key.
     *
     * @param string $key the selection of comments to view
     * @return void
     */
    public function viewByKeyAction($key=null)
    {
        // Shortcut to clear all comments for testing
        // $this->session->set('comments', []);

        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDI($this->di);

        // Get the entire set of comments
        $all = $comments->findAll();

        // Make a selection of comments
        $subset = array();
        foreach ($all as $comment) {
            if ($comment['page_id'] == $key) {
                $subset[] = $comment;
            }
        }

        $this->views->add('comment/comments', [
            'comments' => $subset,
        ]);
    }



    /**
     * Add a comment.
     *
     * @return void
     */

    public function addAction()
    {
        $isPosted = $this->request->getPost('doCreate');

        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        $comment = [
            'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            'page_id'   => $this->request->getPost('page_id'),
            'timestamp' => time(),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
        ];

        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDI($this->di);

        $comments->add($comment);

        $this->response->redirect($this->request->getPost('redirect'));
    }



    /**
     * Remove all comments.
     *
     * @return void
     */
    // public function removeAllAction()
    // {
    //     $isPosted = $this->request->getPost('doRemoveAll');
    //
    //     if (!$isPosted) {
    //         $this->response->redirect($this->request->getPost('redirect'));
    //     }
    //
    //     $comments = new \Phpmvc\Comment\CommentsInSession();
    //     $comments->setDI($this->di);
    //
    //     $comments->deleteAll();
    //
    //     $this->response->redirect($this->request->getPost('redirect'));
    // }
}
