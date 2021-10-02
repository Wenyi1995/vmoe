<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Middleware\LoginCheckMiddleware;
use App\Model\Entity\Collect;
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
                $update = $request->getParsedBody();
                $update['id'] = $id;
                $serviceInfo->fill($update)->save();
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
     * @RequestMapping(route="{id}", method="DELETE")
     * @param int $id
     * @return Response
     */
    public function delService(int $id): Response
    {
        $serviceInfo = Service::whereKey($id)->where('soft_delete', 0)->first(['id', 'uid']);
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
     * @RequestMapping(route="list/{page}/{size}", method="get")
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
     * 获取我发布的列表
     * @RequestMapping(route="mylist/{page}/{size}", method="get")
     * @param int $page
     * @param int $size
     * @return Response
     */
    public function getMyList(int $page = 1, int $size = 10): Response
    {
        $list = Service::where(['soft_delete' => 0, 'uid' => context()->get('userId')])
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

    /**
     * 收藏服务
     * @RequestMapping(route="collect/{id}", method="post")
     * @param int $id
     * @return Response
     */
    public function addCollect(int $id): Response
    {
        $serviceInfo = Service::whereKey($id)->where('soft_delete', 0)->first(['id']);
        if ($serviceInfo) {
            Collect::insert([
                'service_id' => $id,
                'uid' => context()->get('userId')
            ]);
            return context()->getResponse()->withContent('success');
        } else {
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

    /**
     * 删除收藏
     * @RequestMapping(route="collect/{service_id}", method="DELETE")
     * @param int $service_id
     * @return Response
     */
    public function delCollect(int $service_id): Response
    {
        $uid = context()->get('userId');
        $where = ['service_id' => $service_id, 'uid' => $uid];
        $collectInfo = Collect::where($where)->first(['id', 'uid']);
        if ($collectInfo) {
            Collect::where($where)->delete();
            return context()->getResponse()->withContent('success');
        } else {
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

    /**
     * 获取收藏列表
     * @RequestMapping(route="collect/{page}/{size}", method="get")
     * @param int $page
     * @param int $size
     * @return Response
     */
    public function getCollect(int $page, int $size): Response
    {
        $list = Collect::where('collect.uid', context()->get('userId'))
            ->leftJoin('service', 'service_id', '=', 'service.id')
            ->paginate($page, $size, ['collect.*', 'service.title']);
        return context()->getResponse()->withData($list);
    }

    /**
     * 判断是否收藏
     * @RequestMapping(route="is_collect/{service_id}", method="get")
     * @param int $service_id
     * @return Response
     */
    public function getIsCollect(int $service_id): Response
    {
        $uid = context()->get('userId');
        $e = Collect::where(['service_id' => $service_id, 'uid' => $uid])->exists();
        return context()->getResponse()->withData(['is_collect' => $e]);
    }


}
