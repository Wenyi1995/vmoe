<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 *
 * Class User
 *
 * @since 2.0
 *
 * @Entity(table="user")
 */
class User extends Model
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
     * 设备唯一标识
     *
     * @Column()
     *
     * @var string
     */
    private $account;

    /**
     * 手机号
     *
     * @Column()
     *
     * @var string
     */
    private $phone;

    /**
     * 头像
     *
     * @Column()
     *
     * @var string
     */
    private $avatar;

    /**
     * 昵称
     *
     * @Column()
     *
     * @var string
     */
    private $nickname;

    /**
     * 状态 0已封禁1生效2申请中
     *
     * @Column()
     *
     * @var int
     */
    private $status;

    /**
     * 邀请人
     *
     * @Column()
     *
     * @var int
     */
    private $inviter;

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
     * 纬度
     *
     * @Column()
     *
     * @var float|null
     */
    private $lat;

    /**
     * 精度
     *
     * @Column()
     *
     * @var float|null
     */
    private $lng;


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
     * @param string $account
     *
     * @return self
     */
    public function setAccount(string $account): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @param string $phone
     *
     * @return self
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @param string $avatar
     *
     * @return self
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @param string $nickname
     *
     * @return self
     */
    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @param int $status
     *
     * @return self
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param int $inviter
     *
     * @return self
     */
    public function setInviter(int $inviter): self
    {
        $this->inviter = $inviter;

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
     * @param float|null $lat
     *
     * @return self
     */
    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @param float|null $lng
     *
     * @return self
     */
    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

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
    public function getAccount(): ?string
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getInviter(): ?int
    {
        return $this->inviter;
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

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

}
