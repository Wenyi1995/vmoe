# 接口手册
## 接入方式

- 访问地址：lampta.com ｜ 本地 192.168.50.165

- 端口：http请求 -  `18306`  ws - `18308`

- 接口请求前缀 `api/v1`

  eg. http://lampta.com/api/v1/login

- 除了登录 和 注册 接口，其他所有接口需要在 header 中传入 `USER-TOKEN` 

  其中 token会在登录和注册接口返回
  
- 所有写在文档上的参数都是必填参数 因为是demo 数据库设计是最简单的内容

- 返回内容 都是以http status 加上 返回字符串的形式

  字符串内容可以直接以报错信息的形式展示

  eg. 200 + success 操作成功

  - 401 没有登录
  - 403 请求内容错误
  - 404 资源不存在
  - 500 服务器错误



## 接口

### 账户相关

#### 注册

  - post   /register
  - 参数
    - `account`  登录名
    - `pwd`  密码
    - 返回 
      - `token` 
      -  `uid`

#### 登录

  - post   /login

  - 参数
    - `account`  登录名
    - `pwd`  密码

  - 返回 
    - `token` 
    -  `uid`

### 服务相关

#### 发布服务

  - post  /service
  - 参数
    - `title`  标题
    - `content` 内容
    - `serviceType` 服务类型 枚举 1 妆娘  2 道具  3 摄影
    - `type` 发布类型 枚举 1 提供 2 需求
    - `startTime` 开始时间 时间戳
    - `endTime` 结束时间 时间戳
    - `lowPrice ` 最低价  浮点数
    - `highPrice ` 最高价  浮点数

#### 修改服务

  - put  /service/{service_id}
  - 参数
    - `title`  标题
    - `content` 内容
    - `serviceType` 服务类型 枚举 1 妆娘  2 道具  3 摄影
    - `type` 发布类型 枚举 1 提供 2 需求
    - `startTime` 开始时间 时间戳
    - `endTime` 结束时间 时间戳
    - `lowPrice ` 最低价  浮点数
    - `highPrice ` 最高价  浮点数

#### 获取服务详情

  - get  /service/{service_id}

  - 参数

    - `id`   服务id
    - `uid` 创建人uid
    - `title`  标题
    - `content` 内容
    - `serviceType` 服务类型 枚举 1 妆娘  2 道具  3 摄影
    - `type` 发布类型 枚举 1 提供 2 需求
    - `startTime` 开始时间 时间戳
    - `endTime` 结束时间 时间戳
    - `lowPrice ` 最低价  浮点数
    - `highPrice ` 最高价  浮点数

#### 删除服务

  - delete  /service/{service_id}

    

#### 获取服务列表

  - get  /service/list/{page}/{size}
  - 返回
    - `id`   服务id
    - `uid` 创建人uid
    - `title`  标题
    - `serviceType` 服务类型 枚举 1 妆娘  2 道具  3 摄影
    - `type` 发布类型 枚举 1 提供 2 需求
    - `startTime` 开始时间 时间戳
    - `endTime` 结束时间 时间戳
    - `lowPrice ` 最低价  浮点数
    - `highPrice ` 最高价  浮点数
    
#### 获取我发布的服务列表

  - get  /service/mylist/{page}/{size}
  - 返回
    - `id`   服务id
    - `uid` 创建人uid
    - `title`  标题
    - `serviceType` 服务类型 枚举 1 妆娘  2 道具  3 摄影
    - `type` 发布类型 枚举 1 提供 2 需求
    - `startTime` 开始时间 时间戳
    - `endTime` 结束时间 时间戳
    - `lowPrice ` 最低价  浮点数
    - `highPrice ` 最高价  浮点数

#### 收藏服务

  - post  /service/collect/{service_id}

#### 删除收藏

  - delete  /service/collect/{service_id}

#### 获取我的收藏列表

  - get  /service/collect/{page}/{size}
  - 返回
    - `title` 服务标题
    - `create_time` 创建时间



### 排号相关


#### 创建排号

  - post  /number
  - 参数
    - `title`  排号名称
    - `startTime` 开始时间戳
    
#### 修改排号

  - put  /number/{number_id}
  - 参数
    - `title`  排号名称
    - `startTime` 开始时间戳
    

#### 获取我创建的排号列表

  - get  /number/mylist/{page}/{size}
  - 返回
    - `id` 
    - `uid` 创建者uid
    - `title`  标题
    - `startTime`  开始时间戳
    - `whoIsNow`  当前row_id
    - `isEnd`  是否结束 1 是 0 否

#### 获取我加入的排号列表

  - get  /number/joinlist/{page}/{size}
  - 返回
    - `id`
    - `uid` 创建者id
    - `title` 标题
    - `start_time` 开始时间戳
    - `who_is_now` 当前row_id 
    - `is_end` 是否结束 1 是 0 否 
    - `join_time`加入时间戳
    - `is_called` 是否被叫过号
    

#### 获取排号详情

  - get  /number/{number_id}
  - 返回
    - `id`  id需要显示 在加入排号的时候需要填入id
    - `uid`  创建人id
    - `title`  排号名称
    - `who_is_now`  当前rowId
    - `is_end`  是否结束
    - `startTime` 开始时间戳
    - `joinList`  加入排号列表

       - `id` rowId
       - `uid` rowUid
       - `isCalled` 是否已经叫号
       - `lastCallTime` 上次叫号时间
       - `phone` 联系方式
         
       
    
#### 删除排号

  - delete  /number/{number_id}

#### 加入排号

  - patch /number/join/{number_id}
  - 参数
    - `phone` 联系方式 不一定是手机号


#### 叫号

  - patch /number/next/{number_id}

  

#### 结束排号

  - patch  /number/{number_id}

