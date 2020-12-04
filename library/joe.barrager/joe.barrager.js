(function ($) {
    /* 第一次将页面上的弹幕全部清除掉 */
    $('.j-barrager').remove();
    /* 取随机数函数 */
    let random = (min, max) => {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
    };
    /* 循环评论列表 */
    $('.j-barrager-list li').each(function (i, item) {
        /* 头像 */
        let avatar = $(item).find('.j-barrager-list-avatar').attr('data-src');
        /* 内容 */
        let content = $(item).find('.j-barrager-list-content').html();
        /* 如果内容是画图，那么直接结束循环，进行下一轮循环 */
        if (/\{!\{.*/.test(content)) return;
        /* 获取最小高度为网站头部的高度，为了防止将弹幕生成到网站头部上 */
        let minTop = $('.j-header').height();
        /* 生成一个随机的高度，高度值为，网站头部的高度，到窗口的高度 - 34（34是弹幕的高度） */
        let randomTop = random(minTop, $(window).height() - 34) + 'px';
        /* 生成随机的偏移值 */
        let translateX = `translateX(${$(window).width() + random(0, 500)}px)`;
        /* 生成随机过渡时间 */
        let transition = `transform ${random(30, 55)}s linear`;
        /* 生成弹幕元素 */
        let barrager = $("<div class='j-barrager'></div>");
        /* 设置弹幕里的头像和内容 */
        barrager.html(`
            <img src="${avatar}">
            <p>${content}</p>
        `);
        /* 设置弹幕的样式 */
        barrager.css({
            top: randomTop,
            transform: translateX,
            transition: transition
        });
        /* 将弹幕加入到页面中 */
        $('body').append(barrager);
        /* 50毫秒后，将弹幕加平移动画 */
        let timer = setTimeout(function () {
            barrager.css({ transform: 'translateX(-100%)' });
            clearTimeout(timer);
        }, 30);
        /* 监听动画结束事件，结束后重新加入平移动画 */
        barrager.on('transitionend', function () {
            barrager.css({
                transform: translateX,
                transition: ''
            });
            let timer = setTimeout(function () {
                barrager.css({
                    transform: 'translateX(-100%)',
                    transition: transition
                });
                clearTimeout(timer);
            }, 50);
        });
    });
})(jQuery);
