CREATE OR REPLACE FUNCTION nouveauCodeVelo
RETURN VELO.Vel_Num%TYPE
IS 
	sCodeVelo VELO.Vel_Num%TYPE;
BEGIN
	SELECT MAX(Vel_Num)
	INTO sCodeVelo
	FROM VELO;
	
	IF (sCodeVelo IS NULL) THEN
		sCodeVelo := 1;
	ELSE
		sCodeVelo := TO_NUMBER(sCodeVelo);
		sCodeVelo := sCodeVelo + 1;
		sCodeVelo := TO_CHAR(sCodeVelo);
	END IF;
	
	RETURN sCodeVelo;
END;
/
