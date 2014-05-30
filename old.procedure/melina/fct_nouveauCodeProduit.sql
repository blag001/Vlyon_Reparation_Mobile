CREATE OR REPLACE FUNCTION nouveauCodeProduit
RETURN PRODUIT.Pdt_Code%TYPE
IS 
	sCodeProduit PRODUIT.Pdt_Code%TYPE;
BEGIN
	SELECT MAX(Pdt_Code)
	INTO sCodeProduit
	FROM PRODUIT;
	
	IF (sCodeProduit IS NULL) THEN
		sCodeProduit := 1;
	ELSE
		sCodeProduit := TO_NUMBER(sCodeProduit);
		sCodeProduit := sCodeProduit + 1;
		sCodeProduit := TO_CHAR(sCodeProduit);
	END IF;
	
	RETURN sCodeProduit;
END;
/
