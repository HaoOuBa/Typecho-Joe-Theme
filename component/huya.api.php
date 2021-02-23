<!-- <h2 style="font-size: 50px;margin-bottom: 20px; text-align:center; color: #ff0000">本页面仅供学习使用！！！</h2> -->
<div class="huya-list">
    <?php if (empty($_GET['play'])) : ?>
        <div class="huya-list-type">
            <div class="title">直播分类</div>
            <div class="list">
                <span class="muted">娱乐天地</span>
                <ul>
                    <li class="<?php echo $_GET['vid'] == '1663' ? 'active' : ''  ?>" data-vid="1663">星秀</li>
                    <li class="<?php echo $_GET['vid'] == '2165' ? 'active' : ''  ?>" data-vid="2165">户外</li>
                    <li class="<?php echo $_GET['vid'] == '2633' ? 'active' : ''  ?>" data-vid="2633">二次元</li>
                    <li class="<?php echo $_GET['vid'] == '2135' ? 'active' : ''  ?>" data-vid="2135">一起看</li>
                    <li class="<?php echo $_GET['vid'] == '2752' ? 'active' : ''  ?>" data-vid="2752">美食</li>
                    <li class="<?php echo $_GET['vid'] == '2168' ? 'active' : ''  ?>" data-vid="2168">颜值</li>
                    <li class="<?php echo $_GET['vid'] == '4079' ? 'active' : ''  ?>" data-vid="4079">交友</li>
                    <li class="<?php echo $_GET['vid'] == '3793' ? 'active' : ''  ?>" data-vid="3793">音乐</li>
                    <li class="<?php echo $_GET['vid'] == '2356' ? 'active' : ''  ?>" data-vid="2356">体育</li>
                </ul>
            </div>
            <div class="list">
                <span class="muted">网游竞技</span>
                <ul>
                    <li class="<?php echo $_GET['vid'] == '1' ? 'active' : ''  ?>" data-vid="1">英雄联盟</li>
                    <li class="<?php echo $_GET['vid'] == '5485' ? 'active' : ''  ?>" data-vid="5485">LOL云顶之弈</li>
                    <li class="<?php echo $_GET['vid'] == '4' ? 'active' : ''  ?>" data-vid="4">穿越火线</li>
                    <li class="<?php echo $_GET['vid'] == '2' ? 'active' : ''  ?>" data-vid="2">DNF</li>
                    <li class="<?php echo $_GET['vid'] == '8' ? 'active' : ''  ?>" data-vid="8">魔兽世界<lia>
                    <li class="<?php echo $_GET['vid'] == '393' ? 'active' : ''  ?>" data-vid="393">炉石传说</li>
                    <li class="<?php echo $_GET['vid'] == '7' ? 'active' : ''  ?>" data-vid="7">DOTA2</li>
                    <li class="<?php echo $_GET['vid'] == '802' ? 'active' : ''  ?>" data-vid="802">坦克世界</li>
                    <li class="<?php echo $_GET['vid'] == '862' ? 'active' : ''  ?>" data-vid="862">CS:GO</li>
                    <li class="<?php echo $_GET['vid'] == '4615' ? 'active' : ''  ?>" data-vid="4615">魔兽争霸3</li>
                    <li class="<?php echo $_GET['vid'] == '107' ? 'active' : ''  ?>" data-vid="107">问道</li>
                    <li class="<?php echo $_GET['vid'] == '100137' ? 'active' : ''  ?>" data-vid="100137">使命召唤</li>
                </ul>
            </div>
            <div class="list">
                <span class="muted">单机热游</span>
                <ul>
                    <li class="<?php echo $_GET['vid'] == '2793' ? 'active' : ''  ?>" data-vid="2793">绝地求生</li>
                    <li class="<?php echo $_GET['vid'] == '100032' ? 'active' : ''  ?>" data-vid="100032">主机游戏</li>
                    <li class="<?php echo $_GET['vid'] == '1732' ? 'active' : ''  ?>" data-vid="1732">我的世界</li>
                    <li class="<?php echo $_GET['vid'] == '1997' ? 'active' : ''  ?>" data-vid="1997">方舟</li>
                    <li class="<?php echo $_GET['vid'] == '3519' ? 'active' : ''  ?>" data-vid="3519">怪物猎人</li>
                    <li class="<?php echo $_GET['vid'] == '3493' ? 'active' : ''  ?>" data-vid="3493">逃离塔科夫</li>
                    <li class="<?php echo $_GET['vid'] == '100125' ? 'active' : ''  ?>" data-vid="100125">怀旧游戏</li>
                    <li class="<?php echo $_GET['vid'] == '4783' ? 'active' : ''  ?>" data-vid="4783">骑马与砍杀</li>
                    <li class="<?php echo $_GET['vid'] == '4913' ? 'active' : ''  ?>" data-vid="4913">拾遗记</li>
                </ul>
            </div>
            <div class="list">
                <span class="muted">手游休闲</span>
                <ul>
                    <li class="<?php echo $_GET['vid'] == '2336' ? 'active' : ''  ?>" data-vid="2336">王者荣耀</li>
                    <li class="<?php echo $_GET['vid'] == '3203' ? 'active' : ''  ?>" data-vid="3203">和平精英</li>
                    <li class="<?php echo $_GET['vid'] == '100029' ? 'active' : ''  ?>" data-vid="100029">综合手游</li>
                    <li class="<?php echo $_GET['vid'] == '100049' ? 'active' : ''  ?>" data-vid="100049">狼人杀</li>
                    <li class="<?php echo $_GET['vid'] == '2928' ? 'active' : ''  ?>" data-vid="2928">QQ飞车</li>
                    <li class="<?php echo $_GET['vid'] == '2413' ? 'active' : ''  ?>" data-vid="2413">CF手游</li>
                    <li class="<?php echo $_GET['vid'] == '2620' ? 'active' : ''  ?>" data-vid="2620">跑跑手游</li>
                    <li class="<?php echo $_GET['vid'] == '2439' ? 'active' : ''  ?>" data-vid="2439">皇室战争</li>
                    <li class="<?php echo $_GET['vid'] == '2429' ? 'active' : ''  ?>" data-vid="2429">火影手游</li>
                </ul>
            </div>
        </div>
        <ul class="huya-list-item">
            <?php
            if (empty($_GET['pg'])) {
                $_GET['pg'] = 1;
            };
            $vid = $_GET['vid'];
            if (empty($_GET['vid'])) {
                $url = "https://www.huya.com/cache.php?m=LiveList&do=getLiveListByPage&tagAll=0&page=" . $_GET['pg'];
            } else {
                $url = "https://www.huya.com/cache.php?m=LiveList&do=getLiveListByPage&gameId=" . $vid . "&tagAll=0&page=" . $_GET['pg'];
            }
            $res = json_decode(file_get_contents($url), true);
            $totalPage = $res['data']['totalPage'];
            for ($i = 0; $i < count($res['data']['datas']); $i++) {
                $number = $res['data']['datas'][$i]['totalCount'];
                $length = strlen($number);
                if ($length > 4) {
                    $str = substr_replace(strstr($number, substr($number, -3), ' '), '.', -1, 0) . "万";
                } else {
                    $str = $number;
                }
            ?>
                <li>
                    <div class="huya-list-go-play" data-href="<?php echo $res['data']['datas'][$i]['profileRoom'] ?>" data-title="<?php echo $res['data']['datas'][$i]['nick'] ?>">
                        <?php if (!empty($res['data']['datas'][$i]['recommendTagName'])) : ?>
                            <span class="recommendTagName"><?php echo $res['data']['datas'][$i]['recommendTagName'] ?></span>
                        <?php endif; ?>
                        <img class="screenshot lazyload" src="<?php echo GetLazyLoad() ?>" data-original='<?php echo $res['data']['datas'][$i]['screenshot']; ?>'>
                        <div class="desc">
                            <p class="introduction"><?php echo $res['data']['datas'][$i]['introduction'] ?></p>
                            <div class="user">
                                <div class="left">
                                    <img src="<?php echo $res['data']['datas'][$i]['avatar180'] ?>">
                                    <span><?php echo $res['data']['datas'][$i]['nick'] ?></span>
                                </div>
                                <div class="right">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M859.9104 609.92512l0 45.6c-0.67968 2.21952-1.5104 4.4352-1.9648 6.70464-4.66048 24.09984-7.28448 48.82944-14.31552 72.22016-20.84992 69.02016-59.92064 126.53952-114.6944 173.50016-42.24512 36.2496-89.7856 62.36544-144.1344 75.22048-17.87008 4.23552-36.19456 6.73024-54.32064 10.0352l-45.5744 0c-2.21952-0.6848-4.49024-1.72032-6.75456-1.87008-48.12544-2.9952-93.72544-15.52512-136.50048-37.38496-80.86528-41.18528-139.19488-102.5152-165.83552-190.74048-5.67424-18.8544-8.03968-38.62016-11.9744-57.97504l0-43.50976c1.7152-10.69056 3.2-21.47456 5.21984-32.16 8.61952-46.68544 29.36576-88.0256 56.83968-126.19008 25.91488-35.92064 53.44-70.70464 78.016-107.53536 26.56896-39.95008 39.424-84.2944 31.88992-132.9152-1.4848-9.60512-2.87488-19.20896-4.33536-28.76416 0.98048-0.25088 1.9648-0.45056 2.9504-0.73088 59.31008 62.16064 68.96512 138.46528 60.49408 220.92032 2.17088-2.31936 3.98592-3.93472 5.37088-5.79968 50.33984-68.08448 71.96416-143.29984 55.55456-227.54688-10.42944-53.58976-32.99456-101.76512-70.32448-141.81504C369.3056 61.84576 349.69472 47.65568 331.61984 32l18.65472 0c1.536 0.62976 2.976 1.7152 4.53504 1.86496 32.82048 2.81984 63.65056 12.95488 93.02016 27.2 67.17056 32.51584 121.62048 80.58496 167.17056 139.22048 66.9504 86.27968 110.48448 181.99424 119.10528 292.19968 3.30496 42.06976-0.9856 82.95552-12.19968 123.2896-4.23552 15.27552-10.21056 30.04544-15.68 45.94944 21.72544-9.25056 38.24-23.38944 50.9952-41.7152 38.04032-54.77504 48.67456-115.85536 40.05504-183.38048 2.80064 3.24992 4.23552 4.53504 5.21472 6.14528 22.91456 36.19968 40.05504 74.81472 49.0048 116.78464C855.05024 576.17024 857.11488 593.1648 859.9104 609.92512M501.56544 529.61536c-0.85504 0.60544-1.79072 1.2352-2.67008 1.84064-1.18528 16.64-2.06976 33.30048-3.68 49.93536-2.37056 25.38496-8.44544 49.85984-20.32 72.62464-14.52032 27.87968-38.7904 45.21984-65.69088 59.01056-29.00992 14.9696-47.28448 36.34944-49.65504 70.10048-2.46912 34.70976 7.96544 63.86944 35.94496 85.20064 26.21568 19.96032 56.84096 26.4704 89.3056 25.38496 51.82976-1.6896 90.4448-26.32064 105.92512-78.1952 11.11552-37.23008 9.30048-74.71488 1.86496-112.19456-10.16064-51.37536-28.76544-99.26528-60.60032-141.2352C523.04512 550.36032 511.7504 540.40448 501.56544 529.61536" fill="#fc6528" p-id="9784"></path>
                                    </svg>
                                    <span class="totalCount"><?php echo $str ?></span>
                                    <span class="gameFullName"><?php echo $res['data']['datas'][$i]['gameFullName'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="hover">
                            <svg class="svg" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M512 65c247.424 0 448 200.576 448 448S759.424 961 512 961 64 760.424 64 513 264.576 65 512 65z m0 64c-212.077 0-384 171.923-384 384s171.923 384 384 384 384-171.923 384-384-171.923-384-384-384z m-63 214.657a64 64 0 0 1 33.593 9.525L655.857 460.03c30.086 18.552 39.435 57.982 20.882 88.067a64 64 0 0 1-21.324 21.152L482.151 674.17c-30.235 18.308-69.587 8.64-87.896-21.594A64 64 0 0 1 385 619.425V407.657c0-35.346 28.654-64 64-64z m1.196 74.49a8 8 0 0 0-1.196 4.207v183.432a8 8 0 0 0 12.15 6.84l149.688-90.851a8 8 0 0 0 0.057-13.643L461.208 415.55a8 8 0 0 0-11.012 2.595z" p-id="19997"></path>
                            </svg>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <ul class="huya-list-pagination">
            <?php
            if ($_GET['pg'] != 1) {
                echo '<li data-pg="' . ($_GET['pg'] - 1) . '"><svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z" fill="" p-id="9417"></path><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312 0.512zM181.248 877.056c0-3.584 0-7.68 0.512-11.264h-0.512V151.552h0.512c-0.512-3.584-0.512-7.168-0.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-0.512 11.264h0.512V865.792h-0.512c0.512 3.584 0.512 7.168 0.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"></path></svg></li>';
                echo '<li data-pg="' . ($_GET['pg'] - 1) . '">' . ($_GET['pg'] - 1) . '</li>';
            }
            echo '<li class="active" data-pg="' . $_GET['pg'] . '">' . $_GET['pg'] . '</li>';
            if ($_GET['pg'] != $totalPage) {
                echo '<li data-pg="' . ($_GET['pg'] + 1) . '">' . ($_GET['pg'] + 1) . '</li>';
            }
            if ($_GET['pg'] < $totalPage) {
                echo '<li data-pg="' . ($_GET['pg'] + 1) . '"><svg class="next" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z" fill="" p-id="9417"></path><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312 0.512zM181.248 877.056c0-3.584 0-7.68 0.512-11.264h-0.512V151.552h0.512c-0.512-3.584-0.512-7.168-0.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-0.512 11.264h0.512V865.792h-0.512c0.512 3.584 0.512 7.168 0.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"></path></svg></li>';
            }
            ?>
        </ul>
    <?php else : ?>
        <div class="huya-list-play">
            <?php
            ini_set('user_agent', 'Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1');
            $id = $_GET['play'];
            $murl = 'https://www.huya.com/' . $id;
            $play = 'https://liveshare.huya.com/iframe/' . $id;
            ?>
            <div class="title">正在直播：<?php echo $_GET['title'] ?></div>
            <iframe src="<?php echo $play; ?>" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" frameborder="0"></iframe>
        </div>
    <?php endif; ?>
</div>