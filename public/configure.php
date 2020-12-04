<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
<script>
    window.JOE_CONFIG = {
        THEME_URL: '<?php echo THEME_URL ?>',
        /* 网站切换标题 */
        DOCUMENT_TITLE: '<?php $this->options->JDocumentTitle ? $this->options->JDocumentTitle() : null ?>',
        /* 弹幕 */
        DOCUMENT_BARRAGER: '<?php echo $this->options->JBarragerStatus === 'on' ? 'on' : 'off' ?>',
        /* 进度条 */
        DOCUMENT_PROGRESS: '<?php echo $this->options->JProgressStatus === 'on' ? 'on' : 'off' ?>',
        /* 2d人物 */
        DOCUMENT_LIVE2D: '<?php $this->options->JLive2D() ?>',
        /* 鼠标右键 */
        DOCUMENT_CONTEXTMENU: '<?php echo $this->options->JContextMenuStatus === 'on' ? 'on' : 'off' ?>',
        /* 主题色状态 */
        DOCUMENT_THEME_STATUS: '<?php echo $this->options->JGlobalThemeStatus === 'on' ? 'on' : 'off' ?>',
        /* 主题色 */
        DOCUMENT_GLOBAL_THEME: '<?php $this->options->JGlobalThemeColor() ?>',
        /* 鼠标移入音效 */
        DOCUMENT_HOVER_MUSIC: '<?php echo $this->options->JHoverMusicStatus === 'on' ? 'on' : 'off' ?>',
        /* 返回顶部 */
        DOCUMENT_BACK_TOP: '<?php echo $this->options->JBackTopStatus === 'on' ? 'on' : 'off' ?>',
        /* 统计 */
        DOCUMENT_CENSUS: {
            status: '<?php echo $this->options->JCensusStatus === 'on' ? 'on' : 'off' ?>',
            data: [<?php $stat->publishedPagesNum() ?>, <?php $stat->publishedPostsNum() ?>, <?php $stat->publishedCommentsNum() ?>, <?php $stat->categoriesNum() ?>],
        },
        /* 代码高亮 */
        DOCUMENT_HIGHT_LIGHT: '<?php echo $this->options->JCodeColor !== 'off' ? 'on' : 'off' ?>',
        /* 代码防偷 */
        DOCUMENT_CONSOLE: '<?php echo $this->options->JConsoleStatus === 'on' ? 'on' : 'off' ?>',
        /* 天气 */
        DOCUMENT_WEATHER_KEY: '<?php $this->options->JWetherKey() ?>',
        /* 天气显示类型 */
        DOCUMENT_WEATHER_TYPE: '<?php $this->options->JWetherType() ?>',
        /* 3d云标签 */
        DOCUMENT_3D_TAG: '<?php echo $this->options->J3DTagStatus === 'on' ? 'on' : 'off' ?>',
        /* 点击加载更多 */
        DOCUMENT_LOAD_MORE: '<?php $this->options->JPageStatus() ?>',
        /* 页面加载 */
        DOCUMENT_PAGE_LOADING: '<?php $this->options->JPageLoading() ?>',
        /* 轮播图 */
        DOCUMENT_SWIPER: '<?php echo $this->options->JIndexCarousel ? 'on' : 'off' ?>',
        /* 解析 */
        DOCUMENT_ANALYSIS: '<?php echo $this->options->JAnalysis ? 'on' : 'off' ?>',
        /* 弹幕API */
        DPLAYER_DANMAKU_API: '<?php $this->options->JDplayerAPI() ?>',
        /* 缓存 */
        DOCUMENT_CACHE: '<?php echo $this->options->JCache === 'on' ? 'on' : 'off' ?>',
        /* 是否是手机 */
        IS_MOBILE: '<?php echo isMobile() ? 'on' : 'off' ?>',
        /* PC端动画 */
        DOCUMENT_PC_ANIMATION: '<?php $this->options->JPCAnimation() ?>',
        /* WAP端动画 */
        DOCUMENT_WAP_ANIMATION: '<?php $this->options->JWapAnimation() ?>',
        /* 侧边栏自定义一言 */
        DOCUMENT_ASIDE_MOTTO: '<?php echo $this->options->JMotto ? 'on' : 'off' ?>',
        /* 自定义一言API */
        DOCUMENT_MOTTO_API: '<?php echo $this->options->JMottoAPI ? $this->options->JMottoAPI : 'https://api.vvhan.com/api/ian' ?>',
        /* 百度收录 */
        DOCUMENT_BAIDU_TOKEN: '<?php echo $this->options->JBaiDuPushToken() ?>',
        /* 懒加载 */
        DOCUMENT_LAZY_LOAD: '<?php echo GetLazyLoad() ?>',
        /* 苹果CMS API */
        VIDEO_LIST_API: '<?php echo $this->options->JVideoListAPI() ?>',
        /* 被屏蔽的分类 */
        VIDEO_LIST_SHIELD: '<?php echo $this->options->JShieldNames() ?>'
    }
</script>