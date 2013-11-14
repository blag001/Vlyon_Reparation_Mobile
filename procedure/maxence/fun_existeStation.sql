CREATE OR REPLACE FUNCTION existeStation
(pCodeSta IN STATION.Sta_Code%TYPE)
Return boolean
IS

	iNb Number;
BEGIN
	SELECT count(Sta_Code) INTO iNb
	FROM STATION
	WHERE Sta_Code = pCodeSta;

	Return (iNb >=1);

END;