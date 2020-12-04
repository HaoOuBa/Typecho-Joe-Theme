const caceheList = ['jquery']
const notCacheList = ['/admin/']
self.addEventListener('install', function (event) {
	event.waitUntil(self.skipWaiting())
})
var version = '0.0.0'
var versionTag = '5f34ff7562517'
var CACHE_NAME = version + versionTag
self.addEventListener('activate', function (event) {
	var mainCache = [CACHE_NAME]
	event.waitUntil(
		caches.keys().then(function (cacheNames) {
			return Promise.all(
				cacheNames.map(function (cacheName) {
					if (mainCache.indexOf(cacheName) === -1) {
						console.info('version changed, clean the cache, SW: deleting ' + cacheName)
						return caches.delete(cacheName)
					}
				})
			)
		})
	)
	return self.clients.claim()
})
function isExitInCacheList(list, url) {
	return list.some(function (value) {
		return url.indexOf(value) !== -1
	})
}
self.addEventListener('fetch', function (event) {
	// console.log('Handling fetch event for', event.request.url);
	if (event.request.method !== 'GET') {
		return false
	} else {
		if (isExitInCacheList(caceheList, event.request.url) && !isExitInCacheList(notCacheList, event.request.url)) {
			// 只捕获需要加入cache的请求
			// 劫持 HTTP Request
			event.respondWith(
				// 檢查快取中是否有可用的資源
				caches.match(event.request).then(function (response) {
					if (response) {
						// 使用 Service Worker 回應
						// console.log("【cache】use the cache " + event.request.url)
						return response
					} else {
						return fetch(event.request)
							.then(function (response) {
								return caches.open(CACHE_NAME).then(function (cache) {
									// 加入cache中)
									// console.log("【yes】 put in the cache" + event.request.url);
									cache.put(event.request, response.clone())
									return response
								})
							})
							.catch(function (error) {
								// console.error('Fetching request url ,' +event.request.url+' failed:', error);
								// throw error;
							})
					}
				})
			)
		} else {
			return false
		}
	}
})