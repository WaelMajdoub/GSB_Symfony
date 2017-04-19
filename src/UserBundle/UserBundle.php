<?php

namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Le choix de créer un bundle à part pour la gestion d'utilisateurs est justifié par
 * l'héritage au FosUserBundle :
 *      On fait hériter la gestion d'utilisateurs de FOSUSER à notre bundle User
 *      nul besoin d'en faire hériter notre bundle principal et ainsi éviter d'éventuels conflit
 *      + respecter la politique de Symfony qui est de tout séparer dans la mesure du possible
 * Class UserBundle
 * @package UserBundle
 */
class UserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
