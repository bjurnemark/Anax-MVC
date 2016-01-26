<?php

namespace Bjurnemark\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsInSession extends \Phpmvc\Comment\CommentController
{



    /**
     * Add a new comment.
     *
     * @param array $comment with all details.
     *
     * @return void
     */
    // public function add($comment)
    // {
    //     $comments = $this->session->get('comments', []);
    //     $comments[] = $comment;
    //     $this->session->set('comments', $comments);
    // }



    /**
     * Find and return all comments.
     *
     * @return array with all comments.
     */
    // public function findAll()
    // {
    //     return $this->session->get('comments', []);
    // }



    /**
     * Delete all comments.
     *
     * @return void
     */
    // public function deleteAll()
    // {
    //     $this->session->set('comments', []);
    // }
}
