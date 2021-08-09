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

    /**
     * 获取发送消息封装
     * @param string $content
     * @param int $type
     * @return string
     */
    public function sendData(string $content, int $type = 0): string
    {
        $typeArray = ['message'];
        $method = 'message';
        if (isset($typeArray[$type])) {
            $method = $typeArray[$type];
        }

        return json_encode(['method' => $method, 'content' => $content]);
    }

    /**
     * 获取发送消息封装
     * @param int $fd
     * @param string $content
     * @return bool
     */
    public function sender(int $fd, string $content): bool
    {
        return server()->sendTo($fd, $this->sendData($content));
    }
}
