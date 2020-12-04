<!-- 音乐播放器 -->
<?php if ($this->options->JPlayer && !isMobile()) : ?>
    <meting-js id="<?php $this->options->JPlayer(); ?>" lrc-type="1" server="netease" storage-name="meting" theme="#ebebeb" autoplay type="playlist" fixed="true" list-olded="true"></meting-js>
    <script src="https://cdn.jsdelivr.net/npm/aplayer@1.10.1/dist/APlayer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/meting@2.0.1/dist/Meting.min.js"></script>
<?php endif; ?>

<?php $this->footer(); ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.qrcode@1.0.3/jquery.qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@0.14.16/dist/hls.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dplayer@1.26.0/dist/DPlayer.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/draggabilly@2.3.0/dist/draggabilly.pkgd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js"></script>

<!-- live2d -->
<?php if ($this->options->JLive2D !== 'off' && !isMobile()) : ?>
    <script src="https://cdn.jsdelivr.net/npm/live2d-widget@3.1.4/lib/L2Dwidget.min.js"></script>
<?php endif; ?>


<!-- 颜色选择器 -->
<?php if ($this->options->JGlobalThemeStatus === 'on') : ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery-colpick@3.1.0/js/colpick.min.js"></script>
<?php endif; ?>

<!-- 柱状图 -->
<?php if ($this->options->JCensusStatus === 'on') : ?>
    <script src="https://cdn.jsdelivr.net/npm/highcharts@8.2.2/highcharts.min.js"></script>
<?php endif; ?>

<!-- 代码高亮 -->
<?php if ($this->options->JCodeColor !== 'off') : ?>
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.1/build/highlight.min.js"></script>
<?php endif; ?>

<!-- 天气 -->
<?php if ($this->options->JWetherKey) : ?>
    <script src="https://apip.weatherdt.com/standard/static/js/weather-standard-common.js"></script>
<?php endif; ?>

<!-- 页面加载 -->
<?php if ($this->options->JPageLoading !== "off") : ?>
    <script src="https://cdn.jsdelivr.net/npm/fakeloader@1.0.0/fakeLoader.min.js"></script>
<?php endif; ?>

<!-- 轮播图 -->
<?php if ($this->options->JIndexCarousel) : ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@5.4.5/js/swiper.min.js"></script>
<?php endif; ?>

<!-- 平滑滚动 -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/SmoothScroll/SmoothScroll.min.js"></script>

<!-- 图片懒加载 -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/joe.lazyload/joe.lazyload.min.js"></script>

<!-- 弹窗提示 -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/joe.toast/joe.toast.min.js"></script>

<!-- 画图 -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/sketchpad/sketchpad.min.js"></script>

<!-- 鱼群跳跃 -->
<?php if ($this->options->JFishStatus !== "off") : ?>
    <script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/js/fish.min.js"></script>
<?php endif; ?>

<?php if ($this->options->JCDN === 'on') : ?>
    <!-- 弹幕 -->
    <?php if ($this->options->JBarragerStatus === 'on') : ?>
        <script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/library/joe.barrager/joe.barrager.min.js"></script>
    <?php endif; ?>
    <!-- 3dtag -->
    <?php if ($this->options->J3DTagStatus === 'on') : ?>
        <script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/library/3DTag/3DTag.min.js"></script>
    <?php endif; ?>
    <!-- 目录树 -->
    <?php if ($this->options->JDirectoryStatus === 'on'  && !isMobile()) : ?>
        <script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/assets/js/jfloor.min.js"></script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/assets/js/OwO.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/assets/js/joe.config.js?v=<?php echo JoeVersion() ?>"></script>
<?php else : ?>
    <!-- 弹幕 -->
    <?php if ($this->options->JBarragerStatus === 'on') : ?>
        <script src="<?php $this->options->themeUrl('library/joe.barrager/joe.barrager.min.js'); ?>"></script>
    <?php endif; ?>
    <!-- 3dtag -->
    <?php if ($this->options->J3DTagStatus === 'on') : ?>
        <script src="<?php $this->options->themeUrl('library/3DTag/3DTag.min.js'); ?>"></script>
    <?php endif; ?>
    <!-- 目录树 -->
    <?php if ($this->options->JDirectoryStatus === 'on'  && !isMobile()) : ?>
        <script src="<?php $this->options->themeUrl('assets/js/jfloor.min.js'); ?>"></script>
    <?php endif; ?>
    <script src="<?php $this->options->themeUrl('assets/js/OwO.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/joe.config.js?v=' . JoeVersion()); ?>"></script>
<?php endif; ?>

<!-- 背景 -->
<?php $this->need('config/background.php'); ?>

<!-- 鼠标点击特效 -->
<?php $this->need('config/cursor.effect.php'); ?>

<script>
    <?php
    $p = Typecho_Cookie::getPrefix();
    $q = $p . '__typecho_notice';
    $y = $p . '__typecho_notice_type';
    if (isset($_COOKIE[$y]) && ($_COOKIE[$y] == 'success' || $_COOKIE[$y] == 'notice' || $_COOKIE[$y] == 'error')) {
        if (isset($_COOKIE[$q])) { ?>
            $.toast({
                type: "warning",
                message: '<?php echo preg_replace('#\[\"(.*?)\"\]#', '$1', $_COOKIE[$q]); ?>！'
            })
    <?php
            Typecho_Cookie::delete('__typecho_notice');
            Typecho_Cookie::delete('__typecho_notice_type');
        }
    } ?>
    /* 自定义JS */
    <?php $this->options->JCustomScript() ?>
</script>

<?php $this->options->JCustomBodyEnd() ?>