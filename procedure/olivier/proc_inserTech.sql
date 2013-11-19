CREATE OR REPLACE PROCEDURE InserTechnicien
(pNomTech in TECHNICIEN.TEC_NOM%TYPE,
pPrenomTech in TECHNICIEN.TEC_PRENOM%TYPE)
IS 
	sCode TECHNICIEN.Tec_Matricule%TYPE;
	err_doublon Exception;
BEGIN 
	IF (existeTechnicien(pNomTech,pPrenomTech) = FALSE ) THEN
		SELECT MAX(TO_NUMBER(Tec_Matricule))
		INTO sCode
		FROM TECHNICIEN;
		
	/*	sCode := TO_NUMBER(sCode);*/
		sCode := sCode+1;
		sCode := TO_CHAR(sCode);
		
		INSERT INTO TECHNICIEN(Tec_Matricule, Tec_Nom, Tec_Prenom)
		VALUES (sCode, pNomTech, pPrenomTech);
		
	ELSE
		RAISE err_doublon;

	END IF;	
	
EXCEPTION 
	WHEN err_doublon THEN
	INSERT INTO AUDITS(AUD_NUMERO,AUD_LIBELLE)
	VALUES (sCode, 'Erreur lors du technicien, il existe deja');
END;
