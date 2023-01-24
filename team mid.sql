--------------------------------------------------------
--  File created - Tuesday-January-24-2023   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Sequence BOOK_ID_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "PROJECT502"."BOOK_ID_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 41 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Sequence INV_ID_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "PROJECT502"."INV_ID_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 41 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Sequence MANAGER_ID_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "PROJECT502"."MANAGER_ID_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Sequence STAFF_ID_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "PROJECT502"."STAFF_ID_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 21 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Sequence SUPPLIER_ID_SEQ
--------------------------------------------------------

   CREATE SEQUENCE  "PROJECT502"."SUPPLIER_ID_SEQ"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
--------------------------------------------------------
--  DDL for Table BOOK
--------------------------------------------------------

  CREATE TABLE "PROJECT502"."BOOK" 
   (	"BOOKID" NUMBER(5,0), 
	"BOOK_NAME" VARCHAR2(100 BYTE), 
	"BOOK_AUTHOR" VARCHAR2(100 BYTE), 
	"BOOK_PRICE" NUMBER(10,2), 
	"ISBN" VARCHAR2(20 BYTE), 
	"SUPPLIER_ID" NUMBER(5,0), 
	"PUBLICATION_DATE" DATE, 
	"IMAGE_URL" VARCHAR2(200 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table INVENTORY
--------------------------------------------------------

  CREATE TABLE "PROJECT502"."INVENTORY" 
   (	"INVID" NUMBER(5,0), 
	"STAFFID" NUMBER(5,0), 
	"PURCHASE_DATE" DATE
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table INV_BOOK
--------------------------------------------------------

  CREATE TABLE "PROJECT502"."INV_BOOK" 
   (	"INVID" NUMBER(5,0), 
	"BOOKID" NUMBER(5,0), 
	"QUANTITY" NUMBER(5,0), 
	"PURCHASE_PRICE" NUMBER(10,2)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table MANAGER
--------------------------------------------------------

  CREATE TABLE "PROJECT502"."MANAGER" 
   (	"STAFFID" NUMBER(5,0), 
	"BONUS" NUMBER(10,2)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table STAFF
--------------------------------------------------------

  CREATE TABLE "PROJECT502"."STAFF" 
   (	"STAFFID" NUMBER(5,0), 
	"FIRST_NAME" VARCHAR2(50 BYTE), 
	"LAST_NAME" VARCHAR2(50 BYTE), 
	"PHONE_NUMBER" VARCHAR2(20 BYTE), 
	"SALARY" NUMBER(10,2), 
	"HIRE_DATE" DATE, 
	"PASSWORD" VARCHAR2(255 BYTE), 
	"POSITION" VARCHAR2(50 BYTE), 
	"SUPERVISOR_ID" NUMBER(5,0), 
	"EMAIL" VARCHAR2(50 BYTE), 
	"ADDRESS" VARCHAR2(100 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table SUPPLIER
--------------------------------------------------------

  CREATE TABLE "PROJECT502"."SUPPLIER" 
   (	"SUPPLIER_ID" NUMBER(5,0), 
	"SUPPLIER_NAME" VARCHAR2(50 BYTE), 
	"SUPPLIER_ADDRESS" VARCHAR2(100 BYTE), 
	"CONTACT_PERSON" VARCHAR2(50 BYTE), 
	"PHONE_NUMBER" VARCHAR2(20 BYTE)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
REM INSERTING into PROJECT502.BOOK
SET DEFINE OFF;
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (3,'Jujutsu Kaisen','Gege Akutami',15,'1234567890125',3,to_date('04/07/2018','DD/MM/RRRR'),'assets/img/product/Jujutsu_kaisen.png');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (1,'The Night Eaters','Sana Takeda',136,'9781419758706',3,to_date('06/01/2022','DD/MM/RRRR'),'assets/img/HORROR/THE NIGHT EATERS.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (7,'Rivers of London','Ben Aaronovitch',56,'9780575097582',1,to_date('03/01/2023','DD/MM/RRRR'),'assets/img/FANTASY/RIVERS OF LONDON.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (8,'The Bear and The Nightingale','Katherine Arden',45,'9781101885956',1,to_date('25/06/2017','DD/MM/RRRR'),'assets/img/FANTASY/THE BEAR AND THE NIGHT TALE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (9,'The Light of Other Days','Stephen Baxter',68,'978000834556',1,to_date('01/06/2016','DD/MM/RRRR'),'assets/img/SCI-FI/THE LIGHTS OF OTHER DAYS.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (10,'King''s Cage','Victoria Aveyard',61,'9780062310705',2,to_date('12/03/2019','DD/MM/RRRR'),'assets/img/FANTASY/KING''S CAGE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (11,'Shadow and Bone','Leigh Bardugo',43,'97815101105249',2,to_date('05/06/2018','DD/MM/RRRR'),'assets/img/FANTASY/SHADOW AND BONE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (12,'Cruel Prince','Holly Black',47,'9781471407277',3,to_date('19/07/2018','DD/MM/RRRR'),'assets/img/FANTASY/THE CRUEL PRINCE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (13,'Fairy Tale','Stephen King',110,'9781399705417',3,to_date('12/09/2022','DD/MM/RRRR'),'assets/img/HORROR/FAIRY TALE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (14,'The Death of Jane Lawrence','Caitlin Starling',52,'97818033336051',1,to_date('17/09/2022','DD/MM/RRRR'),'assets/img/HORROR/THE DEATH OF JANE LAWRENCE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (15,'Road of Bones','Christopher Golden',53,'9781803361475',1,to_date('20/01/2023','DD/MM/RRRR'),'assets/img/HORROR/ROAD OF BONES.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (16,'World War Z','Mac Brooks',60,'9780715653739',2,to_date('17/04/2019','DD/MM/RRRR'),'assets/img/HORROR/WORLD WAR Z.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (17,'The Ultimate Hitchhiker''s Guide to The Galaxy','Douglas Adams',96,'9781529051438',2,to_date('10/10/2020','DD/MM/RRRR'),'assets/img/SCI-FI/HITCH HIKERS.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (18,'Prelude To Foundation','Isaac Asimov',53,'9780008117481',3,to_date('07/09/2011','DD/MM/RRRR'),'assets/img/SCI-FI/FOUNDATION.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (19,'The Hydrogen Sonata','Iaian M. Banks',60,'9780356501499',2,to_date('13/09/2013','DD/MM/RRRR'),'assets/img/SCI-FI/SONATA.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (20,'Fahrenheit 451','Ray Bradbury',42,'9780006546061',3,to_date('07/07/2006','DD/MM/RRRR'),'assets/img/SCI-FI/FAHRENHEIT.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (21,'It Starts With Us','Coleen Hover',90,'9781668001226',2,to_date('01/01/2023','DD/MM/RRRR'),'assets/img/ROMANCE/START.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (22,'Ugly Love','Coleen Hoover',54,'9781471136726',2,to_date('20/05/2013','DD/MM/RRRR'),'assets/img/ROMANCE/UGLY.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (23,'Twisted Hate','Ana Huang',62,'9780349434339',1,to_date('15/06/2016','DD/MM/RRRR'),'assets/img/ROMANCE/HATE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (24,'The Love Hypothesis','Ali Hazelwood',68,'9781408725764',2,to_date('08/10/2016','DD/MM/RRRR'),'assets/img/ROMANCE/LOVE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (25,'Spanish Love Deception','Elena Armas',56,'9781398515628',3,to_date('06/10/2021','DD/MM/RRRR'),'assets/img/ROMANCE/SPANISH.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (26,'The Song of Achilles ','Madeline Miller',56,'9780062060624',2,to_date('14/08/2012','DD/MM/RRRR'),'assets/img/HISTORICAL/ACHILLES.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (27,'The Dictionary of Lost Words','Pip Williams',54,'9781984820747',3,to_date('22/05/2022','DD/MM/RRRR'),'assets/img/HISTORICAL/DICTIONARY.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (28,'The Last Checkmate','Gabriella Saab',79,'9780063141933',3,to_date('31/12/2021','DD/MM/RRRR'),'assets/img/HISTORICAL/CHECKMATE.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (29,'A Thousand Ships','Natalie Haynes',62,'9781509836215',2,to_date('14/07/2020','DD/MM/RRRR'),'assets/img/HISTORICAL/THOUSAND.jpeg');
Insert into PROJECT502.BOOK (BOOKID,BOOK_NAME,BOOK_AUTHOR,BOOK_PRICE,ISBN,SUPPLIER_ID,PUBLICATION_DATE,IMAGE_URL) values (30,'Daughters of Sparta','Claire Heywood',52,'9781529333695',1,to_date('20/07/2022','DD/MM/RRRR'),'assets/img/HISTORICAL/DAUGHTER.jpeg');
REM INSERTING into PROJECT502.INVENTORY
SET DEFINE OFF;
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (1,1,to_date('01/04/2022','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (2,2,to_date('01/05/2022','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (3,2,to_date('18/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (4,2,to_date('20/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (5,2,to_date('20/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (6,2,to_date('21/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (7,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (8,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (9,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (10,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (11,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (12,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (13,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (14,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (15,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (16,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (17,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (18,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (19,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (20,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (21,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (22,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (23,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (24,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (25,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (26,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (27,1,to_date('24/01/2023','DD/MM/RRRR'));
Insert into PROJECT502.INVENTORY (INVID,STAFFID,PURCHASE_DATE) values (28,1,to_date('24/01/2023','DD/MM/RRRR'));
REM INSERTING into PROJECT502.INV_BOOK
SET DEFINE OFF;
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (1,1,9,20);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (2,3,9,10);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (3,3,20,50);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (4,3,3,50);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (5,1,3,50);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (7,8,10,12);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (8,13,15,78);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (9,7,23,45);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (10,9,90,35);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (13,11,42,30);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (12,10,37,52);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (14,12,87,34);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (15,14,66,34);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (16,15,16,49);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (17,16,41,56);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (18,17,23,87);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (19,18,17,49);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (20,19,25,99);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (21,20,22,38);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (22,21,66,86);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (23,22,54,50);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (24,23,74,58);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (25,24,28,64);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (26,25,6,50);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (27,26,59,50);
Insert into PROJECT502.INV_BOOK (INVID,BOOKID,QUANTITY,PURCHASE_PRICE) values (28,27,77,49);
REM INSERTING into PROJECT502.MANAGER
SET DEFINE OFF;
Insert into PROJECT502.MANAGER (STAFFID,BONUS) values (1,10000);
REM INSERTING into PROJECT502.STAFF
SET DEFINE OFF;
Insert into PROJECT502.STAFF (STAFFID,FIRST_NAME,LAST_NAME,PHONE_NUMBER,SALARY,HIRE_DATE,PASSWORD,POSITION,SUPERVISOR_ID,EMAIL,ADDRESS) values (1,'John','Doe','1234567890',50000,to_date('01/01/2022','DD/MM/RRRR'),'$2y$10$iU4qfAxvlzAX5qLWCwkeGOkiSHGTXUpjtaDSy9fWo5k63Msoqjpgu','Manager',null,'john@email.com','123 Main St');
Insert into PROJECT502.STAFF (STAFFID,FIRST_NAME,LAST_NAME,PHONE_NUMBER,SALARY,HIRE_DATE,PASSWORD,POSITION,SUPERVISOR_ID,EMAIL,ADDRESS) values (2,'Albert','Doe','1234567895',1000,to_date('01/01/2021','DD/MM/RRRR'),'$2y$10$.42TjOUYjdGDtJDXpxFJuOsP./yaRa3xG1xa5dU26waOL0.JEgqyu','Staff',null,'123@email.com','123');
Insert into PROJECT502.STAFF (STAFFID,FIRST_NAME,LAST_NAME,PHONE_NUMBER,SALARY,HIRE_DATE,PASSWORD,POSITION,SUPERVISOR_ID,EMAIL,ADDRESS) values (3,'Maizatul','Ali','0123456789',6000,to_date('22/01/2023','DD/MM/RRRR'),'$2y$10$cSuMFH9uHyeFUWgRcOFpXOXRlJr09KArPdLka1Rbs4oJnU6nv//0a','Manager',0,'mai@email.com','33 Uk 9');
REM INSERTING into PROJECT502.SUPPLIER
SET DEFINE OFF;
Insert into PROJECT502.SUPPLIER (SUPPLIER_ID,SUPPLIER_NAME,SUPPLIER_ADDRESS,CONTACT_PERSON,PHONE_NUMBER) values (1,'Book Channel PLT','No. 45, Jalan Nilam 1/2, Subang Hi-tech Industrial Park, 40000 Shah Alam, Selangor','Lam Chee Long','+60 123456789');
Insert into PROJECT502.SUPPLIER (SUPPLIER_ID,SUPPLIER_NAME,SUPPLIER_ADDRESS,CONTACT_PERSON,PHONE_NUMBER) values (2,'Country Wide Book Distributors','95,97, Jalan Sultan, City Centre, 50000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur','Lai Kim Boon','+60 159753258');
Insert into PROJECT502.SUPPLIER (SUPPLIER_ID,SUPPLIER_NAME,SUPPLIER_ADDRESS,CONTACT_PERSON,PHONE_NUMBER) values (3,'Silverfish Books','63, Lrg Maarof, Bangsar, 59000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur','Vanessa K','+60 764958142');
--------------------------------------------------------
--  DDL for Index BOOKID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."BOOKID_PK" ON "PROJECT502"."BOOK" ("BOOKID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index INVID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."INVID_PK" ON "PROJECT502"."INVENTORY" ("INVID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index STAFFID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."STAFFID_PK" ON "PROJECT502"."STAFF" ("STAFFID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index STAFF_EMAIL_UNIQUE
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."STAFF_EMAIL_UNIQUE" ON "PROJECT502"."STAFF" ("EMAIL") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SUPPLIER_ID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."SUPPLIER_ID_PK" ON "PROJECT502"."SUPPLIER" ("SUPPLIER_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_C007296
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."SYS_C007296" ON "PROJECT502"."MANAGER" ("STAFFID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_C007323
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."SYS_C007323" ON "PROJECT502"."INV_BOOK" ("INVID", "BOOKID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index BOOKID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."BOOKID_PK" ON "PROJECT502"."BOOK" ("BOOKID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index INVID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."INVID_PK" ON "PROJECT502"."INVENTORY" ("INVID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_C007323
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."SYS_C007323" ON "PROJECT502"."INV_BOOK" ("INVID", "BOOKID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_C007296
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."SYS_C007296" ON "PROJECT502"."MANAGER" ("STAFFID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index STAFFID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."STAFFID_PK" ON "PROJECT502"."STAFF" ("STAFFID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index STAFF_EMAIL_UNIQUE
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."STAFF_EMAIL_UNIQUE" ON "PROJECT502"."STAFF" ("EMAIL") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SUPPLIER_ID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "PROJECT502"."SUPPLIER_ID_PK" ON "PROJECT502"."SUPPLIER" ("SUPPLIER_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  Constraints for Table BOOK
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."BOOK" MODIFY ("BOOK_NAME" CONSTRAINT "BOOK_NAME_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."BOOK" MODIFY ("BOOK_AUTHOR" CONSTRAINT "BOOK_AUTHOR_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."BOOK" MODIFY ("BOOK_PRICE" CONSTRAINT "BOOK_PRICE_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."BOOK" MODIFY ("ISBN" CONSTRAINT "ISBN_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."BOOK" MODIFY ("SUPPLIER_ID" CONSTRAINT "SUPPLIER_ID_FK" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."BOOK" MODIFY ("PUBLICATION_DATE" CONSTRAINT "PUBLICATION_DATE_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."BOOK" MODIFY ("IMAGE_URL" CONSTRAINT "IMAGE_URL_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."BOOK" ADD CONSTRAINT "BOOKID_PK" PRIMARY KEY ("BOOKID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Constraints for Table INVENTORY
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."INVENTORY" MODIFY ("STAFFID" CONSTRAINT "STAFFID_FK" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."INVENTORY" MODIFY ("PURCHASE_DATE" CONSTRAINT "PURCHASE_DATE_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."INVENTORY" ADD CONSTRAINT "INVID_PK" PRIMARY KEY ("INVID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Constraints for Table INV_BOOK
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."INV_BOOK" MODIFY ("INVID" CONSTRAINT "INVID_FK" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."INV_BOOK" MODIFY ("BOOKID" CONSTRAINT "BOOKID_FK" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."INV_BOOK" MODIFY ("QUANTITY" CONSTRAINT "QUANTITY_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."INV_BOOK" MODIFY ("PURCHASE_PRICE" CONSTRAINT "PURCHASE_PRICE_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."INV_BOOK" ADD PRIMARY KEY ("INVID", "BOOKID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Constraints for Table MANAGER
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."MANAGER" MODIFY ("BONUS" CONSTRAINT "BONUS_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."MANAGER" ADD PRIMARY KEY ("STAFFID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Constraints for Table STAFF
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("FIRST_NAME" CONSTRAINT "FIRST_NAME_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("LAST_NAME" CONSTRAINT "LAST_NAME_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("PHONE_NUMBER" CONSTRAINT "PHONE_NUMBER_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("SALARY" CONSTRAINT "SALARY_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("HIRE_DATE" CONSTRAINT "HIRE_DATE_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("PASSWORD" CONSTRAINT "PASSWORD_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("POSITION" CONSTRAINT "POSITION_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("EMAIL" CONSTRAINT "EMAIL_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" MODIFY ("ADDRESS" CONSTRAINT "ADDRESS_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."STAFF" ADD CONSTRAINT "STAFFID_PK" PRIMARY KEY ("STAFFID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
  ALTER TABLE "PROJECT502"."STAFF" ADD CONSTRAINT "STAFF_EMAIL_UNIQUE" UNIQUE ("EMAIL")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Constraints for Table SUPPLIER
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."SUPPLIER" MODIFY ("SUPPLIER_NAME" CONSTRAINT "SUPPLIER_NAME_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."SUPPLIER" MODIFY ("SUPPLIER_ADDRESS" CONSTRAINT "SUPPLIER_ADDRESS_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."SUPPLIER" MODIFY ("CONTACT_PERSON" CONSTRAINT "CONTACT_PERSON_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."SUPPLIER" MODIFY ("PHONE_NUMBER" CONSTRAINT "SP_PHONE_NUMBER_NN" NOT NULL ENABLE);
  ALTER TABLE "PROJECT502"."SUPPLIER" ADD CONSTRAINT "SUPPLIER_ID_PK" PRIMARY KEY ("SUPPLIER_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table BOOK
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."BOOK" ADD CONSTRAINT "SUPPLIER_ID_FK_DC" FOREIGN KEY ("SUPPLIER_ID")
	  REFERENCES "PROJECT502"."SUPPLIER" ("SUPPLIER_ID") ON DELETE CASCADE ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table INVENTORY
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."INVENTORY" ADD CONSTRAINT "STAFFID_FK_DC" FOREIGN KEY ("STAFFID")
	  REFERENCES "PROJECT502"."STAFF" ("STAFFID") ON DELETE CASCADE ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table INV_BOOK
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."INV_BOOK" ADD CONSTRAINT "BOOKID_PK_CD" FOREIGN KEY ("BOOKID")
	  REFERENCES "PROJECT502"."BOOK" ("BOOKID") ON DELETE CASCADE ENABLE;
  ALTER TABLE "PROJECT502"."INV_BOOK" ADD CONSTRAINT "INVID_PK_CD" FOREIGN KEY ("INVID")
	  REFERENCES "PROJECT502"."INVENTORY" ("INVID") ON DELETE CASCADE ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table MANAGER
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."MANAGER" ADD CONSTRAINT "STAFFID_M_FK_DC" FOREIGN KEY ("STAFFID")
	  REFERENCES "PROJECT502"."STAFF" ("STAFFID") ON DELETE CASCADE ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table STAFF
--------------------------------------------------------

  ALTER TABLE "PROJECT502"."STAFF" ADD CONSTRAINT "SUPERVISOR_ID_FK" FOREIGN KEY ("STAFFID")
	  REFERENCES "PROJECT502"."STAFF" ("STAFFID") ON DELETE CASCADE ENABLE;
