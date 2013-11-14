CREATE OR REPLACE PROCEDURE insererProduit
(pDesignProduit IN PRODUIT.Pro_Design%TYPE)
IS
	iNbRef integer;
BEGIN
	SELECT MAX(Pro_Ref)+1
	INTO iNbRef
	FROM PRODUIT;
	
	IF existeProduit()=false THEN
		INSERT INTO PRODUIT(Pro_ref, Pro_Design, Pro_Prix, Pro_QteStock, Pro_NbVol, Pro_NbCasse)
		VALUES (iNbRef, pDesignProduit, 0, 0, 0, 0);
COMMIT WORK;
END;
/