<?php

namespace GSBBundle\Repository;
use GSBBundle\Entity\FicheFrais;
use GSBBundle\Entity\LigneFraisForfait;
use GSBBundle\GSBBundle;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * FicheFraisRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FicheFraisRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Retourne le nombre de justificatif d'un visiteur pour un mois donné
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return le nombre entier de justificatifs
     */
    public function getNbjustificatifs($idUser, $mois) {
        return $this->createQueryBuilder('ff')
                    ->addSelect('')
                    ->where('ff.idUser = :idUser')
                    ->andWhere('ff.mois = :mois')
                    ->setParameter('idUser', $idUser)
                    ->setParameter('mois', $mois)
                    ->getQuery()->getSingleResult();
    }


    /**
     * retourne les mois disponibles de l'utilisateur selectioné
     * @param $idVisiteur
     * @return array
     */
    public function getLesMoisDisponibles($idUser)
    {
        return $this->createQueryBuilder('fflmd')
                ->select('fflmd.mois')
                ->where('fflmd.idUser =:idUser')
                ->orderBy('fflmd.mois', 'DESC')
                ->setParameter('idUser', $idUser)
                ->getQuery()->getArrayResult();
    }


    /**
     * Retourne les Mois disponibles de toutes les Fiches validées et mises en paiement de l'utilisateur voulu
     * @param $idUser
     * @return array
     */
    public function getLesMoisDisponiblesDesFichesValidees($idUser){
        return $this->createQueryBuilder('fflmd')
            ->select('fflmd.mois')
            ->where('fflmd.idUser =:idUser')
            ->andWhere('fflmd.idEtat = \'VA\'')
            ->orderBy('fflmd.mois', 'DESC')
            ->setParameter('idUser', $idUser)
            ->getQuery()->getArrayResult();

    }

    /**
     * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
     * @param $idUser
     * @param $mois
     * @return mixed
     */
    public function getLesInfosFicheFraisObject($idUser, $mois){
        return $this->createQueryBuilder('ff')
            ->select('ff')
            ->innerJoin('ff.idEtat', 'e')
            ->where('ff.idUser = :idUser')
            ->andWhere('ff.mois = :unMois')
            ->setParameter('idUser', $idUser)
            ->setParameter('unMois', $mois)
            ->getQuery()->getSingleResult();
    }

    /**
     * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
     * @param $idUser
     * @param $mois
     * @return mixed
     */
    public function getLesInfosFicheFrais($idUser, $mois){
        return $this->createQueryBuilder('ff')
            ->select('ff.id as idFicheFrais', 'ff.nbJustificatifs', 'ff.mois', 'ff.montantValide', 'e.id as idEtat')
            ->innerJoin('ff.idEtat', 'e')
            ->where('ff.idUser = :idUser')
            ->andWhere('ff.mois = :unMois')
            ->setParameter('idUser', $idUser)
            ->setParameter('unMois', $mois)
            ->getQuery()->getArrayResult();
    }

    /**
     * Modifie l'état et la date de modification d'une fiche de frais
     * Modifie le champ idEtat et met la date de modif à aujourd'hui
     *
     * @param $idUser
     * @param $mois sous la forme aaaamm
     */
    public function majEtatFicheFrais($idUser, $mois, $etat) {

        $fiche = $this->findOneBy(array('idUser' => $idUser,
            'mois' => $mois));
        $fiche->setEtat($etat);
        $fiche->setDateModif(new \DateTime('now'));
        $this->_em->persist($fiche);
        $this->_em->flush();
    }

    /**
     * met à jour le nombre de justificatifs de la table ficheFrais
     * pour le mois et le visiteur concerné
     *
     * @param $idUser
     * @param $mois sous la forme aaaamm
     */
    public function majNbJustificatifs($idUser, $mois, $nbJustificatifs) {
        $fiche = $this->findOneBy(array('idUser' => $idUser,
            'mois' => $mois));
        $fiche->setNbJustificatifs($nbJustificatifs);
        $this->_em->persist($fiche);
        $this->_em->flush();
    }

    /**
     * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
     *
     * @param $idUser
     * @param $mois sous la forme aaaamm
     * @return vrai ou faux
     */
    public function estPremierFraisMois($idUser, $mois) {
        $fiche = $this->findOneBy(array('idUser' => $idUser,
            'mois' => $mois));
        if ($fiche) return true;
        else return false;

    }


    /**
     * Retourne le dernier mois en cours d'un visiteur
     *
     * @param $idUser
     * @return le mois sous la forme aaaamm
     */
    public function dernierMoisSaisi($idUser) {

        return $this->createQueryBuilder('fiche_frais')
            ->select('MAX(fiche_frais.mois) as dernierMois')
            ->where('fiche_frais.idUser =:idUser')
            ->setParameter('idUser', $idUser)
            ->getQuery()->getResult();
    }

    /**
     * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
     *
     * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
     * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles
     * @param $idUser
     * @param $mois
     */
    public function creerNouvellesLignesFrais($idUser, $mois){
        $dernierMois = $this->dernierMoisSaisi($idUser);
        $laDerniereFiche = $this->getLesInfosFicheFrais($idUser, $dernierMois);
        if($laDerniereFiche->getEtat()->getId() == 'RB') $this->majEtatFicheFrais($idUser, $dernierMois, 'CL');
        $newFiche = new FicheFrais();
        $newFiche->setVisiteur($idUser);
        $newFiche->setMois($mois);
        $newFiche->setNbJustificatifs(0);
        $newFiche->setMontantValide(0);
        $newFiche->setIdEtat('CR');

        $repository = $this->getDoctrine()
            ->getRepository('GSBBundle:FraisForfait');
        $lesIdFrais = $repository->getLesIdFrais();

        //TODO pour chaque ID FRAIS
        // On ajoute une nouvelle LignesFraisForfait en DB

    }




}
