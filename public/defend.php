<?php if ($this->options->JDefend === 'on') : ?>
    <!DOCTYPE html>
    <html lang="en" style="height: 100%;">

    <head>
        <?php $this->need('public/head.php'); ?>
    </head>

    <body style="height: 100%; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <div class="j-defend">
                <div class="title">通知</div>
                <div class="content">
                    <p>尊敬的访客，您好</p>
                    <p>本博客正在更新迭代中，暂时无法访问！每次的更新都为您带来更好的体验，敬请期待！</p>
                    <p>感谢您的支持！</p>
                </div>
            </div>
        </div>
    </body>

    </html>
    <?php exit; ?>
<?php endif; ?>