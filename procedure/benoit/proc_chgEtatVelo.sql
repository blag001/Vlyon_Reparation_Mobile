CREATE OR REPLACE PROCEDURE ChangerEtatVelo
(
	pVel_Num IN VELO.Vel_Num%TYPE,
	pEta_Libelle IN ETAT.Eta_Libelle%TYPE
)
IS
	sEta_Code ETAT.Eta_Code%TYPE;
	
	err_etat_nofound Exception;
BEGIN
	IF existeEtat(pEta_Libelle) THEN
		SELECT Eta_Code IN TO sEta_Code
		FROM ETAT
		WHERE Eta_Libelle = pEta_Libelle;

		UPDATE VELO
		SET Vel_Etat = sEta_Code
		WHERE Vel_Num = pVel_Num;
	ELSE
		RAISE err_etat_nofound;
	END IF;

COMMIT;

EXCEPTION 
	WHEN err_etat_nofound THEN
		INSERT INTO AUDITS(AUD_NUMERO,AUD_LIBELLE)
		VALUES (sCode, 'Etat inexistant')
END;
/