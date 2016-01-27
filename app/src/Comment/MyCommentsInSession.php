<?php

namespace Bjurnemark\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class MyCommentsInSession extends \Phpmvc\Comment\CommentsInSession
{

    /**
     * Find and return a subset of comments.
     *
     * @param string $key the key (page_id) to search for
     * @return array with the comments matching the key.
     */
    public function findByKey($key)
    {
        // Get the entire set of comments
        $comments = $this->findAll();

        // Remove comments that doesn't match key
        foreach ($comments as $id => $comment) {
            if ($comment['page_id'] != $key) {
                unset($comments[$id]);
            }
        }
        return $comments;
    }


    /**
     * Add a readable time duration to each comment.
     *
     * @param array $comments the set of comments to process
     * @return array with the updated comments
     */
    public function addReadableTime($comments)
    {
        foreach ($comments as $id => $comment) {
            $tdiff = $this->timeElapsedString($comment['timestamp']);
            $comments[$id]['timediff'] = $tdiff;
        }
        return $comments;
    }


    /**
     * Remove a specific comment
     *
     * @param string $pageId the page that the comment belongs to
     * @param string $timestamp the timestamp of the comment
     * @return void
     */
    public function remove($pageId, $timestamp)
    {
        $comments = $this->findAll();
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
            if ($comment['page_id'] == $replacement['page_id'] && $comment['timestamp'] == $orgTimestamp) {
                // Replace values in-place in array to maintain the order of comments
                $comments[$id]['content']   = $replacement['content'];
                $comments[$id]['name']      = $replacement['name'];
                $comments[$id]['mail']      = $replacement['mail'];
                $comments[$id]['ip']        = $replacement['ip'];
                $comments[$id]['timestamp'] = $replacement['timestamp'];
                $this->session->set('comments', $comments);
                return;
            }
        }
    }

    /**
    * Create readable representation of elapsed time
    *
    * @param string $ptime the timestamp of the event
    * @return string the representation of the time elapsed since timestamp
    * @see http://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
    */
    private function timeElapsedString($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '0 seconds';
        }

        $units = array( 365 * 24 * 60 * 60  =>  'år',
                         30 * 24 * 60 * 60  =>  'månad',
                              24 * 60 * 60  =>  'dag',
                                   60 * 60  =>  'timme',
                                        60  =>  'minut',
                                         1  =>  'sekund'
                    );
        $unitsPlural = array( 'år'     => 'år',
                              'månad'  => 'månader',
                              'dag'    => 'dagar',
                              'timme'  => 'timmar',
                              'minut'  => 'minuter',
                              'sekund' => 'sekunder'
                    );

        foreach ($units as $secs => $str)
        {
            $diff = $etime / $secs;
            if ($diff >= 1)
            {
                $roundedDiff = round($diff);
                return $roundedDiff . ' ' . ($roundedDiff > 1 ? $unitsPlural[$str] : $str) . ' sedan';
            }
        }
    }
}
