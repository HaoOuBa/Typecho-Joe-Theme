<?php
/*
 * @Descripttion: 
 * @Author: 帅气的杜恒欧巴
 * @Date: 2020-12-07 09:16:55
 * @LastEditTime: 2020-12-12 08:55:34
 */

/**
 * 留言
 * 
 * @package custom 
 * 
 **/

?>
<?php $this->need('public/prevent.php'); ?>
<?php $this->need('public/defend.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->need('public/head.php'); ?>
</head>

<body>
    <?php $this->options->JCustomBodyStart() ?>

    <section id="joe">
        <!-- 头部 -->
        <?php $this->need('public/header.php'); ?>

        <!-- 主体 -->
        <section class="container j-post">
            <section class="j-adaption">
                <div class="main">
                    <!-- 分类 -->
                    <?php $this->need('component/post.classify.php'); ?>
                    
                    <!-- 标题 -->
                    <?php $this->need('component/post.header.php'); ?>

                    <?php $this->need('component/leaving.list.php'); ?>
                </div>

                <?php $this->need('public/comment.php'); ?>
            </section>
        </section>

        <!-- 弹幕 -->
        <?php if ($this->options->JBarragerStatus === 'on') : ?>
            <ul class="j-barrager-list">
                <?php $this->comments()->to($comments); ?>
                <?php while ($comments->next()) : ?>
                    <li>
                        <span class="j-barrager-list-avatar" data-src="<?php ParseAvatar($comments->mail); ?>"></span>
                        <span class="j-barrager-list-content"><?php $comments->excerpt(); ?></span>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>

        <!-- 尾部 -->
        <?php $this->need('public/footer.php'); ?>
    </section>
    <!-- 配置文件 -->
    <?php $this->need('public/config.php'); ?>
</body>

</html>