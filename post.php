<?php $this->need('public/prevent.php'); ?>
<?php $this->need('public/defend.php'); ?>

<?php
if (isset($_POST['agree'])) {
    if ($_POST['agree'] == $this->cid) {
        exit(agree($this->cid));
    }
    exit('error');
}
?>
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

        <!-- 面包屑 -->
        <?php if ($this->options->JBreadStatus === 'on' && $this->is('post')) : ?>
            <?php $this->need('component/post.bread.php'); ?>
        <?php endif; ?>

        <!-- 主体 -->
        <section class="container j-post">
            <section class="j-adaption">

                <!-- 目录树 -->
                <?php if ($this->options->JDirectoryStatus === 'on') : ?>
                    <?php GetCatalog(); ?>
                <?php endif; ?>

                <!-- 伸缩侧边栏 -->
                <div class="j-stretch">
                    <div class="contain">
                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1024 894.976c0 71.68-51.2 129.024-114.688 129.024H116.736c-63.488 0-114.688-57.344-114.688-129.024V129.024C0 57.344 51.2 0 116.736 0h790.528c63.488 0 114.688 57.344 114.688 129.024v765.952zM987.136 155.648c0-65.536-47.104-118.784-106.496-118.784H145.408c-59.392 0-108.544 53.248-108.544 118.784v712.704c0 65.536 47.104 118.784 106.496 118.784h735.232c59.392 0 106.496-53.248 106.496-118.784V155.648z m0 0" p-id="17709"></path>
                            <path d="M923.648 288.768c0 32.768-24.576 57.344-55.296 57.344H165.888c-30.72 0-55.296-26.624-55.296-57.344V172.032c0-32.768 24.576-57.344 55.296-57.344h702.464c30.72 0 55.296 26.624 55.296 57.344v116.736z m0 0M638.976 851.968a57.344 57.344 0 0 1-57.344 57.344H169.984a57.344 57.344 0 0 1-57.344-57.344V475.136a57.344 57.344 0 0 1 57.344-57.344h411.648a57.344 57.344 0 0 1 57.344 57.344v376.832z m0 0M931.84 851.968a57.344 57.344 0 0 1-57.344 57.344h-112.64a57.344 57.344 0 0 1-57.344-57.344V475.136a57.344 57.344 0 0 1 57.344-57.344h112.64a57.344 57.344 0 0 1 57.344 57.344v376.832z m0 0" p-id="17710"></path>
                        </svg>
                    </div>
                </div>

                <div class="main">
                    <!-- 分类 -->
                    <?php $this->need('component/post.classify.php'); ?>

                    <!-- 标题 -->
                    <?php $this->need('component/post.header.php'); ?>

                    <!-- 当是文章页时 -->
                    <?php if ($this->is('post')) : ?>
                        <!-- 如果文章是密码保护，则需要输入密码 -->
                        <?php if ($this->hidden || $this->titleshow) : ?>
                            <div class="markdown" id="markdown">
                                <form class="protected" id="j-protected" action="<?php echo Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>" method="post">
                                    <div class="form">
                                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M812.63104 664.064h-439.0912a79.0272 79.0272 0 0 0-78.95552 79.09888v196.9664h518.04672a79.0272 79.0272 0 0 0 78.9504-79.09888v-117.84704a79.0272 79.0272 0 0 0-78.9504-79.11936z" fill="#F4CA1C" p-id="7008"></path>
                                            <path d="M812.97408 382.976h-32.36864V313.3696a272.256 272.256 0 1 0-544.512 0V382.976h-25.0624A113.91488 113.91488 0 0 0 97.28 496.77312v367.32928A113.91488 113.91488 0 0 0 211.03104 977.92h601.94304A113.90976 113.90976 0 0 0 926.72 864.1024V496.77312A113.90976 113.90976 0 0 0 812.97408 382.976zM305.7152 313.3696a202.63424 202.63424 0 1 1 405.26848 0V382.976H305.7152V313.3696zM857.088 864.1024a44.1856 44.1856 0 0 1-44.12416 44.15488H211.03104a44.19584 44.19584 0 0 1-44.11904-44.15488V496.77312a44.19584 44.19584 0 0 1 44.11904-44.16512h601.94304a44.1856 44.1856 0 0 1 44.12416 44.16v367.3344z m-331.71456-309.9648a62.69952 62.69952 0 0 0-34.816 114.82112v103.45984a34.816 34.816 0 1 0 69.632 0v-103.45984a62.69952 62.69952 0 0 0-34.80576-114.82112z" fill="#595BB3" p-id="7009"></path>
                                        </svg>
                                        <input class="pass" type="password" name="protectPassword" placeholder="请输入访问密码...">
                                        <input class="cid" type="hidden" name="protectCID" value="<?php $this->cid(); ?>" />
                                        <button type="submit">确定</button>
                                    </div>
                                </form>
                            </div>
                        <?php else : ?>
                            <!-- 否则直接输出 -->
                            <?php if ($this->fields->video) : ?>
                                <?php $this->need('component/post.video.php'); ?>
                            <?php endif ?>
                            <div class="markdown" id="markdown">
                                <?php
                                $db = Typecho_Db::get();
                                $sql = $db->select()->from('table.comments')
                                    ->where('cid = ?', $this->cid)
                                    ->where('mail = ?', $this->remember('mail', true))
                                    ->limit(1);
                                $result = $db->fetchAll($sql);
                                if ($this->user->hasLogin() || $result) {
                                    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '<div class="reply-content">$1</div>', $this->content);
                                } else {
                                    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '<p class="need-reply">此处内容 <span data-href="comments">回复</span> 可见</p>', $this->content);
                                }
                                echo $content
                                ?>
                            </div>
                        <?php endif ?>
                    <?php else : ?>
                        <!-- 为独立页面时，直接输出 -->
                        <?php if ($this->fields->video) : ?>
                            <?php $this->need('component/post.video.php'); ?>
                        <?php endif ?>
                        <!-- 文章内容 -->
                        <div class="markdown" id="markdown">
                            <?php
                            $db = Typecho_Db::get();
                            $sql = $db->select()->from('table.comments')
                                ->where('cid = ?', $this->cid)
                                ->where('mail = ?', $this->remember('mail', true))
                                ->limit(1);
                            $result = $db->fetchAll($sql);
                            if ($this->user->hasLogin() || $result) {
                                $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '<div class="reply-content">$1</div>', $this->content);
                            } else {
                                $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '<p class="need-reply">此处内容 <span data-href="comments">回复</span> 可见</p>', $this->content);
                            }
                            echo $content
                            ?>
                        </div>
                    <?php endif ?>



                    <!-- 标签 -->
                    <?php if ($this->options->JTagStatus === 'on') : ?>
                        <?php $this->need('component/post.tag.php'); ?>
                    <?php endif; ?>

                    <!-- 赞赏点赞 -->
                    <?php $this->need('component/post.fabulous.php'); ?>

                    <!-- 版权 -->
                    <?php if ($this->options->JBanQuanStatus === 'on') : ?>
                        <?php $this->need('component/post.banquan.php'); ?>
                    <?php endif; ?>

                    <!-- 相关文章 -->
                    <?php if ($this->options->JRelatedStatus === 'on' && $this->is('post')) : ?>
                        <?php $this->need('component/post.related.php'); ?>
                    <?php endif; ?>

                </div>

                <?php if ($this->is('post')) : ?>
                    <ul class="page">
                        <?php $this->theNext('<li class="left">%s</li>', '', ['title' => '上一篇']); ?>
                        <?php $this->thePrev('<li class="right">%s</li>', '', ['title' => '下一篇']); ?>
                    </ul>
                <?php endif; ?>

                <?php $this->need('public/comment.php'); ?>
            </section>

            <?php if ($this->options->JPostAsideStatus === 'on' && $this->fields->aside !== 'off') : ?>
                <?php $this->need('public/aside.php'); ?>
            <?php endif; ?>
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