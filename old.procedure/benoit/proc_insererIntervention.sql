CREATE OR REPLACE PROCEDURE InsererIntervention
(
	pTec_Matric IN TECHNICIEN.Tec_Matricule%TYPE,
	pVel_Num IN VELO.Vel_Num%TYPE,
	pSurPlace IN BONINTERV.BI_SurPlace%TYPE,
	pReparable IN BONINTERV.BI_Reparable%TYPE,
	pDatFin IN BONINTERV.BI_DatFin%TYPE,
	pDatDebut IN BONINTERV.BI_DatDebut%TYPE,
	pCpteRendu IN BONINTERV.BI_CpteRendu%TYPE,
	pDem_Num IN DEMANDEINTER.DEMI_Num%TYPE
)
IS
	iBI_Num INTEGER := 1;
BEGIN
	IF pDem_Num <> null THEN
		iBI_Num := MaxCode_BONINTERV();
		INSERT INTO BONINTERV 	
			(BI_NUM, 	BI_Velo, 	BI_DatDebut, 	BI_DatFin, 	BI_Technicien, 	BI_SurPlace, 	BI_Reparable, 	BI_CpteRendu, 	BI_Demande)
		VALUES 	
			(iBI_Num, 	pVel_Num, 	pDatDebut, 		pDatFin, 	pTec_Matric,	pSurPlace, 		pReparable, 	pCpteRendu, 	pDem_Num);

		UPDATE DEMANDEINTER
		SET DemI_Traite = 1
		WHERE DemI_Num = pDem_Num;
	ELSE
		iBI_Num := MaxCode_BONINTERV();
		INSERT INTO BONINTERV 	
			(BI_NUM, 	BI_Velo, 	BI_DatDebut, 	BI_DatFin, 	BI_Technicien, 	BI_SurPlace, 	BI_Reparable, 	BI_CpteRendu)
		VALUES 	
			(iBI_Num, 	pVel_Num, 	pDatDebut, 		pDatFin, 	pTec_Matric,	pSurPlace, 		pReparable, 	pCpteRendu);
	END IF;

	IF pReparable = '0' THEN
		UPDATE VELO
		SET Vel_Casse = 1
		WHERE Vel_Num = pVel_Num;
	END IF;
COMMIT;
END;
/