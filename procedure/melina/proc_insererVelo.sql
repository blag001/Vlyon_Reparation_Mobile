CREATE OR REPLACE PROCEDURE insererVelo
(pNumVelo IN VELO.Vel_Num%TYPE)
IS 
	sCodeVelo integer;
BEGIN
	IF (existeVelo(pNumVelo)=false) THEN
		sCodeVelo := nouveauCodeVelo();
		INSERT INTO VELO (Vel_Num, Vel_Casse)
		VALUES (sCodeVelo, 0);
	END IF;
COMMIT WORK;
END;
/