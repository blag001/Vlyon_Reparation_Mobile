CREATE OR REPLACE PROCEDURE modifEtat
(pCodeInt IN BONINTERV.BI_Num%TYPE,
pDureeInt IN BONINTERV.BI_Duree%TYPE)
IS
	err_Etat Exception;

BEGIN

IF existeEtat(pCodeInt) = True THEN
		UPDATE BONINTERV
		SET BI_Duree = pDureeInt
		WHERE BI_Num = pCodeInt;
	ELSE
		Raise err_Etat;
END IF;

EXCEPTION

	WHEN err_Etat THEN
	INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)
	VALUES(,"L’intervention n’existe pas",sysdate());
END;