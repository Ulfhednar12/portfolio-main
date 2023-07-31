<?php
try{ 
    $server_name = 'localhost'; // connecté au "nom du serveur"
    $db_name = 'portefolio' ;// connecté au nom de la table dans la bdd ( définie une variable reliant au nom correspondant de la table)
    $user_name = 'root';//mdp pour entrer dans la bdd
    $password = '' ;
   $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8mb4", $user_name, $password);// $db= variable définie pour nouvelle connection a la bdd en PDO
   //echo 'connexion reussie👀';
    
} catch(PDOException $e) {//$e en cas d'echec retourne le message qui correspond a l'echec
    echo 'echec de connexion : ' . $e-> getMessage();// echo= pour afficher a l'ecran
}