<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Middleware\LoginCheckMiddleware;
use App\Model\Entity\Service;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
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
     * @RequestMapping("", method="post")
     * @Validate(validator="ServiceValidator")
     * @param Request $request
     * @return Response
     */
    public function addService(Request $request): Response
    {
        $data = $request->getParsedBody();
        $data['uid'] = context()->get('userId');
        Service::insert($data);
        return context()->getResponse()->withContent('success');
    }

    /**
     * @RequestMapping(route="{id}", method="put")
     * @Validate(validator="ServiceValidator")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editService(Request $request, int $id): Response
    {

        $serviceInfo =  Service::whereKey($id)->where('soft_delete',0)->first();
        if($serviceInfo){
            if($serviceInfo['uid'] == context()->get('userId')) {
                $serviceInfo->fill($request->getParsedBody())->save();
                return context()->getResponse()->withContent('success');
            }else{
                return context()->getResponse()->withStatus(403)->withContent('无权操作');
            }
        }else{
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

    /**
     * @RequestMapping(route="{id}", method="delete")
     * @Validate(validator="ServiceValidator")
     * @param int $id
     * @return Response
     */
    public function delService( int $id): Response
    {
        $serviceInfo =  Service::whereKey($id)->where('soft_delete',0)->first();
        if($serviceInfo){
            if($serviceInfo['uid'] == context()->get('userId')) {
                $serviceInfo->setSoftDelete(1)->save();
                return context()->getResponse()->withContent('success');
            }else{
                return context()->getResponse()->withStatus(403)->withContent('无权操作');
            }
        }else{
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

}
