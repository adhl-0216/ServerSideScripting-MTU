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
    public function __construct($username, $email, $password)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setEmail($email);
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
//        echo $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
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
    }

    public static function verify_password($username, $email, $password): bool
    {
        self::sqlConnect($pdo);
        $sqlSelectById = 'SELECT USER_PASSWORD FROM users WHERE (USER_NAME=:username OR USER_EMAIL=:email)';
        $stmt = $pdo->prepare($sqlSelectById);
        $stmt->bindValue('username', $username);
        $stmt->bindValue('email', $email);
        $stmt->execute();
        $row = $stmt->fetch();
        return password_verify($password, $row['USER_PASSWORD']);
    }
}