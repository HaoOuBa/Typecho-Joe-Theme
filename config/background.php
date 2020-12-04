<!-- 移动端 -->
<?php if (isMobile()) : ?>
    <!-- 填写了背景图，则显示背景图 -->
    <?php if ($this->options->JDocumentWAPBG) : ?>
        <style>
            body::before {
                content: '';
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
            }
        </style>
    <?php else : ?>
        <!-- 没填写则显示默认的灰色 -->
        <style>
            body {
                background: #f5f5f5;
            }
        </style>
    <?php endif; ?>
<?php else : ?>
    <!-- 如果开启了动态背景，则显示动态背景 -->
    <?php if ($this->options->JDocumentCanvasBG !== 'off') : ?>
        <?php if ($this->options->JCDN === 'on') : ?>
            <script src="//cdn.jsdelivr.net/npm/typecho_joe_theme@<?php echo JoeVersion() ?>/assets/background/<?php $this->options->JDocumentCanvasBG() ?>"></script>
        <?php else : ?>
            <script src="<?php $this->options->themeUrl('assets/background/' . $this->options->JDocumentCanvasBG); ?>"></script>
        <?php endif; ?>
    <?php else : ?>
        <!-- 如果填写了背景图，则优先显示背景图 -->
        <?php if ($this->options->JDocumentPCBG) : ?>
            <style>
                body::before {
                    content: '';
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
                }
            </style>
        <?php else : ?>
            <!-- 没填写则显示默认的灰色 -->
            <style>
                body {
                    background: #f5f5f5;
                }
            </style>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>