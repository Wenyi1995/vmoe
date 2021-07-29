<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class Service
 *
 * @since 2.0
 *
 * @Entity(table="service")
 */
class Service extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 标题
     *
     * @Column()
     *
     * @var string
     */
    private $title;

    /**
     * 内容
     *
     * @Column()
     *
     * @var string|null
     */
    private $content;

    /**
     * 1 妆娘 2 道具 3 摄影
     *
     * @Column(name="service_type", prop="serviceType")
     *
     * @var int
     */
    private $serviceType;

    /**
     * 1 服务 2 需求
     *
     * @Column()
     *
     * @var int
     */
    private $type;

    /**
     * 最低价
     *
     * @Column(name="low_price", prop="lowPrice")
     *
     * @var float|null
     */
    private $lowPrice;

    /**
     * 最高价
     *
     * @Column(name="high_price", prop="highPrice")
     *
     * @var float|null
     */
    private $highPrice;

    /**
     * 软删除
     *
     * @Column(name="soft_delete", prop="softDelete")
     *
     * @var int
     */
    private $softDelete;

    /**
     * 开始时间
     *
     * @Column(name="start_time", prop="startTime")
     *
     * @var int
     */
    private $startTime;

    /**
     * 结束时间
     *
     * @Column(name="end_time", prop="endTime")
     *
     * @var int
     */
    private $endTime;

    /**
     * 
     *
     * @Column(name="create_time", prop="createTime")
     *
     * @var int
     */
    private $createTime;

    /**
     * 
     *
     * @Column(name="update_time", prop="updateTime")
     *
     * @var int
     */
    private $updateTime;


    /**
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string|null $content
     *
     * @return self
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param int $serviceType
     *
     * @return self
     */
    public function setServiceType(int $serviceType): self
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    /**
     * @param int $type
     *
     * @return self
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param float|null $lowPrice
     *
     * @return self
     */
    public function setLowPrice(?float $lowPrice): self
    {
        $this->lowPrice = $lowPrice;

        return $this;
    }

    /**
     * @param float|null $highPrice
     *
     * @return self
     */
    public function setHighPrice(?float $highPrice): self
    {
        $this->highPrice = $highPrice;

        return $this;
    }

    /**
     * @param int $softDelete
     *
     * @return self
     */
    public function setSoftDelete(int $softDelete): self
    {
        $this->softDelete = $softDelete;

        return $this;
    }

    /**
     * @param int $startTime
     *
     * @return self
     */
    public function setStartTime(int $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @param int $endTime
     *
     * @return self
     */
    public function setEndTime(int $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @param int $createTime
     *
     * @return self
     */
    public function setCreateTime(int $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * @param int $updateTime
     *
     * @return self
     */
    public function setUpdateTime(int $updateTime): self
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getServiceType(): ?int
    {
        return $this->serviceType;
    }

    /**
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @return float|null
     */
    public function getLowPrice(): ?float
    {
        return $this->lowPrice;
    }

    /**
     * @return float|null
     */
    public function getHighPrice(): ?float
    {
        return $this->highPrice;
    }

    /**
     * @return int
     */
    public function getSoftDelete(): ?int
    {
        return $this->softDelete;
    }

    /**
     * @return int
     */
    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    /**
     * @return int
     */
    public function getEndTime(): ?int
    {
        return $this->endTime;
    }

    /**
     * @return int
     */
    public function getCreateTime(): ?int
    {
        return $this->createTime;
    }

    /**
     * @return int
     */
    public function getUpdateTime(): ?int
    {
        return $this->updateTime;
    }

}
