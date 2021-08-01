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

use Swoft\WebSocket\Server\Annotation\Mapping\WsController;
use Swoft\WebSocket\Server\Annotation\Mapping\MessageMapping;

/**
 * Class HeartController - This is an controller for handle websocket message request
 *
 * @WsController("heart")
 */
class HeartController{

    /**
     * 心跳操作
     * @MessageMapping("index")
     * @return array
     */
    public function index(): array
    {
        return ['item0', 'item1'];
    }
}
