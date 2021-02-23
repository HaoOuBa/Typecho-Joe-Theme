<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once("core/core.php");
function themeConfig($form)
{
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    try {
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')->page(1, 1)))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT DEFAULT 0;');
        }
        if (!array_key_exists('agree', $db->fetchRow($db->select()->from('table.contents')->page(1, 1)))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `agree` INT DEFAULT 0;');
        }
        if (!array_key_exists('likes', $db->fetchRow($db->select()->from('table.comments')->page(1, 1)))) {
            $db->query('ALTER TABLE `' . $prefix . 'comments` ADD `likes` INT DEFAULT 0;');
        }
    } catch (Exception $e) {
        echo '<div style="display: none">' . $e->getMessage() . '</div>';
    }
?>
    <div class="j-setting-contain">
        <link href="<?php echo THEME_URL ?>/assets/css/joe.setting.min.css" rel="stylesheet" type="text/css" />
        <div>
            <div class="j-aside">
                <div class="logo">Joe <?php echo JoeVersion() ?></div>
                <ul class="j-setting-tab">
                    <li data-current="j-setting-notice">最新公告</li>
                    <li data-current="j-setting-global">公共设置</li>
                    <li data-current="j-setting-image">图片设置</li>
                    <li data-current="j-setting-post">文章设置</li>
                    <li data-current="j-setting-aside">侧栏设置</li>
                    <li data-current="j-setting-color">色彩圆角</li>
                    <li data-current="j-setting-index">首页设置</li>
                    <li data-current="j-setting-other">其他设置</li>
                </ul>
                <?php require_once("core/backup.php"); ?>
            </div>
        </div>
        <span id="j-version" style="display: none;"><?php echo JoeVersion() ?></span>
        <div class="j-setting-notice">请求数据中...</div>
        <script src="<?php echo THEME_URL ?>/assets/js/joe.setting.min.js"></script>
    <?php


    /* 公共设置 */

    $JCDN = new Typecho_Widget_Helper_Form_Element_Select(
        'JCDN',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '请选择是否启用CDN',
        '介绍：开启后，网站内的部分静态资源（css、js）将不会从本地进行读取，而采用cdn方式引入。<br />
         注意：如果样式异常，请关闭此项！！！
        '
    );
    $JCDN->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCDN->multiMode());

    $JDefend = new Typecho_Widget_Helper_Form_Element_Select(
        'JDefend',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '请选择是否开启网站维护',
        '介绍：开启后，网站所有页面将会显示维护界面，不可访问。'
    );
    $JDefend->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JDefend->multiMode());

    $JPrevent = new Typecho_Widget_Helper_Form_Element_Select(
        'JPrevent',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '请选择是否开启QQ防红拦截',
        '介绍：开启后，如果在QQ里打开网站，则会提示跳转浏览器打开'
    );
    $JPrevent->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JPrevent->multiMode());

    $JHeaderStyle = new Typecho_Widget_Helper_Form_Element_Select(
        'JHeaderStyle',
        array('default' => '居中（默认）', 'fluid' => '全屏'),
        'default',
        '选择一款您喜欢的头部风格',
        '介绍：根据您的个人爱好选择一款您喜爱的风格'
    );
    $JHeaderStyle->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JHeaderStyle->multiMode());


    $JCustomNavs = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomNavs',
        NULL,
        NULL,
        '导航栏自定义链接（非必填）',
        '介绍：用于自定义导航栏链接 <br />
         格式：跳转文字 || 跳转链接（中间使用两个竖杠分隔）<br />
         其他：一行一个，一行代表一个超链接 <br />
         例如：<br />
            百度一下 || https://baidu.com <br />
            腾讯视频 || https://v.qq.com
         '
    );
    $JCustomNavs->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCustomNavs);

    $JNavMaxNum = new Typecho_Widget_Helper_Form_Element_Select(
        'JNavMaxNum',
        array(
            '1' => '1个（默认）',
            '2' => '2个',
            '3' => '3个',
            '4' => '4个（推荐）',
            '5' => '5个',
            '6' => '6个',
            '7' => '7个',
        ),
        '1',
        '选择默认风格导航栏最大显示的个数',
        '介绍：该选项只会在PC端默认头部风格生效。用于设置最大多少个后，显示更多下拉框'
    );
    $JNavMaxNum->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JNavMaxNum->multiMode());

    $JHorseStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JHorseStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启页面顶部跑马灯',
        '介绍：开启后页面顶部将显示跑马灯特效 <br />
         注意：此项只会在当头部为居中风格下生效'
    );
    $JHorseStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JHorseStatus->multiMode());

    $JCensusStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JCensusStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启导航栏统计按钮（仅在分辨率大于768以上的设备显示）',
        '介绍：开启后将会显示HighCharts生成的柱状统计表'
    );
    $JCensusStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCensusStatus->multiMode());

    $JBarragerStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JBarragerStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启弹幕功能（仅限PC）',
        '介绍：开启后，网站将会显示评论弹幕功能，该功能采用CSS动画引擎，并非传统JS操作DOM，无任何性能消耗。'
    );
    $JBarragerStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JBarragerStatus->multiMode());

    $JSignStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JSignStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启登录和注册功能',
        '介绍：开启后，网站将会显示登录和注册按钮 <br />
         注意：注册功能需要您在后台开启允许注册才会显示'
    );
    $JSignStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JSignStatus->multiMode());

    $JProgressStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JProgressStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启或关闭页面进度条',
        '介绍：开启后，网站头部将会显示进度条，该进度条与页面长度成对应关系，页面滚动多少，那么进度条的宽度就是多少。'
    );
    $JProgressStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JProgressStatus->multiMode());

    $JPageStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JPageStatus',
        array('default' => '按钮切换形式（默认）', 'ajax' => '点击加载形式'),
        'default',
        '选择首页的分页形式',
        '介绍：选择一款您所喜欢的分页形式'
    );
    $JPageStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JPageStatus->multiMode());

    $JContextMenuStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JContextMenuStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'on',
        '是否开启禁用鼠标右键（仅限PC）',
        '介绍：开启后则鼠标右键不可用'
    );
    $JContextMenuStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JContextMenuStatus->multiMode());

    $JDocumentTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'JDocumentTitle',
        NULL,
        NULL,
        '网页被隐藏时显示的标题（非必填，仅限PC）',
        '介绍：在PC端切换网页标签时，网站标题显示的内容。如果不填写，则默认不开启'
    );
    $JDocumentTitle->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JDocumentTitle);

    $JCursorEffects = new Typecho_Widget_Helper_Form_Element_Select(
        'JCursorEffects',
        array(
            'off' => '关闭（默认）',
            'cursor1.min.js' => '烟花效果',
            'cursor2.min.js' => '气泡效果',
            'cursor3.min.js' => '富强、民主、和谐（消耗性能）',
            'cursor4.min.js' => '彩色爱心（消耗性能）'
        ),
        'off',
        '选择鼠标点击特效',
        '介绍：用于切换鼠标点击特效 '
    );
    $JCursorEffects->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCursorEffects->multiMode());

    $JPlayer = new Typecho_Widget_Helper_Form_Element_Text(
        'JPlayer',
        NULL,
        NULL,
        '网抑云的歌单ID（非必填，分辨率大于768像素才会显示）',
        '介绍：填写正确的歌单ID后将会显示播放器 <br />
         方法：打开 https://music.163.com/ 登陆自己的号找一个喜欢的歌单，复制地址栏上面的ID，例如149232428。<br />
         注意：填写则显示播放器，如果不填写则不显示'
    );
    $JPlayer->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JPlayer);

    $JCursorType = new Typecho_Widget_Helper_Form_Element_Select(
        'JCursorType',
        array(
            'off' => '默认样式（默认）',
            'cursor1.cur' => '风格1',
            'cursor2.cur' => '风格2',
            'cursor3.cur' => '风格3',
            'cursor4.cur' => '风格4',
            'cursor5.cur' => '风格5',
            'cursor6.cur' => '风格6',
        ),
        'off',
        '是否开启自定义鼠标风格（仅限PC）',
        '介绍：选择一款您所喜欢的鼠标默认样式。'
    );
    $JCursorType->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCursorType->multiMode());

    $JConsoleStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JConsoleStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启页面防调试',
        '介绍：开启后当有人打开f12控制台偷代码时，会强制跳转到Typecho-Joe-Theme/console.html页面'
    );
    $JConsoleStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JConsoleStatus->multiMode());

    $JCustomCSS = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomCSS',
        NULL,
        NULL,
        '自定义CSS（非必填）',
        '介绍：请填写自定义CSS内容，填写时无需填写style标签。'
    );
    $JCustomCSS->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCustomCSS);

    $JCustomScript = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomScript',
        NULL,
        NULL,
        '自定义JS（非必填，请看下方介绍）',
        '介绍：请填写自定义JS内容，例如网站统计等，填写时无需填写script标签。<br />
         注意：该处的JS优先级最高，如果你不小心写错了一个单词，或英文逗号写成了中文逗号，都有可能导致整个模板瘫痪！非专业人士请勿填写！'
    );
    $JCustomScript->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCustomScript);

    $JCustomHeadEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomHeadEnd',
        NULL,
        NULL,
        '自定义head标签末尾位置内容',
        '介绍：此处用于填写在&lt;head&gt;&lt;/head&gt;内末尾的内容'
    );
    $JCustomHeadEnd->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCustomHeadEnd);

    $JCustomBodyStart = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomBodyStart',
        NULL,
        NULL,
        '自定义body标签开始位置内容',
        '介绍：此处用于填写在&lt;body&gt;&lt;/body&gt;开始位置的内容'
    );
    $JCustomBodyStart->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCustomBodyStart);

    $JCustomBodyEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomBodyEnd',
        NULL,
        NULL,
        '自定义body标签末尾位置内容',
        '介绍：此处用于填写在&lt;body&gt;&lt;/body&gt;末尾位置的内容'
    );
    $JCustomBodyEnd->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCustomBodyEnd);




    $JLive2D = new Typecho_Widget_Helper_Form_Element_Select(
        'JLive2D',
        array(
            'off' => '关闭（默认）',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-shizuku@1.0.5/assets/shizuku.model.json' => 'shizuku',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-izumi@1.0.5/assets/izumi.model.json' => 'izumi',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-haru@1.0.5/01/assets/haru01.model.json' => 'haru01',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-haru@1.0.5/02/assets/haru02.model.json' => 'haru02',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-wanko@1.0.5/assets/wanko.model.json' => 'wanko',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-hijiki@1.0.5/assets/hijiki.model.json' => 'hijiki',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-koharu@1.0.5/assets/koharu.model.json' => 'koharu',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-z16@1.0.5/assets/z16.model.json' => 'z16',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-haruto@1.0.5/assets/haruto.model.json' => 'haruto',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-tororo@1.0.5/assets/tororo.model.json' => 'tororo',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-chitose@1.0.5/assets/chitose.model.json' => 'chitose',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-miku@1.0.5/assets/miku.model.json' => 'miku',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-epsilon2_1@1.0.5/assets/Epsilon2.1.model.json' => 'Epsilon2.1',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-unitychan@1.0.5/assets/unitychan.model.json' => 'unitychan',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-nico@1.0.5/assets/nico.model.json' => 'nico',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-rem@1.0.1/assets/rem.model.json' => 'rem',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-nito@1.0.5/assets/nito.model.json' => 'nito',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-nipsilon@1.0.5/assets/nipsilon.model.json' => 'nipsilon',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-ni-j@1.0.5/assets/ni-j.model.json' => 'ni-j',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-nietzsche@1.0.5/assets/nietzche.model.json' => 'nietzche',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-platelet@1.1.0/assets/platelet.model.json' => 'platelet',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-isuzu@1.0.4/assets/model.json' => 'isuzu',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-jth@1.0.0/assets/model/katou_01/katou_01.model.json' => 'katou_01',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-mikoto@1.0.0/assets/mikoto.model.json' => 'mikoto',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-mashiro-seifuku@1.0.1/assets/seifuku.model.json' => 'seifuku',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-ichigo@1.0.1/assets/ichigo.model.json' => 'ichigo',
            'https://cdn.jsdelivr.net/npm/live2d-widget-model-hk_fos@1.0.0/assets/hk416.model.json' => 'hk416'

        ),
        'off',
        '选择一款喜爱的Live2D人物模型（仅限PC并且屏幕大于1600像素才会显示）',
        '介绍：开启后会在右下角显示一个小人，该功能采用远程调用不会消耗性能'
    );
    $JLive2D->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JLive2D->multiMode());

    $JBackTopStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JBackTopStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启返回顶部',
        '介绍：开启后将在屏幕右下方显示返回顶部按钮 <br />
         注意：页面滚动到一定的高度才会显示返回顶部按钮，并不会一直显示'
    );
    $JBackTopStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JBackTopStatus->multiMode());

    $JGlobalThemeColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JGlobalThemeColor',
        NULL,
        NULL,
        '网站默认主题色（非必填，填写时请务必按格式填写正确！例如：#ff6800）',
        '介绍：用户第一次进入页面，或者是在前台没有选择过颜色时候的默认主题色 <br />
         格式：颜色值（例如：#ff6800），若填写请务必按照格式填写，否则会导致网站主题色无法显示！！！'
    );
    $JGlobalThemeColor->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JGlobalThemeColor);

    $JGlobalThemeStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JGlobalThemeStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '请选择是否开启自定义主题',
        '介绍：本模板的特色，采用最新CSS var语法，无任何性能消耗，极其推荐开启 <br />
         注意：不兼容垃圾IE'
    );
    $JGlobalThemeStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JGlobalThemeStatus->multiMode());

    $JCountTime = new Typecho_Widget_Helper_Form_Element_Select(
        'JCountTime',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启页面加载计时',
        '介绍：开启后页面最底部将显示一个加载计时'
    );
    $JCountTime->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JCountTime->multiMode());

    $JBanQuan = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JBanQuan',
        NULL,
        NULL,
        '底部版权文字（非必填）',
        '介绍：字数请勿过多，内容随意。例如：备案信息xxxx，支持html标签'
    );
    $JBanQuan->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JBanQuan);

    $JBanQuanLinks = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JBanQuanLinks',
        NULL,
        NULL,
        '底部链接（非必填）',
        '介绍：要求：a标签格式。例如：&lt;a href="/"&gt;首页&lt;/a&gt; &lt;a href="/"&gt;关于&lt;/a&gt;'
    );
    $JBanQuanLinks->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JBanQuanLinks);

    $JGravatars = new Typecho_Widget_Helper_Form_Element_Select(
        'JGravatars',
        array(
            'gravatar.helingqi.com/wavatar' => '禾令奇（默认）',
            'www.gravatar.com/avatar' => 'gravatar的www源',
            'cn.gravatar.com/avatar' => 'gravatar的cn源',
            'secure.gravatar.com/avatar' => 'gravatar的secure源',
            'sdn.geekzu.org/avatar' => '极客族',
            'cdn.v2ex.com/gravatar' => 'v2ex源',
            'dn-qiniu-avatar.qbox.me/avatar' => '七牛源[不建议]',
            'gravatar.loli.net/avatar' => 'loli.net源',
        ),
        'gravatar.helingqi.com/wavatar',
        '选择头像源',
        '介绍：不同的源响应速度不同，头像也不同'
    );
    $JGravatars->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JGravatars->multiMode());

    $JHoverMusicStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JHoverMusicStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启鼠标划入音效（仅限PC）',
        '介绍：开启后，当鼠标划入到带有 j-hover-music 的类名上时，页面将会播放钢琴音效 <br />
         例如：网站头部的 logo 。如果您想自定义地方，请在需要添加的元素加上 j-hover-music 类名即可。'
    );
    $JHoverMusicStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JHoverMusicStatus->multiMode());

    $JFishStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JFishStatus',
        array(
            'off' => '关闭（默认）',
            'top' => '开启并显示在footer上方',
            'bottom' => '开启并显示在footer下方',
        ),
        'off',
        '是否开启全部底部的鱼群跳跃动画',
        '介绍：开启后，网站底部会有动态的鱼群跳跃动画'
    );
    $JFishStatus->setAttribute('class', 'j-setting-content j-setting-global');
    $form->addInput($JFishStatus->multiMode());

    /* 图片设置 */
    $JLazyLoad = new Typecho_Widget_Helper_Form_Element_Text(
        'JLazyLoad',
        NULL,
        NULL,
        '全局懒加载图（非必填）',
        '介绍：用于修改全局懒加载图片 <br />
         格式：base64 或者 图片url'
    );
    $JLazyLoad->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($JLazyLoad);

    $Jmos = new Typecho_Widget_Helper_Form_Element_Textarea(
        'Jmos',
        NULL,
        NULL,
        '自定义默认缩略图（非必填）',
        '填写图片地址，一行一个，文章中没有图片时将随机使用这里面的图片地址。也可以填写图片API。不填写则使用程序内置的图片（哆啦B梦）'
    );
    $Jmos->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($Jmos);

    $JFavicon = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFavicon',
        NULL,
        NULL,
        '网站 favicon 设置（非必填）',
        '介绍：用于设置网站 favicon，一个好的 favicon 可以给用户一种很专业的观感 <br />
         格式：图片 URL地址 或 图片 Base64 地址 <br />
         其他：免费转换 favicon 网站 <a target="_blank" href="//tool.lu/favicon">tool.lu/favicon</a>'
    );
    $JFavicon->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($JFavicon);

    $JLogo = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JLogo',
        NULL,
        NULL,
        '网站 logo 设置（非必填）',
        '介绍：用于设置网站 logo，一个好的 logo 能为网站带来有效的流量 <br />
         格式：图片 URL地址 或 图片 Base64 地址 <br />
         其他：免费制作 logo 网站 <a target="_blank" href="//www.uugai.com">www.uugai.com</a>'
    );
    $JLogo->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($JLogo);

    $JDocumentCanvasBG = new Typecho_Widget_Helper_Form_Element_Select(
        'JDocumentCanvasBG',
        array(
            'off' => '关闭（默认）',
            'background1.min.js' => '效果1',
            'background2.min.js' => '效果2',
            'background3.min.js' => '效果3',
            'background4.min.js' => '效果4',
            'background5.min.js' => '效果5',
            'background6.min.js' => '效果6'
        ),
        'off',
        '是否开启动态背景图（仅限PC）',
        '介绍：开启后下方您所设置的PC端自定义背景图将会失效，以动态背景优先，并且手机端是不支持此项的。<br />
         注意：此项由于是canvas生成，所以开启这项是影响性能的！'
    );
    $JDocumentCanvasBG->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($JDocumentCanvasBG->multiMode());

    $JDocumentPCBG = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JDocumentPCBG',
        NULL,
        NULL,
        'PC端网站背景图片（非必填）',
        '介绍：PC端网站的背景图片，不填写时显示默认的灰色。<br />
         格式：图片URL地址 或 随机图片api 例如：http://api.btstu.cn/sjbz/?lx=dongman <br />
         注意：若您想使用自定义图片，请先关闭上方的动态背景，否则该项不会起作用。'
    );
    $JDocumentPCBG->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($JDocumentPCBG);

    $JDocumentWAPBG = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JDocumentWAPBG',
        NULL,
        NULL,
        'WAP端网站背景图片（非必填）',
        '介绍：WAP端网站的背景图片，不填写时显示默认的灰色。<br />
         格式：图片URL地址 或 随机图片api 例如：http://api.btstu.cn/sjbz/?lx=m_dongman'
    );
    $JDocumentWAPBG->setAttribute('class', 'j-setting-content j-setting-image');
    $form->addInput($JDocumentWAPBG);


    /* 文章设置 */

    $JBaiDuPushToken = new Typecho_Widget_Helper_Form_Element_Text(
        'JBaiDuPushToken',
        NULL,
        NULL,
        '百度推送Token',
        '介绍：填写则后则未收录的网址，可直接点击直接提交'
    );
    $JBaiDuPushToken->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JBaiDuPushToken);

    $JBreadStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JBreadStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启面包屑导航',
        '介绍：开启后，文章页面顶部将会显示面包屑导航。'
    );
    $JBreadStatus->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JBreadStatus->multiMode());

    $JPostCountingStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JPostCountingStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启统计信息',
        '介绍：开启后，在文章的大标题下方将会显示该篇文章的统计信息，例如浏览量、百度收录、文章发布时间等。'
    );
    $JPostCountingStatus->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JPostCountingStatus->multiMode());

    $JCodeColor = new Typecho_Widget_Helper_Form_Element_Select(
        'JCodeColor',
        array(
            'off' => '关闭该插件（默认）',
            'github' => 'github',
            'darcula' => 'darcula',
            'zenburn' => 'zenburn',
            'xt256' => 'xt256',
            'xcode' => 'xcode',
            'vs2015' => 'vs2015',
            'vs' => 'vs',
            'tomorrow-night-eighties' => 'tomorrow-night-eighties',
            'tomorrow-night-bright' => 'tomorrow-night-bright',
            'tomorrow-night-blue' => 'tomorrow-night-blue',
            'tomorrow-night' => 'tomorrow-night',
            'tomorrow' => 'tomorrow',
            'sunburst' => 'sunburst',
            'srcery' => 'srcery',
            'solarized-light' => 'solarized-light',
            'solarized-dark' => 'solarized-dark',
            'shades-of-purple' => 'shades-of-purple',
            'school-book' => 'school-book',
            'routeros' => 'routeros',
            'rainbow' => 'rainbow',
            'railscasts' => 'railscasts',
            'qtcreator_light' => 'qtcreator_light',
            'qtcreator_dark' => 'qtcreator_dark',
            'purebasic' => 'purebasic',
            'pojoaque' => 'pojoaque',
            'paraiso-light' => 'paraiso-light',
            'paraiso-dark' => 'paraiso-dark',
            'ocean' => 'ocean',
            'obsidian' => 'obsidian',
            'nord' => 'nord',
            'nnfx-dark' => 'nnfx-dark',
            'nnfx' => 'nnfx',
            'night-owl' => 'night-owl',
            'monokai-sublime' => 'monokai-sublime',
            'monokai' => 'monokai',
            'magula' => 'magula',
            'lioshi' => 'lioshi',
            'lightfair' => 'lightfair',
            'kimbie.light' => 'kimbie.light',
            'kimbie.dark' => 'kimbie.dark',
            'isbl-editor-light' => 'isbl-editor-light',
            'isbl-editor-dark' => 'isbl-editor-dark',
            'ir-black' => 'ir-black',
            'idea' => 'idea',
            'hybrid' => 'hybrid',
            'hopscotch' => 'hopscotch',
            'gruvbox-light' => 'gruvbox-light',
            'gruvbox-dark' => 'gruvbox-dark',
            'grayscale' => 'grayscale',
            'gradient-light' => 'gradient-light',
            'gradient-dark' => 'gradient-dark',
            'googlecode' => 'googlecode',
            'gml' => 'gml',
            'github-gist' => 'github-gist',
            'foundation' => 'foundation',
            'far' => 'far',
            'dracula' => 'dracula',
            'docco' => 'docco',
            'default' => 'default',
            'dark' => 'dark',
            'color-brewer' => 'color-brewer',
            'codepen-embed' => 'codepen-embed',
            'brown-paper' => 'brown-paper',
            'atom-one-light' => 'atom-one-light',
            'atom-one-dark-reasonable' => 'atom-one-dark-reasonable',
            'atom-one-dark' => 'atom-one-dark',
            'atelier-sulphurpool-light' => 'atelier-sulphurpool-light',
            'atelier-sulphurpool-dark' => 'atelier-sulphurpool-dark',
            'atelier-seaside-light' => 'atelier-seaside-light',
            'atelier-seaside-dark' => 'atelier-seaside-dark',
            'atelier-savanna-light' => 'atelier-savanna-light',
            'atelier-savanna-dark' => 'atelier-savanna-dark',
            'atelier-plateau-light' => 'atelier-plateau-light',
            'atelier-plateau-dark' => 'atelier-plateau-dark',
            'atelier-lakeside-light' => 'atelier-lakeside-light',
            'atelier-lakeside-dark' => 'atelier-lakeside-dark',
            'atelier-heath-light' => 'atelier-heath-light',
            'atelier-heath-dark' => 'atelier-heath-dark',
            'atelier-forest-light' => 'atelier-forest-light',
            'atelier-forest-dark' => 'atelier-forest-dark',
            'atelier-estuary-light' => 'atelier-estuary-light',
            'atelier-estuary-dark' => 'atelier-estuary-dark',
            'atelier-dune-light' => 'atelier-dune-light',
            'atelier-dune-dark' => 'atelier-dune-dark',
            'atelier-cave-light' => 'atelier-cave-light',
            'atelier-cave-dark' => 'atelier-cave-dark',
            'ascetic' => 'ascetic',
            'arta' => 'arta',
            'arduino-light' => 'arduino-light',
            'an-old-hope' => 'an-old-hope',
            'androidstudio' => 'androidstudio',
            'agate' => 'agate',
            'a11y-light' => 'a11y-light',
            'a11y-dark' => 'a11y-dark'
        ),
        'off',
        '选择一款你所喜欢的代码高亮风格',
        '介绍：强大的语法高亮插件，多种风格供您选择，如果以上还是没有您所喜欢的风格，请关闭该插件，自行使用其他插件'
    );
    $JCodeColor->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JCodeColor->multiMode());

    $JTagStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JTagStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启文章底部标签和操作按钮',
        '介绍：开启后，文章底部将显示标签和操作按钮'
    );
    $JTagStatus->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JTagStatus->multiMode());

    $JBanQuanStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JBanQuanStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启转载版权信息',
        '介绍：开启后，在文章末尾将会显示转载的版权信息。'
    );
    $JBanQuanStatus->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JBanQuanStatus->multiMode());

    $JRelatedStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JRelatedStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启相关文章',
        '介绍：开启后，文章结尾处将会显示当前文章的其他相关文章，如果没有推荐的文章，那么相关推荐是不会显示的。'
    );
    $JRelatedStatus->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JRelatedStatus->multiMode());

    $JDirectoryStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JDirectoryStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启文章页和自定义页目录树（仅限PC并且分辨率大于1570像素才会显示）',
        '介绍：开启后，文章页面和自定义页面将显示目录树（小屏幕上不会显示）'
    );
    $JDirectoryStatus->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JDirectoryStatus->multiMode());

    $JAdmire = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAdmire',
        NULL,
        NULL,
        '3合一收款码（非必填）',
        '介绍：填写则显示文章页与自定义页面的赞赏功能 <br />
         格式：图片地址<br />
         其他：免费生成网址：<a href="http://qrcode.xiaod8.cn" target="_blank">http://qrcode.xiaod8.cn</a>'
    );
    $JAdmire->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JAdmire);

    $JQQSharePic = new Typecho_Widget_Helper_Form_Element_Text(
        'JQQSharePic',
        NULL,
        NULL,
        'QQ内分享链接时的缩略图',
        '介绍：填写则显示分享缩略图，不填写则看脸取网站随机图片'
    );
    $JQQSharePic->setAttribute('class', 'j-setting-content j-setting-post');
    $form->addInput($JQQSharePic);


    /* 侧边栏 */
    $JIndexAsideStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JIndexAsideStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启PC首页和搜索页侧边栏',
        '介绍：开启后，首页和搜索页将显示侧边栏（首先您得先开启下面设置的侧边栏，如果您只开启了此项，而下面的侧边栏选项都是关闭的。那么开启和关闭没什么区别）'
    );
    $JIndexAsideStatus->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JIndexAsideStatus->multiMode());

    $JPostAsideStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JPostAsideStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启PC文章页和自定义页面的侧边栏',
        '介绍：开启后，文章页和自定义页面将显示侧边栏（首先您得先开启下面设置的侧边栏，如果您只开启了此项，而下面的侧边栏选项都是关闭的。那么开启和关闭没什么区别）'
    );
    $JPostAsideStatus->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JPostAsideStatus->multiMode());

    $JADContent1 = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JADContent1',
        NULL,
        NULL,
        '侧边栏广告1（非必填）',
        '介绍：如果不写，则代表不显示这个广告，填写时请务必填写正确！<br />
         格式：广告图片 || 跳转链接 （中间使用两个竖杠分隔）<br />
         例如：http://ae.js.cn/usr/themes/Typecho-Joe-Theme/assets/img/random/3.webp || http://ae.js.cn <br />
         注意：如果您只想显示图片不想跳转，可填写：广告图片 || javascript:void(0)'
    );
    $JADContent1->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JADContent1);

    $JADContent2 = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JADContent2',
        NULL,
        NULL,
        '侧边栏广告2（非必填）',
        '介绍：如果不写，则代表不显示这个广告，填写时请务必填写正确！<br />
         格式：广告图片 || 跳转链接 （中间使用两个竖杠分隔）<br />
         例如：http://ae.js.cn/usr/themes/Typecho-Joe-Theme/assets/img/random/3.webp || http://ae.js.cn <br />
         注意：如果您只想显示图片不想跳转，可填写：广告图片 || javascript:void(0)'
    );
    $JADContent2->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JADContent2);

    $JAsideCustom = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAsideCustom',
        NULL,
        NULL,
        '自定义侧边栏模块（选填）',
        '介绍：此处适用于您自定义内容 <br />
         格式：请填写前端代码，不会写请勿填写 <br />
         例如：您可以在此处添加一个搜索框功能、时间功能、宠物功能等等'
    );
    $JAsideCustom->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAsideCustom);

    $JAsideVisitor = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAsideVisitor',
        NULL,
        NULL,
        '访客信息API（非选填）',
        '介绍：请填写生成访客图片的API接口 <br />
         例如：https://api.vvhan.com/api/ip <br />
         其他：填写则显示，不填写则不显示
         '
    );
    $JAsideVisitor->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAsideVisitor);

    $JWetherKey = new Typecho_Widget_Helper_Form_Element_Text(
        'JWetherKey',
        NULL,
        NULL,
        '天气的KEY值（非必填）',
        '介绍：填写正确的 KEY 值将会显示天气组件，未填写则默认不显示 <br /> 
         注意：填写时请填写正确的KEY值！<br />
         免费申请地址：<a href="//cj.weather.com.cn">cj.weather.com.cn</a>'
    );
    $JWetherKey->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JWetherKey);

    $JWetherType = new Typecho_Widget_Helper_Form_Element_Select(
        'JWetherType',
        array('auto' => '自动（默认）', 'white' => '白色'),
        'auto',
        '选择一款喜欢的天气风格（需先填写上面的KEY）',
        '介绍：选择一款您所喜爱的天气风格'
    );
    $JWetherType->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JWetherType->multiMode());

    $J3DTagStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'J3DTagStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启3D云标签',
        '介绍：开启后侧边栏将显示3D云标签'
    );
    $J3DTagStatus->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($J3DTagStatus->multiMode());

    $JAsideReplyStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JAsideReplyStatus',
        array(
            'off' => '关闭（默认）',
            'on' => '开启',
        ),
        'off',
        '是否开启最新回复',
        '介绍：开启后侧边栏将显示最新回复'
    );
    $JAsideReplyStatus->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAsideReplyStatus->multiMode());

    $JAsideHotNumber = new Typecho_Widget_Helper_Form_Element_Select(
        'JAsideHotNumber',
        array(
            'off' => '关闭（默认）',
            '3' => '开启，并显示3条',
            '4' => '开启，并显示4条',
            '5' => '开启，并显示5条',
            '6' => '开启，并显示6条',
            '7' => '开启，并显示7条',
            '8' => '开启，并显示8条',
            '9' => '开启，并显示9条',
            '10' => '开启，并显示10条',
        ),
        'off',
        '是否开启热门文章',
        '介绍：开启后侧边栏将显示您设置的个数的热门文章'
    );
    $JAsideHotNumber->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAsideHotNumber->multiMode());

    $JAuthorStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JAuthorStatus',
        array(
            'off' => '关闭（默认）',
            '3' => '开启，并显示3条最新文章',
            '4' => '开启，并显示4条最新文章',
            '5' => '开启，并显示5条最新文章',
            '6' => '开启，并显示6条最新文章',
            '7' => '开启，并显示7条最新文章',
            '8' => '开启，并显示8条最新文章',
            '9' => '开启，并显示9条最新文章',
            '10' => '开启，并显示10条最新文章'
        ),
        'off',
        '是否开启作者信息',
        '介绍：开启后侧边栏将显示作者信息，并且显示的文章数由您决定。'
    );
    $JAuthorStatus->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAuthorStatus->multiMode());

    $JAuthorAvatar = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAuthorAvatar',
        NULL,
        NULL,
        '作者信息 —— 头像（非必填）',
        '请填写URL地址，如果不填写，将优先展示文章作者头像'
    );
    $JAuthorAvatar->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAuthorAvatar);

    $JAuthorLink = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAuthorLink',
        NULL,
        NULL,
        '作者信息 —— 点击昵称跳转链接（非必填）',
        '请填写URL地址，如果不填写则默认跳转到您的首页'
    );
    $JAuthorLink->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JAuthorLink);

    $JMotto = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JMotto',
        NULL,
        NULL,
        '作者信息 —— 座右铭（非必填）',
        '介绍：用于显示在侧边栏作者信息的座右铭。<br />
         格式：可以填写多行也可以填写一行，填写多行时，每次随机显示其中的某一条'
    );
    $JMotto->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JMotto);

    $JMottoAPI = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JMottoAPI',
        NULL,
        NULL,
        '作者信息 —— 座右铭默认API（非必填，不填写时采用默认API）',
        '介绍：用于填写默认的一言API。<br />
         格式：API格式有严格的要求，必须返回内容为纯文本，无其他内容，例如以下的API的返回格式！！！<br />
         默认API：https://api.vvhan.com/api/ian <br />
         注意：此项只会在上面座右铭未填写时才会生效
         '
    );
    $JMottoAPI->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JMottoAPI);

    $JCountDownStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JCountDownStatus',
        array(
            'off' => '关闭（默认）',
            'on' => '开启',
        ),
        'off',
        '是否开启人生倒计时',
        '介绍：开启后侧边栏将显示人生倒计时'
    );
    $JCountDownStatus->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JCountDownStatus->multiMode());

    $JRanking = new Typecho_Widget_Helper_Form_Element_Select(
        'JRanking',
        array(
            'off' => '关闭（默认）',
            '知乎全站排行榜$zhihu_total' => '知乎全站排行榜',
            '知乎科学排行榜$zhihu_science' => '知乎科学排行榜',
            '知乎数码排行榜$zhihu_digital' => '知乎数码排行榜',
            '知乎体育排行榜$zhihu_sport' => '知乎体育排行榜',
            '知乎时尚排行榜$zhihu_fashion' => '知乎时尚排行榜',
            '微博热搜榜$weibo' => '微博热搜榜',
            '微博新闻榜$weibo_news' => '微博新闻榜',
            '360实时热点$so_hotnews' => '360实时热点',
            '百度实时热点$baidu_ssrd' => '百度实时热点',
            '百度今日热点$baidu_today' => '百度今日热点',
            '百度七日热点$baidu_week' => '百度七日热点',
            '百度体育热点$baidu_sport' => '百度体育热点',
            '百度娱乐热点$baidu_yule' => '百度娱乐热点',
            '百度民生热点$baidu_minsheng' => '百度民生热点',
            '历史今天$lssdjt' => '历史今天',
            '网易24H新闻点击榜$t_en_dianji' => '网易24H新闻点击榜',
            '网易今日跟贴榜$t_en_today' => '网易今日跟贴榜',
            '网易1小时前点击榜$t_en_hour' => '网易1小时前点击榜',
            '网易娱乐跟贴榜$t_en_yule' => '网易娱乐跟贴榜',
            'CNBA点击榜$cnbeta_hot' => 'CNBA点击榜',
            'CNBA评论榜$cnbeta_comment' => 'CNBA评论榜',
            '虎嗅热文榜$huxiu' => '虎嗅热文榜',
            'IT之家24H最热榜$ithome_day' => 'IT之家24H最热榜',
            'IT之家一周最热榜$ithome_week' => 'IT之家一周最热榜',
            'IT之家月度热文榜$ithome_month' => 'IT之家月度热文榜',
            '36KR人气榜$kr_renqi' => '36KR人气榜',
            '36KR收藏榜$kr_shoucang' => '36KR收藏榜',
            '36KR综合榜$kr_zonghe' => '36KR综合榜',
            '少数派热文榜$sspai' => '少数派热文榜',
            '豆瓣新片榜$douban_day' => '豆瓣新片榜',
            '豆瓣口碑榜$douban_week' => '豆瓣口碑榜',
            '豆瓣北美榜$douban_na' => '豆瓣北美榜',
            '豆瓣京东畅销榜$douban_jd' => '豆瓣京东畅销榜',
            '豆瓣当当畅销榜$douban_dd' => '豆瓣当当畅销榜',
            '观察者24H最热榜$guancha_day' => '观察者24H最热榜',
            '观察者3天最热榜$guancha_three' => '观察者3天最热榜',
            '观察者一周最热榜$guancha_week' => '观察者一周最热榜',
            '晋江文学月排行榜$jjwxc_month' => '晋江文学月排行榜',
            '晋江文学季度榜$jjwxc_quater' => '晋江文学季度榜',
            '晋江文学总分榜$jjwxc_rank' => '晋江文学总分榜',
            '澎湃热门新闻榜$ppnews_day' => '澎湃热门新闻榜',
            '澎湃3天最热新闻榜$ppnews_three' => '澎湃3天最热新闻榜',
            '澎湃一周最热新闻榜$ppnews_week' => '澎湃一周最热新闻榜',
            '起点24小时畅销榜$qidian_day' => '起点24小时畅销榜',
            '起点周阅读指数榜$qidian_week' => '起点周阅读指数榜',
            '起点风云榜$qidian_fy' => '起点风云榜',
            '爱范儿热文排行榜$ifanr' => '爱范儿热文排行榜',
            'ACFun日榜$acfun_day' => 'ACFun日榜',
            'ACFun三日榜$acfun_three_days' => 'ACFun三日榜',
            'ACFun三日榜$acfun_three_days' => 'ACFun三日榜',
            'ACFun七日榜$acfun_week' => 'ACFun七日榜',
            'ACFun七日榜$acfun_week' => 'ACFun七日榜',
            '腾讯视频热门榜$qq_v' => '腾讯视频热门榜',
            'bilibili排行榜$bsite' => 'bilibili排行榜',
            'V2EX热门榜$vsite' => 'V2EX热门榜',
            '52破解热门榜$t_pj_hot' => '52破解热门榜',
            '52破解人气榜$t_pj_renqi' => '52破解人气榜',
            '52破解精品榜$t_pj_soft' => '52破解精品榜',
            '抖音视频榜$t_dy_hot' => '抖音视频榜',
            '抖音正能量榜$t_dy_right' => '抖音正能量榜',
            '抖音搜索榜$t_dy_s' => '抖音搜索榜',
            '汽车之家热门榜$t_auto_art' => '汽车之家热门榜',
            '汽车之家3日最热榜$t_auto_video' => '汽车之家3日最热榜',
            '今日头条周热榜$t_tt_week' => '今日头条周热榜',
            '看看新闻热点榜$kankan' => '看看新闻热点榜',
            '新京报今日热门榜$xingjing' => '新京报今日热门榜',
            '新京报本周热门榜$xingjing_week' => '新京报本周热门榜',
            '新京报本月热门榜$xingjing_month' => '新京报本月热门榜',
            'Zaker新闻榜$zaker' => 'Zaker新闻榜',
            '雪球话题榜$xueqiu' => '雪球话题榜',
            '天涯论坛热帖榜$tianya_retie' => '天涯论坛热帖榜',
            '钛媒体热文榜$tmtpost' => '钛媒体热文榜',
            'techweb排行榜$techweb' => 'techweb排行榜',
            '爱卡汽车热点榜$xcar_ssrd' => '爱卡汽车热点榜',
            '爱卡汽车人气榜$xcar_rq' => '爱卡汽车人气榜',
            '爱卡汽车关注榜$xcar_gz' => '爱卡汽车关注榜',
            '太平洋汽车热文榜$pcauto_art' => '太平洋汽车热文榜',
            '太平洋汽车热贴榜$pcauto_tie' => '太平洋汽车热贴榜',
            '新浪点击榜$sina_dj' => '新浪点击榜',
            '新浪评论榜$sina_pl' => '新浪评论榜',
            '新浪视频榜$sina_vd' => '新浪视频榜',
            '新浪图片榜$sina_pic' => '新浪图片榜'
        ),
        'off',
        '选择一款您想展示的排行榜',
        '介绍：开启后侧边栏将显示您所选择的排行榜 <br>
         注意：开启可能会导致网址变慢！！！
        '
    );
    $JRanking->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JRanking->multiMode());

    /* 色彩设置 */

    $JCardBackground = new Typecho_Widget_Helper_Form_Element_Text(
        'JCardBackground',
        NULL,
        NULL,
        '卡片背景色（非必填，不会写请勿填写！）',
        '介绍：用于修改卡片背景色，默认纯白色。<br />
         例如：您想使用自定义图片背景，但是卡片背景为纯白色，想增加点透明度。那么您可以填写 rgba(255,255,255,0.85) <br/>
         其他：rgba() 前3个数字为色彩，最后一个数字为0-1代表着透明度，不透明1，纯透明0 <br/>
         格式：严格的色彩格式，例如：rgba(255, 255, 255, 0.85)'
    );
    $JCardBackground->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JCardBackground);

    $JClassA = new Typecho_Widget_Helper_Form_Element_Text(
        'JClassA',
        NULL,
        NULL,
        '一级色彩（非必填，不会写请勿填写！）',
        '介绍：用于修改全局一级色彩。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JClassA->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JClassA);

    $JClassB = new Typecho_Widget_Helper_Form_Element_Text(
        'JClassB',
        NULL,
        NULL,
        '二级色彩（非必填，不会写请勿填写！）',
        '介绍：用于修改全局二级色彩。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JClassB->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JClassB);

    $JClassC = new Typecho_Widget_Helper_Form_Element_Text(
        'JClassC',
        NULL,
        NULL,
        '三级色彩（非必填，不会写请勿填写！）',
        '介绍：用于修改全局三级色彩。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JClassC->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JClassC);

    $JClassD = new Typecho_Widget_Helper_Form_Element_Text(
        'JClassD',
        NULL,
        NULL,
        '四级色彩（非必填，不会写请勿填写！）',
        '介绍：用于修改全局四级色彩。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JClassD->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JClassD);

    $JMainColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JMainColor',
        NULL,
        NULL,
        '主要文字色彩（非必填，不会写请勿填写！）',
        '介绍：用于修改全局主要文字色彩。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JMainColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JMainColor);

    $JRoutineColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JRoutineColor',
        NULL,
        NULL,
        '常规文字色彩（非必填，不会写请勿填写！）',
        '介绍：用于修改全局常规文字色彩。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JRoutineColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JRoutineColor);

    $JMinorColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JMinorColor',
        NULL,
        NULL,
        '次要文字色彩（非必填，不会写请勿填写！）',
        '介绍：用于修改全局次要文字色彩。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JMinorColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JMinorColor);

    $JSeatColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JSeatColor',
        NULL,
        NULL,
        '占位文字色彩（非必填，不会写请勿填写！）',
        '介绍：用于修改全局占位文字色彩。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JSeatColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JSeatColor);

    $JSuccessColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JSuccessColor',
        NULL,
        NULL,
        '成功色（非必填，不会写请勿填写！）',
        '介绍：用于修改全局成功色。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JSuccessColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JSuccessColor);

    $JWarningColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JWarningColor',
        NULL,
        NULL,
        '警告色（非必填，不会写请勿填写！）',
        '介绍：用于修改全局警告色。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JWarningColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JWarningColor);

    $JDangerColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JDangerColor',
        NULL,
        NULL,
        '危险色（非必填，不会写请勿填写！）',
        '介绍：用于修改全局危险色。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JDangerColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JDangerColor);

    $JInfoColor = new Typecho_Widget_Helper_Form_Element_Text(
        'JInfoColor',
        NULL,
        NULL,
        '信息色（非必填，不会写请勿填写！）',
        '介绍：用于修改全局信息色。<br />
         格式：严格的色彩格式，例如：#ff6800'
    );
    $JInfoColor->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JInfoColor);

    $JRadiusPC = new Typecho_Widget_Helper_Form_Element_Select(
        'JRadiusPC',
        array(
            '0px' => '0px（默认）',
            '1px' => '1px',
            '2px' => '2px',
            '3px' => '3px',
            '4px' => '4px',
            '5px' => '5px',
            '6px' => '6px',
            '7px' => '7px',
            '8px' => '8px（推荐）',
            '9px' => '9px',
            '10px' => '10px',
        ),
        '0px',
        '选择PC端边框圆角度数',
        '介绍：选择一款您所喜欢的PC端边框圆角'
    );
    $JRadiusPC->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JRadiusPC->multiMode());

    $JRadiusWap = new Typecho_Widget_Helper_Form_Element_Select(
        'JRadiusWap',
        array(
            '0px' => '0px（默认）',
            '1px' => '1px',
            '2px' => '2px',
            '3px' => '3px',
            '4px' => '4px（推荐）',
            '5px' => '5px',
            '6px' => '6px',
            '7px' => '7px',
            '8px' => '8px',
            '9px' => '9px',
            '10px' => '10px',
        ),
        '0px',
        '选择Wap端边框圆角度数',
        '介绍：选择一款您所喜欢的WAP端边框圆角'
    );
    $JRadiusWap->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JRadiusWap->multiMode());

    $JTextShadow = new Typecho_Widget_Helper_Form_Element_Text(
        'JTextShadow',
        NULL,
        NULL,
        '标题阴影（非必填，不会写请勿填写！）',
        '介绍：用于修改大标题阴影。<br />
         格式：严格的文字阴影色彩格式，例如：0 0 10px #ff6800 <br />
         默认：0 1px 2px rgba(0, 0, 0, 0.25) <br />
         格式：严格的文字阴影色彩格式，例如：0 1px 2px rgba(0, 0, 0, 0.25) <br />
         其他：在线调试阴影网站：<a href="//www.w3cschool.cn/tools/index?name=css3_textshadow" target="_blank">//www.w3cschool.cn/tools/index?name=css3_textshadow</a>
         '
    );
    $JTextShadow->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JTextShadow);

    $JBoxShadow = new Typecho_Widget_Helper_Form_Element_Text(
        'JBoxShadow',
        NULL,
        NULL,
        '盒子阴影（非必填，不会写请勿填写！）',
        '介绍：用于修改盒子的阴影。<br />
         格式：严格的盒子阴影色彩格式，例如：0 0 10px #ff6800 <br />
         默认：0px 0px 20px -5px rgba(158, 158, 158, 0.22) <br />
         其他：在线调试阴影网站：<a href="//www.w3cschool.cn/tools/index?name=css3_boxshadow" target="_blank">//www.w3cschool.cn/tools/index?name=css3_boxshadow</a>
         '
    );
    $JBoxShadow->setAttribute('class', 'j-setting-content j-setting-color');
    $form->addInput($JBoxShadow);

    /* 首页设置 */
    $JPCAnimation = new Typecho_Widget_Helper_Form_Element_Select(
        'JPCAnimation',
        array(
            'off' => '关闭（默认）',
            'jSlideUp' => 'jSlideUp',
            'jScale' => 'jScale',
            'jScaleUp' => 'jScaleUp',
            'bounce' => 'bounce',
            'flash' => 'flash',
            'pulse' => 'pulse',
            'rubberBand' => 'rubberBand',
            'shake' => 'shake',
            'swing' => 'swing',
            'tada' => 'tada',
            'wobble' => 'wobble',
            'bounceIn' => 'bounceIn',
            'bounceInLeft' => 'bounceInLeft',
            'bounceInRight' => 'bounceInRight',
            'bounceInUp' => 'bounceInUp',
            'bounceOut' => 'bounceOut',
            'bounceOutDown' => 'bounceOutDown',
            'bounceOutLeft' => 'bounceOutLeft',
            'bounceOutRight' => 'bounceOutRight',
            'bounceOutUp' => 'bounceOutUp',
            'fadeIn' => 'fadeIn',
            'fadeInDown' => 'fadeInDown',
            'fadeInDownBig' => 'fadeInDownBig',
            'fadeInLeft' => 'fadeInLeft',
            'fadeInLeftBig' => 'fadeInLeftBig',
            'fadeInRight' => 'fadeInRight',
            'fadeInRightBig' => 'fadeInRightBig',
            'fadeInUp' => 'fadeInUp',
            'fadeInUpBig' => 'fadeInUpBig',
            'fadeOut' => 'fadeOut',
            'fadeOutDown' => 'fadeOutDown',
            'fadeOutDownBig' => 'fadeOutDownBig',
            'fadeOutLeft' => 'fadeOutLeft',
            'fadeOutLeftBig' => 'fadeOutLeftBig',
            'fadeOutRight' => 'fadeOutRight',
            'fadeOutRightBig' => 'fadeOutRightBig',
            'fadeOutUp' => 'fadeOutUp',
            'fadeOutUpBig' => 'fadeOutUpBig',
            'flip' => 'flip',
            'flipInX' => 'flipInX',
            'flipInY' => 'flipInY',
            'flipOutX' => 'flipOutX',
            'flipOutY' => 'flipOutY',
            'lightSpeedIn' => 'lightSpeedIn',
            'lightSpeedOut' => 'lightSpeedOut',
            'rotateIn' => 'rotateIn',
            'rotateInDownLeft' => 'rotateInDownLeft',
            'rotateInDownRight' => 'rotateInDownRight',
            'rotateInUpLeft' => 'rotateInUpLeft',
            'rotateInUpRight' => 'rotateInUpRight',
            'rotateOut' => 'rotateOut',
            'rotateOutDownLeft' => 'rotateOutDownLeft',
            'rotateOutDownRight' => 'rotateOutDownRight',
            'rotateOutUpLeft' => 'rotateOutUpLeft',
            'rotateOutUpRight' => 'rotateOutUpRight',
            'slideInDown' => 'slideInDown',
            'slideInLeft' => 'slideInLeft',
            'slideInRight' => 'slideInRight',
            'slideOutLeft' => 'slideOutLeft',
            'slideOutRight' => 'slideOutRight',
            'slideOutUp' => 'slideOutUp',
            'hinge' => 'hinge',
            'rollIn' => 'rollIn',
            'rollOut' => 'rollOut'
        ),
        'off',
        '选择PC端列表加载动画',
        '介绍：选择一款PC端列表加载动画 <br />
         其他：可能以上还是没有您喜欢的特效。此功能可拓展性强，例如您完全可以对照 jSlideUp 这个特性进行编写一个您自己喜欢的动画，接着加入到设置这里即可。如果您的动画优秀，会收录到设置里！'
    );
    $JPCAnimation->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JPCAnimation->multiMode());

    $JWapAnimation = new Typecho_Widget_Helper_Form_Element_Select(
        'JWapAnimation',
        array(
            'off' => '关闭（默认）',
            'jSlideUp' => 'jSlideUp',
            'jScale' => 'jScale',
            'jScaleUp' => 'jScaleUp',
            'bounce' => 'bounce',
            'flash' => 'flash',
            'pulse' => 'pulse',
            'rubberBand' => 'rubberBand',
            'shake' => 'shake',
            'swing' => 'swing',
            'tada' => 'tada',
            'wobble' => 'wobble',
            'bounceIn' => 'bounceIn',
            'bounceInLeft' => 'bounceInLeft',
            'bounceInRight' => 'bounceInRight',
            'bounceInUp' => 'bounceInUp',
            'bounceOut' => 'bounceOut',
            'bounceOutDown' => 'bounceOutDown',
            'bounceOutLeft' => 'bounceOutLeft',
            'bounceOutRight' => 'bounceOutRight',
            'bounceOutUp' => 'bounceOutUp',
            'fadeIn' => 'fadeIn',
            'fadeInDown' => 'fadeInDown',
            'fadeInDownBig' => 'fadeInDownBig',
            'fadeInLeft' => 'fadeInLeft',
            'fadeInLeftBig' => 'fadeInLeftBig',
            'fadeInRight' => 'fadeInRight',
            'fadeInRightBig' => 'fadeInRightBig',
            'fadeInUp' => 'fadeInUp',
            'fadeInUpBig' => 'fadeInUpBig',
            'fadeOut' => 'fadeOut',
            'fadeOutDown' => 'fadeOutDown',
            'fadeOutDownBig' => 'fadeOutDownBig',
            'fadeOutLeft' => 'fadeOutLeft',
            'fadeOutLeftBig' => 'fadeOutLeftBig',
            'fadeOutRight' => 'fadeOutRight',
            'fadeOutRightBig' => 'fadeOutRightBig',
            'fadeOutUp' => 'fadeOutUp',
            'fadeOutUpBig' => 'fadeOutUpBig',
            'flip' => 'flip',
            'flipInX' => 'flipInX',
            'flipInY' => 'flipInY',
            'flipOutX' => 'flipOutX',
            'flipOutY' => 'flipOutY',
            'lightSpeedIn' => 'lightSpeedIn',
            'lightSpeedOut' => 'lightSpeedOut',
            'rotateIn' => 'rotateIn',
            'rotateInDownLeft' => 'rotateInDownLeft',
            'rotateInDownRight' => 'rotateInDownRight',
            'rotateInUpLeft' => 'rotateInUpLeft',
            'rotateInUpRight' => 'rotateInUpRight',
            'rotateOut' => 'rotateOut',
            'rotateOutDownLeft' => 'rotateOutDownLeft',
            'rotateOutDownRight' => 'rotateOutDownRight',
            'rotateOutUpLeft' => 'rotateOutUpLeft',
            'rotateOutUpRight' => 'rotateOutUpRight',
            'slideInDown' => 'slideInDown',
            'slideInLeft' => 'slideInLeft',
            'slideInRight' => 'slideInRight',
            'slideOutLeft' => 'slideOutLeft',
            'slideOutRight' => 'slideOutRight',
            'slideOutUp' => 'slideOutUp',
            'hinge' => 'hinge',
            'rollIn' => 'rollIn',
            'rollOut' => 'rollOut'
        ),
        'off',
        '选择WAP端列表加载动画',
        '介绍：选择一款WAP端列表加载动画 <br />
         其他：可能以上还是没有您喜欢的特效。此功能可拓展性强，例如您完全可以对照 jSlideUp 这个特性进行编写一个您自己喜欢的动画，接着加入到设置这里即可。如果您的动画优秀，会收录到设置里！'
    );
    $JWapAnimation->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JWapAnimation->multiMode());

    $JSummaryMeta = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'JSummaryMeta',
        array(
            'author' => '显示作者',
            'cate' => '显示分类',
            'time' => '显示时间',
            'read' => '显示阅读量',
            'comment' => '显示评论量',
        ),
        null,
        '选择首页及搜索页列表显示的选项',
        '该处的设置是用于设置首页及搜索页列表里的文章信息，根据您的爱好自行选择'
    );
    $JSummaryMeta->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JSummaryMeta->multiMode());

    $JIndexSticky = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexSticky',
        NULL,
        NULL,
        '首页置顶文章（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：文章的ID || 文章的ID || 文章的ID （中间使用两个竖杠分隔）<br />
         例如：1 || 2 || 3'
    );
    $JIndexSticky->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexSticky);

    $JIndexNotice = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexNotice',
        NULL,
        NULL,
        '首页通知文字（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：通知文字 || 跳转链接（中间使用两个竖杠分隔，限制一个）<br />
         例如：我是通知哈哈哈||http://baidu.com'
    );
    $JIndexNotice->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexNotice);

    $JIndexAD = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexAD',
        NULL,
        NULL,
        '首页大屏广告（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：广告图片 || 广告链接 （中间使用两个竖杠分隔，限制一个）<br />
         例如：https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0||http://baidu.com'
    );
    $JIndexAD->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexAD);

    $JIndexHotStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JIndexHotStatus',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启热门文章',
        '介绍：开启后，网站首页将会显示浏览量最多的4篇热门文章'
    );
    $JIndexHotStatus->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexHotStatus->multiMode());

    $JIndexCarousel = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexCarousel',
        NULL,
        NULL,
        '首页轮播图（非必填）',
        '介绍：用于显示首页轮播图，请务必填写正确的格式 <br />
         格式：图片地址 || 跳转链接 || 标题 （中间使用两个竖杠分隔）<br />
         其他：一行一个，一行代表一个轮播图 <br />
         例如：<br />
            https://puui.qpic.cn/media_img/lena/PICykqaoi_580_1680/0 || http://baidu.com || 百度一下 <br />
            https://puui.qpic.cn/tv/0/1223447268_1680580/0 || http://v.qq.com || 腾讯视频
         '
    );
    $JIndexCarousel->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexCarousel);

    $JIndexRecommend = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndexRecommend',
        NULL,
        NULL,
        '首页推荐文章（非必填，填写时请填写2个，否则不显示！）',
        '介绍：用于显示推荐文章，请务必填写正确的格式 <br/>
         格式：文章的id || 文章的id （中间使用两个竖杠分隔）<br />
         例如：1 || 2 <br />
         注意：如果填写的不是2个，将不会显示
         '
    );
    $JIndexRecommend->setAttribute('class', 'j-setting-content j-setting-index');
    $form->addInput($JIndexRecommend);

    /* 其他设置 */
    $JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFriends',
        NULL,
        NULL,
        '友情链接（非必填）',
        '介绍：用于填写友情链接 <br />
         注意：您需要先增加友联链接页面，该项才会生效 <br />
         格式：博客名称 || 博客地址 || 博客头像 || 博客简介 <br />
         其他：一行一个，一行代表一个友联（默认带有主题开发者的友联，勿删）
        '
    );
    $JFriends->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JFriends);

    $JVideoListAPI = new Typecho_Widget_Helper_Form_Element_Text(
        'JVideoListAPI',
        NULL,
        NULL,
        '填写苹果CMS开放API',
        '介绍：请填写苹果CMS V10开放API，用于视频模板页面使用<br />
         例如：ok资源网提供的：https://api.okzy.tv/api.php/provide/vod/ <br />
         如果您搭建了苹果cms网站，那么用你自己的即可，如果没有，请去网上找API <br />
         注意：如果您使用视频模板，请务必填写下方自定义解析，如果不写，则视频模板无法播放！
         '
    );
    $JVideoListAPI->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JVideoListAPI);

    $JAnalysis = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAnalysis',
        NULL,
        NULL,
        '自定义视频解析',
        '介绍：如果您不填写此项，则文章页内的播放器默认调用主题自带的DPlayer播放器，并且视频页面无法播放！'
    );
    $JAnalysis->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JAnalysis);


    $JShieldNames = new Typecho_Widget_Helper_Form_Element_Text(
        'JShieldNames',
        NULL,
        NULL,
        '视频页面需要屏蔽的分类名称（非必填）',
        '介绍：用于屏蔽视频模板页面的某些分类 <br />
         例如：伦理片 || 电视剧'
    );
    $JShieldNames->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JShieldNames);

    $JProhibitWords = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JProhibitWords',
        NULL,
        NULL,
        '评论敏感词汇',
        '介绍：有效防止垃圾评论 <br />
         格式：使用 || 分隔 <br />
         例如：傻逼 || 傻吊
         '
    );
    $JProhibitWords->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JProhibitWords);

    $JProhibitScript = new Typecho_Widget_Helper_Form_Element_Select(
        'JProhibitScript',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启禁止脚本回复',
        '介绍：开启后将禁止a标签的脚本回复'
    );
    $JProhibitScript->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JProhibitScript->multiMode());

    $JProhibitEmsp = new Typecho_Widget_Helper_Form_Element_Select(
        'JProhibitEmsp',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启禁止使用空格回复',
        '介绍：开启后使用空格恶意评论回复将被禁止'
    );
    $JProhibitEmsp->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JProhibitEmsp->multiMode());

    $JProhibitChinese = new Typecho_Widget_Helper_Form_Element_Select(
        'JProhibitChinese',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启回复内容至少包含一个中文',
        '介绍：开启后如果无中文，则禁止评论，有效屏蔽老外垃圾评论'
    );
    $JProhibitChinese->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JProhibitChinese->multiMode());

    $JDynamicComment = new Typecho_Widget_Helper_Form_Element_Select(
        'JDynamicComment',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启动态页面的评论功能',
        '介绍：开启后，动态页面将会显示评论按钮'
    );
    $JDynamicComment->setAttribute('class', 'j-setting-content j-setting-other');
    $form->addInput($JDynamicComment->multiMode());
} ?>