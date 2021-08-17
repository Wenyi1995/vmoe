<?php
declare(strict_types=1);

namespace App\Http\Controller;

use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;

// use Swoft\Http\Message\Response;

/**
 * Class HomeController
 *
 * @Controller(prefix="/home")
 * @package App\Http\Controller
 */
class HomeController
{

    /**
     * @RequestMapping("/login", method=RequestMethod::GET)
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        return view('home/login');
    }

    /**
     * @RequestMapping("/index", method=RequestMethod::GET)
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return view('home/index');
    }

    /**
     * @RequestMapping("/number", method=RequestMethod::GET)
     * @param Request $request
     * @return Response
     */
    public function number(Request $request): Response
    {
        return view('home/number');
    }

    /**
     * @RequestMapping("/service", method=RequestMethod::GET)
     * @param Request $request
     * @return Response
     */
    public function service(Request $request): Response
    {
        return view('home/service');
    }

    /**
     * @RequestMapping("/im", method=RequestMethod::GET)
     * @param Request $request
     * @return Response
     */
    public function im(Request $request): Response
    {
        return view('home/im');
    }
}
