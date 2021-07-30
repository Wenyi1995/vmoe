<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class NumberValidator
 * 排号验证器
 * @since 2.0
 *
 * @Validator(name="NumberValidator")
 */

class NumberValidator
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
     * @NotEmpty()
     * @Required()
     * @var int
     */
    protected $startTime;
}
