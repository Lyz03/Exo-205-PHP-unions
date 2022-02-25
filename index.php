<?php

/**
 * Reproduisez les tables présentes dans le fichier image ( via workbench ou phpmyadmin )
 * Ajoutez des donées dans chaque table en vous assurant d'ajouter au moins 1 fois un utilisateur identique dans deux tables.
 * Utilisez UNION pour récupérer les usernames de chaque table, affichez le résultat à l'aide d'un print_r ou d'une boucle.
 * Utilisez UNION ALL pour afficher toutes les données y compris les doublons, affichez le résultat  à l'aide d'une boucle ou d'un print_r.
 * PS: Si vous utilisez un print_r, alors utilisez la balise <pre> pour un résultat plus propre.
 */

$db = new PDO('mysql:host=localhost;dbname=exo_205;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt = $db->prepare("
    SELECT username FROM user
    UNION 
    SELECT username FROM admin
    UNION 
    SELECT username FROM client
");

if ($stmt->execute()) {
    echo '<pre>';
    print_r($stmt->fetchAll());
    echo '</pre>';
}

$stmt = $db->prepare("
    SELECT username FROM user
    UNION ALL
    SELECT username FROM admin
    UNION ALL
    SELECT username FROM client
");

if ($stmt->execute()) {
    echo '<pre>';
    print_r($stmt->fetchAll());
    echo '</pre>';
}