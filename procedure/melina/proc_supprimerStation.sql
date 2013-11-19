CREATE OR REPLACE PROCEDURE supprimerStation
(pCodeStation IN STATION.Sta_Code%TYPE)
IS
BEGIN
	IF (nbVelo(pCodeStation)=0) THEN
		DELETE FROM STATION
		WHERE Sta_Code = pCodeStation;
	ELSE
		INSERT INTO AUDITS(Aud_Code, Aud_Libelle)
		VALUES (seq_audits.NEXTVAL, 'La station contient des velos');
	END IF;
END;
/
