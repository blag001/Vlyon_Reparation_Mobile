Vlyon_Reparation_Mobile Fichier read-me
=======================================

_Ceci est un fichier Read-me, il résume la structure globale et le rôle des différents dossier._

Arborescence principale
-----------------------

* `/curent/`
	contient le site a l'état actuel, c'est ce dossier qu'il faut copier pour une mise en environnement de test.
* `/gantt/`
	contient le gantt du projet, avec les différentes tache, leur réalisation, attribution, ainsi que leur évolution.
* `/maquettes/`
	regroupe les maquettes de l’application
* `/modelisation/`
	MCD et MPD de la base
* `/procedure/`
	contient les procédure Oracle réalisé antérieurement
* `/sql/`
	contient les scripts SQL de mise en place de la BDD : c'est ici que vous trouverez le `Creer_reparation_mysql.sql` qui installe la BDD sur un environnement MySql.
	Vous y trouverez aussi un fichier de DATA qui permet de remplir partiellement la BDD afin de réaliser les tests.
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
* importez le fichier `/sql/Creer_reparation_mysql.sql`
* faite de même avec `/sql/data_test_mysql.sql`
* changez les valeurs id/mdp dans `/inc/connexion.inc.php` cf (1)

(1) :
> si vous avez un compte "root"/"", passez `new Bdd(null, null, null, null)`
> sinon, ajoutez un utilisateur et changez les valeurs en respectent le format
> `new Bdd($host, $db_name, $user, $mdp)`,
> passez null ou FALSE pour garder des valeur par defaut
> voir `/toolSql/Bdd.class.php` pour plus d'info

Normalement vous devriez avoir une Bdd operationnel, il ne vous reste que les page php

### Web

Simple a realiser :
* Copiez le contenue de `/curent/` dans votre dossier de test
* sur un system unix, passez le CHMOD a 777 pour le test (**le dossier racine de l'app doit être écrivable par PHP**)
* Les identifiants de connexion a l'app via l'interface web sont root / root
