-- Script d'insertion de donnees

-- `Sta_Code`,`Sta_Nom`,`Sta_Rue`,`Sta_NbAttaches`,`Sta_NbVelos`,`Sta_NbAttacDispo`,`Sta_NbTotLoc`,`Sta_NbVols`,`Sta_NbDegrad`
INSERT INTO station
	VALUES ('1023', 'Fondcombe', '15 Avenue des Monts Brumeux', 20, 0, 20, 0, 0, 0);
INSERT INTO station
	VALUES ('1024', 'La Comté', '405 place de la Terre du Milieu', 20, 0, 20, 0, 0, 0);
INSERT INTO station
	VALUES ('2001', 'Minas Tirith', 'Avenue du Gondor', 30, 0, 30, 0, 0, 0);
INSERT INTO station
	VALUES ('2009', 'Montagne du Destin', '1 rue du Mordor', 30, 0, 30, 0, 0, 0);
INSERT INTO station
	VALUES ('3029', 'Gouffre de Helm', 'Lieu dit du Rohan', 15, 0, 15, 0, 0, 0);
INSERT INTO station
	VALUES ('3030', 'La Moria', '342 Avenue des Monts Brumeux', 20, 0, 20, 0, 0, 0);
INSERT INTO station
	VALUES ('4001', 'Erebor', 'Lieu dit du Rhovanion', 20, 0, 20, 0, 0, 0);

-- `Eta_Code`, `Eta_Libelle`
INSERT INTO etat
	VALUES (null, 'Opérationnel');
INSERT INTO etat
	VALUES (null, 'Détérioré');
INSERT INTO etat
	VALUES (null, 'Non restitué');
INSERT INTO etat
	VALUES (null, 'Volé');
INSERT INTO etat
	VALUES (null, 'En circulation');
INSERT INTO etat
	VALUES (null, 'En révision');

-- `Pdt_Code`,`Pdt_Libelle`,`Pdt_Poids`,`Pdt_PxCMUP`,`Pdt_QteStk`,`Pdt_NbVols`,`Pdt_NbCasses`
INSERT INTO produit
	VALUES ('A', 'VTT', 13, 250, 5, 0, 0);
INSERT INTO produit
	VALUES ('B', 'VTC', 10, 200, 15, 0, 0);
INSERT INTO produit
	VALUES ('C', 'VAE', 35, 1500, 20, 0, 0);

-- `Tec_Matricule`, `Tec_Nom`, `Tec_Prenom`
INSERT INTO technicien
	VALUES (null, 'Dupon', 'paul');
INSERT INTO technicien
	VALUES (null, 'Delarive', 'jean');
INSERT INTO technicien
	VALUES (null, 'Wrong', 'li');

-- `Vel_Num`, `Vel_Station`, `Vel_Etat`, `Vel_Type`, `Vel_Accessoire`, `Vel_Casse`
INSERT INTO velo
	VALUES (null, '1024', 1, 'B', 'panier', 0);
INSERT INTO velo
	VALUES (null, '1024', 1, 'B', 'panier', 0);
INSERT INTO velo
	VALUES (null, '1024', 1, 'B', 'panier', 0);
INSERT INTO velo
	VALUES (null, '1024', 1, 'B', 'panier', 0);
INSERT INTO velo
	VALUES (null, '1024', 1, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '1024', 1, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '1024', 1, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '1024', 2, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '2001', 1, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '2001', 1, 'B', '', 0);
INSERT INTO velo
	VALUES (null, '2001', 1, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '2009', 1, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '2009', 2, 'B', 'panier', 0);
INSERT INTO velo
	VALUES (null, '1024', 2, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '3029', 1, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '3030', 1, 'A', '', 0);
INSERT INTO velo
	VALUES (null, '4001', 2, 'A', 'panier', 0);
INSERT INTO velo
	VALUES (null, '4001', 1, 'A', 'panier', 0);
INSERT INTO velo
	VALUES (null, '4001', 2, 'A', 'panier', 0);
INSERT INTO velo
	VALUES (null, '4001', 4, 'A', 'panier', 0);
INSERT INTO velo
	VALUES (null, '4001', 2, 'A', 'panier', 1);

-- `DemI_Num`, `DemI_Velo`, `DemI_Date`, `DemI_Technicien`, `DemI_Motif`, `DemI_Traite`
INSERT INTO demandeinter
	VALUES (null, '1', '2013-12-11', '1', 'changer la roue', 1);
INSERT INTO demandeinter
	VALUES (null, '4', '2013-12-11', '1', 'changer les freins', 0);
INSERT INTO demandeinter
	VALUES (null, '5', '2013-12-11', '2', 'changer la roue', 0);
INSERT INTO demandeinter
	VALUES (null, '7', '2013-06-18', '2', 'changer dynamo', 1);

-- `BI_Num`, `BI_Velo`, `BI_DatDebut`, `BI_DatFin`, `BI_CpteRendu`, `BI_Reparable`, `BI_Demande`, `BI_Technicien`, `BI_SurPlace`, `BI_Duree`
INSERT INTO boninterv
	VALUES (null, '7', '2013-06-18', '2013-06-18', 'usure naturel', '1', '1', '1', '1', '1');
INSERT INTO boninterv
	VALUES (null, '2', '2013-02-14', '2013-02-14', 'casse de la pedale', '1', '4', '1', '1', '1');

-- `Use_Num`, `Use_Nom`, `Use_Hash`, `Use_RespAchat`, `Use_Technicien`
INSERT INTO user
		-- id/password : root/root
	VALUES( null, 'tech1', '982a3889dd35194eb495b842e7eecfc9e4e1404621aadc51f68e850782bb791faffd144dd47016a337eb5f5ccc287b15f7af9262f56f3f44b649c038f2e3a40d', 0, 1);
	VALUES( null, 'tech2', '2352f9faca2f2d2d0fa9036d7bb445096426246419020f8038204e2cb7410d94b62cdcd3893ef3cb04898696e00bdde905e68fe1dad2b3ec214dd0fbd67c1219', 0, 1);
	VALUES( null, 'tech3', '5903b77dfbd4d78886b2715868d90b1f9821bd33519bf03dcc27f0c2fc7ca5e40dd577162da15f2e2e8956837d89f24859d03a6617ce05d23e2541b042a2a4e1', 0, 1);
