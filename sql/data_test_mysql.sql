-- Script d'insertion de donnees

-- `Sta_Code`,`Sta_Nom`,`Sta_Rue`,`Sta_NbAttaches`,`Sta_NbVelos`,`Sta_NbAttacDispo`,`Sta_NbTotLoc`,`Sta_NbVols`,`Sta_NbDegrad`
INSERT INTO STATION
	VALUES ('1023', 'Les Palourdes', 'terre de mer', 20, 10, 10, 47, 0, 0);
INSERT INTO STATION
	VALUES ('1024', 'La comptee', 'terre du milieux', 20, 10, 10, 27, 1, 0);
INSERT INTO STATION
	VALUES ('2001', 'Minastirit', 'rue du Mordor', 30, 25, 5, 484, 0, 1);
INSERT INTO STATION
	VALUES ('2009', 'Bellecour', '1 rue de la Barre', 18, 16, 1, 484, 0, 1);
INSERT INTO STATION
	VALUES ('3029', 'Confluence les Docks', '40 quai Rambaud', 26, 2, 23, 484, 0, 1);
INSERT INTO STATION
	VALUES ('3030', 'Drumollet', '8 rue de la cote', 20, 15, 1, 484, 0, 1);
INSERT INTO STATION
	VALUES ('4001', 'Le plaine', '12quater allee des embrumes', 20, 2, 23, 484, 0, 1);

-- `Eta_Code`, `Eta_Libelle`
INSERT INTO ETAT
	VALUES (null, 'Fonctionnel');
INSERT INTO ETAT
	VALUES (null, 'Degard&eacute;');
INSERT INTO ETAT
	VALUES (null, 'Crev&eacute;');

-- `Pdt_Code`,`Pdt_Libelle`,`Pdt_Poids`,`Pdt_PxCMUP`,`Pdt_QteStk`,`Pdt_NbVols`,`Pdt_NbCasses`
INSERT INTO PRODUIT
	VALUES ('A', 'VTT', 13, 250, 5, 1, 0);
INSERT INTO PRODUIT
	VALUES ('B', 'VTC', 10, 200, 15, 4, 0);

-- `Tec_Matricule`, `Tec_Nom`, `Tec_Prenom`
INSERT INTO TECHNICIEN
	VALUES (null, 'dupon', 'paul');
INSERT INTO TECHNICIEN
	VALUES (null, 'dupon', 'pierre');

-- `Vel_Num`, `Vel_Station`, `Vel_Etat`, `Vel_Type`, `Vel_Accessoire`, `Vel_Casse`
INSERT INTO VELO
	VALUES (null, '1024', 1, 'B', 'panier', 0);
INSERT INTO VELO
	VALUES (null, '1024', 1, 'B', 'panier', 0);
INSERT INTO VELO
	VALUES (null, '1024', 1, 'B', 'panier', 0);
INSERT INTO VELO
	VALUES (null, '1024', 1, 'B', 'panier', 0);
INSERT INTO VELO
	VALUES (null, '1024', 2, 'A', '', 0);
INSERT INTO VELO
	VALUES (null, '2001', 1, 'A', '', 0);
INSERT INTO VELO
	VALUES (null, '2009', 1, 'A', '', 0);
INSERT INTO VELO
	VALUES (null, '2009', 2, 'B', 'panier', 0);
INSERT INTO VELO
	VALUES (null, '1024', 2, 'A', '', 0);
INSERT INTO VELO
	VALUES (null, '3029', 1, 'A', '', 0);
INSERT INTO VELO
	VALUES (null, '3030', 1, 'A', '', 0);
INSERT INTO VELO
	VALUES (null, '4001', 2, 'A', 'panier', 0);
INSERT INTO VELO
	VALUES (null, '4001', 1, 'A', 'panier', 0);

-- `DemI_Num`, `DemI_Velo`, `DemI_Date`, `DemI_Technicien`, `DemI_Motif`, `DemI_Traite`
INSERT INTO DEMANDEINTER
	VALUES (null, '1', '2013-12-11', '1', 'changer la roue', 0);
INSERT INTO DEMANDEINTER
	VALUES (null, '4', '2013-12-11', '1', 'changer les freins', 0);
INSERT INTO DEMANDEINTER
	VALUES (null, '5', '2013-12-11', '2', 'changer la roue', 0);
INSERT INTO DEMANDEINTER
	VALUES (null, '7', '2013-06-18', '2', 'changer dynamo', 1);

-- `BI_Num`, `BI_Velo`, `BI_DatDebut`, `BI_DatFin`, `BI_CpteRendu`, `BI_Reparable`, `BI_Demande`, `BI_Technicien`, `BI_SurPlace`, `BI_Duree`
INSERT INTO BONINTERV
	VALUES (null, '7', '2013-06-18', '2013-06-18', 'usure naturel', '1', '', '1', '1', '0');
INSERT INTO BONINTERV
	VALUES (null, '2', '2013-02-14', '2013-02-14', 'casse de la pedale', '1', '', '1', '1', '0');

INSERT INTO USER
	VALUES( null, 'root', '6779bcb1f994927795f01178c45b345a36cdabef683618d11e85489441482dd55ad241d920b466418c5b865a4f96aa0fd1cd76a206f66e58de650bb3d16a9806', 0, null);
