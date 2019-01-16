<?php
/**
 * Cache middleware
 * User: marhone
 * Date: 2019/1/8
 * Time: 12:44
 */

namespace App\Middlewares;


use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Tinyfork\Http\Request;
use Tinyfork\Http\Response;
use Tinyfork\Middleware\MiddlewareInterface;

class Cache implements MiddlewareInterface
{
    /**
     * @var CacheItemInterface
     */
    private $cache;

    /**
     * @var int
     */
    private $ttl;

    /**
     * Cache constructor.
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;

        $this->ttl = 300;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        $cacheKey = 'URL_' . sha1($request->getPathInfo() . '?' .$request->getQueryString());
        $cacheItem = $this->cache->getItem($cacheKey);

        if ($cacheItem->isHit()) {
            $response->setContent($cacheItem->get());

            // 返回上次缓存的内容, 中断中间件链的执行
            return $response;
        }

        // 继续执行中间件链以得到 response
        $response = $next($request, $response);

        // 保存 response 到缓存
        $cacheItem->set($response->getContent())
            ->expiresAfter($this->ttl);
        $this->cache->save($cacheItem);

        return $response;
    }
}