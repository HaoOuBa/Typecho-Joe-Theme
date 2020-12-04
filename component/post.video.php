<div class="video" id="j-video">
    <?php
    $string_arr = explode("\r\n", $this->fields->video);
    $long = count($string_arr);
    ?>
    <div class="player-box">
        <div class="title">
            <span>正在播放：</span>
        </div>
        <div class="player">
            <?php if ($this->options->JAnalysis) : ?>
                <iframe allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" id="j-dplayer-iframe" data-src="<?php $this->options->JAnalysis() ?>"></iframe>
            <?php else : ?>
                <div id="j-dplayer"></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="episodes">
        <div class="title">剧集列表</div>
        <ul>
            <?php
            for ($i = 0; $i < $long; $i++) {
                echo '
                    <li data-url="' . explode("$", $string_arr[$i])[1] . '">
                        <span>' . explode("$", $string_arr[$i])[0] . '</span>
                    </li>
                ';
            }
            ?>

        </ul>
    </div>
</div>