<?php
/*
 * @Descripttion: 
 * @Author: 帅气的杜恒欧巴
 * @Date: 2020-12-22 13:30:55
 * @LastEditTime: 2020-12-22 13:32:22
 */

/**
 * 壁纸
 * 
 * @package custom 
 * 
 **/

?>
<?php $this->need('public/prevent.php'); ?>
<?php $this->need('public/defend.php'); ?>
<!-- 
    *
    * 写字楼里写字间，写字间里程序员；
    * 程序人员写程序，又拿程序换酒钱。
    * 酒醒只在网上坐，酒醉还来网下眠；
    * 酒醉酒醒日复日，网上网下年复年。
    * 但愿老死电脑间，不愿鞠躬老板前；
    * 奔驰宝马贵者趣，公交自行程序员。
    * 别人笑我忒疯癫，我笑自己命太贱；
    * 不见满街漂亮妹，哪个归得程序员？
    *
 -->
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
                <?php $this->need('component/wallpaper.api.php'); ?>
            </section>
        </section>

        <!-- 尾部 -->
        <?php $this->need('public/footer.php'); ?>
    </section>
    <!-- 配置文件 -->
    <?php $this->need('public/config.php'); ?>
</body>

</html>