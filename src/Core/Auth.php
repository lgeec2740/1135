<?php


namespace App\Core;


trait Auth
{
    public function checkAuth(): bool
    {
        if (isset($_SESSION['username'])){
            return true;
        } else return false;
    }
    public function signIn(string $username, int $id): void
    {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $id;
    }
    public function signOut(): void
    {
        unset($_SESSION['username']) ;
        unset($_SESSION['user_id']) ;
    }
}