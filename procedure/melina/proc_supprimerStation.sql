CREATE OR REPLACE PROCEDURE supprimerStation
(pCodeStation IN STATION.Sta_Code%TYPE)
IS
BEGIN
	IF (nbVelo(pCodeStation)=0) THEN
		DELETE FROM STATION
		WHERE Sta_Code = pCodeStation;
	END IF;
END;
/