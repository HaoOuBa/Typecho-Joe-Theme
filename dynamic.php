<?php

/**
 * 动态
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
                <?php $this->need('public/comment.dynamic.php'); ?>
            </section>
            <?php if ($this->options->JPostAsideStatus === 'on') : ?>
                <?php $this->need('public/aside.php'); ?>
            <?php endif; ?>
        </section>

        <!-- 尾部 -->
        <?php $this->need('public/footer.php'); ?>
    </section>

    <!-- 配置文件 -->
    <?php $this->need('public/config.php'); ?>
</body>

</html>