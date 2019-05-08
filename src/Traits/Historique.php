<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 07/05/2019
 * Time: 19:28
 */

namespace App\Traits;


trait Historique
{
    private $texte;

    public function getHistorique()
    {
        echo "Salut, je suis votre historique !";
    }
}