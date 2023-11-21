<?php
declare(strict_types=1);
error_reporting( E_ALL);
ini_set('display_errors', 'on');
session_start();
include_once 'function.php';

dd($_SESSION);
dd($_COOKIE);

function showForm(): string
{
    return $form= '
    <form action="" method="post">
        <div class="input-group has-validation">
            <div class="invalid-feedback">Введите логин</div>
            <input type="text" name="login" class="form-control" id="yourUsername" required>
        </div>
        <div class="invalid-feedback">Введите пароль</div>
        <input type="password" name="password" class="form-control" id="yourPassword" required>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <button class="btn btn-primary w-100" type="submit" name="btnLogin">Login</button>
        <button class="btn btn-primary w-100" type="submit" href="admin.php?action=logout">Exit</button>
    </form>
    ';
}

function login()
{
    if (!isset($_POST['btnlogin']))
    {
        echo showform();
    }
    else
    {
        $check = checklogin($_POST['login'],$_POST['password']);
        if($check == '')
        {
            $_SESSION['message'] = 'Вы зарегистрировались.';
            header("location: register.php");
        }
        else
        {
            $_SESSION['message'] = $check;
            header("location: index.php");
            exit;
        }
    }
}

function checkLogin(string $login, string $password): string
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    $msg = ' ';
    if(empty($login))
    {
        $msg += "Введите логин";
    }
    if(empty($password))
    {
        $msg += "Введите пароль";
    }
    return $msg;

}

function main()
{
    if($_SESSION['user'] = 'admin')
    {
        echo '<h1>Регистрация</h1>';
    }
    else
    {
        login();
    }
}
function logout()
{
    $_SESSION['user'] ='';
}


main();
login();
?>