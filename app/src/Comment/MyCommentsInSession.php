<?php

namespace Bjurnemark\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class MyCommentsInSession extends \Phpmvc\Comment\CommentsInSession
{



    /**
     * Remove a specific comment
     *
     * @param string $pageId the page that the comment belongs to
     * @param string $timestamp the timestamp of the comment
     * @return void
     */
    public function remove($pageId, $timestamp)
    {
        $comments = $this->session->get('comments', []);
        foreach ($comments as $id => $comment) {
            if ($comment['page_id'] == $pageId && $comment['timestamp'] == $timestamp) {
                unset($comments[$id]);
                $this->session->set('comments', $comments);
                return;
            }
        }
    }

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
