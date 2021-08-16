<?php if(!empty($messages)) : ?>
<?php foreach($messages as $message) : ?>
<div class="<?= $message['type'] ?> notes" >
    <?= $message['msg'] ?>
</div>
<?php endforeach ?>
<?php endif ?>