<?php
function verifierMotDePasse($motDePasse) {
    // Vérifier la longueur du mot de passe
    if (strlen($motDePasse) < 8 || strlen($motDePasse) > 50) {
        return false;
    }

    // Vérifier la présence d'au moins un chiffre
    if (!preg_match("/[0-9]/", $motDePasse)) {
        return false;
    }

    // Vérifier la présence d'au moins une majuscule
    if (!preg_match("/[A-Z]/", $motDePasse)) {
        return false;
    }

    // Vérifier la présence d'au moins une minuscule
    if (!preg_match("/[a-z]/", $motDePasse)) {
        return false;
    }

    // Vérifier la présence d'au moins un caractère spéciale
    if (!preg_match("/[!@#$%^&*(),.?:{}|<>]/", $motDePasse)) {
    return false;
    }

    // Si toutes les conditions sont remplies, le mot de passe est valide
    return true;
}