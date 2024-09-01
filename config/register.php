<?php

function verifierMotDePasse($motDePasse) {
   
    if (strlen($motDePasse) < 8 || strlen($motDePasse) > 50) {
        return false;
    }


    if (!preg_match("/[0-9]/", $motDePasse)) {
        return false;
    }

   
    if (!preg_match("/[A-Z]/", $motDePasse)) {
        return false;
    }

    if (!preg_match("/[a-z]/", $motDePasse)) {
        return false;
    }

   
    if (!preg_match("/[!@#$%^&*(),.?:{}|<>]/", $motDePasse)) {
    return false;
    }

   
    return true;
}
