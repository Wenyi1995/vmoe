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
        $token = $request->getHeader('USER-TOKEN');
        if (!empty($token)) {
            $redis = (new RedisService())->getConnect(2);
            $userInfo = $redis->get('userLogin_' . $token[0]);
            if (!empty($userInfo)) {
                return $handler->handle($request);
            }
        }
        return context()->getResponse()->withStatus(401)->withContent('没有登录');
    }
}