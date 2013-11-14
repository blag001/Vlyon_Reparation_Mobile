CREATE OR REPLACE PROCEDURE modifDureeInt
(pCodeInt IN FICHE_INTERVENTION.FI_Num%TYPE,
pDureeInt IN FICHE_INTERVENTION.FI_Duree%TYPE)
IS
	err_Fiche Exception;

BEGIN
	IF existFI(pCodeInt) = True THEN
		UPDATE FICHE_INTERENTION
		SET FI_Duree = pDureeInt
		WHERE FI_NUM = pCodeInt;
	ELSE
		Raise err_Fiche;

EXCEPTION

	WHEN err_Fiche THEN
	INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)
	VALUES(,’Fiche non existante’,);
END;