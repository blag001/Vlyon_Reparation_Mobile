CREATE OR REPLACE FUNCTION existeVelo
(
	pNumVel IN VELO.Vel_Num%TYPE
)
RETURN boolean
IS
	iNb integer;
BEGIN
	SELECT COUNT(*)
	INTO iNb
	FROM VELO
	WHERE Vel_Num = pNumVel;

	RETURN (iNb=1);
END;
/