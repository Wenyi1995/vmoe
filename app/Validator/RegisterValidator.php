<?php declare(strict_types=1);

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Length;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
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
     * @Required()
     * @var string
     */
    protected $account;

    /**
     * @IsString()
     * @NotEmpty()
     * @Required()
     * @Length(min=6,max=64)
     * @var int
     */
    protected $pwd;
}
