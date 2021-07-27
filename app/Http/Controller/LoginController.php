<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Http\Controller;

use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Throwable;
use function context;

/**
 * 登录注册
 * @Controller("/login/")
 */
class LoginController
{
    /**
     * @RequestMapping("login", method="get")
     * @throws Throwable
     */
    public function login(): Response
    {
        return context()->getResponse()->withContent('login');
    }

    /**
     * @RequestMapping("/register")
     *
     * @return Response
     */
    public function register(): Response
    {
        return context()->getResponse()->withContent('register');
    }

}
