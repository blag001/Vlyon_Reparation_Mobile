<?php
// on load la class
require_once('model/Bdd.class.php');

// creation de l'obj
// args : ($host, $db_name, $user, $mdp)
Bdd $_SESSION['bdd'] = new Bdd();