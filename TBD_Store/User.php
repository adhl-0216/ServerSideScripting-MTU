<?php

class User
{
    var $username;
    var $password;
    var $email;

    /**
     * @param $username
     * @param $password
     * @param $email
     */
    public function __construct($email, $password, $username)
    {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setUsername($username);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    private static function sqlConnect(&$pdo)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=tbd_store;charset=utf8','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function sqlInsert()
    {
        self::sqlConnect($pdo);
        $sqlInsert = 'INSERT INTO users (
                   USER_EMAIL, USER_PASSWORD, USER_NAME, REGISTRATION_DATE
                   ) VALUES (
                    :email, :password, :username, CURRENT_TIMESTAMP
                    )';
        $stmt = $pdo->prepare($sqlInsert);
        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':password', password_hash($this->getPassword(),'2y'));
        $stmt->bindValue(':username', $this->getUsername());
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function verify_login($username, $email, $password): bool
    {
        self::sqlConnect($pdo);
        $sqlSelectByUsername = 'SELECT USER_PASSWORD FROM users WHERE (USER_NAME=:username OR USER_EMAIL=:email)';
        $stmt = $pdo->prepare($sqlSelectByUsername);
        $stmt->bindValue('username', $username);
        $stmt->bindValue('email', $email);
        $stmt->execute();
        $row = $stmt->fetch();
        return password_verify($password, $row['USER_PASSWORD']);
    }
}