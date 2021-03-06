<?php

namespace GSBBundle\Repository;

/**
 * LigneFraisHorsForfaitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LigneFraisHorsForfaitRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
     * concernées par les deux arguments
     * La boucle foreach ne peut être utilisée ici car on procède
     * à une modification de la structure itérée - transformation du champ date-
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
     */
    public function getLesFraisHorsForfait($idUser, $mois) {

        return $this->createQueryBuilder('lesFraisHorsForfait')
                    ->select('lesFraisHorsForfait.id', 'lesFraisHorsForfait.libelle', 'lesFraisHorsForfait.mois', 'lesFraisHorsForfait.montant','lesFraisHorsForfait.date', 'e.id as idEtatFrais')
                    ->innerJoin('lesFraisHorsForfait.idEtatFrais', 'e')
                    ->where('lesFraisHorsForfait.idUser = :idUser')
                    ->andWhere('lesFraisHorsForfait.mois = :mois')
                    ->setParameter('idUser', $idUser)
                    ->setParameter('mois', $mois)
                    ->getQuery()->getArrayResult();

    }
}
