<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 10/04/15
 * Time: 11:14
 */

namespace Application;


/**
 * Class Superadmin
 * @package Application
 */
final class Superadmin extends User {
    /**
     * @var
     */
    protected $login;
    /**
     * @var
     */
    protected $pasword;
    /**
     * @var
     */
    protected $role;

    /**
     * @param $login
     * @param $pasword
     * @param $role
     */
    function __construct($login, $pasword, $role)
    {
        $this->login = $login;
        $this->pasword = $pasword;
        $this->role = $role;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $pasword
     */
    public function setPasword($pasword)
    {
        $this->pasword = $pasword;
    }

    /**
     * @return mixed
     */
    public function getPasword()
    {
        return $this->pasword;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }


} 