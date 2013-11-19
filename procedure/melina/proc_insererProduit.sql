CREATE OR REPLACE PROCEDURE insererProduit
(pLibellePdt IN PRODUIT.Pdt_Libelle%TYPE)
IS
	sCodeProduit integer;
BEGIN
	IF (existeProduit(pLibellePdt)=false) THEN
		sCodeProduit := nouveauCodeProduit();
		INSERT INTO PRODUIT(Pdt_Code, Pdt_Libelle, Pdt_Poids, Pdt_PxCMUP, Pdt_QteStk, Pdt_NbVols, Pdt_NbCasses)
		VALUES (sCodeProduit, pLibellePdt,0, 0, 0, 0, 0);
	END IF;
COMMIT WORK;
END;
/