CREATE OR REPLACE FUNCTION existeProduit
(pLibellePdt IN PRODUIT.Pdt_Libelle%TYPE)
RETURN boolean
IS
	iNb integer;
BEGIN
	SELECT COUNT(Pdt_Libelle)
	INTO iNb
	FROM PRODUIT
	WHERE Pdt_Libelle = pLibellePdt;

	RETURN (iNb=1);
END;
/