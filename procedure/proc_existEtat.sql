CREATE OR REPLACE FUNCTION existEtat
(pCodeEtat IN ETAT.eta_Code%TYPE)
Return boolean
IS

	iNb Number;
BEGIN
	SELECT count(eta_Code) INTO iNb
	FROM ETAT
	WHERE eta_Code = pCodeEtat;

	Return (iNb >=1);

END;
