<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use App\Exception\ApiException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Throwable;

/**
 * Class ApiExceptionHandler
 *
 * @since 2.0
 *
 * @ExceptionHandler(ApiException::class)
 */
class ApiExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $except
     * @param Response  $response
     *
     * @return Response
     */
    public function handle(Throwable $except, Response $response): Response
    {
        if(env('APP_DEBUG',0)){
            $data = [
                'error' => sprintf('(%s) %s', get_class($except), $except->getMessage()),
                'file'  => sprintf('At %s line %d', $except->getFile(), $except->getLine()),
                'trace' => $except->getTraceAsString(),
            ];

            return $response->withStatus(500)->withData($data);
        }else{
            return $response->withStatus(500)->withContent('服务器错误');
        }

    }
}
