CREATE OR REPLACE FUNCTION MaxCode_BONINTERV
	RETURN number
IS
	sCodeProd BONINTERV.BI_Num%type;
BEGIN
	SELECT MAX(Pdt_Code)
	INTO sCodeProd
	FROM PRODUIT;
	IF sCodeProd IS NULL THEN
		sCodeProd := 1;
	ELSE
		sCodeProd := TO_NUMBER(sCodeProd);
		sCodeProd := sCodeProd + 1;
		sCodeProd := TO_CHAR(sCodeProd);
	END IF;
	
	RETURN sCodeProd;
END;
/
	