<?php

namespace Application;

/**
 * Interface CRUDInterface
 */
interface CRUDInterface
{
    /**
     * Méthode créer
     * @return mixed
     */
    public function creer();

    /**
     * Méthode modifier
     * @return mixed
     */
    public function modifier($id);

    /**
     * Méthode voir
     * @return mixed
     */
    public function voir();

    /**
     * Méthode supprimer
     * @return mixed
     */
    public function supprimer();
}