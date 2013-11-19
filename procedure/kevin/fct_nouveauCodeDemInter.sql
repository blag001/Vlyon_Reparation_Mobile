CREATE OR REPLACE FUNCTION nouveauCodeDemInterv
RETURN DEMANDEINTER.DemI_Num%TYPE
IS

	sCode DEMANDEINTER.DemI_Num%TYPE;
	
BEGIN
	select  max(DemI_Num)
	into sCode
	from DEMANDEINTER;
	
	IF (sCode IS NULL) THEN
		sCode := 1;
	ELSE
		sCode:= TO_NUMBER(sCode);
		sCode:= sCode + 1;
		sCode:= TO_CHAR(sCode);
	END IF;
	
	return sCode;
END;
	