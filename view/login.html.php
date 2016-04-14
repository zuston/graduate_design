<?php
/**
 * Created by PhpStorm.
 * User: zuston
 * Date: 16/4/13
 * Time: 下午11:02
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>图书管理系统登录</title>
    <meta charset="UTF-8" />
    <meta name="图书管理系统" content="图书管理">
    <link rel="stylesheet" type="text/css" href="view/static/css/reset.css">
    <link rel="stylesheet" type="text/css" href="view/static/css/structure.css">
</head>

<body>
<form class="box login" action="login/user" method="post">
    <fieldset class="boxBody">
        <label>用户名</label>
        <input type="text" tabindex="1" placeholder="请输入您的用户名" required name="username">
        <label><a href="#" class="rLink" tabindex="5">忘记密码?</a>密码</label>
        <input type="password" tabindex="2" required name="password">
    </fieldset>
    <footer>
        <label><input type="checkbox" tabindex="3" name="keeplogin">保持登录</label>
        <input type="submit" class="btnLogin" value="登录" tabindex="4">
    </footer>
</form>
<footer id="main">
    <a href="github.com/zuston">此系统为开源项目</a> | <a href="github.com/zuston">coding by shacha</a>
</footer>
</body>
</html>
