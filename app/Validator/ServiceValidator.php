<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class ServiceValidator
 *
 * 服务内容验证器
 * @since 2.0
 *
 * @Validator(name="ServiceValidator")
 */
class ServiceValidator
{
    /**
     * @IsString(name="标题")
     * @NotEmpty(name="标题")
     * @var string
     */
    protected $title;

    /**
     * @IsString(name="内容")
     * @var int
     */
    protected $content;

    /**
     * @NotEmpty(name="服务类型")
     * @Enum(name="服务类型", values={1,2,3},message="类型只能是1，2，3")。
     * @var int
     */
    protected $serviceType;

    /**
     * @NotEmpty(name="类型")
     * @Enum(name="类型", values={1,2})。
     * @var int
     */
    protected $type;

    /**
     * @NotEmpty(name="开始时间")
     * @IsInt(name="开始时间")
     * @var int
     */
    protected $startTime;

    /**
     * @NotEmpty(name="结束时间")
     * @IsInt(name="结束时间")
     * @var int
     */
    protected $endTime;


    /**
     * @NotEmpty(name="最低价格")
     * @IsInt(name="最低价格")
     * @var int
     */
    protected $lowPrice;

    /**
     * @NotEmpty(name="最高价格")
     * @IsInt(name="最高价格")
     * @var int
     */
    protected $highPrice;
}
