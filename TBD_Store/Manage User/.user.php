<?php
include "../dbConnect.php";
class User
{
//    private static function sqlConnect(&$pdo)
//    {
//        $pdo = new PDO('mysql:host=localhost;dbname=tbd_store;charset=utf8','root','');
//        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    }

    public static function sqlInsert($email, $password, $username)
    {
        dbConnect($pdo);

        $sqlInsert = 'INSERT INTO users (
                   USER_EMAIL, USER_PASSWORD, USER_NAME, REGISTRATION_DATE
                   ) VALUES (
                    :email, :password, :username, CURRENT_TIMESTAMP
                    )';
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', password_hash($password,'2y'));
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function sqlDelete($username){

        dbConnect($pdo);

        $sqlDelete = 'DELETE FROM users WHERE USER_NAME=:username';
        $result = $pdo->prepare($sqlDelete);
        $result->bindValue(':username', $username);
        $result->execute();

        return $result->rowCount();
    }

    public static function verify_login(&$user, $password): bool
    {
        self::sqlConnect($pdo);
        $sqlSelectByUsername = 'SELECT USER_PASSWORD, USER_NAME FROM users WHERE (USER_NAME=:user OR USER_EMAIL=:user)';
        $stmt = $pdo->prepare($sqlSelectByUsername);
        $stmt->bindValue(':user', $user);
        $stmt->execute();
        $row = $stmt->fetch();
        $user = $row['USER_NAME'];
        return password_verify($password, $row['USER_PASSWORD']);
    }
}