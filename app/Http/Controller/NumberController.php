<?php declare(strict_types=1);

namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use App\Http\Middleware\LoginCheckMiddleware;
// use Swoft\Http\Message\Response;

/**
 * Class NumberController
 *
 * @Controller(prefix="/number")
 * @Middleware(LoginCheckMiddleware::class)
 * @package App\Http\Controller
 */
class NumberController{
    /**
     * 创建排号
     * @RequestMapping(route="", method=RequestMethod::POST)
     * @return string
     */
    public function create(): string
    {
        return 'success';
    }

    /**
     * 获取详情
     * @RequestMapping(route="{id}", method=RequestMethod::GET)
     * @param int $id
     * @return string[]
     */
    public function get(int $id): array
    {
        return ['item0'];
    }

    /**
     * 修改
     * @RequestMapping(route="{id}", method=RequestMethod::PUT)
     * @param int $id
     * @return string
     */
    public function edit(int $id): string
    {
        return 'success';
    }

    /**
     * 删除
     * @RequestMapping(route="{id}", method=RequestMethod::DELETE)
     * @param int $id
     * @return string
     */
    public function del(int $id): string
    {
        return 'success';
    }

    /**
     * 结束
     * @RequestMapping(route="{id}", method=RequestMethod::PATCH)
     * @param int $id
     * @return string
     */
    public function end(int $id): string
    {
        return 'success';
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
