CREATE OR REPLACE PROCEDURE InserTechnicien
(pNomTech in TECHNICIEN.TEC_NOM%TYPE)
IS 
	sCode TECHNICIEN.Tec_Matricule%TYPE;
	err_doublon Exception;
BEGIN 
	IF (existeTechnicien(pNomTech) = FALSE ) THEN
		SELECT MAX(Tec_Matricule)+1
		INTO sCode
		FROM TECHNICIEN;
		
		INSERT INTO TECHNICIEN(Tec_Matricule, Tec_Nom, Tec_Prenom)
		VALUES (sCode, pNomTech, pPrenomTech);
		
	ELSE
		RAISE err_doublon

	END IF;	
	
EXCEPTION 
	WHEN err_doublon THEN
	INSERT INTO AUDITS(AUD_NUMERO,AUD_LIBELLE)
	VALUES (sCode, 'Erreur lors du technicien, il existe deja')
END;
/