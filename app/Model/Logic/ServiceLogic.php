<?php

declare(strict_types=1);


namespace App\Model\Logic;


use Swoft\Db\Eloquent\Model;


class ServiceLogic extends Model
{
    private $typeEnum = ['service' => 1, 'need' => 2];
    private $serviceTypeEnum = ['makeup' => 1, 'props' => 2, 'photographer' => 3];

    public function getTypeByKey($key)
    {
        return isset($this->typeEnum[$key]) ? $this->typeEnum[$key] : '';
    }

    public function getServiceTypeByKey($key)
    {
        return isset($this->serviceTypeEnum[$key]) ? $this->serviceTypeEnum[$key] : '';
    }
}
