CREATE OR REPLACE PROCEDURE affecterVelo
(pCodeVel IN VELO. Vel_Num %TYPE)
IS
	sCodeStation STATION.Sta_Code%TYPE;
	err_Velo Exception;

BEGIN
	SELECT MAX(Sta_Code) into sCodeStation
	FROM STATION
	WHERE Sta_NbAttacDispo >= 1;
	

	IF sCodeStation IS NOT NULL THEN
		UPDATE STATION
		SET Sta_NbAttacDispo = Sta_NbAttacDispo -1
		WHERE STA_Code = sCodeStation;

		UPDATE VELO
		SET VEL_ETAT = 1
		WHERE Vel_Num = pCodeVel;
		
	ELSE
		Raise err_Velo;
	END IF;
EXCEPTION

	WHEN err_Velo THEN	
		INSERT INTO AUDITS(AUD_NUMERO, AUD_LIBELLE,AUD_DATE)
		VALUES(,"Aucune Station vide",sysdate());
		
END;