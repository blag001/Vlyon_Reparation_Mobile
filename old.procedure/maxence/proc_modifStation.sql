CREATE OR REPLACE PROCEDURE modifStation(
	pCodeSta IN STATION.Sta_Code%TYPE,   
	pNbAttaches IN STATION.Sta_NbAttaches%TYPE,   
	pNbAttachDispo STATION.Sta_NbAttacDispo%TYPE
	)   
IS   
	err_STATION Exception;  
    pCodeaudits number(6);      
   
   
BEGIN   
   
IF existeStation(pCodeSta) = True THEN   
		IF pNbAttaches IS NOT NULL THEN   
			UPDATE station SET Sta_NbAttaches= pNbAttaches   
			WHERE Sta_Code = pCodeSta ;  
		END IF;   
   
		IF pNbAttachDispo IS NOT NULL THEN   
			UPDATE station SET Sta_NbAttacDispo= pNbAttachDispo   
			WHERE Sta_Code = pCodeSta  ; 
		END IF;   
   
ELSE   
		Raise err_STATION;   
END IF;   
EXCEPTION   
   
	WHEN err_STATION THEN   
         pCodeaudits := codeaudits() + 1;       
			INSERT INTO AUDITS(AUD_CODE, AUD_LIBELLE,AUD_DATE)    
			VALUES(pCodeAudits,'Station non existante',sysdate);    
END;   

