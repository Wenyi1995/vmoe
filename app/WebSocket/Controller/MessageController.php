<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://swoft.org/docs
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\WebSocket\Controller;

use App\Service\RedisService;
use App\Service\WebSocketToolService;
use Swoft\WebSocket\Server\Annotation\Mapping\WsController;
use Swoft\WebSocket\Server\Annotation\Mapping\MessageMapping;
use Swoft\WebSocket\Server\Message\Message;

/**
 * Class MessageController - This is an controller for handle websocket message request
 *
 * @WsController("message")
 */
class MessageController
{
    /**
     * @MessageMapping("index")
     * @param Message $msg
     * @return string[]
     */
    // inject Message object
    public function index(Message $msg): array
    {
        $content = $msg->getData();
        $toUid = $msg->getExt();
        $redis = RedisService::instance()->getConnect(2);
        $toFd = $redis->hGet('User2Fd', $toUid['uid']);
        if ($toFd) {
            $fd = context()->getRequest()->getFd();
            $fromUid = $redis->hGet('Fd2User', (string)$fd);
            WebSocketToolService::instance()->sender((int)$toFd, $content, ['fromUid' => $fromUid]);
            return ['status'=>'success'];
        } else {
            return ['status'=>'failed','msg'=>'用户不在线'];
        }
    }
}
