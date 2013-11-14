CREATE OR REPLACE FUNCTION existFI
(pCodeInt IN FICHE_INTERVENTION.FI_Num%TYPE)
Return boolean
IS

	iNb Number;
BEGIN
	SELECT count(FI_NUM) INTO iNb
	FROM FICHE_INTERVENTION
	WHERE FI_Num = pCodeInt;

	Return (iNb >=1);

END;
