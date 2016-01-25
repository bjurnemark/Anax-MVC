<hr>

<h2>Comments</h2>

<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>
<div class='comment'>
<div class='comment-name'><?=$comment['name']?>
    <span class='comment-mail'><?=$comment['mail']?></span>
    <span class='comment-time'><?=$comment['timestamp']?></span>
</div>
<div class='comment-content'><?=$comment['content']?></div>
<div class='comment-links'>
    <span class='discrete-link'>Radera: <?=$id?></span>
    <span class='discrete-link'>Redigera: <?=$id?></span>
</div>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
