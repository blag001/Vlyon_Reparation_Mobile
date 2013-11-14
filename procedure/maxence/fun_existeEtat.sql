CREATE OR REPLACE FUNCTION existeEtat
(pCodeEtat IN ETAT.Eta_Code%TYPE)
Return boolean
IS

	iNb Number;
BEGIN
	SELECT count(Eta_Code) INTO iNb
	FROM ETAT
	WHERE Eta_Code = pCodeEtat;

	Return (iNb >=1);

END;