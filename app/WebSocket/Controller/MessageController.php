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
 * Class MessageController - This is an controller for handle websocket message request
 *
 * @WsController("message")
 */
class MessageController{
    /**
     * this is a example websocket message request handle method.
     * @MessageMapping("index")
     * @return array
     */
    public function index(): array
    {
        return ['item0', 'item1'];
    }
}
