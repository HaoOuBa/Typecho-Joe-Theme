<?php $this->comments()->to($comments); ?>
<?php if ($comments->have()) : ?>
    <ul id="j-leaving" class="leaving">
        <?php while ($comments->next()) : ?>
            <li>
                <div class="head">
                    <img src="<?php ParseAvatar($comments->mail); ?>" />
                    <span><?php $comments->author(); ?></span>
                    <span><?php $comments->date('Y/m/d'); ?></span>
                </div>
                <div class="body">
                    <div class="content"><?php echo ParseReply($comments->content); ?></div>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else : ?>
    <div class="none">暂无留言。期待您的第一个脚印。</div>
<?php endif; ?>