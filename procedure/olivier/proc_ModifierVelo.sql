CREATE OR REPLACE PROCEDURE ModifierVelo
(pVelNum IN Velo.vel_Num%TYPE,
pStationCode IN Station.Sta_Code%TYPE,
pCodeEtat IN ETAT.Eta_Code%TYPE,
pCasseVelo IN VELO.Vel_Casse%TYPE)
IS
	err_NotExiste Exception;
BEGIN 
	IF (existeVelo(pVelNum)) = TRUE THEN
		UPDATE VELO
		SET Vel_Station    =pStationCode,
			Vel_Etat       =pCodeEtat,
			Vel_casse      =pCasseVelo
		WHERE Vel_Num      =pVelNum;
	ELSE 
		RAISE err_NotExiste;
	END IF;
	COMMIT WORK;
EXCEPTION 
	WHEN err_NotExiste THEN
	INSERT INTO AUDITS(AUD_NUMERO,AUD_LIBELLE)
	VALUES (pVelNum,'existeDeja');

END;
	