-- ============================================================
--   Nom de la base   :  REPARATION
--   Nom de SGBD      :  ORACLE Version 7.x
--   Date de cr‚ation :  05/11/2013  22:15
-- ============================================================

-- ============================================================
--   Table : STATION
-- ============================================================
create table STATION
(
    Sta_Code          CHAR(5)                not null,
    Sta_Nom           VARCHAR(30)           null    ,
    Sta_Rue           VARCHAR(50)           null    ,
    Sta_NbAttaches    DECIMAL(2)              null    ,
    Sta_NbVelos       DECIMAL(2)              null    ,
    Sta_NbAttacDispo  DECIMAL(2)              null    ,
    Sta_NbTotLoc      DECIMAL(10)             null    ,
    Sta_NbVols        DECIMAL(5)              null    ,
    Sta_NbDegrad      DECIMAL(5)              null    ,
    constraint PK_STATION primary key (Sta_Code)
)
;

-- ============================================================
--   Table : ETAT
-- ============================================================
create table ETAT
(
    Eta_Code          INT               not null AUTO_INCREMENT,
    Eta_Libelle       VARCHAR(30)           null    ,
    constraint PK_ETAT primary key (Eta_Code)
)
;

-- ============================================================
--   Table : PRODUIT
-- ============================================================
create table PRODUIT
(
    Pdt_Code          CHAR(6)                not null,
    Pdt_Libelle       VARCHAR(30)            null    ,
    Pdt_Poids         DECIMAL(10)             null    ,
    Pdt_PxCMUP        DECIMAL(6,2)            null    ,
    Pdt_QteStk        DECIMAL(10)             null    ,
    Pdt_NbVols        DECIMAL(5)              null    ,
    Pdt_NbCasses      DECIMAL(5)              null    ,
    constraint PK_PRODUIT primary key (Pdt_Code)
)
;

-- ============================================================
--   Table : TECHNICIEN
-- ============================================================
create table TECHNICIEN
(
    Tec_Matricule     INT                not null AUTO_INCREMENT,
    Tec_Nom           VARCHAR(35)           null    ,
    Tec_Prenom        VARCHAR(35)           null    ,
    constraint PK_TECHNICIEN primary key (Tec_Matricule)
)
;

-- ============================================================
--   Table : VELO
-- ============================================================
create table VELO
(
    Vel_Num           CHAR(5)                not null,
    Vel_Station       CHAR(5)                null    ,
    Vel_Etat          INT               not null,
    Vel_Type          CHAR(6)                not null,
    Vel_Accessoire    VARCHAR(20)           null    ,
    Vel_Casse         BIT(1)                null    ,
    constraint PK_VELO primary key (Vel_Num)
)
;

-- ============================================================
--   Index : POSITIONNER_FK
-- ============================================================
create index POSITIONNER_FK on VELO (Vel_Station asc)
;

-- ============================================================
--   Index : AVOIR_FK
-- ============================================================
create index AVOIR_FK on VELO (Vel_Etat asc)
;

-- ============================================================
--   Index : appartenir_FK
-- ============================================================
create index appartenir_FK on VELO (Vel_Type asc)
;

-- ============================================================
--   Table : DEMANDEINTER
-- ============================================================
create table DEMANDEINTER
(
    DemI_Num          CHAR(5)                not null,
    DemI_Velo         CHAR(5)                not null,
    DemI_Date         DATE                   null    ,
    DemI_Technicien    INT                not null,
    DemI_Motif        VARCHAR(50)           null    ,
    DemI_Traite       BIT(1)                null    ,
    constraint PK_DEMANDEINTER primary key (DemI_Num)
)
;

-- ============================================================
--   Index : CORRESPONDRE_FK
-- ============================================================
create index CORRESPONDRE_FK on DEMANDEINTER (DemI_Velo asc)
;

-- ============================================================
--   Index : rediger_FK
-- ============================================================
create index rediger_FK on DEMANDEINTER (DemI_Technicien asc)
;

-- ============================================================
--   Table : BONINTERV
-- ============================================================
create table BONINTERV
(
    BI_Num            CHAR(10)               not null,
    BI_Velo           CHAR(5)                not null,
    BI_DatDebut       DATE                   null    ,
    BI_DatFin         DATE                   null    ,
    BI_CpteRendu      VARCHAR(100)          null    ,
    BI_Reparable      BIT(1)                null    ,
    BI_Demande        CHAR(5)                null    ,
    BI_Technicien     INT                not null,
    BI_SurPlace       BIT(1)                null    ,
    BI_Duree          DECIMAL(5)              null    ,
    constraint PK_BONINTERV primary key (BI_Num)
)
;

-- ============================================================
--   Index : CONCERNER_FK
-- ============================================================
create index CONCERNER_FK on BONINTERV (BI_Velo asc)
;

-- ============================================================
--   Index : EXECUTER_FK2
-- ============================================================
create index EXECUTER_FK2 on BONINTERV (BI_Demande asc)
;

-- ============================================================
--   Index : realiser_FK
-- ============================================================
create index realiser_FK on BONINTERV (BI_Technicien asc)
;

-- ============================================================
--   Table : USER
-- ============================================================
create table USER
(
    Use_Num            INT                    not null AUTO_INCREMENT,
    Use_Nom            VARCHAR(50)            not null,
    Use_Hash           CHAR(128)              not null,
    Use_RespAchat      BIT(1)                 null    ,
    Use_Technicien     INT                    null    ,
    constraint PK_USER primary key (Use_Num)
)
;

-- ============================================================
--   Index : CONCERNER_FK
-- ============================================================
create index HASH_FK on USER (Use_Hash asc)
;



-- ============================================================
--   ajout des contraites
-- ============================================================
alter table VELO
    add constraint FK_VELO_STATION foreign key  (Vel_Station)
       references STATION (Sta_Code)
;

alter table VELO
    add constraint FK_VELO_ETAT foreign key  (Vel_Etat)
       references ETAT (Eta_Code)
;

alter table VELO
    add constraint FK_VELO_PRODUIT foreign key  (Vel_Type)
       references PRODUIT (Pdt_Code)
;

alter table DEMANDEINTER
    add constraint FK_DEMANDEINTER_VELO foreign key  (DemI_Velo)
       references VELO (Vel_Num)
;

alter table DEMANDEINTER
    add constraint FK_DEMANDEINTER_TECHNICIEN foreign key  (DemI_Technicien)
       references TECHNICIEN (Tec_Matricule)
;

alter table BONINTERV
    add constraint FK_BONINTERV_VELO foreign key  (BI_Velo)
       references VELO (Vel_Num)
;

alter table BONINTERV
    add constraint FK_BONINTERV_DEMANDEINTER foreign key  (BI_Demande)
       references DEMANDEINTER (DemI_Num)
;

alter table BONINTERV
    add constraint FK_BONINTERV_TECHNICIEN foreign key  (BI_Technicien)
       references TECHNICIEN (Tec_Matricule)
;

alter table USER
    add constraint FK_USER_TECHNICIEN foreign key  (Use_Technicien)
       references TECHNICIEN (Tec_Matricule)
;

