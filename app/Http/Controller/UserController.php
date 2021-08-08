<?php declare(strict_types=1);

namespace App\Http\Controller;

use App\Model\Entity\User;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use App\Http\Middleware\LoginCheckMiddleware;
use Swoft\Http\Message\Request;

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
        return User::whereKey($id)->firstArray();
    }

    /**
     * 修改用户信息
     * 主要是修改手机号
     * @param Request $request
     * @param int $id
     * @return string
     */
    public function edit(Request $request,int $id): string
    {
        User::whereKey($id)->update(['phone'=>$request->input('phone')]);
        return 'success';
    }
}
