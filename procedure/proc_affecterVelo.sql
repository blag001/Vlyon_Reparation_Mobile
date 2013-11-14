CREATE OR REPLACE PROCEDURE affecterVelo
(pCodeVel IN VELO.VEL_Code%TYPE)
IS
	CodeStation STATION.Sta_Code%TYPE;
	err_Velo Exception;

BEGIN
	SELECT Sta_NbAttacDispo into CodeStation
	FROM STATION
	WHERE Sta_NbAttacDispo <= 1
	AND LIMIT 1;

	IF CodeStation <= 1 THEN
		UPDATE STATION
		SET Sta_NbAttacDispo = Sta_NbAttacDispo -1
		WHERE STA_Code = CodeStation;

		UPDATE ETAT
		SET ETA_LIBELLE = «En Fonctionnement »
		WHERE VEL_Code = pCodeVel
		AND VEL_Etat = ETA_Code; 
	ELSE
		Raise err_Velo;

EXCEPTION

	WHEN err_Velo THEN	
	INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)
	VALUES(,’Aucune Station vide’,);
		
END;

