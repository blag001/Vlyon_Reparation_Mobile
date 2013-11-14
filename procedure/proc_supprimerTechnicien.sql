CREATE OR REPLACE PROCEDURE SupprimerTechnicien
(pNomTech IN TECHNICIEN.Tech_Nom%type )
IS
BEGIN 
	IF (existeTechnicien(pNomTech,pPrenomTech) = TRUE ) THEN
		DELETE FROM Technicien
		WHERE Tec_Nom = pNomTech;
		COMMIT;
	END IF;	
 END ;
/