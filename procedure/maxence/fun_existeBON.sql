CREATE OR REPLACE FUNCTION existeBon(
	pCodeBon IN BONINTERV.BI_Num%TYPE
	)
	Return boolean
IS

	iNb Number;
BEGIN
	SELECT count(BI_Num) INTO iNb
	FROM BONINTERV
	WHERE BI_Num = pCodeBon;

	Return (iNb >=1);
END;