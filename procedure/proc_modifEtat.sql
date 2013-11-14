CREATE OR REPLACE PROCEDURE modifEtat
(pCodeInt IN FICHE_INTERVENTION.FI_Num%TYPE,
pDureeInt IN FICHE_INTERVENTION.FI_Duree%TYPE)
IS
	err_Etat Exception;

BEGIN
	



IF existEtat(pCodeInt) = True THEN
		UPDATE FICHE_INTERENTION
		SET FI_Duree = pDureeInt
		WHERE FI_NUM = pCodeInt;
	ELSE
		Raise err_Etat;
END IF;
EXCEPTION

	WHEN err_Etat THEN
	INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)
	VALUES(,’L’intervention n’existe pas’,);
END;
