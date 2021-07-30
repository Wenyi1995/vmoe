<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 排号顺序表
 * Class NumberRow
 *
 * @since 2.0
 *
 * @Entity(table="number_row")
 */
class NumberRow extends Model
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
     * 排号表Id
     *
     * @Column(name="number_id", prop="numberId")
     *
     * @var int
     */
    private $numberId;

    /**
     * 手机号 或者其他能够及时联络方式
     *
     * @Column()
     *
     * @var string|null
     */
    private $phone;

    /**
     * 是否叫过了
     *
     * @Column(name="is_called", prop="isCalled")
     *
     * @var int
     */
    private $isCalled;

    /**
     * 上次叫号时间
     *
     * @Column(name="last_call_time", prop="lastCallTime")
     *
     * @var int
     */
    private $lastCallTime;

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
     * @param int $numberId
     *
     * @return self
     */
    public function setNumberId(int $numberId): self
    {
        $this->numberId = $numberId;

        return $this;
    }

    /**
     * @param string|null $phone
     *
     * @return self
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @param int $isCalled
     *
     * @return self
     */
    public function setIsCalled(int $isCalled): self
    {
        $this->isCalled = $isCalled;

        return $this;
    }

    /**
     * @param int $lastCallTime
     *
     * @return self
     */
    public function setLastCallTime(int $lastCallTime): self
    {
        $this->lastCallTime = $lastCallTime;

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
     * @return int
     */
    public function getNumberId(): ?int
    {
        return $this->numberId;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return int
     */
    public function getIsCalled(): ?int
    {
        return $this->isCalled;
    }

    /**
     * @return int
     */
    public function getLastCallTime(): ?int
    {
        return $this->lastCallTime;
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
