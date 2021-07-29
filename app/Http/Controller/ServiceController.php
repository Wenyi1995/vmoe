<?php declare(strict_types=1);

namespace App\Http\Controller;

use App\Model\Entity\Service;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use App\Http\Middleware\LoginCheckMiddleware;
use Swoft\Http\Message\Request;
use Swoft\Validator\Annotation\Mapping\Validate;
use function context;

/**
 * 服务需求类
 * @Controller("/service/")
 * @Middleware(LoginCheckMiddleware::class)
 */
class ServiceController
{

    /**
     * @RequestMapping("service", method="post")
     * @Validate(validator="ServiceValidator")
     * @param Request $request
     * @return Response
     */
    public function addService(Request $request): Response
    {
        $data = $request->getParsedBody();
        Service::insert($data);
        return context()->getResponse()->withContent('success');
    }

}
