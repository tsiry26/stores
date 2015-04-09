<?php

namespace Application;

/**
 * Interface EditeurInterface
 */
interface EditeurInterface
{
    /**
     * function modérer
     * @return mixed
     */
    public function moderer($article);

    /**
     * function blamer
     * @return mixed
     */
    public function blamer($user);

    /**
     * function promouvoir
     * @return mixed
     */
    public function promouvoir($article);
}