(function () {
    if ($('#jFloor').length === 0) return false;
    let toc = document.querySelector('#jFloor');
    let tocPath = document.querySelector('#jFloor path');
    let tocItems;
    let TOP_MARGIN = 0,
        BOTTOM_MARGIN = 0;
    let pathLength;
    window.addEventListener('resize', drawPath, false);
    window.addEventListener('scroll', sync, false);
    drawPath();
    function drawPath() {
        tocItems = [].slice.call(toc.querySelectorAll('li'));
        tocItems = tocItems.map(function (item) {
            let anchor = item.querySelector('a');
            let target = document.getElementById(anchor.getAttribute('data-href').slice(1));
            return {
                listItem: item,
                anchor: anchor,
                target: target
            };
        });
        tocItems = tocItems.filter(function (item) {
            return !!item.target;
        });
        let path = [];
        let pathIndent;
        tocItems.forEach(function (item, i) {
            let x = item.anchor.offsetLeft - 5,
                y = item.anchor.offsetTop,
                height = item.anchor.offsetHeight;
            if (i === 0) {
                path.push('M', x, y, 'L', x, y + height);
                item.pathStart = 0;
            } else {
                if (pathIndent !== x) path.push('L', pathIndent, y);
                path.push('L', x, y);
                tocPath.setAttribute('d', path.join(' '));
                item.pathStart = tocPath.getTotalLength() || 0;
                path.push('L', x, y + height);
            }
            pathIndent = x;
            tocPath.setAttribute('d', path.join(' '));
            item.pathEnd = tocPath.getTotalLength();
        });
        pathLength = tocPath.getTotalLength();
        /* 如果有问题就将下面删除 */
        sync();
    }
    function sync() {
        let windowHeight = window.innerHeight;
        let pathStart = pathLength,
            pathEnd = 0;
        let visibleItems = 0;
        tocItems.forEach(function (item) {
            let targetBounds = item.target.getBoundingClientRect();
            if (targetBounds.bottom > windowHeight * TOP_MARGIN && targetBounds.top < windowHeight * (1 - BOTTOM_MARGIN)) {
                pathStart = Math.min(item.pathStart, pathStart);
                pathEnd = Math.max(item.pathEnd, pathEnd);
                visibleItems += 1;
                item.listItem.classList.add('visible');
            } else {
                item.listItem.classList.remove('visible');
            }
        });
        if (visibleItems > 0 && pathStart < pathEnd) {
            tocPath.setAttribute('stroke-dashoffset', '1');
            tocPath.setAttribute('stroke-dasharray', '1, ' + pathStart + ', ' + (pathEnd - pathStart) + ', ' + pathLength);
            tocPath.setAttribute('opacity', 1);
        } else {
            tocPath.setAttribute('opacity', 0);
        }
    }
})();
