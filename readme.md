# Laravel 入门项目

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 关于项目

本项目使用 Laravel 构建一个类似新浪微博的应用。

使用到 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识，以及一些在 Web 开发中经常用到的技能如 Git 工作流、Laravel Mix 前端工作流、Bootstrap 框架基本使用等。主要功能涵盖：

- 用户的注册登录
- 用户个人信息 CRUD
- 用户账号激活 —— 用于激活新注册的用户；
- 用户密码重设 —— 帮助用户找回密码；
- 使用管理员权限删除用户
- 微博 CRUD
- 粉丝关系
- 查看关注用户的微博动态
- 个人与关注人微博数据流

## 下载与安装

下载：

```
git clone https://github.com/IamComing3/sample.git
```

安装：

 - 安装项目：
```
  composer install

  php artisan key:generate
```
 - 修改配置文件 `.env`
 - 执行数据迁移：
```
  php artisan migrate
  php artisan db:seed
```
  
