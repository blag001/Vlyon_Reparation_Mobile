CREATE OR REPLACE PROCEDURE modifEtat(
	pCodeInt IN BONINTERV.BI_Num%TYPE,  
	pReparable IN BONINTERV.BI_Reparable%TYPE,  
	pSurplace IN BONINTERV.BI_Surplace%TYPE
	)  
IS  
	err_Etat Exception;  
    pCodeaudits Number(6);  
  
BEGIN  
  
IF existeEtat(pCodeInt) = True THEN  
		UPDATE BONINTERV  
		SET BI_Reparable = pReparable , BI_Surplace = pSurplace  
		WHERE BI_Num = pCodeInt;  
	ELSE  
		Raise err_Etat;  
END IF;  
  
EXCEPTION  
  
	WHEN err_Etat THEN  
        pCodeaudits := codeaudits() + 1;      
			INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)  
			VALUES(pCodeaudits,'Lintervention nexiste pas',sysdate);  
END;