CREATE OR REPLACE PROCEDURE modifDureeInt(
	pCodeInt IN BONINTERV.BI_Num%TYPE,   
	pDureeInt IN BONINTERV.BI_Duree%TYPE
	)   
IS   
	err_Fiche Exception;   
    pCodeaudits number(6);   
   
BEGIN   
	IF existeBON(pCodeInt) = True THEN   
		UPDATE BONINTERV   
		SET BI_Duree = pDureeInt   
		WHERE BI_NUM = pCodeInt;   
	ELSE   
		Raise err_Fiche;   
	END IF;  
	 
EXCEPTION   
   
	WHEN err_Fiche THEN   
        pCodeaudits := codeaudits() + 1;      
			INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)   
			VALUES(pCodeAudits,'Fiche Intervention non existante',sysdate);   
END;