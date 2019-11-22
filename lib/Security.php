<?php
class Security{

    private static $seed = '0502699722';

    public static function chiffrer($texte_en_clair) {
        $texte_chiffre = hash('sha256', static::$seed.$texte_en_clair);
        return $texte_chiffre;
    }
}