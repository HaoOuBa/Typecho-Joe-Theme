<div class="classify">
    <?php if ($this->is('post')) : ?>
        <div class="category">
            <?php $this->category(''); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->user->uid == $this->authorId) : ?>
        <?php if ($this->is('post')) : ?>
            <a class="edit" target="_blank" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>">编辑文章</a>
        <?php else : ?>
            <a class="edit" target="_blank" href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid; ?>">编辑页面</a>
        <?php endif; ?>
    <?php endif; ?>
</div>