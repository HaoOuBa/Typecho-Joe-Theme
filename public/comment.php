<?php
function threadedComments($comments, $options)
{
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass = 'comment-by-author';
        }
    }
?>
    <li id="li-<?php $comments->theId(); ?>">
        <div class="scrolltop" id="<?php $comments->theId(); ?>">
            <div class="item">
                <img class="left" src="<?php ParseAvatar($comments->mail); ?>">
                <div class="right">
                    <div class="name">
                        <span><?php $comments->author(); ?></span>
                        <i class="<?php echo $commentClass; ?>">作者</i>
                        <?php if ($comments->status === "waiting") : ?>
                            <em>（审核后可见）</em>
                        <?php endif; ?>
                        <div><?php GetOs($comments->agent); ?> · <?php GetBrowser($comments->agent); ?></div>
                    </div>
                    <div class="content replyContent">
                        <?php echo GetParentReply($comments->parent); ?>
                        <?php echo ParseReply($comments->content); ?>
                    </div>
                    <div class="meta">
                        <span><?php $comments->date('Y-m-d'); ?></span>
                        <a href="javascript:void(0);" onclick="return TypechoComment.reply('<?php $comments->theId(); ?>', <?php $comments->coid(); ?>)">
                            <svg t="1601003432079" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6644" width="200" height="200">
                                <path d="M947.2 467.968h-276.48v61.44h276.48zM947.2 650.24h-363.52v61.44h363.52zM947.2 832.512H482.304v61.44H947.2zM519.168 179.2l122.368 85.504-352.256 503.808-122.368-85.504L519.168 179.2m-14.848-85.504L81.92 698.368l223.232 156.16L727.04 249.856 504.32 93.696z" p-id="6645"></path>
                                <path d="M433.152 195.072L397.824 245.76l223.232 155.648 35.328-50.176zM143.36 740.864l-61.44-42.496v237.056l222.72-81.408-60.928-43.008-100.352 36.864z" p-id="6646"></path>
                            </svg>回复
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($comments->children) { ?>
            <div class="comment-children">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php } ?>
    </li>
<?php } ?>


<?php $this->comments()->to($comments); ?>
<div id="comments" class="j-comment" data-respondId="<?php $this->respondId() ?>">
    <div class="title">评论 (<?php $this->commentsNum(); ?>)</div>
    <?php if ($this->allow('comment')) : ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="change" id="commentType">
                <button data-type="canvas">画图模式</button>
                <button data-type="text" class="active">文本模式</button>
            </div>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form">
                <div class="head">
                    <?php if ($this->user->hasLogin()) : ?>
                        <div class="head-item">
                            <input id="comment-nick" type="text" value="<?php $this->user->screenName(); ?>" autocomplete="off" name="author" maxlength="16" placeholder="昵称：请输入昵称（必填）" />
                        </div>
                        <div class="head-item">
                            <input id="comment-mail" type="text" value="<?php $this->user->mail(); ?>" autocomplete="off" name="mail" placeholder="邮箱：请输入邮箱（必填）" />
                        </div>
                    <?php else : ?>
                        <div class="head-item">
                            <input id="comment-nick" type="text" value="<?php $this->remember('author'); ?>" autocomplete="off" name="author" maxlength="16" placeholder="昵称：请输入昵称（必填）" />
                        </div>
                        <div class="head-item">
                            <input id="comment-mail" type="text" value="<?php $this->remember('mail'); ?>" autocomplete="off" name="mail" placeholder="邮箱：请输入邮箱（必填）" />
                        </div>
                    <?php endif; ?>
                    <div class="head-item">
                        <input id="comment-url" type="text" value="<?php $this->remember('url'); ?>" autocomplete="off" name="url" placeholder="网址：请输入网址（选填）" />
                    </div>
                </div>
                <div class="content" id="commentTypeContent">
                    <textarea class="OwO-textarea" name="text" autocomplete="off" id="comment-content" rows="5" placeholder="说点什么吧，点击右上角可切换成画图模式哦~"></textarea>
                    <div class="canvas" style="display: none;">
                        <ul>
                            <li data-line="3">细</li>
                            <li data-line="5" class="active">中</li>
                            <li data-line="8">粗</li>
                        </ul>
                        <ol>
                            <li data-color="#303133" class="active"></li>
                            <li data-color="#67c23a"></li>
                            <li data-color="#e6a23c"></li>
                            <li data-color="#f56c6c"></li>
                        </ol>
                        <svg title="撤销" class="undo" viewBox="0 0 1365 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M754.133333 337.333333c-16.4-2.266667-32.933333-3.6-49.6-3.6h-7.066666V161.866667c0-40.4-14.666667-65.733333-36.666667-70.133334-1.466667-0.4-3.066667 0-4.666667-0.133333-2.8-0.266667-5.466667-0.666667-8.533333-0.133333-10.133333 1.466667-21.2 6.533333-33.066667 16L192 447.466667c-3.066667 2.4-4.8 5.466667-7.466667 8-3.2 3.2-6.4 6.4-9.066666 9.866666-2.4 3.333333-4.533333 6.533333-6.533334 9.866667-2.666667 4.666667-4.666667 9.466667-6.4 14.4-0.8 2.266667-1.866667 4.4-2.4 6.666667-0.8 3.333333-0.933333 6.666667-1.333333 9.866666-0.133333 1.333333-0.4 2.533333-0.4 3.866667-0.266667 3.066667-0.133333 6 0 9.066667 0.133333 1.733333 0.4 3.333333 0.666667 4.933333 0.4 2.8 0.4 5.733333 1.066666 8.533333 0.8 3.866667 2.666667 7.333333 4.133334 11.066667 1.066667 2.8 2.266667 5.733333 3.733333 8.533333 2.533333 4.8 5.466667 9.466667 9.2 14l0.133333 0.133334c4.4 5.466667 8.666667 11.066667 14.666667 15.866666L611.466667 918.666667c45.466667 36.4 85.466667-0.533333 85.466666-54.666667V680.4h63.6c22 0 43.466667 1.333333 64.133334 3.6 9.466667 1.066667 18.533333 3.2 27.866666 4.666667 11.066667 1.866667 22.4 3.333333 33.2 5.866666 8.666667 2 16.8 4.933333 25.2 7.466667 11.066667 3.333333 22.133333 6.266667 32.8 10.4 7.2 2.666667 14 6.266667 21.066667 9.333333 11.333333 5.066667 22.8 10 33.6 16 5.466667 3.066667 10.533333 6.8 15.866667 10 11.866667 7.333333 23.6 14.666667 34.533333 23.066667 3.6 2.8 6.933333 6.133333 10.533333 9.066667 12.133333 10 24.133333 20.266667 35.333334 31.733333 1.2 1.2 2.266667 2.666667 3.466666 4 26.666667 28.133333 50.666667 60.4 71.333334 97.2 8.533333 14 17.2 19.333333 23.733333 18.4 6.666667-0.533333 11.333333-7.333333 11.333333-18.4-3.333333-255.733333-206.4-540.933333-450.4-575.466667z m6.4 276.266667h-130.4V862.666667c-6-2.4-12.266667-5.733333-18.533333-10.8L232.8 548c-10-21.333333-10.133333-44.933333-0.4-66.266667l382.133333-307.466666c5.2-4.266667 10.4-7.466667 15.466667-10v236.8l66.933333-0.533334h7.6c99.866667 0 194.4 43.866667 274.133334 112.533334 62.8 73.733333 123.2 161.466667 149.066666 254.133333-85.733333-102-217.866667-153.6-367.2-153.6z m0 0" fill="" p-id="1775"></path>
                        </svg>
                        <svg title="动画" class="animate" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M954.9 228.4H619.1c-4.5 0-8.1 3.6-8.1 8s53.8 56 58.2 56H955c4.4 0 8.1-3.6 8.1-8v-48c-0.1-4.4-3.7-8-8.2-8z m5.3 352H837.9c-1.5 0-2.8 3.6-2.8 8v48c0 4.4 1.3 8 2.8 8h122.4c1.5 0 2.8-3.6 2.8-8v-48c-0.1-4.4-1.3-8-2.9-8z m-1.6 128H807.4c-2.4 0-4.4 3.6-4.4 8v48c0 4.4 2 8 4.4 8h151.2c2.4 0 4.4-3.6 4.4-8v-48c0-4.4-2-8-4.4-8z" p-id="4541"></path>
                            <path d="M457.4 798.5l-171.7 90.3c-31.3 16.4-70 4.4-86.4-26.9-6.5-12.5-8.8-26.7-6.4-40.6l32.8-191.2-139-135.4c-25.3-24.7-25.8-65.2-1.2-90.5 9.8-10.1 22.7-16.6 36.6-18.7l192-27.9 85.9-174c15.6-31.7 54-44.7 85.7-29.1 12.6 6.2 22.8 16.4 29.1 29.1l85.9 174 192 27.9c35 5.1 59.2 37.6 54.1 72.5-2 13.9-8.6 26.8-18.7 36.6L689.2 630.1 722 821.4c6 34.8-17.4 67.9-52.3 73.9-13.9 2.4-28.1 0.1-40.6-6.4l-171.7-90.4zM656 837.8c1.2 0.7 2.7 0.9 4.1 0.6 3.5-0.6 5.8-3.9 5.2-7.4l-37.9-221L788 453.4c1-1 1.7-2.3 1.9-3.7 0.5-3.5-1.9-6.7-5.4-7.3l-222-32.3-99.3-201.2c-0.6-1.3-1.6-2.3-2.9-2.9-3.2-1.6-7-0.3-8.6 2.9l-99.3 201.2-222 32.3c-1.4 0.2-2.7 0.9-3.7 1.9-2.5 2.5-2.4 6.6 0.1 9.1L287.5 610l-37.9 221.1c-0.2 1.4 0 2.8 0.6 4.1 1.6 3.1 5.5 4.3 8.6 2.7l198.6-104.4L656 837.8z" p-id="4542"></path>
                        </svg>
                        <canvas id="draw" height="300"></canvas>
                    </div>
                </div>
                <div class="foot">
                    <div class="OwO" id="OwO_Container"></div>
                    <div class="right">
                        <?php $comments->cancelReply("<span data-parent='" . $this->respondId . "'>取消</span>"); ?>
                        <button type="submit">发表评论</button>
                    </div>
                </div>
            </form>
        </div>
        <?php if ($comments->have()) : ?>
            <div class="comment-all">
                <?php $comments->listComments(); ?>
            </div>
            <?php $comments->pageNav(
                '<svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z" fill="" p-id="9417"></path><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312 0.512zM181.248 877.056c0-3.584 0-7.68 0.512-11.264h-0.512V151.552h0.512c-0.512-3.584-0.512-7.168-0.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-0.512 11.264h0.512V865.792h-0.512c0.512 3.584 0.512 7.168 0.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"></path></svg>',
                '<svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z" fill="" p-id="9417"></path><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312 0.512zM181.248 877.056c0-3.584 0-7.68 0.512-11.264h-0.512V151.552h0.512c-0.512-3.584-0.512-7.168-0.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-0.512 11.264h0.512V865.792h-0.512c0.512 3.584 0.512 7.168 0.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"></path></svg>',
                1,
                '...',
                array(
                    'wrapTag' => 'ul',
                    'wrapClass' => 'j-pagination',
                    'itemTag' => 'li',
                    'textTag' => 'a',
                    'currentClass' => 'active',
                    'prevClass' => 'prev',
                    'nextClass' => 'next'
                )
            ); ?>
        <?php endif; ?>
    <?php else : ?>
        <div class="close">本篇文章评论功能已关闭</div>
    <?php endif; ?>
</div>