CREATE OR REPLACE FUNCTION existeDemInterv
(pDemInterv IN DEMANDEINTER.DemI_Num%TYPE)
RETURN Boolean
IS
	iNb integer;
BEGIN
	SELECT COUNT(DemI_Num)
	INTO iNb
	FROM DEMANDEINTER
	WHERE DemI_Num = pDemInterv;
	RETURN(iNb = 1);
END;