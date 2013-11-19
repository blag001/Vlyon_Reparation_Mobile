CREATE OR REPLACE FUNCTION nbVelo
(pCodeStation IN STATION.Sta_Code%TYPE)
RETURN integer
IS
	iNbVelo integer;
BEGIN 
	SELECT COUNT (Vel_Num)
	INTO iNbVelo
	FROM VELO
	WHERE Vel_Station = pCodeStation ;
	
	RETURN (iNbVelo);
 END ;
/