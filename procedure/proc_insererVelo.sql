CREATE OR REPLACE POROCEDURE insererVelo
(pCodeVelo IN VELO.Vel_Code%TYPE)
IS 
	sCodeVelo integer;
BEGIN
	SELECT MAX(Vel_Code)+1
	INTO sCodeVelo
	FROM VELO;
	
	IF existeVelo()=false THEN
		INSERT INTO VELO (Vel_Code, Vel_Casse)
		VALUES (sCodeVelo, 0);
COMMIT WORK;
END;
/