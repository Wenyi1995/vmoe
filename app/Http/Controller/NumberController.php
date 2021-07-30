<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Model\Entity\Number;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use App\Http\Middleware\LoginCheckMiddleware;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * Class NumberController
 *
 * @Controller(prefix="/number")
 * @Middleware(LoginCheckMiddleware::class)
 * @package App\Http\Controller
 */
class NumberController
{
    /**
     * 创建排号
     * @RequestMapping(route="", method=RequestMethod::POST)
     * @Validate(validator="NumberValidator")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $uid = context()->get('userId');
        $hasNow = Number::where(['uid' => $uid, 'soft_delete' => 0, 'is_end' => 0])->first(['id']);
        if ($hasNow) {
            return context()->getResponse()->withStatus(403)->withContent('当前已有排号了');
        } else {
            Number::insert(array_merge(
                $request->getParsedBody(),
                [
                    'uid' => $uid,
                    'soft_delete' => 0,
                    'is_end' => 0
                ]
            ));
            return context()->getResponse()->withContent('success');
        }
    }

    /**
     * 获取详情
     * @RequestMapping(route="{id}", method=RequestMethod::GET)
     * @param int $id
     * @return string[]
     */
    public function get(int $id): array
    {
        return Number::whereKey($id)->first()->toArray();
    }

    /**
     * 修改
     * @RequestMapping(route="{id}", method=RequestMethod::PUT)
     * @Validate(validator="NumberValidator")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, int $id): Response
    {
        $uid = context()->get('userId');
        $hasNow = Number::whereKey($id)->first(['id', 'uid']);
        if ($hasNow) {
            if ($hasNow['uid'] == $uid) {
                $hasNow->fill($request->getParsedBody())->save();
                return context()->getResponse()->withContent('success');
            } else {
                return context()->getResponse()->withStatus(403)->withContent('无权操作');
            }
        } else {
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

    /**
     *
     * 删除
     * @RequestMapping(route="{id}", method=RequestMethod::DELETE)
     * @param int $id
     * @return Response
     */
    public function del(int $id): Response
    {
        $numberInfo = Number::whereKey($id)->where('soft_delete', 0)->first(['uid']);
        if ($numberInfo) {
            if ($numberInfo['uid'] == context()->get('userId')) {
                $numberInfo->setSoftDelete(1)->save();
                return context()->getResponse()->withContent('success');
            } else {
                return context()->getResponse()->withStatus(403)->withContent('无权操作');
            }
        } else {
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

    /**
     * 结束
     * @RequestMapping(route="{id}", method=RequestMethod::PATCH)
     * @param int $id
     * @return Response
     */
    public function end(int $id): Response
    {
        $numberInfo = Number::whereKey($id)->where('soft_delete', 0)->first(['uid']);
        if ($numberInfo) {
            if ($numberInfo['uid'] == context()->get('userId')) {
                $numberInfo->setIsEnd(1)->save();
                return context()->getResponse()->withContent('success');
            } else {
                return context()->getResponse()->withStatus(403)->withContent('无权操作');
            }
        } else {
            return context()->getResponse()->withStatus(404)->withContent('资源不存在');
        }
    }

    /**
     * 叫号
     * @RequestMapping(route="/next/{id}", method=RequestMethod::PATCH)
     * @param int $id
     * @return string
     */
    public function next(int $id): string
    {
        return 'success';
    }

    /**
     * 加入排号
     * @RequestMapping(route="/join/{id}", method=RequestMethod::POST)
     * @param int $id
     * @return string
     */
    public function join(int $id): string
    {
        return 'success';
    }

}
