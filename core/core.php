<?php
define("THEME_URL", str_replace('//usr', '/usr', str_replace(Helper::options()->siteUrl, Helper::options()->rootUrl . '/', Helper::options()->themeUrl)));
$str1 = explode('/themes/', (THEME_URL . '/'));
$str2 = explode('/', $str1[1]);
define("THEME_NAME", $str2[0]);

/* 获取模板版本号 */
function JoeVersion()
{
    return "4.7.7";
}

function GetLocationHref()
{
    return '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function fileget2($url, $timeout = 5)
{
    $user_agent = "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
    curl_setopt($curl, CURLOPT_ENCODING, '');
    return curl_exec($curl);
    curl_close($curl);
}

/* 获取懒加载图片 */
function GetLazyLoad()
{
    if (Helper::options()->JLazyLoad) {
        return Helper::options()->JLazyLoad;
    } else {
        return "https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/img/lazyload.jpg";
    }
}

/* 获取模板内置播放器 */
function GetDplayer()
{
    return THEME_URL . '/player.php';
}

/* 生成目录树 */
function CreateCatalog($obj)
{
    global $catalog;
    global $catalog_count;
    $catalog = array();
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function ($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
        return '<h' . $obj[1] . $obj[2] . ' id="cl-' . $catalog_count . '"><span>' . $obj[3] . '</span></h' . $obj[1] . '>';
    }, $obj);
    return $obj;
}
function GetCatalog()
{
    global $catalog;
    $index = '';
    if ($catalog) {
        $index = '<ul>';
        $prev_depth = '';
        $to_depth = 0;
        foreach ($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>';
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                    $index .= '<ul>';
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i = 0; $i < $to_depth2; $i++) {
                            $index .= '</li></ul>';
                            $to_depth--;
                        }
                    }
                    $index .= '</li>';
                }
            }
            $index .= '<li><a href="javascript: void(0)" data-href="#cl-' . $catalog_item['count'] . '">' . $catalog_item['text'] . '</a>';
            $prev_depth = $catalog_item['depth'];
        }
        for ($i = 0; $i <= $to_depth; $i++) {

            $index .= '</li></ul>';
        }
        $index = '<div class="j-floor"><div class="contain" id="jFloor"><div class="title">文章目录</div>' . $index . '<svg class="toc-marker" xmlns="http://www.w3.org/2000/svg"><path stroke="var(--theme)" stroke-width="3" fill="transparent" stroke-dasharray="0, 0, 0, 1000" stroke-linecap="round" stroke-linejoin="round" transform="translate(-0.5, -0.5)" /></svg></div></div>';
    }
    echo $index;
}

/* 格式化标签 */
function ParseCode($text)
{

    /* 初始化图片为懒加载 */
    $text = Short_Lazyload($text);
    /* 图片短代码 */
    $text = Short_Photo($text);
    /* tag标签短代码 */
    $text = Short_Tag($text);
    /* 按钮短代码 */
    $text = Short_Button($text);
    /* 提示短代码 */
    $text = Short_Alt($text);
    /* 线短代码 */
    $text = Short_Line($text);
    /* tabs短代码 */
    $text = Short_Tabs($text);
    /* 默认卡片短代码 */
    $text = Short_Card_default($text);
    /* 展开隐藏短代码 */
    $text = Short_Collapse($text);
    /* 时间线短代码 */
    $text = Short_Time_line($text);
    /* 复制短代码 */
    $text = Short_Copy($text);
    /* 打字机短代码 */
    $text = Short_Typing($text);
    /* 链接卡片短代码 */
    $text = Short_Card_Nav($text);
    /* dplayer短代码 */
    $text = Short_Dplayer($text);
    /* 音乐短代码 */
    $text = Short_Music($text);
    /* 音乐列表短代码 */
    $text = Short_Music_List($text);
    /* 视频列表短代码 */
    $text = Short_Video_List($text);
    return $text;
}

function Short_Lazyload($text)
{
    $text = preg_replace_callback('/<img src=\"(.*?)\".*?>/ism', function ($text) {
        return '<img class="lazyload" data-original="' . $text[1] . '" src="' . GetLazyLoad() . '" />';
    }, $text);
    return $text;
}

function Short_Photo($text)
{
    $text = preg_replace_callback('/<p>\[photo\](.*?)\[\/photo\]<\/p>/ism', function ($text) {
        return '[photo]' . $text[1] . '[/photo]';
    }, $text);
    $text = preg_replace_callback('/\[photo\](.*?)\[\/photo\]/ism', function ($text) {
        return preg_replace('~<br.*?>~', '', $text[0]);
    }, $text);
    $text = preg_replace_callback('/\[photo\](.*?)\[\/photo\]/ism', function ($text) {
        return '<div class="j-photos">' . $text[1] . '</div>';
    }, $text);
    return $text;
}

function Short_Tag($text)
{
    $text = preg_replace_callback('/\[tag type=\"(.*?)\".*?\](.*?)\[\/tag\]/ism', function ($text) {
        return '<span class="j-tag ' . $text[1] . '">' . $text[2] . '</span>';
    }, $text);

    return $text;
}

function Short_Button($text)
{
    $text = preg_replace_callback('/\[btn href=\"(.*?)\" type=\"(.*?)\".*?\](.*?)\[\/btn\]/ism', function ($text) {
        return '<a href="' . $text[1] . '" class="j-btn ' . $text[2] . '">' . $text[3] . '</a>';
    }, $text);
    return $text;
}


function Short_Alt($text)
{
    $text = preg_replace_callback('/<p>\[alt type=\"(.*?)\".*?\](.*?)\[\/alt\]<\/p>/ism', function ($text) {
        return '[alt type="' . $text[1] . '"]' . $text[2] . '[/alt]';
    }, $text);
    $text = preg_replace_callback('/\[alt type=\"(.*?)\".*?\](.*?)\[\/alt\]/ism', function ($text) {
        return '<div class="j-alt ' . $text[1] . '">' . $text[2] . '</div>';
    }, $text);
    return $text;
}

function Short_Line($text)
{
    $text = preg_replace_callback('/<p>\[line\](.*?)\[\/line\]<\/p>/ism', function ($text) {
        return '[line]' . $text[1] . '[/line]';
    }, $text);
    $text = preg_replace_callback('/\[line\](.*?)\[\/line\]/ism', function ($text) {
        return '<div class="j-line"><span>' . $text[1] . '</span></div>';
    }, $text);
    return $text;
}

function Short_Tabs($text)
{
    $text = preg_replace_callback('/<p>\[tabs\](.*?)\[\/tabs\]<\/p>/ism', function ($text) {
        return '[tabs]' . $text[1] . '[/tabs]';
    }, $text);
    $text = preg_replace_callback('/\[tabs\](.*?)\[\/tabs\]/ism', function ($text) {
        return preg_replace('~<br.*?>~', '', $text[0]);
    }, $text);
    $text = preg_replace_callback('/\[tabs\](.*?)\[\/tabs\]/ism', function ($text) {
        $tabname = '';
        preg_match_all('/label=\"(.*?)\"\]/i', $text[1], $tabnamearr);
        for ($i = 0; $i < count($tabnamearr[1]); $i++) {
            if ($i === 0) {
                $tabname .= '<span class="active" data-panel="' . $i . '">' . $tabnamearr[1][$i] . '</span>';
            } else {
                $tabname .= '<span data-panel="' . $i . '">' . $tabnamearr[1][$i] . '</span>';
            }
        }
        $tabcon = '';
        preg_match_all('/"\](.*?)\[\//i', $text[1], $tabconarr);
        for ($i = 0; $i < count($tabconarr[1]); $i++) {
            if ($i === 0) {
                $tabcon .= '<div class="active" data-panel="' . $i . '">' . $tabconarr[1][$i] . '</div>';
            } else {
                $tabcon .= '<div data-panel="' . $i . '">' . $tabconarr[1][$i] . '</div>';
            }
        }
        return '<div class="j-tabs"><div class="nav">' . $tabname . '</div><div class="content">' . $tabcon . '</div></div>';
    }, $text);
    return $text;
}

function Short_Card_default($text)
{
    $text = preg_replace_callback('/<p>\[card-default width=\"(.*?)\" label=\"(.*?)\".*?\](.*?)\[\/card-default\]<\/p>/ism', function ($text) {
        return '[card-default width="' . $text[1] . '" label="' . $text[2] . '"]' . $text[3] . '[/card-default]';
    }, $text);
    $text = preg_replace_callback('/<p>\[card-default width=\"(.*?)\" label=\"(.*?)\".*?\](.*?)\[\/card-default\]<\/p>/ism', function ($text) {
        return '[card-default width="' . $text[1] . '" label="' . $text[2] . '"]' . $text[3] . '[/card-default]';
    }, $text);
    $text = preg_replace_callback('/\[card-default width=\"(.*?)\" label=\"(.*?)\".*?\](.*?)\[\/card-default\]/ism', function ($text) {
        return '<div class="j-card-default" style="width: ' . $text[1] . '">
                <div class="head">' . $text[2] . '</div>
                <div class="content">' . $text[3] . '</div>
            </div>';
    }, $text);
    return $text;
}


function Short_Collapse($text)
{
    $text = preg_replace_callback('/<p>\[collapse\](.*?)\[\/collapse\]<\/p>/ism', function ($text) {
        return '[collapse]' . $text[1] . '[/collapse]';
    }, $text);
    $text = preg_replace_callback('/\[collapse\](.*?)\[\/collapse\]/ism', function ($text) {
        return preg_replace('~<br.*?>~', '', $text[0]);
    }, $text);
    $text = preg_replace_callback('/\[collapse\](.*?)\[\/collapse\]/ism', function ($text) {
        return '<div class="j-collapse">' . $text[1] . '</div>';
    }, $text);
    $text = preg_replace_callback('/\<p>\[collapse-item label=\"(.*?)\".*?\](.*?)\[\/collapse-item\]<\/p>/ism', function ($text) {
        return '[collapse-item label="' . $text[1] . '"]' . $text[2] . '[/collapse-item]';
    }, $text);
    $text = preg_replace_callback('/\[collapse-item label=\"(.*?)\".*?\](.*?)\[\/collapse-item\]/ism', function ($text) {
        return '<div class="collapse-head"><span>' . $text[1] . '</span><svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M21.6 772.8c28.8 28.8 74.4 28.8 103.2 0L512 385.6 899.2 772.8c28.8 28.8 74.4 28.8 103.2 0 28.8-28.8 28.8-74.4 0-103.2l-387.2-387.2-77.6-77.6c-14.4-14.4-37.6-14.4-51.2 0l-77.6 77.6-387.2 387.2c-28.8 28.8-28.8 75.2 0 103.2z"></path></svg></div><div class="collapse-body">' . $text[2] . '</div>';
    }, $text);
    return $text;
}

function Short_Time_line($text)
{
    $text = preg_replace_callback('/<p>\[timeline\](.*?)\[\/timeline\]<\/p>/ism', function ($text) {
        return '[timeline]' . $text[1] . '[/timeline]';
    }, $text);
    $text = preg_replace_callback('/\[timeline\](.*?)\[\/timeline\]/ism', function ($text) {
        return preg_replace('~<br.*?>~', '', $text[0]);
    }, $text);
    $text = preg_replace_callback('/\[timeline\](.*?)\[\/timeline\]/ism', function ($text) {
        return '<div class="j-timeline">' . $text[1] . '</div>';
    }, $text);
    $text = preg_replace_callback('/<p>\[timeline-item\](.*?)\[\/timeline-item\]<\/p>/ism', function ($text) {
        return '[timeline-item]' . $text[1] . '[/timeline-item]';
    }, $text);
    $text = preg_replace_callback('/\[timeline-item\](.*?)\[\/timeline-item\]/ism', function ($text) {
        return '<div class="item">' . $text[1] . '</div>';
    }, $text);
    return $text;
}

function Short_Copy($text)
{
    $text = preg_replace_callback('/\[copy\](.*?)\[\/copy\]/ism', function ($text) {
        return '<span class="j-copy" data-copy="' . $text[1] . '">' . $text[1] . '</span>';
    }, $text);
    return $text;
}

function Short_Typing($text)
{
    $text = preg_replace_callback('/\[typing\](.*?)\[\/typing\]/ism', function ($text) {
        return '<span class="j-typing">' . $text[1] . '</span>';
    }, $text);
    return $text;
}

function Short_Card_Nav($text)
{
    $text = preg_replace_callback('/<p>\[card-nav\](.*?)\[\/card-nav\]<\/p>/ism', function ($text) {
        return '[card-nav]' . $text[1] . '[/card-nav]';
    }, $text);
    $text = preg_replace_callback('/\[card-nav\](.*?)\[\/card-nav\]/ism', function ($text) {
        return preg_replace('~<br.*?>~', '', $text[0]);
    }, $text);
    $text = preg_replace_callback('/\[card-nav\](.*?)\[\/card-nav\]/ism', function ($text) {
        return '<div class="j-card-nav">' . $text[1] . '</div>';
    }, $text);
    $text = preg_replace_callback('/\[card-nav-item src=\"(.*?)\" title=\"(.*?)\" img=\"(.*?)\".*?\/\]/ism', function ($text) {
        $img = $text[3] === "auto" ? $text[1] . '/favicon.ico' : $text[3];
        $arr = array(
            0 => "linear-gradient(to right, #6DE195, #C4E759)",
            1 => "linear-gradient(to right, #41C7AF, #54E38E)",
            2 => "linear-gradient(to right, #99E5A2, #D4FC78)",
            3 => "linear-gradient(to right, #ABC7FF, #C1E3FF)",
            4 => "linear-gradient(to right, #6CACFF, #8DEBFF)",
            5 => "linear-gradient(to right, #5583EE, #41D8DD)",
            6 => "linear-gradient(to right, #A16BFE, #DEB0DF)",
            6 => "linear-gradient(to right, #D279EE, #F8C390)",
            7 => "linear-gradient(to right, #F78FAD, #FDEB82)",
            8 => "linear-gradient(to right, #A43AB2, #E13680)",
        );
        return '<div class="item">
                    <a href="' . $text[1] . '" class="nav" style="background-image: ' . $arr[rand(0, 8)] . '">
                        <span class="avatar" style="background-image: url(' . $img . ')"></span>
                        <span class="content">' . $text[2] . '</span>
                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M428.8 928h-60.8v-282.24l280.96-284.16 46.08 44.8-263.04 265.6v164.48l137.6-131.2 174.08 80 98.56-568.32-604.8 334.72 96 44.16-26.88 58.24L96 556.8l832-460.8-135.68 782.72-209.92-97.28z" p-id="5322"></path></svg>
                    </a>
                </div>';
    }, $text);
    return $text;
}

function Short_Dplayer($text)
{
    $text = preg_replace_callback('/<p>\[dplayer src="(.*?)".*?\/]<\/p>/ism', function ($text) {
        return '[dplayer src="' . $text[1] . '" /]';
    }, $text);

    $text = preg_replace_callback('/\[dplayer src="(.*?)".*?\/]/ism', function ($text) {
        return '<iframe scrolling="no" allowfullscreen="allowfullscreen" frameborder="0" width="100%" class="iframe-dplayer" src="' . GetDplayer() . '?url=' . $text[1] . '"></iframe>';
    }, $text);

    return $text;
}

function Short_Music($text)
{
    $text = preg_replace_callback('/<p>\[music id="(.*?)".*?\/]<\/p>/ism', function ($text) {
        return '[music id="' . $text[1] . '" /]';
    }, $text);

    $text = preg_replace_callback('/\[music id="(.*?)".*?\/]/ism', function ($text) {
        return '<iframe class="iframe-music" frameborder="no" border="0" width="330" height="86" src="//music.163.com/outchain/player?type=2&id=' . $text[1] . '&auto=1&height=66"></iframe>';
    }, $text);

    return $text;
}

function Short_Music_List($text)
{
    $text = preg_replace_callback('/<p>\[music-list id="(.*?)".*?\/]<\/p>/ism', function ($text) {
        return '[music-list id="' . $text[1] . '" /]';
    }, $text);

    $text = preg_replace_callback('/\[music-list id="(.*?)".*?\/]/ism', function ($text) {
        return '<iframe class="iframe-music" frameborder="no" border="0" width="330" height="450" src="//music.163.com/outchain/player?type=0&id=' . $text[1] . '&auto=1&height=430"></iframe>';
    }, $text);

    return $text;
}

function Short_Video_List($text)
{
    $text = preg_replace_callback('/<p>\[video](.*?)\[\/video]<\/p>/ism', function ($text) {
        return '[video]' . $text[1] . '[/video]';
    }, $text);
    $text = preg_replace_callback('/\[video](.*?)\[\/video]/ism', function ($text) {
        return preg_replace('~<br.*?>~', '', $text[0]);
    }, $text);
    $text = preg_replace_callback('/\[video](.*?)\[\/video]/ism', function ($text) {
        return '<div class="j-short-video">' . $text[1] . '</div>';
    }, $text);
    $text = preg_replace_callback('/\[video-item src="(.*?)" poster="(.*?)".*?\/]/ism', function ($text) {
        return '<div class="item">
                    <div class="inner" data-poster="' . $text[2] . '" data-src="' . $text[1] . '" style="background-image: url(' . GetLazyLoad() . ')">
                        <svg t="1607510948740" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="19996" width="80" height="80"><path d="M512 65c247.424 0 448 200.576 448 448S759.424 961 512 961 64 760.424 64 513 264.576 65 512 65z m0 64c-212.077 0-384 171.923-384 384s171.923 384 384 384 384-171.923 384-384-171.923-384-384-384z m-63 214.657a64 64 0 0 1 33.593 9.525L655.857 460.03c30.086 18.552 39.435 57.982 20.882 88.067a64 64 0 0 1-21.324 21.152L482.151 674.17c-30.235 18.308-69.587 8.64-87.896-21.594A64 64 0 0 1 385 619.425V407.657c0-35.346 28.654-64 64-64z m1.196 74.49a8 8 0 0 0-1.196 4.207v183.432a8 8 0 0 0 12.15 6.84l149.688-90.851a8 8 0 0 0 0.057-13.643L461.208 415.55a8 8 0 0 0-11.012 2.595z" p-id="19997"></path></svg>
                    </div>
                </div>';
    }, $text);

    return $text;
}



function themeInit($archive)
{
    /* 强奸用户关闭反垃圾保护 */
    Helper::options()->commentsAntiSpam = false;
    /* 强奸用户关闭检查来源URL */
    Helper::options()->commentsCheckReferer = false;
    /* 强奸用户强制要求填写邮箱 */
    Helper::options()->commentsRequireMail = true;
    /* 强奸用户强制要求无需填写url */
    Helper::options()->commentsRequireURL = false;
    /* 强奸用户强制开启评论回复 */
    Helper::options()->commentsThreaded = true;

    if ($archive->is('single')) {
        $archive->content = ParseReply($archive->content);
        $archive->content = CreateCatalog($archive->content);
        $archive->content = ParseCode($archive->content);
    }
    if ($archive->request->isPost() && $archive->request->likeup) {
        commentLike($archive->request->likeup);
        exit;
    }
}



/* 请求 */
function GetRequest($curl, $method = 'post', $data = null, $https = true)
{
    $ch = curl_init(); //初始化
    curl_setopt($ch, CURLOPT_URL, $curl); //设置访问的URL
    curl_setopt($ch, CURLOPT_HEADER, false); //设置不需要头信息
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //只获取页面内容，但不输出
    if ($https) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不做服务器认证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不做客户端认证
    }
    if ($method == 'post') {
        curl_setopt($ch, CURLOPT_POST, true); //设置请求是POST方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //设置POST请求的数据
    }
    $str = curl_exec($ch); //执行访问，返回结果
    curl_close($ch); //关闭curl，释放资源
    return $str;
}


/* 解析头像 */
function ParseAvatar($mail, $re = 0, $id = 0)
{
    $a = Typecho_Widget::widget('Widget_Options')->JGravatars;
    $b = 'https://' . $a . '/';
    $c = strtolower($mail);
    $d = md5($c);
    $f = str_replace('@qq.com', '', $c);
    if (strstr($c, "qq.com") && is_numeric($f) && strlen($f) < 11 && strlen($f) > 4) {
        $g = '//thirdqq.qlogo.cn/g?b=qq&nk=' . $f . '&s=100';
        if ($id > 0) {
            $g = Helper::options()->rootUrl . '?id=' . $id . '" data-type="qqtx';
        }
    } else {
        $g = $b . $d . '?d=mm';
    }
    if ($re == 1) {
        return $g;
    } else {
        echo $g;
    }
}

/* 获取父级评论 */
function GetParentReply($parent)
{
    if ($parent == 0) {
        return '';
    }
    $db = Typecho_Db::get();
    $commentInfo = $db->fetchRow($db->select('author,status,mail')->from('table.comments')->where('coid = ?', $parent));
    $link = '<div class="parent">@' . $commentInfo['author'] .  '</div>';
    return $link;
}


function ParsePaopaoBiaoqingCallback($match)
{
    return '<img class="owo" src="' . THEME_URL . '/assets/owo/paopao/' . str_replace('%', '', urlencode($match[1])) . '_2x.png">';
}

function ParseAruBiaoqingCallback($match)
{
    return '<img class="owo" src="' . THEME_URL . '/assets/owo/aru/' . str_replace('%', '', urlencode($match[1])) . '_2x.png">';
}

/* 格式化 */
function ParseReply($content)
{
    $content = preg_replace_callback(
        '/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
        'ParsePaopaoBiaoqingCallback',
        $content
    );
    $content = preg_replace_callback(
        '/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
        'ParseAruBiaoqingCallback',
        $content
    );
    return $content;
}




/* 判断是否是移动端 */
function isMobile()
{
    if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;
    if (isset($_SERVER['HTTP_VIA'])) {
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            return true;
    }
    if (isset($_SERVER['HTTP_ACCEPT'])) {
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}

/* 页面加载计时 */
timerStart();
function timerStart()
{
    global $timestart;
    $mtime     = explode(' ', microtime());
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
function timerStop($display = 0, $precision = 3)
{
    global $timestart, $timeend;
    $mtime     = explode(' ', microtime());
    $timeend   = $mtime[1] + $mtime[0];
    $timetotal = number_format($timeend - $timestart, $precision);
    $r         = $timetotal < 1 ? $timetotal * 1000 . "ms" : $timetotal . "s";
    if ($display) {
        echo $r;
    }
    return $r;
}


/* 热门文章 */
class Widget_Post_hot extends Widget_Abstract_Contents
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault(array('pageSize' => $this->options->commentsListSize, 'parentId' => 0, 'ignoreAuthor' => false));
    }
    public function execute()
    {
        $select  = $this->select()->from('table.contents')
            ->where("table.contents.password IS NULL OR table.contents.password = ''")
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created <= ?', time())
            ->where('table.contents.type = ?', 'post')
            ->limit($this->parameter->pageSize)
            ->order('table.contents.views', Typecho_Db::SORT_DESC);
        $this->db->fetchAll($select, array($this, 'push'));
    }
}

/* 随机图片 */
function GetRandomThumbnail($widget)
{
    $random = 'https://cdn.jsdelivr.net/npm/typecho_joe_theme@4.3.5/assets/img/random/' . rand(1, 25) . '.webp';
    if (Helper::options()->Jmos) {
        $moszu = explode("\r\n", Helper::options()->Jmos);
        $random = $moszu[array_rand($moszu, 1)] . "?jrandom=" . mt_rand(0, 1000000);
    }
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
    $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
    $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
    $t = preg_match_all($pattern, $widget->content, $thumbUrl);
    $img = $random;
    if ($widget->fields->thumb) {
        $img = $widget->fields->thumb;
    } elseif ($t) {
        $img = $thumbUrl[1][0];
    } elseif (preg_match_all($patternMD, $widget->content, $thumbUrl)) {
        $img = $thumbUrl[1][0];
    } elseif (preg_match_all($patternMDfoot, $widget->content, $thumbUrl)) {
        $img = $thumbUrl[1][0];
    }
    echo $img;
}


/* 获取浏览量 */
function GetPostViews($archive)
{
    $db = Typecho_Db::get();
    $cid = $archive->cid;
    $exist = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
    if ($archive->is('single')) {
        $cookie = Typecho_Cookie::get('contents_views');
        $cookie = $cookie ? explode(',', $cookie) : array();
        if (!in_array($cid, $cookie)) {
            $db->query($db->update('table.contents')
                ->rows(array('views' => (int)$exist + 1))
                ->where('cid = ?', $cid));
            $exist = (int)$exist + 1;
            array_push($cookie, $cid);
            $cookie = implode(',', $cookie);
            Typecho_Cookie::set('contents_views', $cookie);
        }
    }
    echo number_format($exist);
}

/* 随机一言 */
function GetRandomMotto()
{
    if (Helper::options()->JMotto) {
        $JMottoRandom = explode("\r\n", Helper::options()->JMotto);
        $random = $JMottoRandom[array_rand($JMottoRandom, 1)];
        echo $random;
    }
}


/* 点赞数 */
function agreeNum($cid)
{
    $db = Typecho_Db::get();
    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
    $AgreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
    if (empty($AgreeRecording)) {
        Typecho_Cookie::set('typechoAgreeRecording', json_encode(array(0)));
    }
    return array(
        'agree' => $agree['agree'],
        'recording' => in_array($cid, json_decode(Typecho_Cookie::get('typechoAgreeRecording'))) ? true : false
    );
}
/* 点赞 */
function agree($cid)
{
    $db = Typecho_Db::get();
    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
    $agreeRecording = Typecho_Cookie::get('typechoAgreeRecording');
    if (empty($agreeRecording)) {
        Typecho_Cookie::set('typechoAgreeRecording', json_encode(array($cid)));
    } else {
        $agreeRecording = json_decode($agreeRecording);
        if (in_array($cid, $agreeRecording)) {
            return $agree['agree'];
        }
        array_push($agreeRecording, $cid);
        Typecho_Cookie::set('typechoAgreeRecording', json_encode($agreeRecording));
    }
    $db->query($db->update('table.contents')->rows(array('agree' => (int)$agree['agree'] + 1))->where('cid = ?', $cid));
    $agree = $db->fetchRow($db->select('table.contents.agree')->from('table.contents')->where('cid = ?', $cid));
    return $agree['agree'];
}

/* 评论like数 */
function commentLikeNum($coid)
{
    $db = Typecho_Db::get();
    $likes = $db->fetchRow($db->select('table.comments.likes')->from('table.comments')->where('coid = ?', $coid));
    $LikesRecording = Typecho_Cookie::get('typechoLikesRecording');
    if (empty($LikesRecording)) {
        Typecho_Cookie::set('typechoLikesRecording', json_encode(array(0)));
    }
    return array(
        'likes' => $likes['likes'],
        'recording' => in_array($coid, json_decode(Typecho_Cookie::get('typechoLikesRecording'))) ? true : false
    );
}

/* 评论like */
function commentLike($likeup)
{
    $db = Typecho_Db::get();
    $likes = $db->fetchRow($db->select('table.comments.likes')->from('table.comments')->where('coid = ?', $likeup));
    $likesRecording = Typecho_Cookie::get('typechoLikesRecording');
    if (empty($likesRecording)) {
        Typecho_Cookie::set('typechoLikesRecording', json_encode(array($likeup)));
    } else {
        $likesRecording = json_decode($likesRecording);
        if (in_array($likeup, $likesRecording)) {
            echo $likes['likes'];
            return;
        }
        array_push($likesRecording, $likeup);
        Typecho_Cookie::set('typechoLikesRecording', json_encode($likesRecording));
    }
    $db->query($db->update('table.comments')->rows(array('likes' => (int)$likes['likes'] + 1))->where('coid = ?', $likeup));
    $likes = $db->fetchRow($db->select('table.comments.likes')->from('table.comments')->where('coid = ?', $likeup));
    echo $likes['likes'];
}


/* 获取浏览器信息 */
function GetBrowser($agent)
{
    if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
        $outputer = 'Internet Explore';
    } else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Firefox/', $regs[0]);
        $FireFox_vern = explode('.', $str1[1]);
        $outputer = 'FireFox';
    } else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Maxthon/', $agent);
        $Maxthon_vern = explode('.', $str1[1]);
        $outputer = 'MicroSoft Edge';
    } else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
        $outputer = '360 Fast Browser';
    } else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Edge/', $regs[0]);
        $Edge_vern = explode('.', $str1[1]);
        $outputer = 'MicroSoft Edge';
    } else if (preg_match('/UC/i', $agent)) {
        $str1 = explode('rowser/',  $agent);
        $UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC Browser';
    } else if (preg_match('/QQ/i', $agent, $regs) || preg_match('/QQ Browser\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('rowser/',  $agent);
        $QQ_vern = explode('.', $str1[1]);
        $outputer = 'QQ Browser';
    } else if (preg_match('/UBrowser/i', $agent, $regs)) {
        $str1 = explode('rowser/',  $agent);
        $UCBrowser_vern = explode('.', $str1[1]);
        $outputer = 'UC Browser';
    } else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
        $outputer = 'Opera';
    } else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Chrome/', $agent);
        $chrome_vern = explode('.', $str1[1]);
        $outputer = 'Google Chrome';
    } else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
        $str1 = explode('Version/',  $agent);
        $safari_vern = explode('.', $str1[1]);
        $outputer = 'Safari';
    } else {
        $outputer = 'Google Chrome';
    }
    echo $outputer;
}

// 获取操作系统信息
function GetOs($agent)
{
    $os = false;
    if (preg_match('/win/i', $agent)) {
        if (preg_match('/nt 6.0/i', $agent)) {
            $os = 'Windows Vista';
        } else if (preg_match('/nt 6.1/i', $agent)) {
            $os = 'Windows 7';
        } else if (preg_match('/nt 6.2/i', $agent)) {
            $os = 'Windows 8';
        } else if (preg_match('/nt 6.3/i', $agent)) {
            $os = 'Windows 8.1';
        } else if (preg_match('/nt 5.1/i', $agent)) {
            $os = 'Windows XP';
        } else if (preg_match('/nt 10.0/i', $agent)) {
            $os = 'Windows 10';
        } else {
            $os = 'Windows X64';
        }
    } else if (preg_match('/android/i', $agent)) {
        if (preg_match('/android 9/i', $agent)) {
            $os = 'Android Pie';
        } else if (preg_match('/android 8/i', $agent)) {
            $os = 'Android Oreo';
        } else {
            $os = 'Android';
        }
    } else if (preg_match('/ubuntu/i', $agent)) {
        $os = 'Ubuntu';
    } else if (preg_match('/linux/i', $agent)) {
        $os = 'Linux';
    } else if (preg_match('/iPhone/i', $agent)) {
        $os = 'iPhone';
    } else if (preg_match('/mac/i', $agent)) {
        $os = 'MacOS';
    } else if (preg_match('/fusion/i', $agent)) {
        $os = 'Android';
    } else {
        $os = 'Linux';
    }
    echo $os;
}


/* 自定义字段 */
function themeFields($layout)
{
    $thumb = new Typecho_Widget_Helper_Form_Element_Text(
        'thumb',
        NULL,
        NULL,
        '自定义文章缩略图',
        '填写时：将会显示填写的文章缩略图 <br>
         不填写时：如果文章内有图片则取文章图片，否则取模板自带的随机缩略图'
    );
    $layout->addItem($thumb);

    $desc = new Typecho_Widget_Helper_Form_Element_Text(
        'desc',
        NULL,
        NULL,
        'SEO描述',
        '用于填写文章或独立页面的SEO描述，如果不填写则显示默认描述'
    );
    $layout->addItem($desc);

    $keywords = new Typecho_Widget_Helper_Form_Element_Text(
        'keywords',
        NULL,
        NULL,
        'SEO关键词',
        '用于填写文章或独立页面的SEO关键词，如果不填写则显示默认关键词'
    );
    $layout->addItem($keywords);

    $keywords = new Typecho_Widget_Helper_Form_Element_Text(
        'keywords',
        NULL,
        NULL,
        'SEO关键词',
        '用于填写文章或独立页面的SEO关键词，如果不填写则显示默认关键词'
    );
    $layout->addItem($keywords);

    $video = new Typecho_Widget_Helper_Form_Element_Textarea(
        'video',
        NULL,
        NULL,
        'M3U8或MP4地址（仅限文章和自定义页面使用）',
        '填写则会显示视频模板，不填写则显示默认文章模板 <br>
         格式：视频名称&视频地址。如果有多个，换行写即可 <br>
         例如：<br>
            第01集$https://iqiyi.cdn9-okzy.com/20201104/17638_8f3022ce/index.m3u8 <br>
            第02集$https://iqiyi.cdn9-okzy.com/20201104/17639_5dcb8a3b/index.m3u8 
        '
    );
    $layout->addItem($video);

    $sharePic = new Typecho_Widget_Helper_Form_Element_Textarea(
        'sharePic',
        NULL,
        NULL,
        'QQ里分享链接时的缩略图',
        '填写则会优先使用此缩略图，不填写则随机取网站中图片 <br>
         格式：图片URL 或 BASE64地址'
    );
    $layout->addItem($sharePic);

    $aside = new Typecho_Widget_Helper_Form_Element_Select(
        'aside',
        array(
            'on' => '开启（默认）',
            'off' => '关闭'
        ),
        'on',
        '是否开启当前页面的侧边栏',
        '用于单独设置当前页面侧边栏的开启状态 <br /> 
         只有在外观设置侧边栏开启状态下生效'
    );
    $layout->addItem($aside);
}

function GetQQSharePic($widget)
{
    if ($widget->fields->sharePic) {
        return $widget->fields->sharePic;
    } else {
        return Helper::options()->JQQSharePic;
    }
}

/* 评论回复 */
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('myyodux', 'one');
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('myyodux', 'one');
class myyodux
{
    public static function one($con, $obj, $text)
    {
        $text = empty($text) ? $con : $text;
        if (!$obj->is('single')) {
            $text = preg_replace("/\[hide\](.*?)\[\/hide\]/sm", '', $text);
        }
        return $text;
    }
}


function check_in($words_str, $str)
{
    $words = explode("||", $words_str);
    if (empty($words)) {
        return false;
    }
    foreach ($words as $word) {
        if (false !== strpos($str, trim($word))) {
            return true;
        }
    }
    return false;
}

Typecho_Plugin::factory('Widget_Feedback')->comment = array('plgl', 'one');
class plgl
{
    public static function one($comment, $post)
    {
        $options = Helper::options();
        $action = "";
        $msg = "";

        /* 脚本回复 */
        if ($options->JProhibitScript === "on") {
            if (preg_match("/<a(.*?)href=\"javascript:(.*?)>(.*?)<\/a>/u", $comment['text']) == 1) {
                $msg = "检测到脚本回复，已禁止！";
                $action = 'abandon';
            }
        }

        /* 空格回复 */
        if ($options->JProhibitEmsp === "on") {
            if (ctype_space($comment['text'])) {
                $msg = "请不要使用空格评论！";
                $action = 'abandon';
            }
        }

        /* 非中文评论 */
        if ($options->JProhibitChinese === "on") {
            if (!preg_match("/{\!\{(.*?)/", $comment['text']) && preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
                $msg = "评论至少包含一个中文！";
                $action = 'abandon';
            }
        }


        /* 敏感词 */
        if (!empty($options->JProhibitWords)) {
            if (check_in($options->JProhibitWords, $comment['text'])) {
                $msg = "评论内容中包含敏感词汇";
                $action = "abandon";
            }
        }

        if ($action == "abandon") {
            Typecho_Cookie::set('__typecho_remember_text', $comment['text']);
            throw new Typecho_Widget_Exception(_t($msg), 403);
        }

        Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
    }
}

Typecho_Plugin::factory('admin/write-post.php')->bottom = array('editor', 'reset');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('editor', 'reset');
class editor
{
    public static function reset()
    {
        Typecho_Widget::widget('Widget_Options')->to($options);
?>

        <style>
            .wmd-button.custom {
                width: 20px;
                height: 20px;
                line-height: 20px;
                text-align: center;
            }

            .wmd-button.custom svg {
                width: 15px;
                height: 15px;
                vertical-align: middle;
            }

            body.fullscreen {
                overflow-x: hidden;
            }

            .wmd-button-row {
                height: auto;
            }

            #custom-field .typecho-list-table tbody textarea {
                width: 100%;
                height: 100px;
            }

            #custom-field .typecho-list-table tbody input[type="text"] {
                width: 100%;
            }
        </style>
        <script>
            $(function() {
                $("#wmd-button-bar .wmd-edittab").remove()
                $("#wmd-button-row .wmd-spacer").remove()
                $("#wmd-button-row #wmd-more-button").remove()
                $("#wmd-button-row #wmd-code-button").remove()
                $("#wmd-button-row #wmd-heading-button").remove()
                $("#wmd-fullscreen-button").on("click", function() {
                    $(".fullscreen #text").css("top", $('.fullscreen #wmd-button-bar').outerHeight())
                })
                $("#wmd-button-row #wmd-fullscreen-button").before(`
                    <li class="wmd-button custom" id="j-wmd-linecode" title="行内代码">
                        <svg t="1607495229023" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1161" width="15" height="15"><path d="M810.666667 213.333333a85.333333 85.333333 0 0 1 85.333333 85.333334v426.666666a85.333333 85.333333 0 0 1-85.333333 85.333334H213.333333a85.333333 85.333333 0 0 1-85.333333-85.333334V298.666667a85.333333 85.333333 0 0 1 85.333333-85.333334h597.333334z m0 42.666667H213.333333a42.666667 42.666667 0 0 0-42.666666 42.666667v426.666666a42.666667 42.666667 0 0 0 42.666666 42.666667h597.333334a42.666667 42.666667 0 0 0 42.666666-42.666667V298.666667a42.666667 42.666667 0 0 0-42.666666-42.666667z" p-id="1162" fill="#888888"></path><path d="M593.194667 330.965333L774.229333 512l-181.034666 181.034667-53.546667-53.546667 128.554667-128.554667-127.445334-127.488 52.48-52.48z m-170.666667 0l52.48 52.48-127.445333 127.488 128.554666 128.554667-53.589333 53.546667L241.536 512l180.992-181.034667z" p-id="1163" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-code" title="代码块">
                        <svg t="1607495398743" class="icon" viewBox="0 0 1170 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1936" width="15" height="15"><path d="M1144.876703 504.481774l-279.739458-253.118501a40.15084 40.15084 0 0 0-59.458348 5.631356 47.976231 47.976231 0 0 0 5.19255 64.065821l250.485658 226.716947-251.436407 227.521426a47.537424 47.537424 0 0 0-5.119415 63.480745 39.712033 39.712033 0 0 0 58.873272 5.485087l291.587247-263.796137a47.537424 47.537424 0 0 0 5.119415-63.480745 42.052337 42.052337 0 0 0-15.431379-12.505999zM108.926526 547.777397l250.485659-226.716947a47.976231 47.976231 0 0 0 5.192549-64.065821 40.15084 40.15084 0 0 0-59.458347-5.631356L25.333794 504.481774a44.685179 44.685179 0 0 0-24.86573 34.812021 46.952348 46.952348 0 0 0 14.6269 41.101588l291.587247 263.942407a39.712033 39.712033 0 0 0 58.873272-5.558222 47.537424 47.537424 0 0 0-5.19255-63.480745L108.853392 547.631128zM667.089022 0.804479a44.904582 44.904582 0 0 1 33.934407 52.218033L548.611133 984.975431a44.53891 44.53891 0 0 1-26.620957 36.128443 39.492629 39.492629 0 0 1-42.125471-8.044795 47.171752 47.171752 0 0 1-13.529883-43.880699L618.893387 37.298594a42.198606 42.198606 0 0 1 48.415038-36.567249z" p-id="1937" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-reply" title="回复可见">
                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M927.533978 927.744c-31.744 0-58.88-18.944-71.68-48.64-27.136-75.776-86.016-136.704-159.744-172.544v73.728c0 18.944-6.144 35.84-18.944 48.64-14.848 16.896-35.84 27.136-56.832 27.136-18.944 0-35.84-6.144-48.64-18.944l-349.184-296.448c-4.096-2.048-6.144-6.144-8.192-8.192-27.136-31.744-23.04-79.872 10.752-104.96L574.253978 133.12c29.696-25.088 75.776-20.992 100.864 4.096 14.848 14.848 20.992 33.792 20.992 52.736v92.672c191.488 58.88 328.192 242.176 328.192 441.856 0 52.736-8.192 104.96-27.136 155.648-8.192 20.992-23.04 37.888-44.032 44.032-8.704 3.584-17.408 3.584-25.6 3.584z m-261.12-298.496c4.096 0 6.144 0 10.752 2.048 111.616 35.84 201.728 119.808 239.616 227.328 2.048 8.192 10.752 8.192 14.848 6.144 4.096-2.048 6.144-4.096 6.144-6.144 14.848-41.984 23.04-88.576 23.04-132.608 0-178.688-126.464-340.992-303.104-387.072-14.848-2.048-25.088-14.848-25.088-31.744V189.44c0-10.752-12.8-14.848-20.992-8.192L264.493978 473.6c-4.096 4.096-6.144 12.8-2.048 16.896l2.048 2.048 349.184 299.008c2.048 2.048 6.144 2.048 8.192 2.048 2.048 0 6.144 0 8.192-4.096 2.048-2.048 2.048-4.096 2.048-8.192V660.48c0-10.752 4.096-18.944 12.8-25.088 8.704-4.096 15.36-6.144 21.504-6.144z m0 0" p-id="1791" fill="#888888"></path><path d="M309.037978 778.752c-8.192 0-14.848-2.048-20.992-8.192L24.877978 538.624 18.221978 532.48c-27.136-31.744-23.04-79.872 6.144-107.52l267.264-229.376c12.8-10.752 31.744-8.192 44.032 6.144 10.752 12.8 8.192 33.792-4.096 44.032L66.861978 473.6c-4.096 2.048-4.096 6.144-4.096 8.192 0 2.048 0 6.144 2.048 8.192l263.168 233.472c12.8 10.752 14.848 31.744 2.048 44.032-4.608 8.704-12.8 11.264-20.992 11.264z m0 0" p-id="1792" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-dplayer" title="插入视频（dplayer）">
                        <svg t="1607493718815" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4465" width="15" height="15"><path d="M903.168 759.808H144.896c-38.4 0-68.608-30.208-68.608-68.608V220.672c0-38.4 30.208-68.608 68.608-68.608h758.272c38.4 0 68.608 30.208 68.608 68.608V691.2c0.512 38.4-30.208 68.608-68.608 68.608zM163.328 203.776c-19.968 0-34.816 14.848-34.816 34.304v436.736c0 19.456 15.36 34.304 34.816 34.304h720.896c19.968 0 34.816-14.848 34.816-34.304V237.568c0-19.456-15.36-34.304-34.816-34.304 0.512 0.512-720.896 0.512-720.896 0.512z" p-id="4466" fill="#888888"></path><path d="M657.92 419.328c-3.072-6.144-9.728-11.264-15.872-15.872L480.256 289.792c-14.336-9.728-30.208-14.336-48.128-11.264s-31.744 11.264-41.472 25.6c-9.728 11.264-12.8 25.6-12.8 38.4v228.864c0 17.408 6.144 33.792 17.408 46.592 11.264 11.264 27.136 19.456 46.592 19.456 12.8 0 25.6-3.072 38.4-11.264l161.792-113.664c30.208-21.504 36.864-62.976 15.872-93.184z m-40.96 40.448c-1.536 7.68-5.12 14.336-11.776 18.432l-132.608 93.184c-4.096 4.096-10.24 5.12-15.872 5.12-6.656 0-13.312-2.56-18.432-7.68-5.12-4.096-7.68-10.24-7.68-18.432V361.472c0-5.12 1.536-10.24 5.12-15.872s10.24-9.216 16.896-10.24h4.096c5.12 0 10.24 1.536 15.872 4.096l132.608 93.184c2.56 1.536 5.12 4.096 6.656 6.656 5.12 5.12 6.144 12.8 5.12 20.48zM303.104 861.696c-2.048-12.288 6.144-24.064 18.432-26.624l197.12-41.472h4.608l214.016 44.032c12.8 2.56 20.48 14.848 17.92 27.648-3.072 12.288-14.848 19.456-26.624 17.408l-205.312-42.496-192.512 40.96c-12.8 2.56-25.6-6.144-27.648-19.456z" p-id="4467" fill="#888888"></path><path d="M524.288 824.32c-15.36 0-25.6-8.704-25.6-22.016v-43.52c0-13.312 10.24-22.016 25.6-22.016s25.6 8.704 25.6 22.016v43.52c0 13.312-10.24 22.016-25.6 22.016z" p-id="4468" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-nav" title="卡片导航">
                        <svg t="1607493766492" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5346" width="15" height="15"><path d="M932.636444 54.158222a26.396444 26.396444 0 0 1 31.573334 5.632 26.567111 26.567111 0 0 1 7.566222 26.680889l-1.820444 4.664889-377.400889 863.687111c-2.844444 11.320889-13.653333 17.976889-25.998223 17.976889a29.639111 29.639111 0 0 1-23.893333-13.368889l-1.877333-3.811555-133.461334-333.653334-338.147555-145.351111C57.856 473.770667 51.2 462.961778 51.2 450.56c0-10.581333 4.892444-20.024889 12.856889-24.120889l4.266667-1.592889L932.636444 54.158222z m-42.609777 79.701334L150.926222 450.56l286.208 122.368c4.266667 2.161778 8.362667 5.688889 11.434667 9.955556l2.673778 4.437333 113.265777 283.192889 325.518223-736.654222z" p-id="5347" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-typing" title="打字机效果">
                        <svg t="1607493790924" class="icon" viewBox="0 0 1102 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5996" width="15" height="15"><path d="M108.307692 59.076923V0a59.076923 59.076923 0 0 0-59.076923 59.076923h59.076923z m886.153846 0h59.076924a59.076923 59.076923 0 0 0-59.076924-59.076923v59.076923zM935.384615 236.307692a59.076923 59.076923 0 1 0 118.153847 0h-118.153847zM49.230769 236.307692a59.076923 59.076923 0 0 0 118.153846 0h-118.153846zM610.461538 59.076923a59.076923 59.076923 0 1 0-118.153846 0h118.153846zM433.230769 856.615385a59.076923 59.076923 0 1 0 0 118.153846v-118.153846z m236.307693 118.153846a59.076923 59.076923 0 1 0 0-118.153846v118.153846zM108.307692 118.153846h886.153846V0H108.307692v118.153846z m827.076923-59.076923V236.307692h118.153847V59.076923h-118.153847zM49.230769 59.076923V236.307692h118.153846V59.076923h-118.153846z m443.076923 0v856.615385h118.153846V59.076923h-118.153846zM551.384615 856.615385H433.230769v118.153846H551.384615v-118.153846z m0 118.153846h118.153847v-118.153846H551.384615v118.153846z" p-id="5997" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-copy" title="点击复制">
                        <svg t="1607493844750" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7177" width="15" height="15"><path d="M702.144 892.224c0 35.008-28.352 63.36-63.36 63.36L131.776 955.584c-34.944 0-63.36-28.352-63.36-63.36L68.416 385.28c0-35.008 28.416-63.36 63.36-63.36l63.36 0 0-63.36-63.36 0c-70.016 0-126.72 56.768-126.72 126.72l0 507.008c0 70.08 56.704 126.72 126.72 126.72L638.72 1019.008c70.08 0 126.72-56.704 126.72-126.72l0-63.36-63.36 0L702.08 892.224zM892.224 4.992 385.28 4.992c-70.016 0-126.72 56.768-126.72 126.72L258.56 638.72c0 69.952 56.704 126.72 126.72 126.72l507.008 0c70.08 0 126.72-56.832 126.72-126.72L1019.008 131.776C1019.008 61.76 962.304 4.992 892.224 4.992zM955.648 638.72c0 35.072-28.352 63.36-63.36 63.36L385.28 702.08c-34.944 0-63.36-28.288-63.36-63.36L321.92 131.776c0-35.008 28.416-63.36 63.36-63.36l507.008 0c35.008 0 63.36 28.352 63.36 63.36L955.648 638.72z" p-id="7178" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-timeline" title="时间线">
                        <svg t="1607493940871" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="10654" width="15" height="15"><path d="M976.896 317.44h-737.28c-26.624 0-47.104-22.528-47.104-49.152 0-26.624 20.48-49.152 47.104-49.152h737.28c26.624 0 47.104 22.528 47.104 49.152s-20.48 49.152-47.104 49.152zM143.36 655.36c0 30.72-18.432 57.344-47.104 67.584v100.352c0 14.336-10.24 24.576-24.576 24.576-12.288 0-24.576-10.24-24.576-24.576v-100.352C18.432 712.704 0 686.08 0 655.36c0-30.72 18.432-57.344 47.104-67.584V335.872C18.432 325.632 0 299.008 0 268.288c0-30.72 18.432-57.344 47.104-67.584V147.456c0-12.288 10.24-24.576 24.576-24.576 12.288 0 24.576 10.24 24.576 24.576v53.248c28.672 10.24 47.104 36.864 47.104 67.584 0 30.72-18.432 57.344-47.104 67.584v249.856C124.928 598.016 143.36 624.64 143.36 655.36z m94.208-290.816h405.504c26.624 0 47.104 22.528 47.104 49.152s-20.48 49.152-47.104 49.152H237.568c-26.624 0-47.104-22.528-47.104-49.152 0-26.624 20.48-49.152 47.104-49.152z m0 241.664h737.28c26.624 0 47.104 22.528 47.104 49.152 0 26.624-20.48 49.152-47.104 49.152h-737.28c-26.624 0-47.104-22.528-47.104-49.152 0-26.624 20.48-49.152 47.104-49.152z m0 145.408h405.504c26.624 0 47.104 22.528 47.104 49.152s-20.48 49.152-47.104 49.152H237.568c-26.624 0-47.104-22.528-47.104-49.152 0-26.624 20.48-49.152 47.104-49.152z" p-id="10655" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-collapse" title="伸缩展开">
                        <svg t="1607493989220" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="12886" width="15" height="15"><path d="M115.851209 65.575505c255.579865 70.284963 511.15973 134.179929 773.129592 204.463893 38.33598 12.779993 57.50497-51.115973 19.16799-63.894967-255.579865-70.283963-511.15973-134.179929-773.129592-204.463892-38.33598-12.778993-57.50497 51.115973-19.16799 63.894966z" p-id="12887" fill="#888888"></path><path d="M262.810131 461.724297c191.684899-70.283963 383.369798-140.568926 581.443694-210.852889 38.33698-12.779993 19.16799-76.67396-19.16899-63.894967C633.399936 257.260404 441.715037 327.545367 243.641142 397.82933c-38.33698 19.16899-19.16799 83.063956 19.168989 63.894967zM262.810131 838.705098c191.684899-70.284963 383.369798-140.569926 575.053697-204.463892 38.33698-12.779993 19.16899-76.67396-19.16799-63.894967C627.009939 640.630202 435.32604 710.915165 243.640142 774.810131c-38.33698 19.16799-19.16799 76.67396 19.168989 63.894967z" p-id="12888" fill="#888888"></path><path d="M115.851209 436.16631l766.739596 210.853889c38.33698 12.778993 57.50497-51.115973 19.167989-63.894967L135.020199 372.270344c-38.33598-12.778993-57.50497 51.115973-19.16799 63.894966zM115.851209 806.757115l766.739596 210.853888c38.33698 12.777993 57.50497-51.115973 19.167989-63.894966L135.020199 742.862148c-38.33598-6.389997-57.50497 57.50597-19.16799 63.894967z" p-id="12889" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-card" title="默认卡片">
                        <svg t="1607494030087" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="14061" width="15" height="15"><path d="M872.96 145.408h-716.8c-69.632 0-126.464 56.832-126.464 126.464v489.984c0 69.632 56.832 126.464 126.464 126.464h716.8c69.632 0 126.464-56.832 126.464-126.464V271.872c0-69.632-56.832-126.464-126.464-126.464z m-716.8 56.832h716.8c38.4 0 69.632 31.232 69.632 69.632v92.16H86.528v-92.16c0-38.4 31.232-69.632 69.632-69.632z m716.8 629.248h-716.8c-38.4 0-69.632-31.232-69.632-69.632V424.448h856.576v337.408c-0.512 38.4-31.744 69.632-70.144 69.632z" p-id="14062" fill="#888888"></path><path d="M368.64 673.792H193.536c-16.896 0-30.208 13.824-30.208 30.208 0 16.896 13.824 30.208 30.208 30.208H368.64c16.896 0 30.208-13.824 30.208-30.208 0.512-16.896-13.312-30.208-30.208-30.208z" p-id="14063" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-tabs" title="Tab栏切换">
                        <svg t="1607494155654" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="23134" width="15" height="15"><path d="M46.54475 0.0055h279.2715a46.54475 46.54475 0 0 1 46.54575 46.54475v186.181h605.08675A46.54475 46.54475 0 0 1 1023.9945 279.277v698.17825A46.54475 46.54475 0 0 1 977.44975 1024H46.54475A46.54475 46.54475 0 0 1 0 977.45525V46.55025A46.54475 46.54475 0 0 1 46.54475 0.0055z m0 46.54475v930.905h930.905V279.277H325.81625V46.55025H46.54475z m930.905 116.363375V46.55025H767.995875A23.272875 23.272875 0 1 1 767.995875 0.0055h232.72575A23.272875 23.272875 0 0 1 1023.9945 23.278375v139.63525a23.272875 23.272875 0 1 1-46.54475 0z m-325.81725 0V46.55025H442.179625a23.272875 23.272875 0 1 1 0-46.54475h232.72575a23.272875 23.272875 0 0 1 23.272875 23.272875v139.63525a23.272875 23.272875 0 1 1-46.54575 0z" p-id="23135" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-line" title="线状标题">
                        <svg t="1607494312518" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="31552" width="15" height="15"><path d="M0 874.7h768v64H0v-64z m0-192h1024v64H0v-64z m805.2-357.1h202.5c1.4-31-0.4-60.7-5.4-89.1-5.1-28.4-13.3-53.7-24.7-75.9-11.4-22.2-26-39.9-43.7-53.1-17.7-13.2-38.5-19.8-62.4-19.8-21.4 0-40.8 5.4-58.4 16.3-17.6 10.8-32.7 25.7-45.3 44.6-12.7 18.9-22.4 41.2-29.3 67-6.9 25.8-10.3 53.7-10.3 83.7 0 31 3.3 59.4 10 85.2 6.7 25.8 16.2 48 28.5 66.6 12.3 18.6 27.3 32.9 45.1 43 17.7 10.1 37.6 15.1 59.7 15.1 31.9 0 59-10.3 81.4-31 22.4-20.7 39.1-55 49.9-103.1H935c-2.5 12.4-9.4 24.2-20.6 35.3-11.2 11.1-24.6 16.7-40.2 16.7-21.7 0-38.4-8-49.9-24-11.7-16-18-41.8-19.1-77.5z m125.4-69.7H805.2c0.4-7.7 1.5-16.5 3.5-26.3s5.4-19.1 10.3-27.9c4.9-8.8 11.4-16.1 19.5-22.1 8.1-5.9 18.4-8.9 30.7-8.9 18.8 0 32.8 7.2 42.1 21.7 9.3 14.4 15.7 35.6 19.3 63.5zM624.7 85.3v419.8h77.1V85.3h-77.1zM550 189.4V86.2h-77.1v103.2h-46.7v50.2h46.7v203.8c0 13.7 2.4 24.8 7.1 33.3 4.7 8.5 11.1 15 19.3 19.5 8.1 4.6 17.6 7.7 28.2 9.2 10.7 1.6 22 2.4 33.9 2.4 7.6 0 15.4-0.2 23.3-0.5 8-0.4 15.2-1.1 21.7-2.1V447c-3.6 0.7-7.4 1.2-11.4 1.6-4 0.4-8.1 0.5-12.5 0.5-13 0-21.7-2.1-26.1-6.3-4.3-4.2-6.5-12.7-6.5-25.4V239.6h56.5v-50.2H550z m-214.7 0v320h77.1v-320h-77.1z m77.1-42.3V85.3h-77.1v61.8h77.1z m-303.1 8V512h80.2V155.1h109.3V85.3H0V155h109.3z" p-id="31553" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-alt" title="提示框">
                        <svg t="1607494381005" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="34022" width="15" height="15"><path d="M621.714286 950.857143a36.571429 36.571429 0 1 1 0 73.142857h-219.428572a36.571429 36.571429 0 1 1 0-73.142857h219.428572zM512 0a402.285714 402.285714 0 0 1 182.857143 760.685714v80.457143a36.571429 36.571429 0 0 1-36.571429 36.571429H365.714286a36.571429 36.571429 0 0 1-36.571429-36.571429v-80.457143A402.285714 402.285714 0 0 1 512 0z m0 73.142857a329.142857 329.142857 0 0 0-149.504 622.445714l39.862857 20.406858V804.571429h219.428572V715.922286l39.789714-20.333715A329.142857 329.142857 0 0 0 512 73.142857z m0 73.142857a36.571429 36.571429 0 0 1 0 73.142857 182.857143 182.857143 0 0 0-179.273143 146.651429 36.571429 36.571429 0 1 1-71.68-14.336A256 256 0 0 1 512 146.285714z" p-id="34023" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-btn" title="按钮">
                        <svg t="1607494425154" class="icon" viewBox="0 0 1033 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="36132" width="15" height="15"><path d="M321.668096 551.0144V502.272h390.0928v48.7424H321.668096z m-97.4848-195.072a170.6496 170.6496 0 1 0 0 341.3504h585.1136a170.6496 170.6496 0 1 0 0-341.3504H224.183296z m0-48.7424h585.1136a219.4432 219.4432 0 1 1 0 438.8352H224.183296a219.4432 219.4432 0 1 1 0-438.8352z" p-id="36133" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-tag" title="标签">
                        <svg t="1607494486968" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="40194" width="15" height="15"><path d="M777.728 287.232l-636.416 0.512c-51.712 0-72.704 20.992-72.704 72.704v303.104c0 51.712 21.504 72.704 72.704 72.704l636.928 0.512 177.664-224.768-178.176-224.768z" p-id="40195" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-photo" title="相册">
                        <svg t="1607510400757" class="icon" viewBox="0 0 1317 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4334" width="48" height="48"><path d="M325.065 353.023c62.086 0 112.423-50.705 112.423-113.277S387.21 126.469 325.065 126.469 212.64 177.174 212.64 239.73s50.338 113.292 112.424 113.292zM663.6 496.13l-86.394-93.122-224.316 264.834-91.974-84.686-133.741 172.198h932.6V583.155L840.54 264.981 663.601 496.129z" p-id="4335" fill="#888888"></path><path d="M65.428 754.75V139.085c0-40.355 27.856-73.172 62.1-73.172h937.416c34.245 0 62.1 32.832 62.1 73.172V754.75c0 40.356-27.855 73.173-62.1 73.173H127.53c-34.245 0-62.1-32.89-62.1-73.173z m1127.045 0V139.085C1192.458 62.396 1135.26 0 1064.944 0H127.53C57.213 0 0 62.395 0 139.086V754.75c0 76.692 57.213 139.087 127.529 139.087h937.415c70.316 0 127.514-62.395 127.514-139.087z" p-id="4336" fill="#888888"></path><path d="M1240.705 141.633l0.147 85.304c8.834 12.647 11.425 24.676 11.425 42.314v615.663c0 40.355-27.856 73.172-62.1 73.172h-937.43c-20.362 0-29.74-2.945-42.83-20.288-17.505 0.427-57.227 0-75.086 0 16.195 58.582 61.836 86.187 117.871 86.187h937.46c70.316 0 127.528-62.395 127.528-139.086V269.251c0-58.214-30.343-106.932-76.985-127.618z" p-id="4337" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-music" title="网抑云音乐">
                        <svg t="1607494540558" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="41806" width="15" height="15"><path d="M603.97 105.21c22.1-6.37 45.78-6.05 68.1-0.92 25.63 6.09 49.88 17.86 70.75 33.9 7.62 5.79 14.5 12.99 18 22.05 5.42 13.4 3.97 29.42-4.03 41.49-6.98 10.84-18.85 18.39-31.64 20.01-10.22 1.4-20.93-0.77-29.71-6.2-4.95-2.91-8.72-7.4-13.69-10.28-13.33-8.46-28.68-15.12-44.73-14.74-11.3 0.13-21.24 6.75-28.9 14.53-7.17 7.4-10.82 18.31-8.45 28.46 5.51 20.74 10.99 41.48 16.49 62.22 39.54 2.03 79.06 12.49 113.05 33.13 33.04 20.44 62.89 46.36 86.56 77.25 20.09 26.18 35.32 56.08 44.64 87.74 10.09 34.12 13.36 70.1 10.73 105.54-2.19 29.24-7.94 58.31-17.86 85.94-25.65 67.28-73.16 126.27-134.31 164.5-44.85 28.33-96.36 45.42-148.89 51.94-36.26 4.53-73.21 4.55-109.29-1.63-74.14-12.25-143.62-49.2-196.35-102.57-52.4-52.5-88.87-120.64-103.62-193.33-10.88-53.01-10.39-108.36 1.68-161.13 14.75-65.07 47.35-125.94 93.18-174.41 37.38-39.8 83.55-71.29 134.23-91.62 5.22-1.99 10.36-4.35 15.92-5.23 11.87-2.08 24.55 0.73 34.27 7.89 13.16 9.29 20.4 26.14 18.21 42.08-1.81 16.27-13.36 30.94-28.75 36.51-51.2 19.14-96.6 53.34-129.28 97.13-29.21 38.86-48.27 85.28-54.66 133.49-6.45 47.72-0.71 97 16.39 142 24.7 65.79 73.81 122.4 136.42 154.62 37.7 19.53 80.14 29.73 122.59 29.44 34.92-0.45 69.95-6.06 102.77-18.2 28.86-10.72 55.91-26.55 78.91-47.07 21.44-19 39.28-41.96 52.89-67.15 6.82-12.85 13.12-26.08 16.97-40.15 11.36-40.22 13.33-83.81 1.18-124.09-10.05-33.78-30.73-63.89-57.14-87.02-11.68-10.22-24.16-19.59-37.54-27.47-11.82-6.64-24.73-11.16-37.9-14.25 9.18 35.9 19 71.65 28.31 107.52 1.58 8.6 3.16 17.2 4.64 25.82 1.36 37.01-11.62 74.29-35.49 102.6-22.24 26.68-53.82 45.45-87.98 51.9-36.82 7.34-76.41 0.41-108.03-20-30.19-19.14-52.49-49.45-64.25-83-6.66-18.77-9.98-38.62-10.64-58.5-2.02-43.25 9.29-87.44 34.03-123.21 29.07-42.69 74.9-72.04 124.04-86.36-3.62-13.84-7.32-27.66-10.98-41.5-9.49-29.87-7.47-63.41 6.69-91.49 7.64-15.67 19-29.32 32.14-40.67 14.63-12.51 31.71-22.39 50.33-27.51M486.64 430.56c-13.18 13.84-22.42 31.34-26.4 50.02-3.58 16.96-3.6 34.64-0.38 51.65 3.93 18.79 13.63 37.17 29.71 48.26 12.48 8.86 28.73 11.55 43.62 8.64 27.55-4.84 50.03-30.19 50.8-58.24-1.05-6.95-2.2-13.9-4.16-20.66-10.29-38.92-20.67-77.81-30.9-116.75-23.28 7.18-45.44 19.28-62.29 37.08z" p-id="41807" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-music-list" title="网抑云歌单">
                        <svg t="1607503583369" class="icon" viewBox="0 0 1055 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1903" width="15" height="15"><path d="M1010.516047 403.238232C985.941254 403.238232 966.020777 381.456029 966.020777 354.523048 966.020777 206.050337 889.969238 125.778884 806.377705 103.903594L806.377705 800.99616C806.439763 802.857887 806.719022 804.688585 806.719022 806.58134 806.719022 808.474096 806.439763 810.304794 806.377705 812.166521L806.377705 820.420176C806.377705 821.785442 805.726101 822.902478 805.633015 824.236716 794.679855 935.878266 681.176579 1024 542.974394 1024 397.542503 1024 279.229766 926.476545 279.229766 806.58134 279.229766 686.748193 397.542503 589.193709 542.974394 589.193709 608.041745 589.193709 667.585973 608.834927 713.632683 641.135887L713.632683 48.268992C713.632683 36.043653 718.380086 25.18358 725.578763 16.681694 726.199338 15.937004 726.540655 14.913054 727.192259 14.199392 727.347403 14.044248 727.533576 13.98219 727.657691 13.858075 735.663116 5.35619 746.49216 0.050268 758.500298 0.050268 758.903672 0.050268 759.307046 0.112326 759.71042 0.112326 759.803507 0.112326 759.896593 0.050268 760.020708 0.050268 760.175852 0.050268 760.330996 0.143355 760.48614 0.143355 907.190211 1.229362 1054.980289 122.862179 1054.980289 354.523048 1054.980289 381.456029 1035.059812 403.238232 1010.516047 403.238232ZM542.974394 681.535358C450.01217 681.535358 374.426062 737.635392 374.426062 806.58134 374.426062 875.558318 450.01217 931.658351 542.974394 931.658351 635.936618 931.658351 711.522726 875.558318 711.522726 806.58134 711.522726 737.635392 635.936618 681.535358 542.974394 681.535358ZM542.415876 341.335817 47.413753 341.335817C21.380606 341.335817 0.250007 320.577563 0.250007 294.97882 0.250007 269.380077 21.380606 248.621823 47.413753 248.621823L542.415876 248.621823C568.417993 248.621823 589.548592 269.380077 589.548592 294.97882 589.548592 320.577563 568.417993 341.335817 542.415876 341.335817ZM542.415876 93.07455 47.413753 93.07455C21.380606 93.07455 0.250007 72.347325 0.250007 46.748582 0.250007 21.149839 21.380606 0.391585 47.413753 0.391585L542.415876 0.391585C568.417993 0.391585 589.548592 21.149839 589.548592 46.748582 589.548592 72.347325 568.417993 93.07455 542.415876 93.07455ZM47.413753 496.88309 294.185638 496.88309C320.187755 496.88309 341.318354 517.610315 341.318354 543.209058 341.318354 568.807801 320.187755 589.566055 294.185638 589.566055L47.413753 589.566055C21.380606 589.566055 0.250007 568.807801 0.250007 543.209058 0.250007 517.610315 21.380606 496.88309 47.413753 496.88309Z" p-id="1904" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-delete" title="删除线">
                        <svg t="1607494660243" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1750" width="15" height="15"><path d="M968 542.9V481c0-1.7-0.5-3-2.3-3H571.6l-0.5-0.1c-10.7-2.1-21.6-4.2-32.5-6.2-16.9-3.1-23.2-4.3-31.8-6-53.1-10.4-85.4-20.7-111.6-35.8-37.9-22.1-56.3-52.2-56.3-92 0-39.7 16.4-72.8 47.3-95.7 30.1-22.3 72.8-34 123.3-34 57.8 0 102.6 15.3 133.1 45.5 15.6 15.4 27.1 34.3 34 56.2 1.6 4.9 3.1 11.4 4.6 18.8 0.5 2.5 2.7 4.3 5.3 4.3h75c2.9 0 5.4-2.3 5.4-5.2v-0.8c-1-6.8-1.3-12.1-2-15.9-7.3-43.8-28-82-59.9-110.8-44.7-40.8-110.8-62.4-191-62.4-73.4 0-139.4 18.3-185.9 51.5-25.8 18.6-45.6 41.4-58.8 67.9-13.4 27.2-20.3 58.7-20.3 93.5 0 29.5 5.6 54.5 17.2 76.5 8.2 15.5 19.3 29.2 34 41.9l10.2 8.8H59.2c-1.8 0-4.2 1.4-4.2 3.1V543c0 1.8 2.4 3 4.2 3h446.7l0.5 0.2c1.3 0.3 2.6 0.6 3.8 0.8 0.8 0.2 1.5 0.3 2.3 0.5 33 6.6 51.7 10.9 69 15.8 24.3 6.9 42.8 14.1 58 22.6 38.7 21.8 57.5 53.2 57.5 96 0 37.9-16.6 71.8-46.8 95.4-32.2 25.2-79.7 38.6-137.5 38.6-45.6 0-84.6-8.9-116-26.4-30.9-17.3-52.4-42.3-63.8-74.3-0.9-2.4-1.8-5.8-2.9-9.9-0.6-2.3-2.8-4.3-5.2-4.3h-82.1c-3 0-5.7 3-5.7 6v0.8c0 2.2 0.5 4.1 0.7 5.4 6.5 48.9 30.4 89 70.9 119 47.6 35.2 115 53.8 194.6 53.8 85.6 0 157.4-20.1 207.3-58 25-18.9 44.3-42.2 57.3-69.3 13.1-27.4 19.8-58.4 19.8-92.1 0-32-5.8-58.6-17.8-81.5-5.7-11.1-13-21.4-21.7-30.7l-7.9-8.5h225.3c2 0.1 2.5-1.3 2.5-3z" p-id="1751" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-table" title="插入表格">
                        <svg t="1607495516074" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2817" width="15" height="15"><path d="M960 591.424V368.96c0-0.288 0.16-0.512 0.16-0.768s-0.16-0.512-0.16-0.768V192a32 32 0 0 0-32-32H96a32 32 0 0 0-32 32v175.424c0 0.288-0.16 0.512-0.16 0.768s0.16 0.48 0.16 0.768v222.464c0 0.288-0.16 0.512-0.16 0.768s0.16 0.48 0.16 0.768V864a32 32 0 0 0 32 32h832a32 32 0 0 0 32-32V592.96c0-0.288 0.16-0.512 0.16-0.768s-0.16-0.512-0.16-0.768z m-560-31.232v-160h208v160H400z m208 64V832H400V624.192h208z m-480-224h208v160H128v-160z m544 0h224v160H672v-160zM896 224v112.192H128V224h768zM128 624.192h208V832H128V624.192zM672 832V624.192h224V832H672z" p-id="2818" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-title" title="插入标题">
                        <svg t="1607495979397" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4871" width="15" height="15"><path d="M237.909333 567.068444v389.12c0 44.487111-20.764444 66.787556-62.065777 66.787556C134.371556 1022.976 113.777778 1000.675556 113.777778 956.302222V77.767111C113.777778 25.941333 134.371556 0 175.786667 0c41.358222 0 62.122667 25.941333 62.122666 77.767111V461.368889h541.866667V77.767111c0-48.071111 22.641778-74.126222 67.811556-77.767111 41.358222 0 62.065778 25.941333 62.065777 77.767111v878.364445c0 44.430222-20.707556 66.730667-62.008889 66.730666-45.226667 0-67.868444-22.300444-67.868444-66.730666v-389.12H237.909333z" p-id="4872" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-footer" title="插入脚注">
                        <svg t="1607496225463" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6607" width="15" height="15"><path d="M830.42178027 223.13075733c-25.66834027 0-46.47065387-20.78485013-46.47065387-46.43681706 0-25.63777707 20.80340587-46.4226272 46.47065387-46.4226272 25.65196693 0 46.456464 20.78485013 46.456464 46.4226272C876.87715307 202.3469984 856.0737472 223.13075733 830.42178027 223.13075733zM711.24235627 155.84250773c-24.5451584 0-44.45242133-19.8897984-44.45242134-44.41967573 0-24.52987733 19.90617067-44.42076693 44.45242134-44.42076693 24.542976 0 44.436048 19.8908896 44.436048 44.42076693C755.67840427 135.95161813 735.7853312 155.84250773 711.24235627 155.84250773zM583.97253547 135.64271573c-27.15063253 0-49.15908373-21.98989547-49.15908374-49.12306346 0-27.11897813 22.0084512-49.12415467 49.15908374-49.12415467 27.14954133 0 49.15471787 22.00517653 49.15471786 49.12415467C633.1283456 113.65282027 611.12207787 135.64271573 583.97253547 135.64271573zM453.33098987 149.10342187c-30.86073173 0-55.8785216-25.00032533-55.8785216-55.8468672 0-30.84435947 25.01778987-55.86214933 55.8785216-55.86214934 30.87928747 0 55.89598613 25.01669867 55.89598613 55.86214934C509.22697707 124.10309653 484.2102784 149.10342187 453.33098987 149.10342187zM260.1231392 255.42575467c-55.04896213 0-99.66402027-44.5834048-99.66402027-99.58324694 0-55.01621547 44.6150592-99.59962027 99.66402027-99.59962026 55.0325888 0 99.6498304 44.58231253 99.6498304 99.59962026C359.7718784 210.84234987 315.1546368 255.42575467 260.1231392 255.42575467zM585.30201493 986.09585173c-24.2537216 0-48.08611307-6.22825067-68.92117333-18.01346346-39.6988224-22.45379413-66.20327253-52.48496533-78.77874987-89.2563136-11.796128-34.49660693-11.29075093-75.288048 1.50303254-121.23804374 1.97457173-7.07418347 3.09666133-13.2598656 3.43503466-18.92488853 0.98674027-16.30522453 1.48010987-29.8794496 1.5073984-41.51948907 0.0764064-23.9862976-8.5542944-47.91801813-24.30502293-67.40285973-31.00481387-38.34314667-56.70808213-76.8587552-76.39267307-114.47385387-23.04867627-44.02454293-26.55793387-95.91353493-9.6239904-142.35690026 20.97695893-57.5463744 48.99208-100.01003413 85.64554454-129.81635094 42.12201173-34.2531968 96.7496448-51.7274464 162.36458346-51.93701973l0.38203414 0c7.02834027 0 14.0719616 0.55886187 20.93220586 1.66021227 57.03772267 9.03456533 102.65152853 28.52377387 139.40868694 59.57333973 32.06577707 27.0873248 56.58146453 62.47352533 74.9464 108.18120213 13.57968213 33.8056704 20.9485792 70.70800213 21.90475626 109.68096 3.69700053 150.69616427-12.2785824 265.21367893-48.83817493 350.09624534-17.24393707 40.038288-39.47615147 73.65621547-66.0788384 99.92380373-25.28957973 24.9708544-55.3098368 44.07911893-89.22466027 56.79431253C619.195008 983.05704107 602.4160608 986.09585173 585.30201493 986.09585173zM582.118032 229.359008l-0.26524053 0c-107.4138592 0.341648-172.87052693 48.65043307-212.23315947 156.63516053-13.2598656 36.36857493-10.49830293 77.02794133 7.57846933 111.55511147 18.51993173 35.38947627 42.82822933 71.78315627 72.25360427 108.1713792 21.25748053 26.2970592 32.9051616 58.80162987 32.8003744 91.52887253-0.02947093 12.37136213-0.5457632 26.672544-1.57725547 43.70581654-0.49991893 8.3851072-2.06080213 17.1860864-4.76888 26.88975786-21.89929813 78.6575904-3.06282347 131.7221568 59.28408534 166.98392427 15.10891093 8.54665387 32.43798827 13.06339093 50.1119872 13.06339093 12.51544427 0 24.7787456-2.22016533 36.45153066-6.5982784 60.21079147-22.57386133 103.92097387-67.07758507 133.63232854-136.05988373 33.85588053-78.6041056 49.24204053-190.99423467 45.73169066-334.0464384-0.84265813-34.39618667-7.29030613-66.82107627-19.1628416-96.3763424-33.65940587-83.77466773-92.4195584-129.61769387-184.92207253-144.26925547C592.19828053 229.7661472 587.05500693 229.359008 582.118032 229.359008z" p-id="6608" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-html" title="原生代码">
                        <svg t="1607496478319" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7487" data-spm-anchor-id="a313x.7781069.0.i37" width="15" height="15"><path d="M868.8 105.6 155.2 105.6c-28.8 0-51.2 25.6-48 54.4l75.2 600c1.6 17.6 12.8 32 28.8 38.4l281.6 118.4c11.2 4.8 25.6 4.8 36.8 0l281.6-118.4c16-6.4 27.2-20.8 28.8-38.4l75.2-600C920 129.6 897.6 105.6 868.8 105.6zM865.6 179.2l-70.4 558.4c-1.6 8-6.4 16-14.4 19.2l-259.2 108.8c-6.4 3.2-12.8 3.2-19.2 0l-259.2-108.8c-8-3.2-12.8-11.2-14.4-19.2L158.4 179.2c-1.6-14.4 9.6-27.2 24-27.2l659.2 0C856 153.6 867.2 166.4 865.6 179.2z" p-id="7488" fill="#888888"></path><path d="M716.8 252.8 331.2 252.8c-28.8 0-51.2 25.6-48 54.4l17.6 136c3.2 24 24 41.6 48 41.6l294.4 0c14.4 0 25.6 12.8 24 27.2l-9.6 80c-1.6 8-6.4 16-14.4 19.2l-120 51.2c-6.4 3.2-12.8 3.2-19.2 0l-120-51.2c-8-3.2-12.8-11.2-14.4-19.2l-3.2-28.8c-1.6-12.8-14.4-22.4-27.2-20.8-12.8 1.6-22.4 14.4-20.8 27.2l4.8 41.6c1.6 17.6 12.8 32 28.8 38.4l142.4 60.8c11.2 4.8 25.6 4.8 36.8 0l142.4-60.8c16-6.4 27.2-20.8 28.8-38.4l14.4-121.6c3.2-28.8-19.2-54.4-48-54.4l-300.8 0c-12.8 0-22.4-9.6-24-20.8l-11.2-88c-1.6-14.4 9.6-27.2 24-27.2l358.4 0c11.2 0 20.8-8 24-19.2l0 0C742.4 267.2 731.2 252.8 716.8 252.8z" p-id="7489" fill="#888888"></path></svg>
                    </li>
                    <li class="wmd-button custom" id="j-wmd-video-album" title="视频册">
                        <svg t="1607510613858" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="16645" width="48" height="48"><path d="M0 224v576c0 70.7 57.3 128 128 128h768c70.7 0 128-57.3 128-128V224c0-70.7-57.3-128-128-128H128C57.3 96 0 153.3 0 224z m160-64h80c8.8 0 16 7.2 16 16v672c0 8.8-7.2 16-16 16h-80c-53 0-96-43-96-96V256c0-53 43-96 96-96z m528 704H336c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h352c8.8 0 16 7.2 16 16v672c0 8.8-7.2 16-16 16z m176 0h-80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h80c53 0 96 43 96 96v512c0 53-43 96-96 96z" p-id="16646" fill="#888888"></path><path d="M128 224c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16v-64c0-8.8-7.2-16-16-16h-64zM128 384c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16v-64c0-8.8-7.2-16-16-16h-64zM128 544c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16v-64c0-8.8-7.2-16-16-16h-64zM128 704c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16v-64c0-8.8-7.2-16-16-16h-64zM832 224c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16v-64c0-8.8-7.2-16-16-16h-64zM832 384c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16v-64c0-8.8-7.2-16-16-16h-64zM832 544c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16v-64c0-8.8-7.2-16-16-16h-64zM832 704c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16h64c8.8 0 16-7.2 16-16v-64c0-8.8-7.2-16-16-16h-64z" p-id="16647" fill="#888888"></path></svg>
                    </li>
                `)
                $("#j-wmd-linecode").on("click", function() {
                    insertAtCursor(' `行内代码` ');
                })
                $("#j-wmd-code").on("click", function() {
                    insertAtCursor('\n```html\n<div>可以将html换成你需要使用的语法（您需要先在外观设置里开启代码高亮才会显示）</div>\n```\n');
                })
                $("#j-wmd-reply").on("click", function() {
                    insertAtCursor('\n[hide]需要隐藏的内容[/hide]\n');
                })
                $("#j-wmd-dplayer").on("click", function() {
                    insertAtCursor('\n[dplayer src="视频地址"/]\n');
                })
                $("#j-wmd-nav").on("click", function() {
                    insertAtCursor('\n[card-nav]\n [card-nav-item src="跳转地址" title="跳转名称" img="网站图标" /]\n [card-nav-item src="跳转地址" title="跳转名称" img="网站图标" /]\n[/card-nav]\n');
                })
                $("#j-wmd-typing").on("click", function() {
                    insertAtCursor(' [typing]打字机效果[/typing] ');
                })
                $("#j-wmd-copy").on("click", function() {
                    insertAtCursor(' [copy]点击复制[/copy] ');
                })
                $("#j-wmd-timeline").on("click", function() {
                    insertAtCursor('\n[timeline]\n [timeline-item]时间线[/timeline-item]\n [timeline-item]时间线[/timeline-item]\n[/timeline]\n');
                })
                $("#j-wmd-collapse").on("click", function() {
                    insertAtCursor('\n[collapse]\n [collapse-item label="标题"]伸缩展开的内容[/collapse-item]\n [collapse-item label="标题"]伸缩展开的内容[/collapse-item]\n[/collapse]\n');
                })
                $("#j-wmd-card").on("click", function() {
                    insertAtCursor('\n[card-default width="卡片宽度" label="卡片标题"]卡片内容[/card-default]\n');
                })
                $("#j-wmd-tabs").on("click", function() {
                    insertAtCursor('\n[tabs]\n [tab-pane label="Tab标题"]Tab内容[/tab-pane]\n [tab-pane label="Tab标题"]Tab内容[/tab-pane]\n[/tabs]\n');
                })
                $("#j-wmd-line").on("click", function() {
                    insertAtCursor('\n[line]带线的标题[/line]\n');
                })
                $("#j-wmd-alt").on("click", function() {
                    insertAtCursor('\n[alt type="success"]成功提示的文案[/alt]\n[alt type="info"]消息提示的文案[/alt]\n[alt type="warning"]警告提示的文案[/alt]\n[alt type="error"]错误提示的文案[/alt]\n');
                })
                $("#j-wmd-btn").on("click", function() {
                    insertAtCursor('\n[btn href="跳转链接" type="default"]默认按钮[/btn]\n[btn href="跳转链接" type="primary"]主要按钮[/btn]\n[btn href="跳转链接" type="success"]成功按钮[/btn]\n[btn href="跳转链接" type="info"]信息按钮[/btn]\n[btn href="跳转链接" type="warning"]警告按钮[/btn]\n[btn href="跳转链接" type="danger"]危险按钮[/btn]\n');
                })
                $("#j-wmd-tag").on("click", function() {
                    insertAtCursor('\n[tag type="default"]标签一[/tag]\n[tag type="success"]标签二[/tag]\n[tag type="info"]标签三[/tag]\n[tag type="warning"]标签四[/tag]\n[tag type="danger"]标签五[/tag]\n');
                })
                $("#j-wmd-photo").on("click", function() {
                    insertAtCursor('\n[photo]\n markdown的图片\n markdown的图片\n[/photo]\n');
                })
                $("#j-wmd-music").on("click", function() {
                    insertAtCursor('\n[music id="网抑云音乐ID"/]\n');
                })
                $("#j-wmd-music-list").on("click", function() {
                    insertAtCursor('\n[music-list id="网抑云歌单ID"/]\n');
                })
                $("#j-wmd-delete").on("click", function() {
                    insertAtCursor(' ~~ 删除线效果 ~~ ');
                })
                $("#j-wmd-table").on("click", function() {
                    insertAtCursor('\n表头|表头|表头\n---|:--:|---:\n居左|居中|居右\n居左|居中|居右\n');
                })
                $("#j-wmd-title").on("click", function() {
                    insertAtCursor('\n# 一级标题\n## 二级标题\n### 三级标题\n#### 四级标题\n##### 五级标题\n###### 六级标题\n');
                })
                $("#j-wmd-footer").on("click", function() {
                    insertAtCursor('\n使用 Markdown[^1]可以效率的书写文档, 直接转换成 HTML[^2],。\n\n[^1]:Markdown是一种纯文本标记语言\n\n[^2]:HyperText Markup Language 超文本标记语言\n');
                })
                $("#j-wmd-html").on("click", function() {
                    insertAtCursor('\n!!!\n这里写原生html代码\n!!!\n');
                })
                $("#j-wmd-video-album").on("click", function() {
                    insertAtCursor('\n[video]\n [video-item src="视频地址" poster="海报图（填写数字则表示截取视频帧）" /]\n [video-item src="视频地址" poster="海报图（填写数字则表示截取视频帧）" /]\n[/video]\n');
                })

                function insertAtCursor(myValue, myField = $('#text')[0]) {
                    if (document.selection) {
                        myField.focus();
                        sel = document.selection.createRange();
                        sel.text = myValue;
                        sel.select();
                    } else if (myField.selectionStart || myField.selectionStart == '0') {
                        var startPos = myField.selectionStart;
                        var endPos = myField.selectionEnd;
                        var restoreTop = myField.scrollTop;
                        myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);
                        if (restoreTop > 0) {
                            myField.scrollTop = restoreTop;
                        }
                        myField.focus();
                        myField.selectionStart = startPos + myValue.length;
                        myField.selectionEnd = startPos + myValue.length;
                    } else {
                        myField.value += myValue;
                        myField.focus();
                    }
                }


                /* 粘贴上传 */
                // 上传URL
                var uploadUrl = '<?php Helper::security()->index('/action/upload'); ?>';
                // 处理有特定的 CID 的情况
                var cid = $('input[name="cid"]').val();
                if (cid) {
                    uploadUrl += '&cid=' + cid;
                }

                // 上传文件函数
                function uploadFile(file) {
                    // 生成一段随机的字符串作为 key
                    var index = Math.random().toString(10).substr(2, 5) + '-' + Math.random().toString(36).substr(2);
                    // 默认文件后缀是 png，在Chrome浏览器中剪贴板粘贴的图片都是png格式，其他浏览器暂未测试
                    var fileName = index + '.png';

                    // 上传时候提示的文字
                    var uploadingText = '[图片上传中...(' + index + ')]';

                    // 先把这段文字插入
                    var textarea = $('#text'),
                        sel = textarea.getSelection(),
                        offset = (sel ? sel.start : 0) + uploadingText.length;
                    textarea.replaceSelection(uploadingText);
                    // 设置光标位置
                    textarea.setSelection(offset, offset);

                    // 设置附件栏信息
                    // 先切到附件栏
                    $('#tab-files-btn').click();

                    // 更新附件的上传提示
                    var fileInfo = {
                        id: index,
                        name: fileName
                    }
                    fileUploadStart(fileInfo);

                    // 是时候展示真正的上传了
                    var formData = new FormData();
                    formData.append('name', fileName);
                    formData.append('file', file, fileName);

                    $.ajax({
                        method: 'post',
                        url: uploadUrl,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            var url = data[0],
                                title = data[1].title;
                            textarea.val(textarea.val().replace(uploadingText, '![' + title + '](' + url + ')'));
                            // 触发输入框更新事件，把状态压人栈中，解决预览不更新的问题
                            textarea.trigger('paste');
                            // 附件上传的UI更新
                            fileUploadComplete(index, url, data[1]);
                        },
                        error: function(error) {
                            textarea.val(textarea.val().replace(uploadingText, '[图片上传错误...]\n'));
                            // 触发输入框更新事件，把状态压人栈中，解决预览不更新的问题
                            textarea.trigger('paste');
                            // 附件上传的 UI 更新
                            fileUploadError(fileInfo);
                        }
                    });
                }

                // 监听输入框粘贴事件
                document.getElementById('text').addEventListener('paste', function(e) {
                    var clipboardData = e.clipboardData;
                    var items = clipboardData.items;
                    for (var i = 0; i < items.length; i++) {
                        if (items[i].kind === 'file' && items[i].type.match(/^image/)) {
                            // 取消默认的粘贴操作
                            e.preventDefault();
                            // 上传文件
                            uploadFile(items[i].getAsFile());
                            break;
                        }
                    }
                });

                // 更新附件数量显示
                function updateAttacmentNumber() {
                    var btn = $('#tab-files-btn'),
                        balloon = $('.balloon', btn),
                        count = $('#file-list li .insert').length;

                    if (count > 0) {
                        if (!balloon.length) {
                            btn.html($.trim(btn.html()) + ' ');
                            balloon = $('<span class="balloon"></span>').appendTo(btn);
                        }

                        balloon.html(count);
                    } else if (0 == count && balloon.length > 0) {
                        balloon.remove();
                    }
                }

                // 开始上传文件的提示
                function fileUploadStart(file) {
                    $('<li id="' + file.id + '" class="loading">' +
                        file.name + '</li>').appendTo('#file-list');
                }

                // 上传完毕的操作
                var completeFile = null;

                function fileUploadComplete(id, url, data) {
                    var li = $('#' + id).removeClass('loading').data('cid', data.cid)
                        .data('url', data.url)
                        .data('image', data.isImage)
                        .html('<input type="hidden" name="attachment[]" value="' + data.cid + '" />' +
                            '<a class="insert" target="_blank" href="###" title="<?php _e('点击插入文件'); ?>">' + data.title + '</a><div class="info">' + data.bytes +
                            ' <a class="file" target="_blank" href="<?php $options->adminUrl('media.php'); ?>?cid=' +
                            data.cid + '" title="<?php _e('编辑'); ?>"><i class="i-edit"></i></a>' +
                            ' <a class="delete" href="###" title="<?php _e('删除'); ?>"><i class="i-delete"></i></a></div>')
                        .effect('highlight', 1000);

                    attachInsertEvent(li);
                    attachDeleteEvent(li);
                    updateAttacmentNumber();

                    if (!completeFile) {
                        completeFile = data;
                    }
                }

                // 增加插入事件
                function attachInsertEvent(el) {
                    $('.insert', el).click(function() {
                        var t = $(this),
                            p = t.parents('li');
                        Typecho.insertFileToEditor(t.text(), p.data('url'), p.data('image'));
                        return false;
                    });
                }

                // 增加删除事件
                function attachDeleteEvent(el) {
                    var file = $('a.insert', el).text();
                    $('.delete', el).click(function() {
                        if (confirm('<?php _e('确认要删除文件 %s 吗?'); ?>'.replace('%s', file))) {
                            var cid = $(this).parents('li').data('cid');
                            $.post('<?php Helper::security()->index('/action/contents-attachment-edit'); ?>', {
                                    'do': 'delete',
                                    'cid': cid
                                },
                                function() {
                                    $(el).fadeOut(function() {
                                        $(this).remove();
                                        updateAttacmentNumber();
                                    });
                                });
                        }

                        return false;
                    });
                }

                // 错误处理，相比原来的函数，做了一些微小的改造
                function fileUploadError(file) {
                    var word;

                    word = '<?php _e('上传出现错误'); ?>';

                    var fileError = '<?php _e('%s 上传失败'); ?>'.replace('%s', file.name),
                        li, exist = $('#' + file.id);

                    if (exist.length > 0) {
                        li = exist.removeClass('loading').html(fileError);
                    } else {
                        li = $('<li>' + fileError + '<br />' + word + '</li>').appendTo('#file-list');
                    }

                    li.effect('highlight', {
                        color: '#FBC2C4'
                    }, 2000, function() {
                        $(this).remove();
                    });
                }
            })
        </script>
<?php }
} ?>