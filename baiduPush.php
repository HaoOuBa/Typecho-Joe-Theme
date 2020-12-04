<?php
/* 
  *
  * joe 主题牛逼， 使用 joe 模板得永生
  * 观自在菩萨，行深般若波罗蜜多时，照见五蕴皆空，渡一切苦厄。
  * 舍利子!色不异空，空不异色;色即是空，空即是色;受想行识，亦复如是。
  * 舍利子!是诸法空相，不生不灭，不垢不净，不增不减。
  * 是故空中无色，无受想行识，无眼耳鼻舌身意，无色声香味触法，无眼界，乃至无意识界。
  * 无无明，亦无无明尽，乃至无老死，亦无老死尽，无苦集灭道。无智亦无得。
  * 以无所得故，菩提萨埵，依般若波罗蜜多故，心无罣碍，无罣碍故，无有恐怖， 远离颠倒梦想，究竟涅槃。
  * 三世诸佛，依般若波罗蜜多故，得阿耨多罗三藐三菩提。
  * 故知般若波罗蜜多，是大神咒，是大明咒，是无上咒，是无等等咒，能除一切苦，真实不虚。
  * 故说般若波罗蜜多咒，即说咒曰︰揭諦揭諦，波罗揭諦，波罗僧揭諦，菩提娑婆呵。
  *
  *
*/
header("Content-type:text/html; charset=utf-8");
$get_urls = $_GET['urls'];
$urls = explode(',', $get_urls);
$token = $_GET['token'];
$domain = $_GET['domain'];
$api = 'http://data.zz.baidu.com/urls?site=' . $domain . '&token=' . $token;
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $urls),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
echo $result;
curl_close($ch);
