<!-- 初始化页面背景与昼夜模式 -->
<div id="background"></div>
<script>
    if (localStorage.getItem("dark")) {
        document.querySelector("#j-day-night") && document.querySelector("#j-day-night").classList.add("dark")
        document.documentElement.setAttribute("dark", true)
    } else {
        document.querySelector("#j-day-night") && document.querySelector("#j-day-night").classList.remove("dark")
        document.documentElement.removeAttribute('dark')
    }
    function handleMode() {
        let background = document.querySelector('#background')
        /* 如果本地里面有dark，表示当前为黑夜模式 */
        if (localStorage.getItem('dark')) {
            background && (background.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: #222;
                z-index: -999;
            `)
        } else {
            /* 当是移动端时，只操作背景图和背景 */
            <?php if (isMobile()) : ?>
                <?php if ($this->options->JDocumentWAPBG) : ?>
                    /* 如果用户填写了移动端自定义背景，则优先显示自定义背景 */
                    background && (background.style.cssText = `
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: url(<?php $this->options->JDocumentWAPBG() ?>);
                        background-repeat: no-repeat;
                        background-size: cover;
                        background-position: center 0;
                        z-index: -999;
                    `)
                <?php else : ?>
                    /* 否则显示默认灰色 */
                    background && (background.style.cssText = `
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: #f5f5f5;
                        z-index: -999; 
                    `)
                <?php endif; ?>
            <?php else : ?>
                // 如果开启了动态背景，则显示动态背景
                <?php if ($this->options->JDocumentCanvasBG !== 'off') : ?>
                    background && (background.style.cssText = "display: none");
                    if (!document.querySelector("#canvasBg")) {
                        let scripts = document.createElement("script")
                        scripts.id = 'canvasBg';
                        scripts.src = '<?php $this->options->themeUrl('assets/background/' . $this->options->JDocumentCanvasBG); ?>'
                        document.body.appendChild(scripts)
                    }
                <?php else : ?>
                    <?php if ($this->options->JDocumentPCBG) : ?>
                        // 如果填写了背景图，则优先显示背景图
                        background && (background.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background: url(<?php $this->options->JDocumentPCBG() ?>);
                            background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center 0;
                            z-index: -999; 
                        `)
                    <?php else : ?>
                        // 没填写则显示默认的灰色
                        background && (background.style.cssText = `
                            position: fixed;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background: #f5f5f5;
                            z-index: -999; 
                        `)
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        }
    }
    handleMode()
</script>

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
<script src="https://cdn.jsdelivr.net/npm/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/draggabilly@2.3.0/dist/draggabilly.pkgd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js"></script>





<!-- live2d -->
<?php if ($this->options->JLive2D !== 'off' && !isMobile()) : ?>
    <script src="https://cdn.jsdelivr.net/npm/live2d-widget@3.1.4/lib/L2Dwidget.min.js"></script>
<?php endif; ?>


<!-- 颜色选择器 -->
<script src="https://cdn.jsdelivr.net/npm/jquery-colpick@3.1.0/js/colpick.min.js"></script>
<!-- 柱状图 -->
<script src="https://cdn.jsdelivr.net/npm/highcharts@8.2.2/highcharts.min.js"></script>
<!-- 代码高亮 -->
<?php if ($this->options->JCodeColor !== 'off') : ?>
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.1/build/highlight.min.js"></script>
<?php endif; ?>
<!-- 天气 -->
<?php if ($this->options->JWetherKey) : ?>
    <script src="https://apip.weatherdt.com/standard/static/js/weather-standard-common.js"></script>
<?php endif; ?>
<!-- 轮播图 -->
<script src="https://cdn.jsdelivr.net/npm/swiper@5.4.5/js/swiper.min.js"></script>
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
<!-- 弹幕 -->
<?php if ($this->options->JBarragerStatus === 'on') : ?>
    <script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/joe.barrager/joe.barrager.min.js"></script>
<?php endif; ?>
<!-- 3dtag -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/3DTag/3DTag.min.js"></script>
<!-- 目录树 -->
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/js/jfloor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/js/OwO.min.js"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.config.min.js?v=' . JoeVersion()); ?>"></script>


<!-- 鼠标点击特效 -->
<?php if ($this->options->JCursorEffects !== 'off') : ?>
    <script src="<?php $this->options->themeUrl('assets/cursor/' . $this->options->JCursorEffects); ?>"></script>
<?php endif; ?>

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