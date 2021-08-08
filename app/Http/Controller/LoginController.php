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

use App\Model\Entity\User;
use App\Model\Entity\UserLogin;
use App\Service\RedisService;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\Http\Message\Request;
use function context;

/**
 * 登录注册
 * @Controller()
 */
class LoginController
{
    /**
     * @RequestMapping("/login", method="post")
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        $account = $request->post('account');
        $password = $request->post('pwd');
        $uInfo = UserLogin::where(['account' => $account])
            ->first(['account', 'salt', 'password', 'user_id']);
        if ($uInfo) {
            $password = md5($password . $uInfo['salt']);
            if ($password == $uInfo['password']) {
                $token = $this->loginSuccess($uInfo['user_id'], $uInfo['salt']);
                return context()->getResponse()->withData(['token' => $token, 'uid' => $uInfo['user_id']]);
            }
            return context()->getResponse()->withStatus(400)->withContent('密码错误');
        }
        return context()->getResponse()->withStatus(400)->withContent('用户不存在');
    }

    /**
     * @RequestMapping("/register",method="post")
     * @Validate(validator="RegisterValidator")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $account = $request->post('account');
        $password = $request->post('pwd');
        $salt = $this->getSalt(4);
        $uid = User::insertGetId(['account' => $account, 'status' => 1, 'soft_delete' => 0]);
        UserLogin::insert([
            'account' => $account,
            'salt' => $salt,
            'user_id' => $uid,
            'password' => md5($password . $salt)
        ]);
        $token = $this->loginSuccess($uid, $salt);
        return context()->getResponse()->withData(['token' => $token, 'uid' => $uid]);
    }

    private function getSalt($length)
    {
        $str = md5((string)time());
        return substr($str, rand(0, 32 - $length), $length);
    }

    /**
     * 登录成功操作
     * @param $uid
     * @param $salt
     * @return string
     */
    private function loginSuccess($uid, $salt)
    {
        $token = md5($uid . $salt . (string)time());
        $redis = RedisService::instance()->getConnect(2);
        $redis->set('userLogin::' . $token, $uid);
        $redis->expire('userLogin::' . $token, 86000);
        return $token;
    }
}
