-- ============================================================
--   Nom de la base   :  LOCATION                              
--   Nom de SGBD      :  ORACLE Version 7.x                    
--   Date de cr‚ation :  15/10/2013  14:35                     
-- ============================================================

-- ============================================================
--   Table : ABONNEMENT                                        
-- ============================================================
create table ABONNEMENT
(
    Abo_Code           CHAR(2)                not null,
    Abo_Libelle        VARCHAR2(35)           null    ,
    Abo_Duree          NUMBER(4)              null    ,
    Abo_Px             NUMBER(5,2)            null    ,
    Abo_PxDemiHr       NUMBER(4,2)            null    ,
    Abo_PxMajore       NUMBER(5,2)            null    ,
    constraint PK_ABONNEMENT primary key (Abo_Code)
)
/

-- ============================================================
--   Table : ETAT                                              
-- ============================================================
create table ETAT
(
    Eta_Code           CHAR(2)                not null,
    Eta_Libelle        VARCHAR2(30)           null    ,
    constraint PK_ETAT primary key (Eta_Code)
)
/

-- ============================================================
--   Table : STATION                                           
-- ============================================================
create table STATION
(
    Sta_Code           CHAR(5)                not null,
    Sta_Nom            VARCHAR2(30)           null    ,
    Sta_Rue            VARCHAR2(50)           null    ,
    Sta_NbAttaches     NUMBER(2)              null    ,
    Sta_NbVelos        NUMBER(2)              null    ,
    Sta_NbAttacDispos  NUMBER(2)              null    ,
    Sta_NbTotLoc       NUMBER(10)             null    ,
    Sta_NbVols         NUMBER(5)              null    ,
    Sta_NbDegrad       NUMBER(5)              null    ,
    constraint PK_STATION primary key (Sta_Code)
)
/

-- ============================================================
--   Table : PRODUIT                                           
-- ============================================================
create table PRODUIT
(
    Pdt_Code           CHAR(6)                not null,
    Pdt_Roue           VARCHAR2(15)           null    ,
    Pdt_Poids          NUMBER(6,2)            null    ,
    Pdt_QteStk         NUMBER(10)             null    ,
    Pdt_NbVols         NUMBER(5)              null    ,
    Pdt_NbCasses       NUMBER(5)              null    ,
    constraint PK_PRODUIT primary key (Pdt_Code)
)
/

-- ============================================================
--   Table : PENALITE                                          
-- ============================================================
create table PENALITE
(
    Pen_Code           CHAR(2)                not null,
    Pen_Libelle        VARCHAR2(35)           null    ,
    Pen_Prix           NUMBER(5,2)            null    ,
    constraint PK_PENALITE primary key (Pen_Code)
)
/

-- ============================================================
--   Table : ADHERENT                                          
-- ============================================================
create table ADHERENT
(
    Adh_Code           CHAR(10)               not null,
    Adh_Type           CHAR(2)                not null,
    Adh_Titre          CHAR(4)                null    ,
    Adh_Nom            VARCHAR2(30)           null    ,
    Adh_Prenom         VARCHAR2(30)           null    ,
    Adh_Rue            VARCHAR2(50)           null    ,
    Adh_Cp             CHAR(5)                null    ,
    Adh_Ville          VARCHAR2(40)           null    ,
    Adh_Pays           VARCHAR2(30)           null    ,
    Adh_Ddn            DATE                   null    ,
    Adh_NbUtils        NUMBER(3)              null    ,
    Adh_Date1Adh       DATE                   null    ,
    Adh_DateAbont      DATE                   null    ,
    constraint PK_ADHERENT primary key (Adh_Code)
)
/

-- ============================================================
--   Index : ADHERER_FK                                        
-- ============================================================
create index ADHERER_FK on ADHERENT (Adh_Type asc)
/

-- ============================================================
--   Table : VELO                                              
-- ============================================================
create table VELO
(
    Vel_Num            CHAR(6)                not null,
    Vel_Station        CHAR(5)                not null,
    Vel_Etat           CHAR(2)                not null,
    Vel_Type           CHAR(6)                not null,
    Vel_Accessoire     VARCHAR2(20)           null    ,
    Vel_Casse          CHAR(1)                null    ,
    constraint PK_VELO primary key (Vel_Num)
)
/

-- ============================================================
--   Index : POSITIONNER_FK                                    
-- ============================================================
create index POSITIONNER_FK on VELO (Vel_Station asc)
/

-- ============================================================
--   Index : AVOIR_FK                                          
-- ============================================================
create index AVOIR_FK on VELO (Vel_Etat asc)
/

-- ============================================================
--   Index : appartenir_FK                                     
-- ============================================================
create index appartenir_FK on VELO (Vel_Type asc)
/

-- ============================================================
--   Table : UTILISATION                                       
-- ============================================================
create table UTILISATION
(
    Uti_Num            CHAR(10)               not null,
    Uti_Adherent       CHAR(10)               not null,
    Uti_Velo           CHAR(6)                not null,
    Uti_Date           DATE                   null    ,
    Uti_HrDebut        DATE                   null    ,
    Uti_Duree          NUMBER(4)              null    ,
    Uti_NbKm           NUMBER(3)              null    ,
    Uti_NonRendu       CHAR(1)                null    ,
    Uti_PxTot          NUMBER(6,2)            null    ,
    Uti_Deteriore      CHAR(1)                null    ,
    constraint PK_UTILISATION primary key (Uti_Num)
)
/

-- ============================================================
--   Index : CONCERNER_FK                                      
-- ============================================================
create index CONCERNER_FK on UTILISATION (Uti_Adherent asc)
/

-- ============================================================
--   Index : LOUER_FK                                          
-- ============================================================
create index LOUER_FK on UTILISATION (Uti_Velo asc)
/

-- ============================================================
--   Table : SUBIR                                             
-- ============================================================
create table SUBIR
(
    Sub_Penalite       CHAR(2)                not null,
    Sub_Utilisation    CHAR(10)               not null,
    constraint PK_SUBIR primary key (Sub_Penalite, Sub_Utilisation)
)
/

-- ============================================================
--   Index : LIEN_367_FK                                       
-- ============================================================
create index LIEN_367_FK on SUBIR (Sub_Penalite asc)
/

-- ============================================================
--   Index : LIEN_368_FK                                       
-- ============================================================
create index LIEN_368_FK on SUBIR (Sub_Utilisation asc)
/

alter table ADHERENT
    add constraint FK_ADHERENT_ABONNEMENT foreign key  (Adh_Type)
       references ABONNEMENT (Abo_Code)
/

alter table VELO
    add constraint FK_VELO_STATION foreign key  (Vel_Station)
       references STATION (Sta_Code)
/

alter table VELO
    add constraint FK_VELO_ETAT foreign key  (Vel_Etat)
       references ETAT (Eta_Code)
/

alter table VELO
    add constraint FK_VELO_PRODUIT foreign key  (Vel_Type)
       references PRODUIT (Pdt_Code)
/

alter table UTILISATION
    add constraint FK_UTILISATION_ADHERENT foreign key  (Uti_Adherent)
       references ADHERENT (Adh_Code)
/

alter table UTILISATION
    add constraint FK_UTILISATION_VELO foreign key  (Uti_Velo)
       references VELO (Vel_Num)
/

alter table SUBIR
    add constraint FK_SUBIR_PENALITE foreign key  (Sub_Penalite)
       references PENALITE (Pen_Code)
/

alter table SUBIR
    add constraint FK_SUBIR_UTILISATION foreign key  (Sub_Utilisation)
       references UTILISATION (Uti_Num)
/

