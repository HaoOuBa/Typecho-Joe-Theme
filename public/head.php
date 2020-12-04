<meta charset="utf-8" />
<meta name="renderer" content="webkit" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="author" content="Joe, QQ群：966245514" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<?php if ($this->fields->sharePic || $this->options->JQQSharePic) : ?>
    <meta itemprop="image" content="<?php echo GetQQSharePic($this); ?>" />
<?php endif; ?>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no, viewport-fit=cover">

<!-- favicon图标 -->
<link rel="shortcut icon" href="<?php echo $this->options->JFavicon ? $this->options->JFavicon : 'https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/img/favicon.ico'; ?>" />

<!-- Typecho自有函数 -->
<?php if ($this->fields->keywords || $this->fields->desc) : ?>
    <?php $this->header('keywords=' . $this->fields->keywords . '&description=' . $this->fields->desc); ?>
<?php else : ?>
    <?php $this->header(); ?>
<?php endif; ?>

<!-- 网站标题 -->
<title>
    <?php if ($this->_currentPage > 1) echo '第 ' . $this->_currentPage . ' 页 - '; ?>
    <?php $this->archiveTitle(
        array(
            'category' => '分类 %s 下的文章',
            'search' => '包含关键字 %s 的文章', 'tag' =>  '标签 %s 下的文章', 'author' => '%s 发布的文章'
        ),
        '',
        ' - '
    ); ?>
    <?php $this->options->title(); ?>
</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap-grid.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.7.2/animate.min.css">

<!-- 颜色选择器 -->
<?php if ($this->options->JGlobalThemeStatus === 'on') : ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-colpick@3.1.0/css/colpick.min.css" />
<?php endif; ?>

<!-- 代码高亮 -->
<?php if ($this->options->JCodeColor !== 'off') : ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.1/build/styles/<?php $this->options->JCodeColor() ?>.min.css">
<?php endif; ?>

<!-- 页面加载 -->
<?php if ($this->options->JPageLoading !== "off") : ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fakeloader@1.0.0/fakeLoader.min.css" />
<?php endif; ?>

<!-- 播放器 -->
<?php if ($this->options->JPlayer) : ?>
    <link href="https://cdn.jsdelivr.net/npm/aplayer@1.10.1/dist/APlayer.min.css" rel="stylesheet" />
<?php endif; ?>

<!-- 轮播图 -->
<?php if ($this->options->JIndexCarousel) : ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@5.4.5/css/swiper.min.css">
<?php endif; ?>

<?php if ($this->options->JCDN === 'on') : ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/assets/css/OwO.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/assets/css/joe.min.css?v=<?php echo JoeVersion() ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/assets/css/joe.responsive.min.css?v=<?php echo JoeVersion() ?>" />
<?php else : ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/OwO.min.css'); ?>" />
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.min.css?v=' . JoeVersion()); ?>" />
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.responsive.min.css?v=' . JoeVersion()); ?>" />
<?php endif; ?>

<!-- joe 弹窗提示 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/library/joe.toast/joe.toast.min.css" />

<style>
    :root {
        --element: #409eff;
        cursor: <?php echo $this->options->JCursorType !== 'off' ? 'url(' . THEME_URL . '\/assets\/cur\/' . $this->options->JCursorType . '), auto' : 'auto' ?>;
        --classA: <?php echo $this->options->JClassA ? $this->options->JClassA : '#dcdfe6' ?>;
        --classB: <?php echo $this->options->JClassB ? $this->options->JClassB : '#e4e7ed' ?>;
        --classC: <?php echo $this->options->JClassC ? $this->options->JClassC : '#ebeef5' ?>;
        --classD: <?php echo $this->options->JClassD ? $this->options->JClassD : '#f2f6fc' ?>;
        --main: <?php echo $this->options->JMainColor ? $this->options->JMainColor : '#303133' ?>;
        --routine: <?php echo $this->options->JRoutineColor ? $this->options->JRoutineColor : '#606266' ?>;
        --minor: <?php echo $this->options->JMinorColor ? $this->options->JMinorColor : '#909399' ?>;
        --seat: <?php echo $this->options->JSeatColor ? $this->options->JSeatColor : '#c0c4cc' ?>;
        --success: <?php echo $this->options->JSuccessColor ? $this->options->JSuccessColor : '#67c23a' ?>;
        --warning: <?php echo $this->options->JWarningColor ? $this->options->JWarningColor : '#e6a23c' ?>;
        --danger: <?php echo $this->options->JDangerColor ? $this->options->JDangerColor : '#f56c6c' ?>;
        --info: <?php echo $this->options->JInfoColor ? $this->options->JInfoColor : '#909399' ?>;
        --radius-pc: <?php echo $this->options->JRadiusPC ?>;
        --radius-wap: <?php echo $this->options->JRadiusWap ?>;
        --text-shadow: <?php echo $this->options->JTextShadow ? $this->options->JTextShadow : '0 1px 2px rgba(0, 0, 0, 0.25)' ?>;
        --box-shadow: <?php echo $this->options->JBoxShadow ? $this->options->JBoxShadow : '0px 0px 20px -5px rgba(158, 158, 158, 0.22)' ?>;
        --background: <?php echo $this->options->JCardBackground ? $this->options->JCardBackground : '#fff' ?>;
        --swiper-theme-color: #fff !important;
    }

    <?php $this->options->JCustomCSS() ?>
</style>

<?php $this->need('public/configure.php'); ?>

<?php $this->options->JCustomHeadEnd() ?>