CREATE OR REPLACE PROCEDURE insererDemInterv
(pDemI_Date IN DEMANDEINTER.DemI_Date%TYPE,
pDemI_Motif IN DEMANDEINTER.DemI_Motif%TYPE
)
IS
	sCode DEMANDEINTER.DemI_Num%TYPE;
BEGIN
	IF (existeDemInterv(pDemInterv) = false) THEN
		sCode = nouveauCodeDemInterv();
		INSERT INTO DEMANDEINTER(DemI_Num, DemI_Date, Demi_Motif)
		VALUES (sCode, pDemI_Date, pDemI_Motif);
		COMMIT;
	END IF;
END
