<?php
namespace GSBBundle\Services;
/**
 * Class DateManager
 * @package GSBBundle\Services
 */
class DateManager
{
    /**
     * Retourne un DateTime depuis une date au format YYYYMM
     *
     * @param $date string au format YYYYMM
     * @return \DateTime
     */
    public function YYYYMMToDateTime($date)
    {
        $mois = substr($date, -2);
        $annee = substr($date, -6, 4);
        $laDate = new \DateTime();
        $laDate->setDate((int)$annee, (int)$mois, 1);
        return $laDate;
    }
    /**
     * Retourne un string depuis un dateTime
     * @param $date \DateTime
     * @return string au format YYYYMM
     */
    public function DateTimeToYYYYMM($date)
    {
        $annee = $date->format('Y');
        $mois = $date->format('m');
        return $annee.$mois;
    }
}