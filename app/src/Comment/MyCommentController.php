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
        $comments = new \Bjurnemark\Comment\MyCommentsInSession();
        $comments->setDI($this->di);

        $subset = $comments->findByKey($key);

        // Add readable time durations
        $subset = $comments->addReadableTime($subset);

        $this->views->add('comment/comments', [
            'comments' => $subset,
        ]);
    }



    /**
     * Add a comment.
     * Override base class version to store page_id
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
     * Remove a specific comment.
     *
     * @param string $pageId the page that the comment belongs to
     * @param string $timestamp the timestamp of the comment
     * @return void
     */
    public function removeAction($pageId, $timestamp)
    {
        $comments = new \Bjurnemark\Comment\MyCommentsInSession();
        $comments->setDI($this->di);

        $comments->remove($pageId, $timestamp);
        $this->response->redirect($this->request->getServer('HTTP_REFERER'));
    }


    /**
     * Display a form to edit a comment.
     *
     * @param string $pageId the page that the comment belongs to
     * @param string $timestamp the timestamp of the comment
     * @return void
     */
    public function editAction($pageId, $timestamp)
    {
        $this->theme->setTitle("Redigera kommentar");
        $this->views->add('comment/index', [
            'content' => "<h1>Redigera kommentar</h1>",
        ]);

        $comments = new \Bjurnemark\Comment\MyCommentsInSession();
        $comments->setDI($this->di);

        $comment = $comments->get($pageId, $timestamp);
        if (isset($comment)) {
            // Add the comment form view
            $this->views->add('comment/editform', [
                'mail'      => $comment['mail'],
                'name'      => $comment['name'],
                'content'   => $comment['content'],
                'output'    => null,
                'page_id'   => $pageId,
                'timestamp' => $timestamp,
            ]);
        }
    }


    /**
     * Replace an existing comment with a new version.
     *
     * @return void
     */
    public function replaceAction()
    {
        $isPosted = $this->request->getPost('doEdit');

        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        $orgTimestamp = $this->request->getPost('timestamp');

        $replacement = [
            'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'mail'      => $this->request->getPost('mail'),
            'page_id'   => $this->request->getPost('page_id'),
            'timestamp' => time(),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
        ];

        $comments = new \Bjurnemark\Comment\MyCommentsInSession();
        $comments->setDI($this->di);

        $comments->replace($replacement, $orgTimestamp);

        $this->response->redirect($this->request->getPost('redirect'));
    }
}
