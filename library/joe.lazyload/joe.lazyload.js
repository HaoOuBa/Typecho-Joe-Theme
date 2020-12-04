class LazyLoad {
    constructor(el) {
        /* 获取图片列表 */
        this.imglist = Array.from($(el));
        /* 初始化组件 */
        this.init();
    }
    /* 调用加载 */
    canILoad() {
        let imglist = this.imglist;
        for (let i = imglist.length; i--; ) this.getBound(imglist[i]) && this.loadImage(imglist[i], i);
    }
    /* 判断是否在屏幕内 */
    getBound(el) {
        /* 获取元素的大小 */
        let bound = el.getBoundingClientRect();
        let clientHeight = window.innerHeight;
        return bound.top <= clientHeight;
    }
    /* 加载图片 */
    loadImage(el, index) {
        let src = el.getAttribute('data-original');
        el.src = src;
        this.imglist.splice(index, 1);
    }
    bindEvent() {
        /* 当页面发生滚动或尺寸大小发生变化时，执行 */
        $(window).on('scroll', () => this.imglist.length && this.canILoad());
        $(window).on('resize', () => this.imglist.length && this.canILoad());
    }
    /* 初始化 */
    init() {
        this.canILoad();
        this.bindEvent();
    }
}
