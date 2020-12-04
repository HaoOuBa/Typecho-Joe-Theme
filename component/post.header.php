<div class="header">
    <h1 class="title j-typing"><?php $this->title() ?></h1>
    <?php if ($this->options->JPostCountingStatus === 'on') : ?>
        <div class="conting">
            <div class="info">
                <img src="<?php ParseAvatar($this->author->mail); ?>" />
                <div class="meta">
                    <div class="author">
                        <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                    </div>
                    <div class="item">
                        <span><?php $this->date('Y-m-d'); ?></span>
                        <div class="line">/</div>
                        <span><?php $this->commentsNum('%d'); ?> 评论</span>
                        <div class="line">/</div>
                        <span><?php getPostViews($this) ?> 阅读</span>
                        <div class="line">/</div>
                        <span id="baiduIncluded">正在检测是否收录...</span>
                    </div>
                </div>
            </div>
            <div class="time"><?php $this->date('m/d'); ?></div>
        </div>
    <?php endif; ?>
</div>