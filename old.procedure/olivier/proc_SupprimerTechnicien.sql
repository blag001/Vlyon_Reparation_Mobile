CREATE OR REPLACE PROCEDURE SupprimerTechnicien
(pNomTech IN TECHNICIEN.Tec_Nom%type, 
pPrenomTech IN TECHNICIEN.Tec_Prenom%type)
IS
BEGIN 
	IF (existeTechnicien(pNomTech,pPrenomTech) = TRUE ) THEN
		DELETE FROM Technicien
		WHERE Tec_Nom = pNomTech
		AND Tec_Prenom= pPrenomTech;
		COMMIT;
	END IF;	
 END ;
/