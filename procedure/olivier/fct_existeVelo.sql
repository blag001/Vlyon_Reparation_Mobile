CREATE OR REPLACE FUNCTION existeVelo
(pNumVelo IN VELO.Vel_Num%TYPE)
RETURN boolean
IS
	iNb integer;
BEGIN
	SELECT COUNT(Vel_Num)
	INTO iNb
	FROM VELO
	WHERE Vel_Num = pNumVelo;

	RETURN (iNb=1);
END;
/