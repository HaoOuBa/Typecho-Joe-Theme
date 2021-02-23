<div class="j-aside">
    <?php if ($this->options->JAuthorStatus !== 'off') : ?>
        <div class="aside aside-user">
            <div class="user">
                <img src="<?php $this->options->JAuthorAvatar ? $this->options->JAuthorAvatar() : ParseAvatar($this->author->mail); ?>" />
                <?php if ($this->options->JAuthorLink) : ?>
                    <a href="<?php $this->options->JAuthorLink(); ?>"><?php $this->author->screenName(); ?></a>
                <?php else : ?>
                    <a href="<?php $this->options->siteUrl(); ?>"><?php $this->author->screenName(); ?></a>
                <?php endif; ?>
                <!-- 座右铭 -->
                <?php if ($this->options->JMotto) : ?>
                    <div class="p j-aside-motto"><?php GetRandomMotto(); ?></div>
                <?php else : ?>
                    <div class="p j-aside-motto"></div>
                <?php endif; ?>
            </div>
            <?php Typecho_Widget::widget('Widget_Stat')->to($quantity); ?>
            <div class="webinfo">
                <div class="item" title="累计文章数">
                    <span class="num"><?php echo number_format($quantity->publishedPostsNum); ?></span>
                    <span>文章数</span>
                </div>
                <div class="item" title="累计评论数">
                    <span class="num"><?php echo number_format($quantity->publishedCommentsNum); ?></span>
                    <span>评论量</span>
                </div>
            </div>
            <?php $this->widget('Widget_Contents_Post_Recent@aside565', 'pageSize=' . $this->options->JAuthorStatus)->to($hot); ?>
            <?php if ($hot->have()) : ?>
                <ul class="articles">
                    <?php while ($hot->next()) : ?>
                        <li title="<?php $hot->title(); ?>">
                            <a href="<?php $hot->permalink(); ?>"><?php $hot->title(); ?></a>
                            <svg t="1599802830077" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M448.12 320.331a30.118 30.118 0 0 1-42.616-42.586L552.568 130.68a213.685 213.685 0 0 1 302.2 0l38.552 38.551a213.685 213.685 0 0 1 0 302.2L746.255 618.497a30.118 30.118 0 0 1-42.586-42.616l147.034-147.035a153.45 153.45 0 0 0 0-217.028l-38.55-38.55a153.45 153.45 0 0 0-216.998 0L448.12 320.33zM575.88 703.67a30.118 30.118 0 0 1 42.616 42.586L471.432 893.32a213.685 213.685 0 0 1-302.2 0l-38.552-38.551a213.685 213.685 0 0 1 0-302.2l147.065-147.065a30.118 30.118 0 0 1 42.586 42.616L173.297 595.125a153.45 153.45 0 0 0 0 217.027l38.55 38.551a153.45 153.45 0 0 0 216.998 0L575.88 703.64z m-234.256-63.88L639.79 341.624a30.118 30.118 0 0 1 42.587 42.587L384.21 682.376a30.118 30.118 0 0 1-42.587-42.587z" p-id="7351"></path>
                            </svg>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- 广告1 -->
    <?php if ($this->options->JADContent1) : ?>
        <?php
        $adContent1 = $this->options->JADContent1;
        $adContent1Counts = explode("||", $adContent1);
        ?>
        <a class="aside aside-ad" rel="external nofollow" href="<?php echo $adContent1Counts[1] ?>">
            <img src="<?php echo $adContent1Counts[0] ?>">
        </a>
    <?php endif; ?>

    <!-- 自定义 -->
    <?php if ($this->options->JAsideCustom) : ?>
        <div class="aside aside-custom">
            <?php $this->options->JAsideCustom(); ?>
        </div>
    <?php endif; ?>

    <!-- ip信息 -->
    <?php if ($this->options->JAsideVisitor) : ?>
        <div class="aside aside-visitor">
            <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-original="<?php $this->options->JAsideVisitor() ?>" alt="IP信息">
        </div>
    <?php endif; ?>

    <!-- 人生倒计时 -->
    <?php if ($this->options->JCountDownStatus === "on") : ?>
        <div class="aside aside-count">
            <h3>
                <svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M864.801 895.471h-33.56v-96.859c0-126.081-73.017-235.093-179.062-287.102 106.046-52.01 179.062-161.022 179.062-287.102v-96.859h33.56c17.301 0 31.325-14.327 31.325-32 0-17.673-14.024-32-31.325-32H159.018c-17.3 0-31.325 14.327-31.325 32 0 17.673 14.025 32 31.325 32h33.02v96.859c0 126.08 73.016 235.092 179.061 287.102-106.046 52.009-179.062 161.02-179.062 287.101v96.859h-33.02c-17.3 0-31.325 14.326-31.325 32s14.025 32 31.325 32H864.8c17.301 0 31.325-14.326 31.325-32s-14.023-31.999-31.324-31.999zM256.05 222.427v-94.878h513.046v94.878c0 141.674-114.85 256.522-256.523 256.522-141.674 0-256.523-114.848-256.523-256.522z m513.046 673.044H256.05v-94.879c0-141.674 114.849-256.521 256.523-256.521 141.673 0 256.523 114.848 256.523 256.521v94.879z" p-id="29837"></path>
                    <path d="M544.141 384c0-17.69-14.341-32.031-32.031-32.031-71.694 0-127.854-56.161-127.854-127.855 0-17.69-14.341-32.032-32.031-32.032s-32.032 14.341-32.032 32.032c0 107.617 84.3 191.918 191.917 191.918 17.69 0 32.031-14.342 32.031-32.032z" p-id="29838"></path>
                </svg>
                <span>人生倒计时</span>
                <span class="line"></span>
            </h3>
            <div class="content">
                <div class="item" id="dayProgress">
                    <div class="title">今日已经过去<span></span>小时</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-1"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="weekProgress">
                    <div class="title">这周已经过去<span></span>天</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-2"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="monthProgress">
                    <div class="title">本月已经过去<span></span>天</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-3"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="yearProgress">
                    <div class="title">今年已经过去<span></span>个月</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-4"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- 天气 -->
    <?php if ($this->options->JWetherKey) : ?>
        <div class="aside aside-wether">
            <h3>
                <svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M773.12 757.76h-79.872c-15.36 0-29.696-15.36-29.696-29.696s15.36-29.696 29.696-29.696h79.872c100.352 0 180.224-79.872 180.224-180.224S873.472 337.92 773.12 337.92c-25.6 0-50.176 5.12-74.752 15.36-10.24 5.12-20.48 5.12-25.6 0-10.24-5.12-15.36-15.36-15.36-20.48-15.36-100.352-100.352-175.104-200.704-175.104C346.112 155.648 256 245.76 250.88 356.352c0 15.36-10.24 29.696-29.696 29.696-79.872 5.12-145.408 74.752-145.408 160.768 0 90.112 70.656 160.768 160.768 160.768h75.776c15.36 0 29.696 15.36 29.696 29.696s-15.36 30.72-30.72 30.72h-79.872C110.592 757.76 10.24 662.528 10.24 541.696c0-105.472 75.776-195.584 175.104-216.064 15.36-130.048 130.048-235.52 266.24-235.52 120.832 0 225.28 79.872 256 195.584 20.48-5.12 45.056-10.24 65.536-10.24C908.288 276.48 1013.76 387.072 1013.76 517.12S903.168 757.76 773.12 757.76z" fill="" p-id="13873"></path>
                    <path d="M437.248 933.888c-10.24 0-15.36-5.12-20.48-10.24-10.24-10.24-10.24-29.696 0-45.056l79.872-79.872h-60.416c-10.24 0-25.6-5.12-29.696-20.48-5.12-10.24 0-24.576 5.12-34.816l130.048-130.048c10.24-10.24 29.696-10.24 45.056 0 10.24 10.24 10.24 29.696 0 45.056L512 742.4h55.296c10.24 0 24.576 5.12 29.696 20.48 5.12 10.24 0 24.576-5.12 34.816L461.824 928.768c-10.24 5.12-20.48 5.12-24.576 5.12z" fill="" p-id="13874"></path>
                </svg>
                <span>今日天气</span>
                <span class="line"></span>
            </h3>
            <div class="content" title="今日天气">
                <div class="loading">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 30" xml:space="preserve">
                        <rect x="0" y="13" width="4" height="5" fill="#333">
                            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="10" y="13" width="4" height="5" fill="#333">
                            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="20" y="13" width="4" height="5" fill="#333">
                            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                        </rect>
                    </svg>
                </div>
                <div id="weather-v2-plugin-standard"></div>
            </div>
        </div>
    <?php endif; ?>

    <!-- 热门文章 -->
    <?php if ($this->options->JAsideHotNumber !== 'off') : ?>
        <div class="aside aside-hot">
            <h3>
                <svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M512 938.666667A426.666667 426.666667 0 0 1 85.333333 512a421.12 421.12 0 0 1 131.2-306.133333 58.88 58.88 0 0 1 42.666667-16.64c33.28 1.066667 58.026667 28.16 84.266667 56.96 7.893333 8.533333 19.626667 21.333333 28.373333 29.013333a542.933333 542.933333 0 0 0 24.533333-61.866667c18.133333-52.266667 35.413333-101.76 75.306667-121.6C526.72 64 583.253333 129.706667 654.933333 213.333333c16.213333 18.773333 38.613333 44.8 53.546667 59.52 1.706667-4.48 3.2-8.96 4.48-12.373333 8.533333-24.32 18.986667-54.613333 51.2-61.653333a57.813333 57.813333 0 0 1 55.68 20.053333A426.666667 426.666667 0 0 1 512 938.666667zM260.693333 282.453333A336.64 336.64 0 0 0 170.666667 512a341.333333 341.333333 0 1 0 614.826666-203.733333 90.24 90.24 0 0 1-42.666666 50.56 68.266667 68.266667 0 0 1-53.546667 1.706666c-25.6-9.173333-51.626667-38.4-99.2-93.226666a826.666667 826.666667 0 0 0-87.253333-91.733334 507.733333 507.733333 0 0 0-26.24 64c-18.133333 52.266667-35.413333 101.76-75.946667 119.253334-48.853333 21.333333-88.32-21.333333-120.106667-56.96-5.76-4.693333-13.226667-13.013333-19.84-19.413334z" p-id="14764"></path>
                    <path d="M512 810.666667a298.666667 298.666667 0 0 1-298.666667-298.666667 42.666667 42.666667 0 0 1 85.333334 0 213.333333 213.333333 0 0 0 213.333333 213.333333 42.666667 42.666667 0 0 1 0 85.333334z" p-id="14765"></path>
                </svg>
                <span>热门文章</span>
                <span class="line"></span>
            </h3>
            <?php $this->widget('Widget_Post_hot@asidehot@hot', 'pageSize=' . $this->options->JAsideHotNumber)->to($hot); ?>
            <?php if ($hot->have()) : ?>
                <ul>
                    <?php $i = 1; ?>
                    <?php while ($hot->next()) : ?>
                        <li>
                            <a href="<?php $hot->permalink(); ?>" title="<?php $hot->title(); ?>">
                                <img class="lazyload" src="<?php echo GetLazyLoad() ?>" data-original="<?php GetRandomThumbnail($hot); ?>">
                                <div class="info">
                                    <p><?php $hot->title(); ?></p>
                                    <span><?php GetPostViews($hot); ?> 阅读 - <?php $hot->date('m/d'); ?></span>
                                </div>
                                <div class="tip"><?php echo $i; ?></div>
                            </a>
                        </li>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p class="empty">暂无内容</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- 微博热搜 -->
    <?php if ($this->options->JRanking !== 'off') : ?>
        <?php
        $ranking = $this->options->JRanking;
        $rankingStr = explode("$", $ranking);
        ?>
        <div class="aside aside-ranking">
            <h3>
                <svg t="1609208304108" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M939.855405 202.777641H832.417563v-78.366426A124.320931 124.320931 0 0 0 708.367484 0H315.271381a124.411215 124.411215 0 0 0-124.05008 124.411215v78.366426H83.873744A84.144595 84.144595 0 0 0 0 286.922236c0 123.14724 82.248633 199.437136 194.561806 232.481044a321.862105 321.862105 0 0 0 281.414918 273.469935v158.899665H308.680656a36.11356 36.11356 0 0 0 0 72.22712h406.277552a36.11356 36.11356 0 0 0 0-72.22712H547.662141v-158.899665a321.681538 321.681538 0 0 0 281.414918-273.469935c112.313172-33.043908 194.65209-109.333804 194.652089-232.481044a84.144595 84.144595 0 0 0-83.873743-84.144595zM67.442074 286.922236A16.612238 16.612238 0 0 1 83.873744 270.851702h107.347557v175.602186C118.542761 415.305943 67.442074 370.976547 67.442074 286.922236z m444.377358 440.314583a254.14918 254.14918 0 0 1-252.794921-253.968612V124.411215a56.69829 56.69829 0 0 1 56.24687-56.69829h393.096103a56.69829 56.69829 0 0 1 56.608005 56.69829v348.856992a254.14918 254.14918 0 0 1-252.794921 253.968612z m320.598131-280.782931V270.851702h107.437842a16.612238 16.612238 0 0 1 16.341386 16.43167c0 83.693176-51.100688 128.022571-123.779228 159.170516z" p-id="15686"></path>
                    <path d="M696.540293 469.476283a33.675895 33.675895 0 0 0-43.426556 19.772174 153.482631 153.482631 0 0 1-92.540999 90.283901 33.856463 33.856463 0 0 0 11.014636 65.816963 32.953624 32.953624 0 0 0 10.924352-1.805678 218.938459 218.938459 0 0 0 133.710457-130.640804A33.856463 33.856463 0 0 0 696.540293 469.476283zM517.417034 157.906542l-2.437665 2.708517a163.955563 163.955563 0 0 1-33.856463 27.08517 183.998589 183.998589 0 0 1-39.8152 16.341386l-6.410157 1.62511v64.914125l10.743784-3.069653a180.567801 180.567801 0 0 0 55.253747-25.911479v223.272086h64.282137v-306.965262z" p-id="15687"></path>
                </svg>
                <span><?php echo $rankingStr[0] ?></span>
                <span class="line"></span>
            </h3>
            <ul class="list">
                <?php
                $result = GetRequest("https://the.top/v1/" . $rankingStr[1] . "/1/20", "get");
                $res = json_decode($result, true);
                if ($res['code'] === 0) {
                    for ($i = 0; $i < count($res['data']); $i++) {
                        if ($i < 9) {
                            echo
                                "<li title=" . $res['data'][$i]['title'] . ">
                                    <span>" . ($i + 1) . "</span>
                                    <a target='_blank' href=" . $res['data'][$i]['url'] . ">" . $res['data'][$i]['title'] . "</a>
                                </li>";
                        }
                    }
                } else {
                    echo "<li>获取失败！</li>";
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>


    <!-- 最新回复 -->
    <?php if ($this->options->JAsideReplyStatus !== 'off') : ?>
        <div class="aside aside-reply">
            <h3>
                <svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M512 647.238856a204.391218 204.391218 0 0 0 204.391218-204.391218V204.391218a204.391218 204.391218 0 0 0-408.782436 0v238.45642a204.391218 204.391218 0 0 0 204.391218 204.391218zM375.739188 204.391218a136.260812 136.260812 0 0 1 272.521624 0v238.45642a136.260812 136.260812 0 0 1-272.521624 0z" p-id="25083"></path>
                    <path d="M852.652029 476.912841a34.065203 34.065203 0 0 0-68.130406 0 257.532934 257.532934 0 0 1-272.521623 238.45642A257.532934 257.532934 0 0 1 239.478377 476.912841a34.065203 34.065203 0 0 0-34.065203-34.065203 34.065203 34.065203 0 0 0-34.065203 34.065203 321.575516 321.575516 0 0 0 307.26813 303.86161V953.825682H307.608782a34.065203 34.065203 0 0 0-34.065202 34.065203 34.065203 34.065203 0 0 0 34.065202 34.065203h408.782436a34.065203 34.065203 0 0 0 34.065202-34.065203 34.065203 34.065203 0 0 0-34.065202-34.065203H546.065203v-170.326015-4.769128A321.575516 321.575516 0 0 0 852.652029 476.912841z" p-id="25084"></path>
                </svg>
                <span>最新回复</span>
                <span class="line"></span>
            </h3>
            <?php $this->widget('Widget_Comments_Recent@ok88', 'ignoreAuthor=true&pageSize=5')->to($comments); ?>
            <?php if ($comments->have()) : ?>
                <ol class="list" id="asideReply">
                    <?php while ($comments->next()) : ?>
                        <li>
                            <div class="user">
                                <img src="<?php ParseAvatar($comments->mail); ?>">
                                <div class="info">
                                    <div class="name"><?php $comments->author(false); ?></div>
                                    <span><?php $comments->date('Y-m-d'); ?></span>
                                </div>
                            </div>
                            <div class="reply">
                                <a title="<?php $comments->excerpt(); ?>" href="<?php $comments->permalink(); ?>"><?php echo ParseReply($comments->content); ?></a>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ol>
            <?php else : ?>
                <p class="empty">暂无回复</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- 广告2 -->
    <?php if ($this->options->JADContent2) : ?>
        <?php
        $adContent2 = $this->options->JADContent2;
        $adContent2Counts = explode("||", $adContent2);
        ?>
        <a class="aside aside-ad" rel="external nofollow" href="<?php echo $adContent2Counts[1] ?>" title="广告">
            <img src="<?php echo $adContent2Counts[0] ?>">
            <div class="j-ad">广告</div>
        </a>
    <?php endif; ?>

    <!-- 云标签 -->
    <?php if ($this->options->J3DTagStatus === 'on') : ?>
        <div class="aside aside-cloud">
            <h3>
                <svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M898.048 556.544L547.84 916.992c-43.008 44.032-112.64 44.032-155.648 0l-272.384-280.576c-43.008-44.032-43.008-116.224 0-160.256l350.208-360.96c26.624-28.672 31.744-41.472 59.904-41.472H885.76c28.16 0 50.688 23.552 50.688 52.224v366.592c0 28.672-15.872 40.448-38.4 64zM158.72 596.48l272.384 280.576c21.504 22.016 56.32 22.016 77.824 0l38.4-39.936-349.696-361.472-39.424 40.448c-20.992 22.528-20.992 58.368 0.512 80.384z m727.04-444.416c0-14.336-11.264-26.112-25.6-26.112h-305.152c-13.824 0-33.792 16.384-46.592 29.184l-271.36 280.576 349.696 360.96 272.384-280.576c13.824-14.336 26.624-35.328 26.624-49.664V152.064z m-275.456 270.336c-42.496-43.52-42.496-114.688 0-158.208 42.496-44.032 111.104-44.032 153.6 0 42.496 43.52 42.496 114.688 0 158.208s-111.616 43.52-153.6 0z m115.2-118.784c-20.992-22.016-55.808-22.016-76.8 0s-20.992 57.344 0 79.36c20.992 22.016 55.808 22.016 76.8 0s20.992-57.344 0-79.36z" p-id="25822"></path>
                </svg>
                <span>标签云</span>
                <span class="line"></span>
            </h3>
            <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 50))->to($tags); ?>
            <?php if ($tags->have()) : ?>
                <div class="cloud" id="cloud"></div>
                <ul id="cloudList">
                    <?php while ($tags->next()) : ?>
                        <li data-url="<?php $tags->permalink(); ?>" data-label="<?php $tags->name(); ?>"></li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p class="empty">暂无标签</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>