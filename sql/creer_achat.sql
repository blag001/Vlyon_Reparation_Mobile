-- ============================================================
--   Nom de la base   :  ACHAT                                 
--   Nom de SGBD      :  ORACLE Version 7.x                    
--   Date de cr‚ation :  05/11/2013  22:17                     
-- ============================================================

-- ============================================================
--   Table : PRODUIT                                           
-- ============================================================
create table PRODUIT
(
    Pdt_Code         CHAR(6)                not null,
    Pdt_Libelle      VARCHAR2(30)           null    ,
    Pdt_Poids        NUMBER(6,2)            null    ,
    Pdt_PxCMUP       NUMBER(7,2)            null    ,
    Pdt_QteStk       NUMBER(10)             null    ,
    Pdt_NbVols       NUMBER(5)              null    ,
    Pdt_NbCasses     NUMBER(5)              null    ,
    constraint PK_PRODUIT primary key (Pdt_Code)
)
/

-- ============================================================
--   Table : FOURNISSEUR                                       
-- ============================================================
create table FOURNISSEUR
(
    Fou_Code         CHAR(5)                not null,
    Fou_Nom          VARCHAR2(30)           null    ,
    Fou_Rue          VARCHAR2(50)           null    ,
    Fou_Cp           CHAR(5)                null    ,
    Fou_Ville        VARCHAR2(30)           null    ,
    Fou_Tel          VARCHAR2(15)           null    ,
    Fou_Mail         VARCHAR2(30)           null    ,
    constraint PK_FOURNISSEUR primary key (Fou_Code)
)
/

-- ============================================================
--   Table : RESPONSABLE                                       
-- ============================================================
create table RESPONSABLE
(
    Res_Matricule    CHAR(5)                not null,
    Res_Nom          VARCHAR2(35)           null    ,
    Res_Prenom       VARCHAR2(35)           null    ,
    constraint PK_RESPONSABLE primary key (Res_Matricule)
)
/

-- ============================================================
--   Table : COMMANDE                                          
-- ============================================================
create table COMMANDE
(
    Cde_Num          NUMBER(3)              not null,
    Cde_Fournisseur  CHAR(5)                not null,
    Cde_Date         DATE                   null    ,
    Cde_Montant      NUMBER(6,2)            null    ,
    Cde_Etat         VARCHAR2(20)           null    ,
    constraint PK_COMMANDE primary key (Cde_Num)
)
/

-- ============================================================
--   Index : ENVOYER_FK                                        
-- ============================================================
create index ENVOYER_FK on COMMANDE (Cde_Fournisseur asc)
/

-- ============================================================
--   Table : DEMANDE                                           
-- ============================================================
create table DEMANDE
(
    Dem_Num          CHAR(5)                not null,
    Dem_Produit      CHAR(6)                not null,
    Dem_Commande     NUMBER(3)              null    ,
    Dem_Date         DATE                   null    ,
    Dem_Qte          NUMBER(2)              null    ,
    Dem_Valide       CHAR(1)                null    ,
    Dem_Responsab    CHAR(5)                not null,
    Dem_Motif        VARCHAR2(50)           null    ,
    constraint PK_DEMANDE primary key (Dem_Num)
)
/

-- ============================================================
--   Index : concerner_FK                                      
-- ============================================================
create index concerner_FK on DEMANDE (Dem_Produit asc)
/

-- ============================================================
--   Index : regrouper_FK                                      
-- ============================================================
create index regrouper_FK on DEMANDE (Dem_Commande asc)
/

-- ============================================================
--   Index : rediger_FK                                        
-- ============================================================
create index rediger_FK on DEMANDE (Dem_Responsab asc)
/

-- ============================================================
--   Table : LigneCde                                          
-- ============================================================
create table LigneCde
(
    LigC_Commande    NUMBER(3)              not null,
    LigC_Produit     CHAR(6)                not null,
    Lig_QteCdee      NUMBER(2)              null    ,
    LigC_Prix        NUMBER(5,2)            null    ,
    LigC_QteLivree   NUMBER(2)              null    ,
    constraint PK_LIGNECDE primary key (LigC_Commande, LigC_Produit)
)
/

-- ============================================================
--   Index : LIEN_265_FK                                       
-- ============================================================
create index LIEN_265_FK on LigneCde (LigC_Commande asc)
/

-- ============================================================
--   Index : LIEN_266_FK                                       
-- ============================================================
create index LIEN_266_FK on LigneCde (LigC_Produit asc)
/

alter table COMMANDE
    add constraint FK_COMMANDE_FOURNISSEUR foreign key  (Cde_Fournisseur)
       references FOURNISSEUR (Fou_Code)
/

alter table DEMANDE
    add constraint FK_DEMANDE_PRODUIT foreign key  (Dem_Produit)
       references PRODUIT (Pdt_Code)
/

alter table DEMANDE
    add constraint FK_DEMANDE_COMMANDE foreign key  (Dem_Commande)
       references COMMANDE (Cde_Num)
/

alter table DEMANDE
    add constraint FK_DEMANDE_RESPONSABLE foreign key  (Dem_Responsab)
       references RESPONSABLE (Res_Matricule)
/

alter table LigneCde
    add constraint FK_LIGNECDE_COMMANDE foreign key  (LigC_Commande)
       references COMMANDE (Cde_Num)
/

alter table LigneCde
    add constraint FK_LIGNECDE_PRODUIT foreign key  (LigC_Produit)
       references PRODUIT (Pdt_Code)
/

