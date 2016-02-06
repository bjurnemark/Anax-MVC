<?php

echo "<hr><h2>Kommentarer</h2>";

if (is_array($comments) && count($comments) > 0) {
    echo "<div class='comments'>";

    foreach ($comments as $id => $comment) {
        echo "<div class='comment'>";
        echo "<a class='comment-name' href='mailto:{$comment->email}'>{$comment->name}</a>";
        echo "<span class='comment-time'>{$comment->updated}</span>";
        echo "<div class='comment-content'>{$comment->content}</div>";
        echo "<div class='comment-links'>";
        echo "<a href=" . $this->url->create('comment/update/' . $comment->id) . " class='discrete-link'>Redigera</a> | ";
        echo "<a href=" . $this->url->create('comment/delete/' . $comment->id) . " class='discrete-link'>Radera</a>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Bli den förste att kommentera ämnet!</p>";
}
