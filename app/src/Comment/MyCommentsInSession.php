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
     * Get a specific comment
     *
     * @param string $pageId the page that the comment belongs to
     * @param string $timestamp the timestamp of the comment
     * @return array the contents of the comments or null
     */
    public function get($pageId, $timestamp)
    {
        $comments = $this->session->get('comments', []);
        foreach ($comments as $id => $comment) {
            if ($comment['page_id'] == $pageId && $comment['timestamp'] == $timestamp) {
                return($comments[$id]);
            }
        }
        return null;
    }


    /**
     * Replace a comment with an updated version
     *
     * @param array $replacement with all details.
     * @param string $orgTimestamp the original timestamp of the comment
     * @return void
     */
    public function replace($replacement, $orgTimestamp)
    {
        $comments = $this->session->get('comments', []);
        foreach ($comments as $id => $comment) {
            // Replace values in-place in comments array to maintain the order of comments
            if ($comments[$id]['page_id'] == $replacement['page_id'] && $comments[$id]['timestamp'] == $orgTimestamp) {
                $comments[$id]['content']   = $replacement['content'];
                $comments[$id]['name']      = $replacement['name'];
                $comments[$id]['mail']      = $replacement['mail'];
                $comments[$id]['page_id']   = $replacement['page_id'];
                $comments[$id]['ip']        = $replacement['ip'];
                $comments[$id]['timestamp'] = $replacement['timestamp'];
                $this->session->set('comments', $comments);
                return;
            }
        }
    }
}
