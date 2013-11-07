CREATE OR REMPLACE PROCEDURE InsererIntervention
(
	pTec_Matric IN TECHNICIEN.Tec_Matric%TYPE,
	pDem_Num IN DEMANDEINTER.DEM_Num%TYPE
)
IS
	iBI_Num INTEGER := 1;
BEGIN
	IF pDem_Num <> null THEN

	ELSE
		iBI_Num := 
		INSERT INTO BONINTERV (BI_NUM, BI_Velo, BI_DatDebut, BI_Technicien, BI_SurPlace)
		VALUES ()