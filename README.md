﻿Vlyon_Reparation_Mobile Fichier read-me
=======================================

_Ceci est un fichier Read-me, il résume la structure globale et le rôle des différents dossier._

Arborescence principale
-----------------------

* `/current/`
	contient le site a l'état actuel, c'est ce dossier qu'il faut copier pour une mise en environnement de test.
* `/flowchartt/`
	contient les diagrames de flux des trigger.
* `/gantt/`
	contient le gantt du projet, avec les différentes tache, leur réalisation, attribution, ainsi que leur évolution.
* `/maquettes/`
	regroupe les maquettes de l’application
* `/modelisation/`
	MCD et MPD de la base
* `/procedure/`
	contient les procédure Oracle réalisé antérieurement
* `/sql/`
	contient les scripts SQL de mise en place de la BDD, utilisez dans l'ordre les trois (3) fichiers dans `./mysql/` pour une instalation sur Mysql.
* `/sujet/`
	le sujet à traiter
* `/uml/`
	le diagramme UML du projet

Mettre en place le site
-----------------------

Dans un permier temps, procurez vous le zip/clone de ce Git.

### MySql

Ensuite, sur un environement MySql :
* creez une base que vous nommerez `sio_reparation`
* importez les 3 fichiers de `/sql/mysql/*` dans l'ordre (1, puis 2 et 3)
* changez les valeurs id/mdp dans `/inc/connexion.inc.php` cf (1)

(1) :
> si vous avez un compte "root"/"", ne rien changer
> sinon, ajoutez un utilisateur et changez les valeurs en respectent le format
> `new Bdd($host, $db_name, $user, $mdp)`,
> passez null ou FALSE pour garder des valeur par defaut
> voir `/toolSql/Bdd.class.php` pour plus d'info

Normalement vous devriez avoir une Bdd operationnel, il ne vous reste que les page php

### Web

Simple à realiser :
* Copiez le contenue de `/current/` dans votre dossier de test
* sur un system unix, passez le CHMOD à 777 pour le test (**le dossier racine de l'app doit être écrivable par PHP**)
* Les identifiants de connexion à l'app via l'interface web sont "root" / "root" mais représente un compte ustilisateur
