<?php declare(strict_types=1);

namespace App\Http\Middleware;

use App\Service\RedisService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Contract\MiddlewareInterface;
use function context;

/**
 * Class LoginCheckMiddleware
 * 登录检查
 * @Bean()
 */
class LoginCheckMiddleware implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface|Request $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine("USER-TOKEN");
        if (!empty($token)) {
            $redis = (new RedisService())->getConnect(2);
            $userInfo = $redis->get('userLogin::' . $token);
            if (!empty($userInfo)) {
                if($redis->ttl('userLogin::' . $token) <= (int)(86000/2)) {
                    (new RedisService())->getConnect(2)->expire('userLogin::' . $token, 86000);
                }
                return $handler->handle($request);
            }
        }
        return context()->getResponse()->withStatus(401)->withContent('没有登录');
    }
}
