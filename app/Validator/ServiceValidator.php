<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsFloat;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;
use Swoft\Validator\Annotation\Mapping\Enum;

/**
 *
 * Class ServiceValidator
 *
 * @since 2.0
 *
 * @Validator(name="ServiceValidator")
 */
class ServiceValidator
{
    /**
     * @IsString()
     * @NotEmpty()
     * @Required()
     * @var string
     */
    protected $title;

    /**
     * @IsString()
     * @var string
     */
    protected $content;

    /**
     * @IsInt()
     * @NotEmpty()
     * @Required()
     * @Enum(values={1,2,3})。
     * @var int
     */
    protected $serviceType;

    /**
     * @IsInt()
     * @NotEmpty()
     * @Required()
     * @Enum(values={1,2})。
     * @var int
     */
    protected $type;

    /**
     * @IsInt()
     * @NotEmpty()
     * @Required()
     * @var int
     */
    protected $startTime;

    /**
     * @IsInt()
     * @NotEmpty()
     * @Required()
     * @var int
     */
    protected $endTime;


    /**
     * @IsFloat()
     * @NotEmpty()
     * @Required()
     *
     * @var int
     */
    protected $lowPrice;

    /**
     * @IsFloat()
     * @NotEmpty()
     * @Required()
     *
     * @var int
     */
    protected $highPrice;
}
