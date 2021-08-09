<?php declare(strict_types=1);

namespace App\Service;

use App\Common\Traits\StaticInstance;

/**
 * websocket通用服务
 * Class RedisService
 * @package App\Service
 */
class WebSocketToolService
{

    use StaticInstance;

    /**
     * 通用断开链接方法
     * @param int $fd
     * @return bool
     */
    public function socketClose(int $fd)
    {
        $redis = RedisService::instance()->getConnect(2);
        $uid = (string)$redis->hGet('Fd2User', (string)$fd);
        $redis->hDel('Fd2User', (string)$fd);
        $redis->hDel('User2Fd', $uid);
        return true;
    }
}
