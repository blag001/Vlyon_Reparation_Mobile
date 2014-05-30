CREATE OR REPLACE PROCEDURE ModifierDemInter
(
	pDemI_Num IN DEMANDEINTER.DemI_Num%TYPE,
	pEta_Libelle IN ETAT.Eta_Libelle%TYPE
)
IS
	sEta_Code ETAT.Eta_Code%TYPE;
	sVel_Num VELO.Vel_Num%TYPE;
	
	err_DemandeI_nofound Exception;
	err_Etat_nofound Exception;
BEGIN
	IF existeDemandeI(pDemI_Num) THEN
		IF existeEtat(pEta_Libelle) THEN
			SELECT Eta_Code INTO sEta_Code
			FROM ETAT
			WHERE Eta_Libelle = pEta_Libelle;

			SELECT DemI_Velo INTO sVel_Num
			FROM DEMANDEINTER
			WHERE DemI_Num = pDemI_Num;

			UPDATE VELO 
			SET Vel_Etat = sEta_Code
			WHERE Vel_Num = sVel_Num;
		ELSE
			RAISE err_Etat_nofound;
		END IF;
	ELSE
		RAISE err_DemandeI_nofound;
	END IF;

COMMIT;
EXCEPTION 
	WHEN err_Etat_nofound THEN
		INSERT INTO AUDITS(Aud_Code, Aud_Libelle)
		VALUES (seq_audits.NEXTVAL, 'Etat inexistant');

	WHEN err_DemandeI_nofound THEN
		INSERT INTO AUDITS(Aud_Code, Aud_Libelle)
		VALUES (seq_audits.NEXTVAL, 'Demande intervention inexistant');
END;
/
