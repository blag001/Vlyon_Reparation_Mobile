CREATE OR REPLACE PROCEDURE modifDureeInt
(pCodeInt IN BONINTERV.BI_Num%TYPE,
pDureeInt IN BONINTERV.BI_Duree%TYPE)
IS
	err_Fiche Exception;

BEGIN
	IF existeBON(pCodeInt) = True THEN
		UPDATE BONINTERV
		SET BI_Duree = pDureeInt
		WHERE BI_NUM = pCodeInt;
	ELSE
		Raise err_Fiche;
	END IF;	
EXCEPTION

	WHEN err_Fiche THEN
	INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)
	VALUES(,"Fiche non existante",sysdate());
END;