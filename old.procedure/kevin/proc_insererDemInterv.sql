CREATE OR REPLACE PROCEDURE insererDemInterv
(pDemI_Date IN DEMANDEINTER.DemI_Date%TYPE,
pDemI_Motif IN DEMANDEINTER.DemI_Motif%TYPE
)
IS
	sCode DEMANDEINTER.DemI_Num%TYPE;
	err_demInterExisteDeja Exception;
	pCodeaudits number(6);  
	
BEGIN
	sCode := nouveauCodeDemInterv();
	IF (existeDemInterv(sCode) = false) THEN
		
		INSERT INTO DEMANDEINTER(DemI_Num, DemI_Date, DemI_Motif)
		VALUES (sCode, pDemI_Date, pDemI_Motif);
	
	ELSE   
		Raise err_demInterExisteDeja;   
	END IF; 

EXCEPTION   
   
	WHEN err_demInterExisteDeja THEN   
		pCodeaudits := codeaudits() + 1;      
		INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)   
		VALUES(pCodeAudits,'La demande d intervention existe deja',sysdate);  
		 
END;
