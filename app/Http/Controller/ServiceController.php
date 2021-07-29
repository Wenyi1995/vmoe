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
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
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
     * 新增
     * @RequestMapping("", method=RequestMethod::POST)
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
     * 修改
     * @RequestMapping(route="{id}", method="put")
     * @Validate(validator="ServiceValidator")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editService(Request $request, int $id): Response
    {
        $serviceInfo = Service::whereKey($id)->where('soft_delete', 0)->first(['uid']);
        if ($serviceInfo) {
            if ($serviceInfo['uid'] == context()->get('userId')) {
                $serviceInfo->fill($request->getParsedBody())->save();
                return context()->getResponse()->withContent('success');
            } else {
                return context()->getResponse()->withStatus(403)->withContent('无权操作');
            }
        } else {
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

    /**
     * 删除
     * @RequestMapping(route="{id}", method="delete")
     * @Validate(validator="ServiceValidator")
     * @param int $id
     * @return Response
     */
    public function delService(int $id): Response
    {
        $serviceInfo = Service::whereKey($id)->where('soft_delete', 0)->first(['uid']);
        if ($serviceInfo) {
            if ($serviceInfo['uid'] == context()->get('userId')) {
                $serviceInfo->setSoftDelete(1)->save();
                return context()->getResponse()->withContent('success');
            } else {
                return context()->getResponse()->withStatus(403)->withContent('无权操作');
            }
        } else {
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }


    /**
     * 获取列表
     * @RequestMapping(route="list/p/{page}/s/{size}", method="get")
     * @param int $page
     * @param int $size
     * @return Response
     */
    public function getList(int $page = 1, int $size = 10): Response
    {
        $list = Service::where('soft_delete', 0)
            ->paginate($page, $size,
                ['id', 'uid', 'title', 'service_type', 'type', 'start_time', 'end_time', 'low_price', 'high_price']);
        return context()->getResponse()->withData($list);
    }


    /**
     * 获取详情
     * @RequestMapping(route="{id}", method="get")
     * @param int $id
     * @return Response
     */
    public function serviceDetail(int $id): Response
    {
        $serviceInfo = Service::whereKey($id)->where('soft_delete', 0)->first();
        if ($serviceInfo) {
            return context()->getResponse()->withData($serviceInfo);
        } else {
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

}
