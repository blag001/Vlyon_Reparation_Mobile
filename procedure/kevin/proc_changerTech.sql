CREATE OR REPLACE PROCEDURE changerTech
(pNomTec IN TECHNICIEN.Tec_nom%type,
pPrenomTec IN TECHNICIEN.Tec_Prenom%type,
pDemCode IN DEMANDEINTER.DemI_Num%TYPE
)
IS

	pTechCode DEMANDEINTER.DemI_Technicien%TYPE;
	pCodeaudits number(6); 
	err_tecNoExiste Exception;
	err_interNoExiste Exception;
	err_nExistePas Exception;

BEGIN
	IF ((existeDemInterv(pDemCode) = true) AND (existeTechnicien(pNomTec, pPrenomTec) = true)) THEN
		select DemI_Technicien into pTechCode
		from DEMANDEINTER
		where DemI_Num = pDemCode;
		
		Update DEMANDEINTER
		set DemI_Technicien = pTechCode
		where DemI_Num = pDemCode;
		
	ELSE IF ((existeDemInterv(pDemCode) = true) AND (existeTechnicien(pNomTec, pPrenomTec) = false)) THEN
		Raise err_tecNoExiste;
		
		ELSE IF ((existeDemInterv(pDemCode) = false) AND (existeTechnicien(pNomTec, pPrenomTec) = true)) THEN
			Raise err_interNoExiste;  
			
			ELSE
				Raise err_nExistePas;   
			END IF;
		END IF;
	END IF;  
	
EXCEPTION  	

	WHEN err_tecNoExiste THEN   
        pCodeaudits := codeaudits() + 1;      
			INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)   
			VALUES(pCodeAudits,'Technicien n existe pas',sysdate);
	
	WHEN err_interNoExiste THEN   
        pCodeaudits := codeaudits() + 1;      
			INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)   
			VALUES(pCodeAudits,'Demande intervention n existe pas',sysdate);  
	WHEN err_nExistePas THEN   
        pCodeaudits := codeaudits() + 1;      
			INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)   
			VALUES(pCodeAudits,'Technicien et demande intervention n existent pas',sysdate);  
END;
