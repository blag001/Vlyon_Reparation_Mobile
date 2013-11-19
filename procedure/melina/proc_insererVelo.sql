CREATE OR REPLACE PROCEDURE insererVelo
(pNumVelo     IN VELO.Vel_Num%TYPE,
 pStationVelo IN VELO.Vel_Station%TYPE,
 pEtatVelo    IN VELO.Vel_Etat%TYPE,
 pTypeVelo    IN VELO.Vel_Type%TYPE)
IS 
	sCodeVelo integer;
BEGIN
	IF (existeVelo(pNumVelo)=false) THEN
		sCodeVelo := nouveauCodeVelo();
		INSERT INTO VELO (Vel_Num, Vel_Station, Vel_Etat, Vel_Type, Vel_Accessoire, Vel_Casse)
		VALUES (sCodeVelo, pStationVelo, pEtatVelo, pTypeVelo, 0, 0);
	ELSE
		INSERT INTO AUDITS(Aud_Code, Aud_Libelle)
		VALUES (seq_audits.NEXTVAL, 'Le velo existe deja');
	END IF;
COMMIT WORK;
END;
/
