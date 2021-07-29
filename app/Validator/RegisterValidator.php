<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Min;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class RegisterValidator
 * 注册验证器
 * @since 2.0
 *
 * @Validator(name="RegisterValidator")
 */

class RegisterValidator
{
    /**
     * @IsString()
     * @NotEmpty()
     * @var string
     */
    protected $account;

    /**
     * @IsString()
     * @NotEmpty()
     * @Min(value=6,message="密码最小6位")
     * @var int
     */
    protected $pwd;
}
