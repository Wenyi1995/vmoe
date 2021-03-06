<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://swoft.org/docs
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\WebSocket;

use App\Service\RedisService;
use App\Service\WebSocketToolService;
use App\WebSocket\Controller\MessageController;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\WebSocket\Server\Annotation\Mapping\WsModule;
use Swoft\WebSocket\Server\Annotation\Mapping\OnOpen;
use Swoft\WebSocket\Server\Annotation\Mapping\OnClose;
use Swoft\WebSocket\Server\Annotation\Mapping\OnHandshake;
use Swoft\WebSocket\Server\MessageParser\JsonParser;
use Swoole\WebSocket\Server;

/**
 * Class IndexModule - This is an module for handle websocket
 *
 * @WsModule(
 *     path="/index",
 *     messageParser=JsonParser::class,
 *     controllers={MessageController::class,}
 *  )
 */
class IndexModule
{

    /**
     * 在这里你可以验证握手的请求信息
     * - 必须返回含有两个元素的array
     *  - 第一个元素的值来决定是否进行握手
     *  - 第二个元素是response对象
     * - 可以在response设置一些自定义header,body等信息
     *
     * @OnHandshake()
     * @param Request $request
     * @param Response $response
     * @return array
     */
    public function checkHandshake(Request $request, Response $response): array
    {
        $token = $request->get('token');
        if (!empty($token)) {
            $redis = RedisService::instance()->getConnect(2);
            $userInfo = $redis->get('userLogin::' . $token);
            if (!empty($userInfo)) {
                if ($redis->ttl('userLogin::' . $token) <= (int)(86000 / 2)) {
                    $redis->expire('userLogin::' . $token, 86000);
                }
                $redis->hSet('Fd2User', (string)$request->getFd(), $userInfo);
                $redis->hSet('User2Fd', $userInfo, (string)$request->getFd());
                return [true, $response];
            }
        }
        return [false, $response];
    }

    /**
     * @OnOpen()
     * @param Server $server
     * @param Request $request
     * @param int $fd
     * @return mixed
     */
    public function onOpen(Server $server, Request $request, int $fd)
    {
        // $server->push($fd, 'hello, welcome! :)');
    }

    /**
     * @OnClose()
     * @param Server $server
     * @param int $fd
     * @return mixed
     */
    public function onClose(Server $server, int $fd)
    {
        WebSocketToolService::instance()->socketClose($fd);
    }
}
