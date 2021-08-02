<?php declare(strict_types=1);

namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use App\Http\Middleware\LoginCheckMiddleware;
// use Swoft\Http\Message\Response;

/**
 * Class UserController
 *
 * @Controller(prefix="/user")
 * @Middleware(LoginCheckMiddleware::class)
 * @package App\Http\Controller
 */
class UserController
{

    /**
     * 获取用户详情
     * @RequestMapping(route="{id}", method=RequestMethod::GET)
     * @param int $id
     * @return array
     */
    public function info(int $id): array
    {
        return ['item0'];
    }

    /**
     * 修改用户信息
     * 主要是修改手机号
     * @RequestMapping(route="{id}", method=RequestMethod::PUT)
     * @param int $id
     * @return string
     */
    public function edit(int $id): string
    {
        return 'success';
    }
}
