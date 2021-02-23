;(() => {
	class Joe {
		constructor(options) {
			options = {
				reloadTime: options.reloadTime || 1500
			}
			this.options = options
			this.video_page = 0
			this.video_canLoad = true

			this.wallpaper_page = 0
			this.wallpaper_cid = ''

			this.init()
		}

		init() {
			/* 解决移动端 hover 问题*/
			$(document).on('touchstart', e => {})
			/* 初始化昼夜模式 */
			this.init_day_light()
			/* 初始化页面的hash值跳转 */
			this.init_url_hash()
			/* 初始化标题 */
			this.init_document_title()
			/* 初始化弹幕 */
			this.init_document_barrager()
			/* 初始化进度条 */
			this.init_document_progress()
			/* 初始化live2d */
			this.init_document_live2d()
			/* 鼠标右键 */
			this.init_document_contextmenu()
			/* 初始化主题色 */
			this.init_document_theme()
			/* 初始化鼠标移入音效 */
			this.init_hover_music()
			/* 初始化返回顶部 */
			this.init_back_top()
			/* 初始化统计 */
			this.init_document_census()
			/* 初始化代码高亮 */
			this.init_high_light()
			/* 初始化代码防偷 */
			this.init_document_console()
			/* 初始化天气 */
			this.init_document_weather()
			/* 初始化3d云标签 */
			this.init_3d_tag()
			/* 初始化加载更多 */
			this.init_load_more()
			/* 初始化轮播图 */
			this.init_document_swiper()
			/* 初始化解析 */
			this.init_document_analysis()
			/* 初始化owo标签 */
			this.init_owo()
			/* 初始化回复可见按钮 */
			this.init_replay_see()
			/* 初始化画板功能 */
			this.init_draw()
			/* 初始化赞赏按钮 */
			this.init_admire()
			/* 初始化点赞按钮 */
			this.init_thumbs_up()
			/* 初始化文章生成二维码 */
			this.init_share_code()
			/* 初始化复制按钮 */
			this.init_copy()
			/* 初始化朗读功能 */
			this.init_synth()
			/* 初始化typecho评论 */
			this.init_typecho_comment()
			/* 初始化文章内容 */
			this.init_markdown()
			/* 初始化百度收录 */
			this.init_baidu_collect()
			/* 初始化打字机效果 */
			this.init_typing()
			/* 初始化侧边栏人生倒计时 */
			this.init_life_time()
			/* 初始化侧边栏评论 */
			this.init_aside_reply()
			/* 初始化归档下拉 */
			this.init_file_toggle()
			/* 初始化目录树点击事件 */
			this.init_floor_click()
			/* 初始化下拉框按钮 */
			this.init_drop_down()
			/* 初始化手风琴 */
			this.init_panel_down()
			/* 初始化侧边栏相关 */
			this.init_aside_config()
			/* 初始化登录注册验证 */
			this.init_sign_verify()
			/* 初始化分页的hash值 */
			this.init_pagination_hash()
			/* 初始化回复列表内容 */
			this.init_replay_content()
			/* 初始化评论 */
			this.init_comment()
			/* 初始化留言板 */
			this.init_leaving()
			/* 初始化移动端搜索按钮点击事件 */
			this.init_wap_search_click()
			/* 初始化搜索框验证 */
			this.init_search_verify()
			/* 初始化密码访问验证 */
			this.init_protect_verify()
			/* 初始化微语发布 */
			this.init_dynamic_verify()
			/* 初始化评论提交 */
			this.init_comment_submit()
			/* 初始化移动端搜索标签云 */
			this.init_wap_cloud()
			/* 初始化移动端搜索按钮点击事件 */
			this.init_wap_search()
			/* 初始化移动端侧边栏点击事件 */
			this.init_wap_sidebar()
			/* 初始化动画 */
			this.init_wow()

			/* 初始化视频分类列表 */
			this.init_video_list_type()
			/* 初始化视频列表 */
			this.init_video_list()
			/* 初始化视频搜索 */
			this.init_video_search()
			/* 初始化滚动加载更多视频 */
			this.init_load_more_video()
			/* 初始化加载详情 */
			this.init_video_detail()
			/* 初始化tabs */
			this.init_j_tabs()
			/* 初始化collapse */
			this.init_j_collapse()
			/* 初始化侧边栏一言 */
			this.init_aside_motto()
			/* 初始化评论点赞 */
			this.init_comment_like()
			/* 初始化动态回复 */
			this.init_dynamic_reply()
			/* 初始化视频册 */
			this.init_video_album()
			/* 初始化壁纸页 */
			this.init_wallpaper()
			/* 初始化虎牙页 */
			this.init_huya_type()
			/* 初始化虎牙跳转 */
			this.init_huya_skip()
			/* 初始化虎牙分页 */
			this.init_huya_pagination()
			/* 初始化图片懒加载 */
			this.init_lazy_load()
		}
		/* 初始化昼夜 */
		init_day_light() {
			$('#j-day-night').on('click', function () {
				$(this).toggleClass('dark')
				if ($(this).hasClass('dark')) {
					$('html').attr('dark', true)
					localStorage.setItem('dark', 1)
				} else {
					$('html').removeAttr('dark')
					localStorage.removeItem('dark')
				}
				handleMode()
			})
		}

		/* 格式化url参数 */
		changeURLArg(url, arg, arg_val) {
			var pattern = arg + '=([^&]*)'
			var replaceText = arg + '=' + arg_val
			if (url.match(pattern)) {
				var tmp = '/(' + arg + '=)([^&]*)/gi'
				tmp = url.replace(eval(tmp), replaceText)
				return tmp
			} else {
				if (url.match('[?]')) {
					return url + '&' + replaceText
				} else {
					return url + '?' + replaceText
				}
			}
			return url + '\n' + arg + '\n' + arg_val
		}

		/* 初始化页面的hash值跳转 */
		init_url_hash() {
			let p = new URLSearchParams(location.search)
			if (p.get('jscroll') && $('#' + p.get('jscroll')).length > 0) {
				let timer = setTimeout(() => {
					window.scroll({
						top: $('#' + p.get('jscroll')).offset().top - ($('.j-header').height() + 20),
						behavior: 'smooth'
					})
					clearTimeout(timer)
				}, 300)
			}
		}

		/* 初始化网站切换标题 */
		init_document_title() {
			if (window.JOE_CONFIG.DOCUMENT_TITLE === '' || window.JOE_CONFIG.IS_MOBILE === 'on') return
			const DOCUMENT_TITLE = document.title
			$(document).on('visibilitychange', function () {
				if (document.visibilityState === 'hidden') {
					document.title = window.JOE_CONFIG.DOCUMENT_TITLE
				} else {
					document.title = DOCUMENT_TITLE
				}
			})
		}

		/* 初始化弹幕 */
		init_document_barrager() {
			if (window.JOE_CONFIG.DOCUMENT_BARRAGER === 'off') return
			if (localStorage.getItem('barragerStatus') === 'on') {
				$('#barrager').attr('checked', true)
				$('.j-barrager').css({
					opacity: 1,
					visibility: 'visible'
				})
			} else {
				$('#barrager').attr('checked', false)
				$('.j-barrager').css({
					opacity: 0,
					visibility: 'hidden'
				})
			}
			$('#barrager').on('change', function () {
				localStorage.setItem('barragerStatus', $(this).prop('checked') ? 'on' : 'off')
				if ($('#barrager').prop('checked')) {
					$('.j-barrager').css({
						opacity: 1,
						visibility: 'visible'
					})
				} else {
					$('.j-barrager').css({
						opacity: 0,
						visibility: 'hidden'
					})
				}
			})
		}

		/* 初始化进度条 */
		init_document_progress() {
			if (window.JOE_CONFIG.DOCUMENT_PROGRESS === 'off') return
			let calcProgress = () => {
				let scrollTop = $(window).scrollTop()
				let documentHeight = $(document).height()
				let windowHeight = $(window).height()
				let progress = parseInt((scrollTop / (documentHeight - windowHeight)) * 100)
				if (progress < 0) progress = 0
				if (progress > 100) progress = 100
				$('#progress').css('width', progress + '%')
			}
			calcProgress()
			$(window).on('scroll', () => calcProgress())
		}

		/* 初始化live2d */
		init_document_live2d() {
			if (window.JOE_CONFIG.DOCUMENT_LIVE2D === 'off' || window.JOE_CONFIG.IS_MOBILE === 'on') return
			L2Dwidget.init({
				model: {
					jsonPath: window.JOE_CONFIG.DOCUMENT_LIVE2D,
					scale: 1
				},
				mobile: {
					show: false
				},
				display: {
					position: 'right',
					width: 160,
					height: 200,
					hOffset: 70,
					vOffset: 0
				}
			})
		}

		/* 鼠标右键 */
		init_document_contextmenu() {
			if (window.JOE_CONFIG.DOCUMENT_CONTEXTMENU === 'off' || window.JOE_CONFIG.IS_MOBILE === 'on') return
			$(document).on('contextmenu', () => false)
		}

		/* 初始化主题色 */
		init_document_theme() {
			if (window.JOE_CONFIG.DOCUMENT_THEME_STATUS === 'on') {
				if (!window.JOE_CONFIG.DOCUMENT_GLOBAL_THEME) {
					$('body').css('--theme', localStorage.getItem('--theme') || '#4e7cf2')
				} else {
					$('body').css('--theme', localStorage.getItem('--theme') || window.JOE_CONFIG.DOCUMENT_GLOBAL_THEME)
				}
				let color = null
				if (localStorage.getItem('--theme')) {
					color = localStorage.getItem('--theme')
				} else {
					if (!window.JOE_CONFIG.DOCUMENT_GLOBAL_THEME) {
						color = '#4e7cf2'
					} else {
						color = window.JOE_CONFIG.DOCUMENT_GLOBAL_THEME
					}
				}
				$('#colorPick').colpick({
					flat: true,
					layout: 'hex',
					submit: false,
					color,
					colorScheme: 'dark',
					onChange(a, b, c) {
						$('body').css('--theme', '#' + b)
						localStorage.setItem('--theme', '#' + b)
					}
				})
				$('#openColorPick').on('click', function (e) {
					e.stopPropagation()
					$('#colorPick').toggleClass('active')
				})
				$('#colorPick').on('click', function (e) {
					e.stopPropagation()
				})
				$(document).on('click', function (e) {
					$('#colorPick').removeClass('active')
				})
			} else {
				if (window.JOE_CONFIG.DOCUMENT_GLOBAL_THEME === '') {
					$('body').css('--theme', '#4e7cf2')
				} else {
					$('body').css('--theme', window.JOE_CONFIG.DOCUMENT_GLOBAL_THEME)
				}
			}
		}

		/* 初始化鼠标移入音效 */
		init_hover_music() {
			if (window.JOE_CONFIG.DOCUMENT_HOVER_MUSIC === 'off' || window.JOE_CONFIG.IS_MOBILE === 'on') return
			let random = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min
			$('.j-hover-music').on('mouseover', function () {
				$('#j-hover-music').attr('src', window.JOE_CONFIG.THEME_URL + '/assets/audio/' + random(1, 8) + '.ogv')
			})
		}

		/* 初始化返回顶部 */
		init_back_top() {
			if (window.JOE_CONFIG.DOCUMENT_BACK_TOP === 'off') return
			let isShowBackTop = () => {
				if ($(window).scrollTop() > 500) {
					$('#backToTop').addClass('active')
				} else {
					$('#backToTop').removeClass('active')
				}
			}
			isShowBackTop()
			$(window).on('scroll', () => isShowBackTop())
			$('#backToTop').on('click', () => {
				window.scroll({
					top: 0,
					behavior: 'smooth'
				})
			})
		}

		/* 初始化统计 */
		init_document_census() {
			if (window.JOE_CONFIG.DOCUMENT_CENSUS.status === 'off') return
			Highcharts.chart('census', {
				title: {
					text: null
				},
				subtitle: {
					text: null
				},
				xAxis: {
					text: null,
					categories: ['页面', '文章', '评论', '分类']
				},
				yAxis: {
					title: {
						text: null
					}
				},
				credits: {
					enabled: false
				},
				series: [
					{
						name: '数量',
						type: 'column',
						colorByPoint: true,
						data: window.JOE_CONFIG.DOCUMENT_CENSUS.data,
						showInLegend: false
					}
				]
			})
		}

		/* 初始化代码高亮 */
		init_high_light() {
			if (window.JOE_CONFIG.DOCUMENT_HIGHT_LIGHT === 'off') return
			hljs.initHighlighting()
		}

		/* 初始化代码防偷 */
		init_document_console() {
			if (window.JOE_CONFIG.DOCUMENT_CONSOLE == 'off') return
			function endebug(off, code) {
				if (!off) {
					!(function (e) {
						function n(e) {
							function n() {
								return u
							}
							function o() {
								window.Firebug && window.Firebug.chrome && window.Firebug.chrome.isInitialized ? t('on') : ((a = 'off'), console.log(d), console.clear(), t(a))
							}
							function t(e) {
								u !== e && ((u = e), 'function' == typeof c.onchange && c.onchange(e))
							}
							function r() {
								l || ((l = !0), window.removeEventListener('resize', o), clearInterval(f))
							}
							'function' == typeof e &&
								(e = {
									onchange: e
								})
							var i = (e = e || {}).delay || 500,
								c = {}
							c.onchange = e.onchange
							var a,
								d = new Image()
							d.__defineGetter__('id', function () {
								a = 'on'
							})
							var u = 'unknown'
							c.getStatus = n
							var f = setInterval(o, i)
							window.addEventListener('resize', o)
							var l
							return (c.free = r), c
						}
						var o = o || {}
						;(o.create = n),
							'function' == typeof define
								? (define.amd || define.cmd) &&
								  define(function () {
										return o
								  })
								: 'undefined' != typeof module && module.exports
								? (module.exports = o)
								: (window.jdetects = o)
					})(),
						jdetects.create(function (e) {
							var a = 0
							var n = setInterval(function () {
								if ('on' == e) {
									setTimeout(function () {
										if (a == 0) {
											a = 1
											setTimeout(code)
										}
									}, 200)
								}
							}, 100)
						})
				}
			}
			endebug(false, function () {
				window.location.href = window.JOE_CONFIG.THEME_URL + '/console.html'
			})
		}

		/* 初始化天气 */
		init_document_weather() {
			if (window.JOE_CONFIG.DOCUMENT_WEATHER_KEY === '') return
			window.WIDGET = {
				CONFIG: {
					layout: 2,
					width: '220',
					height: '270',
					background: window.JOE_CONFIG.DOCUMENT_WEATHER_TYPE === 'auto' ? 1 : 2,
					dataColor: window.JOE_CONFIG.DOCUMENT_WEATHER_TYPE === 'auto' ? 'ffffff' : '303133',
					key: window.JOE_CONFIG.DOCUMENT_WEATHER_KEY
				}
			}
			let timer = setTimeout(() => {
				$('.aside-wether .loading').addClass('active')
				clearTimeout(timer)
			}, 1000)
		}

		/* 初始化3d云标签 */
		init_3d_tag() {
			if (window.JOE_CONFIG.DOCUMENT_3D_TAG === 'off') return
			let cloudList = []
			$('#cloudList li').each(function (i, item) {
				cloudList.push({
					label: $(item).attr('data-label'),
					url: $(item).attr('data-url'),
					target: '_blank'
				})
			})
			$('#cloud').svg3DTagCloud({
				entries: cloudList,
				width: 220,
				height: 230,
				radius: '65%',
				radiusMin: 75,
				bgDraw: !0,
				bgColor: '#000',
				opacityOver: 1,
				opacityOut: 0.05,
				opacitySpeed: 6,
				fov: 800,
				speed: 0.5,
				fontSize: 13,
				fontColor: '#fff',
				fontWeight: '500',
				fontStyle: 'normal',
				fontStretch: 'normal',
				fontToUpperCase: !0
			})
		}

		/* 初始化加载更多 */
		init_load_more() {
			if (window.JOE_CONFIG.DOCUMENT_LOAD_MORE !== 'ajax') return
			let _this = this
			$('.j-loadmore a').attr('data-href', $('.j-loadmore a').attr('href'))
			$('.j-loadmore a').removeAttr('href')
			$('.j-loadmore a').on('click', function () {
				if ($(this).attr('disabled')) return
				$(this).html('loading...')
				$(this).attr('disabled', true)
				let url = $(this).attr('data-href')
				if (!url) return
				$.ajax({
					url: url,
					type: 'get',
					success: data => {
						$(this).removeAttr('disabled')
						$(this).html('查看更多')
						let list = $(data).find('.article-list:not(.sticky)')
						$('.j-index-article.article').append(list)
						window.scroll({
							top: $(list).first().offset().top - ($('.j-header').height() + 20),
							behavior: 'smooth'
						})
						let newURL = $(data).find('.j-loadmore a').attr('href')
						if (newURL) {
							$(this).attr('data-href', newURL)
						} else {
							$('.j-loadmore').remove()
						}
						_this.init_lazy_load()
					}
				})
			})
		}

		/* 初始化轮播图 */
		init_document_swiper() {
			if (window.JOE_CONFIG.DOCUMENT_SWIPER === 'off' || !Swiper) return
			let direction = $('#recommend').length > 0 ? 'vertical' : 'horizontal'
			new Swiper('.swiper-container', {
				direction: direction,
				slidesPerView: 1,
				spaceBetween: 20,
				mousewheel: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true
				}
			})
		}

		/* 初始化解析 */
		init_document_analysis() {
			if ($('#j-video').length === 0) return
			$('#j-dplayer').attr('src', $('#j-dplayer').attr('data-src') + $('#j-video .episodes ul li').first().attr('data-url'))
			$('#j-video .episodes ul li').first().addClass('active')
			$('#j-video .player-box .title span').html('正在播放：' + $('#j-video .episodes ul li span').first().html())
			$('#j-video .episodes ul li').on('click', function () {
				$('#j-video .episodes ul li').removeClass('active')
				$(this).addClass('active')
				$('#j-dplayer').attr('src', $('#j-dplayer').attr('data-src') + $(this).attr('data-url'))
				$('#j-video .player-box .title span').html('正在播放：' + $(this).find('span').html())
			})
		}

		/* 初始化owo标签 */
		init_owo() {
			if ($('#OwO_Container').length === 0) return
			new OwO({
				logo: 'OωO表情',
				container: document.getElementsByClassName('OwO')[0],
				target: document.getElementsByClassName('OwO-textarea')[0],
				api: '/usr/themes/Typecho-Joe-Theme/OwO.json',
				position: 'down',
				width: '100%',
				maxHeight: '250px'
			})
			$(document).on('click', function () {
				$('.OwO').removeClass('OwO-open')
			})
		}

		/* 初始化回复可见按钮 */
		init_replay_see() {
			$('.need-reply span').on('click', function () {
				let id = $(this).attr('data-href')
				window.scrollTo({
					top: $('#' + id).offset().top - ($('.j-header').height() + 20),
					behavior: 'smooth'
				})
			})
		}

		/* 初始化画板功能 */
		init_draw() {
			if ($('#draw').length === 0) return
			window.sketchpad = new Sketchpad({
				element: '#draw',
				height: 300,
				penSize: 5,
				color: '303133'
			})
			$('#commentTypeContent .undo').on('click', function () {
				window.sketchpad.undo()
			})
			$('#commentTypeContent .animate').on('click', function () {
				window.sketchpad.animate(10)
			})
			$('#commentTypeContent .canvas ul li').on('click', function () {
				window.sketchpad.penSize = $(this).attr('data-line')
				$('#commentTypeContent .canvas ul li').removeClass('active')
				$(this).addClass('active')
			})
			$('#commentTypeContent .canvas ol li').on('click', function () {
				window.sketchpad.color = $(this).attr('data-color')
				$('#commentTypeContent .canvas ol li').removeClass('active')
				$(this).addClass('active')
			})
		}

		/* 初始化赞赏按钮 */
		init_admire() {
			$('#j-admire').on('click', function () {
				$('.j-admire-modal').addClass('active')
				$('body').css('overflow', 'hidden')
			})
			$('.j-admire-modal .close').on('click', function () {
				$('.j-admire-modal').removeClass('active')
				$('body').css('overflow', '')
			})
		}

		/* 初始化点赞按钮 */
		init_thumbs_up() {
			$('#j-thumbs-up').on('click', function () {
				if ($(this).attr('disabled')) {
					return $.toast({
						type: 'warning',
						message: '本篇文章您已经赞过~'
					})
				}
				$(this).find('span').html('loading...')
				$.ajax({
					type: 'post',
					url: $(this).attr('data-url'),
					data: 'agree=' + $(this).attr('data-cid'),
					timeout: 30000,
					cache: false,
					success: function (data) {
						let reg = /\d/
						if (reg.test(data)) $('#j-thumbs-up span').html('赞 · ' + data.trim())
						$.toast({
							type: 'success',
							message: '感谢您的点赞！'
						})
						$('#j-thumbs-up').attr('disabled', 'disabled')
					}
				})
			})
		}

		/* 初始化文章生成二维码 */
		init_share_code() {
			if ($('#j-share-code').length === 0) return
			$('#j-share-code').qrcode({
				render: 'canvas',
				width: 90,
				height: 90,
				text: encodeURI(window.location.href),
				background: '#ffffff',
				foreground: '#000000',
				correctLevel: 0
			})
		}

		/* 初始化复制按钮 */
		init_copy() {
			$('.j-copy').on('click', function (e) {
				e.preventDefault()
				$('body').append(`<input id="copyInput" value="${$(this).attr('data-copy')}"/>`)
				$('#copyInput').select()
				document.execCommand('copy')
				$.toast({
					type: 'success',
					message: '已复制到剪切板中~'
				})
				$('#copyInput').remove()
			})
		}

		/* 初始化朗读功能 */
		init_synth() {
			if (!window.speechSynthesis) return $('#read').remove()
			$('#read').on('click', function () {
				const synth = window.speechSynthesis
				const msg = new SpeechSynthesisUtterance()
				if ($(this).find('span').html() === '朗读') {
					msg.lang = 'zh-CN'
					msg.text = $('#markdown').text()
					synth.speak(msg)
					$(this).find('span').html('停止朗读')
				} else {
					synth.cancel(msg)
					$(this).find('span').html('朗读')
				}
			})
		}

		/* 初始化typecho评论 */
		init_typecho_comment() {
			window.TypechoComment = {
				dom: function (id) {
					return document.getElementById(id)
				},
				create: function (tag, attr) {
					var el = document.createElement(tag)
					for (var key in attr) {
						el.setAttribute(key, attr[key])
					}
					return el
				},
				reply: function (cid, coid) {
					var comment = this.dom(cid),
						parent = comment.parentNode,
						response = this.dom($('.j-comment').attr('data-respondid')),
						input = this.dom('comment-parent'),
						form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
						textarea = response.getElementsByTagName('textarea')[0]
					if (null == input) {
						input = this.create('input', {
							type: 'hidden',
							name: 'parent',
							id: 'comment-parent'
						})
						form.appendChild(input)
					}
					input.setAttribute('value', coid)
					if (null == this.dom('comment-form-place-holder')) {
						var holder = this.create('div', {
							id: 'comment-form-place-holder'
						})
						response.parentNode.insertBefore(holder, response)
					}
					if ($(comment).find(response).length === 0) {
						comment.appendChild(response)
					}
					this.dom('cancel-comment-reply-link').style.display = ''
					if (null != textarea && 'text' == textarea.name) {
						window.scroll({
							top: $('#li-' + cid).offset().top - ($('.j-header').height() + 20),
							behavior: 'smooth'
						})
					}
					return false
				},
				cancelReply: function () {
					var response = this.dom($('.j-comment').attr('data-respondid')),
						holder = this.dom('comment-form-place-holder'),
						input = this.dom('comment-parent')
					if (null != input) {
						input.parentNode.removeChild(input)
					}
					if (null == holder) {
						return true
					}
					this.dom('cancel-comment-reply-link').style.display = 'none'
					holder.parentNode.insertBefore(response, holder)
					window.scroll({
						top: $('#comments').offset().top - ($('.j-header').height() + 20),
						behavior: 'smooth'
					})
					return false
				}
			}
		}

		/* 初始化文章内的链接为新窗口打开 */
		init_markdown() {
			/* 设置a标签为新窗口打开 */
			$('#markdown a:not(a[no-target])').attr({
				target: '_blank'
			})

			/* 增加预览功能 */
			$('#markdown img:not(img.owo)').each(function () {
				let element = document.createElement('a')
				$(element).attr('data-fancybox', 'gallery')
				$(element).attr('href', $(this).attr('data-original') || $(this).attr('src'))
				$(this).wrap(element)
			})

			$('code.hljs').parent().addClass('hljs-pre')
			$('code.hljs').each(function () {
				$(this).html('<ol><li>' + $(this).html().replace(/\n/g, '\n</li><li>') + '\n</li></ol>')
			})
		}

		/* 初始化百度收录 */
		init_baidu_collect() {
			$.ajax({
				url: window.JOE_CONFIG.THEME_URL + '/baiduRecord.php?url=' + encodeURI(window.location.href),
				method: 'get',
				success(res) {
					if (!res.success) {
						$('#baiduIncluded').html('查询失败')
						$('#baiduIncluded').css('color', '#f56c6c')
					} else if (res.data.baidu === '未收录') {
						if (window.JOE_CONFIG.DOCUMENT_BAIDU_TOKEN === '') {
							$('#baiduIncluded').html(`<a target="_blank" href="https://ziyuan.baidu.com/linksubmit/url?sitename=${encodeURI(window.location.href)}">未收录，去提交</a>`)
						} else {
							$('#baiduIncluded').html('<span>未收录，点击推送</span>')
						}
					} else {
						$('#baiduIncluded').html('百度已收录')
						$('#baiduIncluded').css('color', '#3bca72')
					}
				}
			})
			$(document).on('click', '#baiduIncluded span', function () {
				$.ajax({
					url: window.JOE_CONFIG.THEME_URL + '/baiduPush.php?urls=' + encodeURI(window.location.href),
					method: 'get',
					dataType: 'json',
					data: {
						token: window.JOE_CONFIG.DOCUMENT_BAIDU_TOKEN,
						domain: window.location.hostname
					},
					success: res => {
						let obj = {
							'site error': '站点未验证！',
							'empty content': '内容为空！',
							'only 2000 urls are allowed once': '超过限制！',
							'over quota': '今日提交已上限'
						}
						if (res.success) {
							$('#baiduIncluded').css('color', '#3bca72')
							$('#baiduIncluded').html('推送成功！')
						} else {
							$('#baiduIncluded').css('color', '#e6a23c')
							if (res.error === 401) {
								$('#baiduIncluded').html('Token错误！')
							} else if (res.error === 400) {
								$('#baiduIncluded').html(obj[res.message] || '未知错误')
							} else if (res.error === 404) {
								$('#baiduIncluded').html('地址错误！')
							} else {
								$('#baiduIncluded').html('服务异常！')
							}
						}
					}
				})
			})
		}

		/* 初始化打字机效果 */
		init_typing() {
			$('.j-typing').each(function (index, item) {
				$(item).show()
				$(item).css('opacity', 1)
				let htmlStr = $(item).html()
				let timer = null
				let i = 0
				let typing = () => {
					if (i <= htmlStr.length) {
						$(item).html(htmlStr.slice(0, i++) + '_')
						timer = setTimeout(typing, 100)
					} else {
						$(item).html(htmlStr)
						clearTimeout(timer)
					}
				}
				typing()
			})
		}

		/* 初始化侧边栏人生倒计时 */
		init_life_time() {
			function getAsideLifeTime() {
				/* 当前时间戳 */
				let nowDate = +new Date()
				/* 今天开始时间戳 */
				let todayStartDate = new Date(new Date().toLocaleDateString()).getTime()
				/* 今天已经过去的时间 */
				let todayPassHours = (nowDate - todayStartDate) / 1000 / 60 / 60
				/* 今天已经过去的时间比 */
				let todayPassHoursPercent = (todayPassHours / 24) * 100
				$('#dayProgress .title span').html(parseInt(todayPassHours))
				$('#dayProgress .progress .progress-inner').css('width', parseInt(todayPassHoursPercent) + '%')
				$('#dayProgress .progress .progress-percentage').html(parseInt(todayPassHoursPercent) + '%')
				/* 当前周几 */
				let weeks = {
					0: 7,
					1: 1,
					2: 2,
					3: 3,
					4: 4,
					5: 5,
					6: 6
				}
				let weekDay = weeks[new Date().getDay()]
				let weekDayPassPercent = (weekDay / 7) * 100
				$('#weekProgress .title span').html(weekDay)
				$('#weekProgress .progress .progress-inner').css('width', parseInt(weekDayPassPercent) + '%')
				$('#weekProgress .progress .progress-percentage').html(parseInt(weekDayPassPercent) + '%')
				let year = new Date().getFullYear()
				let date = new Date().getDate()
				let month = new Date().getMonth() + 1
				let monthAll = new Date(year, month, 0).getDate()
				let monthPassPercent = (date / monthAll) * 100
				$('#monthProgress .title span').html(date)
				$('#monthProgress .progress .progress-inner').css('width', parseInt(monthPassPercent) + '%')
				$('#monthProgress .progress .progress-percentage').html(parseInt(monthPassPercent) + '%')
				let yearPass = (month / 12) * 100
				$('#yearProgress .title span').html(month)
				$('#yearProgress .progress .progress-inner').css('width', parseInt(yearPass) + '%')
				$('#yearProgress .progress .progress-percentage').html(parseInt(yearPass) + '%')
			}
			getAsideLifeTime()
			setInterval(() => {
				getAsideLifeTime()
			}, 1000)
		}

		/* 初始化侧边栏评论 */
		init_aside_reply() {
			$('#asideReply a').each(function (i, item) {
				let str = $(item).html()
				if (/\{!\{.*/.test(str)) {
					$(item).html('# 图片回复')
				} else {
					$(item).html(str)
				}
				$(item).css('display', '-webkit-box')
				if (!$(item).attr('href').includes('#')) return
				$(item).attr('href', $(item).attr('href').replace('#', '?jscroll='))
			})
		}

		/* 初始化归档下拉 */
		init_file_toggle() {
			$('.j-file .panel').first().next().slideToggle(0)
			$('.j-file .panel').on('click', function () {
				let next = $(this).next()
				next.slideToggle(200)
				$('.j-file .panel-body').not(next).slideUp()
			})
		}

		/* 初始化目录树点击事件 */
		init_floor_click() {
			if (window.JOE_CONFIG.IS_MOBILE === 'on') return
			$('.j-floor a').on('click', function (e) {
				e.preventDefault()
				window.scroll({
					top: $($(this).attr('data-href')).offset().top - ($('.j-header').height() + 20),
					behavior: 'smooth'
				})
			})
		}

		/* 初始化下拉框按钮 */
		init_drop_down() {
			$('.j-drop').on('click', function (e) {
				e.stopPropagation()
				if ($(this).siblings('.j-dropdown').hasClass('active')) {
					$(this).siblings('.j-dropdown').removeClass('active')
				} else {
					$('.j-dropdown').removeClass('active')
					$(this).siblings('.j-dropdown').addClass('active')
				}
			})
			$(document).on('click', e => $('.j-dropdown').removeClass('active'))
			$('.j-dropdown[stop-propagation]').on('click', function (e) {
				e.stopPropagation()
			})
		}

		/* 初始化手风琴 */
		init_panel_down() {
			$('.j-panel').on('click', function () {
				let next = $(this).next()
				$(this).next().stop().slideToggle()
				$('.j-panel-down').not(next).slideUp()
			})
		}

		/* 初始化侧边栏相关 */
		init_aside_config() {
			let asideWidth = $('.j-aside').width()
			if (asideWidth > 0) {
				$('.j-stretch').addClass('active')
				$('.j-aside').css('width', asideWidth)
			}
			$('.j-aside .aside')
				.last()
				.css('top', $('.j-header').height() + 20)
			$('.j-floor .contain').css('top', $('.j-header').height() + 20)
			$('.j-stretch .contain').css('top', $('.j-header').height() + 20)
			$('.j-stretch .contain').on('click', function () {
				/* 设置侧边栏宽度 */
				if ($('.j-aside').width() === 0) {
					$('.j-aside').css('width', asideWidth)
					$('.j-aside').css('overflow', '')
				} else {
					$('.j-aside').css('width', 0)
					$('.j-aside').css('overflow', 'hidden')
				}
				$("#commentType button[data-type='text']").click()
			})
		}

		/* 初始化登录注册验证 */
		init_sign_verify() {
			$('#loginForm').on('submit', function (e) {
				if ($('#loginForm .username').val().trim() === '') {
					e.preventDefault()
					return $.toast({
						type: 'warning',
						message: '请输入用户名！'
					})
				}
				if ($('#loginForm .password').val().trim() === '') {
					e.preventDefault()
					return $.toast({
						type: 'warning',
						message: '请输入密码！'
					})
				}
			})
			$('#registerForm').on('submit', function (e) {
				if ($('#registerForm .username').val().trim() === '') {
					e.preventDefault()
					return $.toast({
						type: 'warning',
						message: '请输入用户名！'
					})
				}
				if ($('#registerForm .mail').val().trim() === '') {
					e.preventDefault()
					return $.toast({
						type: 'warning',
						message: '请输入邮箱！'
					})
				}
				if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test($('#registerForm .mail').val())) {
					e.preventDefault()
					return $.toast({
						type: 'warning',
						message: '请输入正确的邮箱！'
					})
				}
			})
		}

		/* 初始化分页的hash值 */
		init_pagination_hash() {
			$('.j-pagination a').each((i, item) => {
				if (!$(item).attr('href')) return
				if (!$(item).attr('href').includes('#')) return
				$(item).attr('href', $(item).attr('href').replace('#', '?jscroll='))
			})
		}

		/* 初始化回复列表内容 */
		init_replay_content() {
			$('.replyContent p').each(function (i, item) {
				let str = $(item).html()
				if (!/\{!\{.*\}!\}/.test(str)) return
				str = str.replace(/{!{/, '').replace(/}!}/, '')
				$(item).html('<img class="canvas" src="' + str + '" />')
			})
			$('.replyContent').show()
		}

		/* 初始化评论 */
		init_comment() {
			$('#commentType button').on('click', function () {
				$('#commentType button').removeClass('active')
				$(this).addClass('active')
				if ($(this).attr('data-type') === 'canvas') {
					$('#draw').prop('width', $('#commentTypeContent').width())
					$('#commentTypeContent textarea').hide()
					$('#commentTypeContent .canvas').show()
					$('#commentTypeContent .canvas').attr('data-type', 'canvas')
				} else {
					$('#commentTypeContent textarea').show()
					$('#commentTypeContent .canvas').hide()
					$('#commentTypeContent .canvas').attr('data-type', 'text')
				}
			})
			$('.comment-list .meta a').on('click', function () {
				$('#draw').prop('width', $('#commentTypeContent').width())
			})
			$('#cancel-comment-reply-link').on('click', function () {
				$('#draw').prop('width', $('#commentTypeContent').width())
			})
		}

		/* 初始化留言板 */
		init_leaving() {
			let zIndex = 100
			function random(min, max) {
				return Math.floor(Math.random() * (max - min + 1)) + min
			}
			$('#j-leaving li').each(function (i, item) {
				$(item)
					.find('.body .content p')
					.each(function (_i, _item) {
						let str = $(_item).html()
						if (!/\{!\{.*\}!\}/.test(str)) return
						str = str.replace(/{!{/, '').replace(/}!}/, '')
						$(_item).html('<img class="canvas" src="' + str + '" />')
					})
				$(item).css({
					'z-index': random(1, 99),
					'background-color': `rgba(${random(0, 255)}, ${random(0, 255)}, ${random(0, 255)}, ${random(0.8, 1)})`,
					top: parseInt(Math.random() * ($('#j-leaving').height() - $(item).height()), 10),
					left: parseInt(Math.random() * ($('#j-leaving').width() - $(item).width()), 10),
					display: 'flex'
				})
				$(item).draggabilly({ containment: true })
				$(item).on('dragStart', function (e) {
					zIndex++
					$(item).css('z-index', zIndex)
				})
			})
		}

		/* 初始化移动端搜索按钮点击事件 */
		init_wap_search_click() {
			$('.j-search-toggle').on('click', function () {
				$(this).toggleClass('active')
				if ($(this).hasClass('active')) {
					$('.j-nav').hide()
					$('.j-search').css('display', 'flex')
				} else {
					$('.j-nav').css('display', 'flex')
					$('.j-search').hide()
				}
			})
		}

		/* 初始化搜索框验证 */
		init_search_verify() {
			$('.j-search').on('submit', function (e) {
				if ($('.j-search input').val().trim() === '') {
					e.preventDefault()
					return $.toast({
						type: 'warning',
						message: '请输入搜索内容！'
					})
				}
			})
		}

		/* 初始化密码访问验证 */
		init_protect_verify() {
			let _this = this
			$('#j-protected').on('submit', e => {
				e.preventDefault()
				if ($('#j-protected').find('.pass').val() === '') {
					return $.toast({
						type: 'info',
						message: '请输入访问密码！'
					})
				}
				let url = $('#j-protected').attr('action')
				$.ajax({
					url: url,
					method: 'post',
					datatype: 'text',
					data: {
						protectPassword: $('#j-protected').find('.pass').val(),
						cid: $('#j-protected').find('.cid').val()
					},
					success: res => {
						let arr = [],
							str = ''
						arr = $(res).contents()
						Array.from(arr).forEach(_ => {
							if (_.parentNode.className === 'container') str = _
						})
						if (!/TypechoJoeTheme/.test(res)) {
							$.toast({
								type: 'warning',
								message: str.textContent || ''
							})
						} else {
							let url = location.href
							url = _this.changeURLArg(url, 'jscroll', 'comments')
							$.toast({
								type: 'success',
								message: '密码正确，即将刷新本页！'
							})
							setTimeout(function () {
								window.location.href = url
							}, _this.options.reloadTime)
						}
					}
				})
			})
		}

		/* 初始化微语发布 */
		init_dynamic_verify() {
			let _this = this
			$('#j-dynamic-form').on('submit', function (e) {
				e.preventDefault()
				if ($('#j-dynamic-form-text').val().trim() === '') {
					return $.toast({
						type: 'info',
						message: '请输入发表内容！'
					})
				}
				if ($(this).attr('data-disabled')) return
				$(this).attr('data-disabled', true)
				$.ajax({
					url: $(this).attr('action'),
					type: 'post',
					data: $(this).serializeArray(),
					success: res => {
						let arr = [],
							str = ''
						arr = $(res).contents()
						Array.from(arr).forEach(_ => {
							if (_.parentNode.className === 'container') str = _
						})
						if (!/TypechoJoeTheme/.test(res)) {
							$.toast({
								type: 'warning',
								message: str.textContent || ''
							})
							$(this).removeAttr('data-disabled')
						} else {
							let url = location.href
							url = _this.changeURLArg(url, 'jscroll', 'comments')
							$.toast({
								type: 'success',
								message: '发表成功，即将刷新本页！'
							})
							setTimeout(function () {
								window.location.href = url
							}, _this.options.reloadTime)
						}
					}
				})
			})
		}

		/* 初始化评论提交 */
		init_comment_submit() {
			let _this = this
			$('#comment-form').on('submit', function (e) {
				e.preventDefault()
				if ($('#comment-nick').val().trim() === '') {
					return $.toast({
						type: 'warning',
						message: '请输入您的昵称！'
					})
				}
				if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test($('#comment-mail').val())) {
					return $.toast({
						type: 'warning',
						message: '请输入正确的邮箱！'
					})
				}
				if ($('#commentTypeContent .canvas').attr('data-type') === 'canvas') {
					let url = $('#draw')[0].toDataURL('image/webp', 0.1)
					$('#comment-content').val('{!{' + url + '}!} ')
				}
				if ($('#comment-content').val().trim() === '') {
					return $.toast({
						type: 'warning',
						message: '请输入评论内容！'
					})
				}
				if ($(this).attr('data-disabled')) return
				$(this).attr('data-disabled', true)
				$(this).find("button[type='submit']").html('请等待...')
				$.ajax({
					url: $(this).attr('action'),
					type: 'post',
					data: $(this).serializeArray(),
					success: res => {
						let arr = [],
							str = ''
						arr = $(res).contents()
						Array.from(arr).forEach(_ => {
							if (_.parentNode.className === 'container') str = _
						})
						if (!/TypechoJoeTheme/.test(res)) {
							$.toast({
								type: 'warning',
								message: str.textContent || ''
							})
							$(this).removeAttr('data-disabled')
							$(this).find("button[type='submit']").html('发表评论')
						} else {
							let url = location.href
							url = _this.changeURLArg(url, 'jscroll', 'comments')
							$.toast({
								type: 'success',
								message: '发送成功，即将刷新本页！'
							})
							setTimeout(function () {
								window.location.href = url
							}, _this.options.reloadTime)
						}
					}
				})
			})
		}

		/* 初始化移动端搜索标签云 */
		init_wap_cloud() {
			let random = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min
			$('#search-cloud a').each((i, item) => {
				$(item).css('background', `rgba(${random(0, 255)}, ${random(0, 255)}, ${random(0, 255)}, ${random(0.8, 1)})`)
			})
		}

		/* 初始化移动端搜索点击事件 */
		init_wap_search() {
			$('.search-toggle-xs').on('click', function () {
				$('.j-slide').removeClass('active')
				$('.j-sidebar-xs').removeClass('active')
				$('.j-search-down-xs').toggleClass('active')
				if ($('.j-search-down-xs').hasClass('active')) {
					$('body').css('overflow', 'hidden')
					$('.j-header').css('box-shadow', 'none')
				} else {
					$('body').css('overflow', '')
					$('.j-header').css('box-shadow', '')
				}
			})
			$('.j-search-down-xs .mask').on('click', function () {
				$('.j-search-down-xs').removeClass('active')
				$('body').css('overflow', '')
				$('.j-header').css('box-shadow', '')
			})
		}

		/* 初始化移动端侧边栏点击事件 */
		init_wap_sidebar() {
			$('.j-slide').on('click', function (e) {
				$('.j-search-down-xs').removeClass('active')
				$('body').css('overflow', '')
				$('.j-header').css('box-shadow', '')
				$(this).toggleClass('active')
				$('.j-sidebar-xs').toggleClass('active')
				if ($(this).hasClass('active')) {
					$('body').css('overflow', 'hidden')
				} else {
					$('body').css('overflow', '')
				}
			})
			$('.j-sidebar-xs .mask').on('click', function () {
				$('.j-slide').removeClass('active')
				$('.j-sidebar-xs').removeClass('active')
				$('body').css('overflow', '')
			})
		}

		/* 初始化动画 */
		init_wow() {
			if (window.JOE_CONFIG.IS_MOBILE === 'on' && window.JOE_CONFIG.DOCUMENT_WAP_ANIMATION === 'off') return
			if (window.JOE_CONFIG.IS_MOBILE === 'off' && window.JOE_CONFIG.DOCUMENT_PC_ANIMATION === 'off') return
			var wow = new WOW({
				boxClass: 'wow',
				animateClass: 'animated',
				offset: 0,
				mobile: true,
				live: true,
				scrollContainer: null
			})
			wow.init()
		}

		/* 初始化视频分类列表 */
		init_video_list_type() {
			if ($('#j-video-type').length === 0) return
			if (window.JOE_CONFIG.VIDEO_LIST_API === '')
				return $.toast({
					type: 'warning',
					message: '苹果CMS API未填写！'
				})
			$('.j-video-load-1').show()
			$.ajax({
				url: window.JOE_CONFIG.VIDEO_LIST_API,
				method: 'get',
				data: {
					ac: 'list',
					at: 'json'
				},
				dataType: 'json',
				success: res => {
					if (res.code !== 1)
						return $.toast({
							type: 'warning',
							message: '获取列表失败！'
						})
					$('.j-video-load-1').hide()
					let htmlStr = '<li class="active">全部</li>'
					let arr = window.JOE_CONFIG.VIDEO_LIST_SHIELD.split('||')
					let shieldArr = arr.map(_ => _.trim())
					res.class.forEach(_ => {
						if (!shieldArr.some(item => item === _.type_name)) htmlStr += `<li data-id="${_.type_id}">${_.type_name}</li>`
					})
					$('#j-video-type').html(htmlStr)
				}
			})
			let _this = this
			$(document).on('click', '#j-video-type li', function () {
				$(this).addClass('active').siblings().removeClass('active')
				_this.video_page = 0
				$('#j-video-list').html('')
				_this.init_video_list($(this).attr('data-id'))
			})
		}

		/* 加载视频列表 */
		init_video_list(t, wd) {
			if ($('#j-video-list').length === 0) return
			let _this = this
			if (!_this.video_canLoad) return
			_this.video_canLoad = false
			_this.video_page += 1
			$('.j-video-load-2').show()
			$.ajax({
				url: window.JOE_CONFIG.VIDEO_LIST_API,
				method: 'get',
				data: {
					pg: _this.video_page,
					ac: 'videolist',
					at: 'json',
					t,
					wd
				},
				dataType: 'json',
				success: res => {
					if (res.code !== 1) return
					$('.j-video-load-2').hide()
					res.list.forEach(_ => {
						$('#j-video-list').append(`
                                <li>
                                    <a href="${window.location.href + '?vod_id=' + _.vod_id}">
                                        <img class="lazyload" src="${window.JOE_CONFIG.DOCUMENT_LAZY_LOAD}" data-original="${_.vod_pic}">
                                        <h2>${_.vod_name}</h2>
                                        ${_.vod_year && _.vod_year != 0 ? '<i>' + _.vod_year + '</i>' : ''}
                                    </a>
                                </li>
                            `)
					})
					_this.init_lazy_load()
					_this.video_canLoad = true
				}
			})
		}

		/* 初始化视频搜索 */
		init_video_search() {
			let _this = this
			$('#j-video-search button').on('click', function () {
				if ($('#j-video-search input').val().trim() === '') {
					return $.toast({
						type: 'info',
						message: '请输入内容！'
					})
				}
				_this.video_page = 0
				$('#j-video-list').html('')
				_this.init_video_list(null, $('#j-video-search input').val())
			})
		}

		/* 初始化加载更多视频 */
		init_load_more_video() {
			if ($('#j-video-list').length === 0) return
			let _this = this
			$(window).on('scroll', function () {
				let scrollTop = $(window).scrollTop()
				let windowHeight = $(window).height()
				let videoListHeight = $('#j-video-list').offset().top + $('#j-video-list').height()
				if (scrollTop + windowHeight >= videoListHeight) {
					_this.init_video_list()
				}
			})
		}

		/* 初始化视频详情 */
		init_video_detail() {
			let p = new URLSearchParams(window.location.search)
			let ids = p.get('vod_id')
			if (!ids) return
			$('.j-video-load-3').show()
			$.ajax({
				url: window.JOE_CONFIG.VIDEO_LIST_API,
				method: 'get',
				data: {
					ac: 'detail',
					at: 'json',
					ids
				},
				dataType: 'json',
				success: res => {
					if (res.code !== 1 || res.list.length !== 1)
						return $.toast({
							type: 'warning',
							message: '数据获取失败！'
						})
					$('.j-video-load-3').hide()
					let item = res.list[0]
					/* 详情 */
					$('#j-video-info').html(`
						<div class="image">
							<img class="lazyload" src="${window.JOE_CONFIG.DOCUMENT_LAZY_LOAD}" alt="${item.vod_name}" data-original="${item.vod_pic}" title="${item.vod_name}">
							${item.vod_year && item.vod_year !== 0 ? '<i>' + item.vod_year + '</i>' : ''}
						</div>
						<dl>
							<dt>${item.vod_name + (item.vod_remarks ? ' - ' + item.vod_remarks : '')}</dt>
							<dd>
								<span>类型：</span>
								<span>${item.vod_class || '未知'}</span>
							</dd>
							<dd>
								<span>主演：</span>
								<span>${item.vod_actor || '未知'}</span>
							</dd>
							<dd>
								<span>导演：</span>
								<span>${item.vod_director || '未知'}</span>
							</dd>
							<dd>
								<span>简介：</span>
								<span>${item.vod_content ? item.vod_content : item.vod_blurb}</span>
							</dd>
						</dl>
					`)
					this.init_lazy_load()

					/* 播放源 */
					let playFromArr = item.vod_play_from.split('$$$')
					let playUrlArr = item.vod_play_url.split('$$$')
					let maps = new Map()
					playFromArr.forEach((item, index) => {
						maps.set(item, playUrlArr[index] || [])
					})
					function parseObj(str) {
						let arr = str.split('$')
						return {
							name: arr[0] || '',
							link: arr[1] || ''
						}
					}
					for (var [key, value] of maps) {
						let arr = value.split('#')
						let str = ''
						arr.forEach(item => {
							str += `
								<li data-link="${parseObj(item).link}">${parseObj(item).name}</li>
							`
						})
						$('#j-video-play').append(`
							<div class="video-list-play">
								<div class="title">源：${key}</div>
								<ul class="list-item">
									${str}
								</ul>
							</div>
						`)
					}
					/* 如果没填写解析，则直接中断 */
					if (!$('#j-video-player iframe').attr('data-src') || $('#j-video-player iframe').attr('data-src') === '') return
					/* 点击切换播放源 */
					$('.video-list-play .list-item li').on('click', function () {
						$('.video-list-play .list-item li').removeClass('active')
						$(this).addClass('active')
						$('#j-video-player iframe').attr('src', $('#j-video-player iframe').attr('data-src') + $(this).attr('data-link'))
						sessionStorage.setItem('playUrl', $(this).attr('data-link'))
					})
					/* 判断是否至少有一项 */
					let firstLi = $('#j-video-play .video-list-play:first-child .list-item li:first-child')
					if (firstLi.length === 0) return
					/* 刷新页面 */
					if (sessionStorage.getItem('playUrl')) {
						let flag = null
						$('.video-list-play .list-item li').each((i, item) => {
							if ($(item).attr('data-link') === sessionStorage.getItem('playUrl')) {
								$(item).addClass('active')
								flag = true
							}
						})
						if (flag === true) {
							$('#j-video-player iframe').attr('src', $('#j-video-player iframe').attr('data-src') + sessionStorage.getItem('playUrl'))
						} else {
							$('#j-video-player iframe').attr('src', $('#j-video-player iframe').attr('data-src') + firstLi.attr('data-link'))
							firstLi.addClass('active')
						}
					} else {
						$('#j-video-player iframe').attr('src', $('#j-video-player iframe').attr('data-src') + firstLi.attr('data-link'))
						firstLi.addClass('active')
					}
					$('#j-video-player-title').html('正在播放：' + item.vod_name)
				}
			})
		}

		/* 初始化tabs */
		init_j_tabs() {
			$('.j-tabs .nav span').on('click', function () {
				let panel = $(this).attr('data-panel')
				$(this).addClass('active').siblings().removeClass('active')
				$(this).parents('.j-tabs').find('.content div').hide()
				$(this)
					.parents('.j-tabs')
					.find('.content div[data-panel=' + panel + ']')
					.show()
			})
		}

		/* 初始化collapse */
		init_j_collapse() {
			$('.j-collapse .collapse-head').on('click', function () {
				let next = $(this).next()
				next.slideToggle(200)
				$('.j-collapse .collapse-body').not(next).slideUp()
			})
		}

		/* 初始化侧边栏一言 */
		init_aside_motto() {
			if (window.JOE_CONFIG.DOCUMENT_ASIDE_MOTTO === 'on') {
				$('.j-aside-motto').show()
			} else {
				$.ajax({
					url: window.JOE_CONFIG.DOCUMENT_MOTTO_API,
					method: 'get',
					dataType: 'text',
					success: res => {
						$('.j-aside-motto').html(res)
						$('.j-aside-motto').show()
					},
					error: err => {
						$('.j-aside-motto').html('人生之路，难免坎坷，但我执着')
						$('.j-aside-motto').show()
					}
				})
			}
		}

		/* 初始化评论点赞 */
		init_comment_like() {
			$('.j-comment-like').on('click', function () {
				if ($(this).hasClass('active'))
					return $.toast({
						type: 'warning',
						message: '本条评论您已经赞过~'
					})
				$.ajax({
					url: window.location.href,
					type: 'post',
					data: 'likeup=' + $(this).attr('data-coid'),
					timeout: 30000,
					cache: false,
					success: res => {
						let reg = /\d/
						if (reg.test(res)) $(this).find('span').html(res.trim())
						$.toast({
							type: 'success',
							message: '点赞成功！'
						})
						$(this).addClass('active')
					}
				})
			})
		}

		/* 初始化动态页面回复 */
		init_dynamic_reply() {
			let _this = this

			/* 页面点击关闭所有回复 */
			$(document).on('click', () => $('.j-dynamic-reply').hide())

			/* 点击评论按钮显示隐藏评论区域 */
			$('.j-comment-reply').on('click', function (e) {
				e.stopPropagation()
				$(this).parents('li').find('.j-dynamic-reply').toggle()
			})

			/* 阻止事件传播 */
			$('.j-dynamic-reply').on('click', e => e.stopPropagation())

			$('.j-dynamic-reply').on('submit', function (e) {
				e.preventDefault()
				if ($(this).find("input[name='author']").val().trim() === '') {
					return $.toast({
						type: 'warning',
						message: '请输入您的昵称！'
					})
				}
				if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test($(this).find("input[name='mail']").val())) {
					return $.toast({
						type: 'warning',
						message: '请输入正确的邮箱！'
					})
				}
				if ($(this).find("textarea[name='text']").val().trim() === '') {
					return $.toast({
						type: 'warning',
						message: '请输入回复内容！'
					})
				}
				if ($(this).attr('data-disabled')) return
				$(this).attr('data-disabled', true)
				$.ajax({
					url: $('.j-comment-url').val(),
					type: 'post',
					data: $(this).serializeArray(),
					success: res => {
						let arr = [],
							str = ''
						arr = $(res).contents()
						Array.from(arr).forEach(_ => {
							if (_.parentNode.className === 'container') str = _
						})
						if (!/TypechoJoeTheme/.test(res)) {
							$.toast({
								type: 'warning',
								message: str.textContent || ''
							})
							$(this).removeAttr('data-disabled')
						} else {
							let url = location.href
							url = _this.changeURLArg(url, 'jscroll', 'comments')
							$.toast({
								type: 'success',
								message: '发送成功，即将刷新本页！'
							})
							setTimeout(function () {
								window.location.href = url
							}, _this.options.reloadTime)
						}
					}
				})
			})
		}

		/* 初始化视频册 */
		init_video_album() {
			function GetVideoPoster(url, frame = 1, scale = 1, definition = 0.5) {
				let video = document.createElement('VIDEO')
				video.setAttribute('src', url)
				video.crossOrigin = '*'
				video.currentTime = frame
				return new Promise((resolve, reject) => {
					video.addEventListener('loadeddata', () => {
						let canvas = document.createElement('canvas')
						canvas.width = video.videoWidth * scale
						canvas.height = video.videoHeight * scale
						canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height)
						resolve(canvas.toDataURL('image/webp', definition))
					})
				})
			}
			$('.j-short-video .inner').each((i, item) => {
				let poster = $(item).attr('data-poster')
				let src = $(item).attr('data-src')
				/* 如果传入字符串图片，则直接显示字符串图片 */
				if (isNaN(poster)) {
					$(item).css('background-image', 'url(' + poster + ')')
				} else {
					/* 否则抓取视频帧 */
					GetVideoPoster(src, poster).then(res => {
						$(item).css('background-image', 'url(' + res + ')')
					})
				}
				$(item).on('click', function () {
					$('body').css('overflow', 'hidden')
					$('.j-video-preview').addClass('active')
					$('.j-video-preview iframe').attr('src', window.JOE_CONFIG.THEME_URL + '/player.php?url=' + src)
				})
			})
			$('.j-video-preview .close').on('click', function () {
				$('body').css('overflow', '')
				$('.j-video-preview').removeClass('active')
			})
		}

		/* 初始化壁纸分类 */
		init_wallpaper() {
			if ($('#wallpaper-type').length === 0) return
			$.ajax({
				url: window.JOE_CONFIG.THEME_URL + '/wallpaperApi.php?cid=360tags',
				method: 'get',
				dataType: 'json',
				success: res => {
					if (res.errno !== '0')
						return $.toast({
							type: 'warning',
							message: '接口异常，请联系开发者！'
						})
					$('.j-wallpaper-load-1').hide()
					let str = '<li data-cid="360new" class="active">最新壁纸</li>'
					res.data.forEach(_ => {
						str += `<li data-cid="${_.id}">${_.name}</li>`
					})
					$('#wallpaper-type').html(str)
					$('#wallpaper-type li').first().click()
				}
			})
			let _this = this
			$(document).on('click', '#wallpaper-type li', function () {
				$(this).addClass('active').siblings().removeClass('active')
				_this.wallpaper_page = 0
				_this.wallpaper_cid = $(this).attr('data-cid')
				$('#wallpaper-list').html('')
				_this.init_wallpaper_list()
			})
			$('#wallpaper-load').on('click', function () {
				_this.wallpaper_page += 1
				_this.init_wallpaper_list()
			})
		}

		init_wallpaper_list() {
			let _this = this
			$('.j-wallpaper-load-2').show()
			$.ajax({
				url: window.JOE_CONFIG.THEME_URL + '/wallpaperApi.php',
				data: {
					cid: _this.wallpaper_cid,
					start: _this.wallpaper_page * 20,
					count: 20
				},
				method: 'get',
				dataType: 'json',
				success: res => {
					$('.j-wallpaper-load-2').hide()
					if (res.total != 0) {
						res.data.forEach(_ => {
							$('#wallpaper-list').append(`
                                <a class="item" data-fancybox="gallery" href="${_.url}">
                                    <img class="lazyload" src="${window.JOE_CONFIG.DOCUMENT_LAZY_LOAD}" data-original="${_.img_1024_768}" />
                                </a>
                            `)
						})
						_this.init_lazy_load()
					} else {
						$('#wallpaper-load').remove()
					}
				}
			})
		}

		/* 初始化虎牙页 */
		init_huya_type() {
			if ($('.huya-list-type').length === 0) return
			let _this = this
			$('.huya-list-type .list ul li').on('click', function () {
				window.location.href = _this.changeURLArg(window.location.href, 'vid', $(this).attr('data-vid'))
			})
		}

		/* 初始化虎牙跳转 */
		init_huya_skip() {
			if ($('.huya-list-go-play').length === 0) return
			let _this = this
			$('.huya-list-go-play').on('click', function () {
				let href = _this.changeURLArg(window.location.href, 'play', $(this).attr('data-href'))
				href = _this.changeURLArg(href, 'title', $(this).attr('data-title'))
				window.open(href)
			})
		}

		/* 初始化虎牙分页 */
		init_huya_pagination() {
			if ($('.huya-list-pagination').length === 0) return
			let _this = this
			$('.huya-list-pagination li').on('click', function () {
				let href = window.location.href
				href = _this.changeURLArg(href, 'pg', $(this).attr('data-pg'))
				window.location.href = href
			})
		}

		/* 初始化图片懒加载 */
		init_lazy_load() {
			new LazyLoad('.lazyload')
		}
	}
	if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
		module.exports = Joe
	} else {
		window.Joe = Joe
	}
})()

new Joe({})
