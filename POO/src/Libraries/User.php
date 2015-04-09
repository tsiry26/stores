<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 08/04/15
 * Time: 14:31
 */

namespace Libraries;


class User {
    /**
     * @var email
     */
    protected $email;
    /**
     * @var password
     */
    protected $password;

    /**
     * @param $email
     * @param $password
     */
    public function __construct($email,$password){
        $this->email=$email;
        $this->password=$password;
    }

    /**
     * @param \Libraries\email $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \Libraries\email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param \Libraries\password $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return \Libraries\password
     */
    public function getPassword()
    {
        return $this->password;
    }

} 