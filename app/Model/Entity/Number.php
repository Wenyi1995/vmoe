<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 排号表
 * Class Number
 *
 * @since 2.0
 *
 * @Entity(table="number")
 */
class Number extends Model
{

    /**
     * 自动修改创建时间
     *
     * @var string
     */
    protected const CREATED_AT = 'create_time';

    /**
     * 自动修改更新时间
     *
     * @var string
     */
    protected const UPDATED_AT = 'update_time';


    /**
     *
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 用户id
     *
     * @Column()
     *
     * @var int
     */
    private $uid;

    /**
     * 标题
     *
     * @Column()
     *
     * @var string|null
     */
    private $title;

    /**
     * 开始时间
     *
     * @Column(name="start_time", prop="startTime")
     *
     * @var int
     */
    private $startTime;

    /**
     * 现在到了哪个号 row表id
     *
     * @Column(name="who_is_now", prop="whoIsNow")
     *
     * @var int
     */
    private $whoIsNow;

    /**
     * 是否结束
     *
     * @Column(name="is_end", prop="isEnd")
     *
     * @var int
     */
    private $isEnd;

    /**
     * 软删除
     *
     * @Column(name="soft_delete", prop="softDelete")
     *
     * @var int
     */
    private $softDelete;

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
     * @param int $uid
     *
     * @return self
     */
    public function setUid(int $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @param string|null $title
     *
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

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
     * @param int $whoIsNow
     *
     * @return self
     */
    public function setWhoIsNow(int $whoIsNow): self
    {
        $this->whoIsNow = $whoIsNow;

        return $this;
    }

    /**
     * @param int $isEnd
     *
     * @return self
     */
    public function setIsEnd(int $isEnd): self
    {
        $this->isEnd = $isEnd;

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
     * @return int
     */
    public function getUid(): ?int
    {
        return $this->uid;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
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
    public function getWhoIsNow(): ?int
    {
        return $this->whoIsNow;
    }

    /**
     * @return int
     */
    public function getIsEnd(): ?int
    {
        return $this->isEnd;
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
