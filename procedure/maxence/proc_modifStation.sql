CREATE OR REPLACE PROCEDURE modifStation
(pCodeSta IN STATION.Sta_Code%TYPE,
pNbAttaches IN STATION.Sta_NbAttaches%TYPE,
pNbAttachDispo STATION.Sta_NbAttacDispo%TYPE)
IS
	err_STATION Exception;

BEGIN

IF existeStation(pCodeSta) = True THEN
		IF pNbAttaches IS NOT NULL THEN
			UPDATE STATION
			SET Sta_NbAttaches = pNbAttaches
			WHERE Sta_Code = pCodeSta
		END IF;
		
		IF pNbAttacDispo IS NOT NULL THEN
			UPDATE STATION
			SET Sta_NbAttacDispo = pNbAttacDispo
			WHERE Sta_Code = pCodeSta
		END IF;

	ELSE
		Raise err_STATION;
END IF;
EXCEPTION

	WHEN err_STATION THEN
		INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)
		VALUES(,’La station n’existe pas’,sysdate());
END;
