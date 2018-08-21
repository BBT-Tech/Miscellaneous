# 百步梯人员管理系统·临时登录授权 API 文档
Kingsley - 22nd Aug, 2018

[TOC]

### 获取授权码
使用 API 需要首先获取一个授权码，以下内容中的 `auth_key` 均指该授权码

### 接口地址
[https://hemc.100steps.net/2018/auth-bbt/interface.php](https://hemc.100steps.net/2018/auth-bbt/interface.php)

### 请求方式
```
POST https://hemc.100steps.net/2018/auth-bbt/interface.php

key: auth_key
stuno: "学号"
password: "密码"
```

### 响应数据示例

#### 操作成功

```json
{
    "errcode": 0,
    "data": {
        "name": "姓名",
        "sex": "性别",
        "mobile": "手机号",
        "dep": "部门",
        "grp": "组别",
        "college": "学院",
        "major": "专业",
        "email": "邮箱"
    }
}
```

#### 操作失败
```json
{
    "errcode": 1,
    "errmsg": "用户名或密码错误"
}
```

#### 注意事项
1. 用户数据（`data` 段）可用于在登录后的自动填写等操作，如需要学院信息的直接自动填写学院的值，所以每次使用由前端取需要的一部分即可
2. 接口的请求由后端完成，注意将授权码 `auth_key` 写在配置文件中，不要误提交到版本管理系统中，更不要外泄
3. 一些对 `errcode` 值对应情况的解释：

- `== 0`
  - 操作成功

- `> 0`
  - 验证失败：用户名或密码错误、账号已被删除、账号未激活等
  - 此时直接将 `errmsg` 返回给前端显示即可
  - 错误信息示例：“用户名或密码错误”

- `< 0`
  - 人员管理系统相关问题导致的操作失败：未修改默认密码、未设置邮箱、个人信息填写不完整等
  - 此时将 `errmsg` 返回给前端显示，并需要前端在用户点击确定后跳转到人员管理系统的 URL 让用户登录
  - 错误信息示例：“很抱歉，你的个人信息没有填写完整，先到人员管理系统完善它吧”

附：人员管理系统的 URL 为 [https://hemc.100steps.net/2013/bbter/users](https://hemc.100steps.net/2013/bbter/users)，可以直接放在前端，判断到 `errcode` 为负数时，在用户读完信息点击确定后跳转到该网页
