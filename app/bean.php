<?php
declare(strict_types=1);

/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

use Swoft\Db\Database;
use Swoft\Db\Pool;
use Swoft\Http\Server\HttpServer;
use Swoft\Http\Server\Swoole\RequestListener;
use Swoft\Redis\RedisDb;
use Swoft\Server\SwooleEvent;
use Swoft\Task\Swoole\FinishListener;
use Swoft\Task\Swoole\TaskListener;
use Swoft\WebSocket\Server\WebSocketServer;

$config = [
    'noticeHandler' => [
        'logFile' => '@runtime/logs/notice-%d{Y-m-d-H}.log',
    ],
    'applicationHandler' => [
        'logFile' => '@runtime/logs/error-%d{Y-m-d}.log',
    ],
    'logger' => [
        'flushRequest' => false,
        'enable' => true,
        'json' => true,
    ],
    'httpServer' => [
        'class' => HttpServer::class,
        'port' => 18306,
        'listener' => [
            // 'rpc' => bean('rpcServer'),
            // 'tcp' => bean('tcpServer'),
        ],
        'process' => [
            // 'monitor' => bean(\App\Process\MonitorProcess::class)
            'crontab' => bean(\Swoft\Crontab\Process\CrontabProcess::class)
        ],
        'on' => [
            // SwooleEvent::TASK   => bean(SyncTaskListener::class),  // Enable sync task
            SwooleEvent::TASK => bean(TaskListener::class),  // Enable task must task and finish event
            SwooleEvent::FINISH => bean(FinishListener::class)
        ],
        /* @see HttpServer::$setting */
        'setting' => [
            'task_worker_num' => 4,
            'task_enable_coroutine' => true,
            'worker_num' => 2,
            // static handle
            // 'enable_static_handler'    => true,
            // 'document_root'            => dirname(__DIR__) . '/public',
        ]
    ],
    'httpRouter'=>[
        'tmpCacheNumber'=>1000,// 缓存路由数，最近一1000条(缓存到路由对象的，重启后失效，只会缓存动态路由)
        'currentGroupPrefix'=>'/api/v1',// 将会给所有的路由设置前缀(例如：/api) !!请谨慎使用!!
    ],
    'httpDispatcher' => [
        // Add global http middleware
        'afterMiddlewares' => [
            \Swoft\Http\Server\Middleware\ValidatorMiddleware::class
        ]
    ],
    'db' => [
        'class' => Database::class,
        'dsn' => 'mysql:dbname='.env('DB_NAME').';host='.env('DB_HOST','127.0.0.1'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'charset' => 'utf8mb4',
    ],
    'db.pool' => [
        'class' => Pool::class,
        'database' => bean('db'),
    ],
    'migrationManager' => [
        'migrationPath' => '@database/Migration',
    ],
    'wsServer' => [
        'class' => WebSocketServer::class,
        'port' => 18308,
        'on' => [
            // Enable http handle
            SwooleEvent::REQUEST => bean(RequestListener::class),
            // Enable task must add task and finish event
            SwooleEvent::TASK => bean(TaskListener::class),
            SwooleEvent::FINISH => bean(FinishListener::class)
        ],
         'debug'   => env('SWOFT_DEBUG', 0),
        /* @see WebSocketServer::$setting */
        'setting' => [
            'task_worker_num' => 6,
            'task_enable_coroutine' => true,
            'worker_num' => 6,
            'log_file' => alias('@runtime/swoole.log'),
            // 'open_websocket_close_frame' => true,
        ],
    ],
    // 'wsConnectionManager' => [
    //     'storage' => bean('wsConnectionStorage')
    // ],
    // 'wsConnectionStorage' => [
    //     'class' => \Swoft\Session\SwooleStorage::class,
    // ],
    /** @see \Swoft\WebSocket\Server\WsMessageDispatcher */
    'wsMsgDispatcher' => [
        'middlewares' => [
        ],
    ],
    'cliRouter' => [// 'disabledGroups' => ['demo', 'test'],
    ],
];
for ($i = 0; $i <= 15; $i++) {
    $config['redis_' . $i] = [
        'class' => RedisDb::class,
        'host' => env('REDIS_HOST','127.0.0.1'),
        'port' => env('REDIS_PORT',6379),
        'database' => $i
    ];
    $config['redis_' . $i . '.pool'] = [
        'class' => Swoft\Redis\Pool::class,
        'redisDb' => bean('redis_' . $i),
        'minActive' => 10,
        'maxActive' => 20,
        'maxWait' => 0,
        'maxWaitTime' => 0,
        'maxIdleTime' => 60,
    ];
}

return $config;
