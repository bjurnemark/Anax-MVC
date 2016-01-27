<hr>

<h2>Kommentarer</h2>

<?php if (is_array($comments) && count($comments) > 0) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>
<div class='comment'>
<a class='comment-name' href="mailto:<?=$comment['mail']?>"><?=$comment['name']?></a>
<span class='comment-time'> <?=$comment['timediff']?></span>
<div class='comment-content'><?=$comment['content']?></div>
<div class='comment-links'>
<a href="<?=$this->url->create('my_comment/edit/'. $comment['page_id'] . '/' . $comment['timestamp'])?>" class='discrete-link'>Redigera</a> |
<a href="<?=$this->url->create('my_comment/remove/'. $comment['page_id'] . '/' . $comment['timestamp'])?>" class='discrete-link'>Radera</a>
</div>
</div>
<?php endforeach; ?>
</div>
<?php else : ?>
<p>Bli den förste att kommentera ämnet!</p>
<?php endif; ?>
