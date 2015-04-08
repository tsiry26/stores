<?php

namespace Application;

/**
 * doir être sufixé par le mot Interface
 * Interface AuthentificationInterface
 */
interface AuthentificationInterface
{
    /**
     * set Last Login
     * @param $date
     * @return mixed
     */
    public function setLastLogin($date);

    /**
     * Get Last Login
     * @return mixed
     */
    public function getLastLogin();

    /**
     * Set Date Created
     * @param $date
     * @return mixed
     */
    public function setDateCreated($date);

    /**
     * Get Date Created
     * @return mixed
     */
    public function getDateCreated();

}