# book
 project302 (oracle as DBMS)

# dir

- [x] index.php - have signin
   - [ ] homepage.php - menus for staff // check staff position if manager there might be manager only menus
      - [ ] Staff
         - [ ] staff_view.php - table to show all the staff details (limit 10-20 per view // have next button for next.) // (manager only: have edit button)
         - [ ] staff_edit.php - manager only access. here can update staff details and can do action delete.
      - [ ] Inventory
         - [ ] inventory_view.php - shows the inventory details. (view based on staffid -> if there is no staffid under the inventory table, then show "no inventory is being managed by you". (note: manager can view all the inventory details and the staff handling it)
         - [ ] inventory_add.php - staff can add
         - [ ] inventory_edit.php - staff can edit/update book quantity etc.
      - [ ] Book
         - [ ] book_view.php - table to show all the book details (limit 10-20 per view // have next button for next.) // (manager only: have edit button)
         - [ ] book_edit.php - manager only access. here can update book details and can do action delete.
      - [ ] Supplier
         - [ ] supplier_view.php - table to show all the supplier details (limit 10-20 per view // have next button for next.) // (manager only: have edit button)
         - [ ] supplier_edit.php - manager only access. here can update supplier details and can do action delete.


 - [ ] php functions
    - [ ] get_staff_data - handles the retrieval of staff data from the database.
    - [ ] get_inventory_data - handles the retrieval of inventory data from the database.
    - [ ] get_book_data - handles the retrieval of book data from the database.
    - [ ] get_supplier_data - handles the retrieval of supplier data from the database.
    - [ ] add_staff - handles the submission of new staff data to the database.
    - [ ] add_inventory - handles the submission of new inventory data to the database.
    - [ ] add_book - handles the submission of new book data to the database.
    - [ ] add_supplier - handles the submission of new supplier data to the database.

# page descriptions
- Staff management page: This page would allow a manager to view and manage all staff members, including their personal details, salary information, and the staff members they supervise. It could also include functionality for adding, editing, and deleting staff members, as well as assigning supervisors.
(staff_view.php, staff_add.php, staff_edit.php)

- Inventory management page: This page would allow a staff member to view and manage the inventory they handle, including the books they have in stock and the suppliers they purchase from. It could also include functionality for adding, editing, and deleting inventory items, as well as updating the quantity of books in stock.
(inventory_view.php, inventory_add.php, inventory_edit.php)

- Book management page: This page would allow a staff member to view and manage all books, including their details, authors, prices, and suppliers. It could also include functionality for adding, editing, and deleting books.
(book_view.php, book_add.php, book_edit.php)

- Supplier management page: This page would allow a staff member to view and manage all suppliers, including their details, addresses, and contact information. It could also include functionality for adding, editing, and deleting suppliers.
(supplier_view.php, supplier_add.php, supplier_edit.php)

- Login page: This page would allow staff members to log in to the system with their email and password, allowing them to access the pages appropriate to their role.

- Home page: This page would provide a summary of the different sections of the website and allow users to navigate to the pages they need

# ERD
![images](https://github.com/wintercarbon/book/blob/main/erd%20latest.jpg)


# how to
- how to import sql
1)  create schema "PROJECT502" dulu (ikut dlam notes lab 11)
2) make the connection
3) import data (try follow https://www.youtube.com/watch?v=xO5HLHocHxw )


### --- 
# DDL
```sql


CREATE TABLE Staff
(
staffid NUMBER(5) CONSTRAINT staffid_pk PRIMARY KEY,
first_name VARCHAR2(50) CONSTRAINT first_name_nn NOT NULL,
last_name VARCHAR2(50) CONSTRAINT last_name_nn NOT NULL,
phone_number VARCHAR2(20) CONSTRAINT phone_number_nn NOT NULL,
salary NUMBER(10,2) CONSTRAINT salary_nn NOT NULL,
hire_date DATE CONSTRAINT hire_date_nn NOT NULL,
password VARCHAR2(255) CONSTRAINT password_nn NOT NULL,
position VARCHAR2(50) CONSTRAINT position_nn NOT NULL,
supervisor_id NUMBER(5) CONSTRAINT supervisor_id_fk REFERENCES Staff(staffid) ON UPDATE CASCADE,
email VARCHAR2(50) CONSTRAINT email_nn NOT NULL,
address VARCHAR2(100) CONSTRAINT address_nn NOT NULL
);

CREATE TABLE Manager
(
staffid NUMBER(5) PRIMARY KEY,
bonus NUMBER(10,2) CONSTRAINT bonus_nn NOT NULL,
FOREIGN KEY (staffid) REFERENCES Staff(staffid) ON UPDATE CASCADE
);

CREATE TABLE Inventory
(
invid NUMBER(5) CONSTRAINT invid_pk PRIMARY KEY,
staffid NUMBER(5) CONSTRAINT staffid_fk NOT NULL,
purchase_date DATE CONSTRAINT purchase_date_nn NOT NULL,
FOREIGN KEY (staffid) REFERENCES Staff(staffid) ON UPDATE CASCADE
);

CREATE TABLE Supplier
(
supplier_id NUMBER(5) CONSTRAINT supplier_id_pk PRIMARY KEY,
supplier_name VARCHAR2(50) CONSTRAINT supplier_name_nn NOT NULL,
supplier_address VARCHAR2(100) CONSTRAINT supplier_address_nn NOT NULL,
contact_person VARCHAR2(50) CONSTRAINT contact_person_nn NOT NULL,
phone_number VARCHAR2(20) CONSTRAINT sp_phone_number_nn NOT NULL
);

CREATE TABLE Book
(
bookid NUMBER(5) CONSTRAINT bookid_pk PRIMARY KEY,
book_name VARCHAR2(100) CONSTRAINT book_name_nn NOT NULL,
book_author VARCHAR2(100) CONSTRAINT book_author_nn NOT NULL,
book_price NUMBER(10,2) CONSTRAINT book_price_nn NOT NULL,
isbn VARCHAR2(20) CONSTRAINT isbn_nn NOT NULL,
supplier_id NUMBER(5) CONSTRAINT supplier_id_fk NOT NULL,
publication_date DATE CONSTRAINT publication_date_nn NOT NULL,
image_url VARCHAR2(200) CONSTRAINT image_url_nn NOT NULL,
FOREIGN KEY (supplier_id) REFERENCES Supplier(supplier_id) ON UPDATE CASCADE
);

CREATE TABLE inv_book
(
invid NUMBER(5) CONSTRAINT invid_fk NOT NULL,
bookid NUMBER(5) CONSTRAINT bookid_fk NOT NULL,
quantity NUMBER(5) CONSTRAINT quantity_nn NOT NULL,
purchase_price NUMBER(10,2) CONSTRAINT purchase_price_nn NOT NULL,
PRIMARY KEY (invid, bookid),
FOREIGN KEY (invid) REFERENCES Inventory(invid) ON UPDATE CASCADE,
FOREIGN KEY (bookid) REFERENCES Book(bookid) ON UPDATE CASCADE
);

ALTER TABLE Staff ADD CONSTRAINT email_uk UNIQUE (email);

-- sequence
CREATE SEQUENCE book_id_seq START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE inv_id_seq START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE manager_id_seq START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE staff_id_seq START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE supplier_id_seq START WITH 1 INCREMENT BY 1;
```

# DML
// im getting all of this from the php\function.php
```sql
-- note: :<something> is to bound data using php method.

SELECT EMAIL, PASSWORD FROM STAFF WHERE EMAIL = :email;

SELECT STAFFID FROM STAFF WHERE EMAIL = :email;

SELECT STAFFID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, SALARY, HIRE_DATE, POSITION, EMAIL, ADDRESS, SUPERVISOR_ID FROM STAFF WHERE STAFFID = :staffid;

SELECT POSITION FROM STAFF WHERE STAFFID = :staffid;

SELECT FIRST_NAME || ' ' || LAST_NAME AS FULLNAME FROM STAFF WHERE STAFFID = :staffid;

SELECT COUNT(*) AS TOTAL FROM STAFF;

SELECT STAFFID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, HIRE_DATE, EMAIL, POSITION, SUPERVISOR_ID FROM STAFF;

SELECT FIRST_NAME || ' ' || LAST_NAME AS FULLNAME FROM STAFF WHERE STAFFID = :supervisorid;

SELECT STAFFID, FIRST_NAME || ' ' || LAST_NAME AS FULLNAME FROM STAFF WHERE POSITION = 'Manager';

UPDATE STAFF SET FIRST_NAME = :firstname, LAST_NAME = :lastname, PHONE_NUMBER = :phonenumber, EMAIL = :email, ADDRESS = :address, POSITION = :position, SALARY = :salary, SUPERVISOR_ID = :supervisorid WHERE STAFFID = :staffid;

DELETE FROM STAFF WHERE STAFFID = :staffid;

INSERT INTO STAFF (STAFFID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, HIRE_DATE, EMAIL, ADDRESS, POSITION, SALARY, SUPERVISOR_ID, PASSWORD) VALUES (STAFF_ID_SEQ.nextval, :firstname, :lastname, :phonenumber, TO_DATE(:hiredate), :email, :address, :position, TO_NUMBER(:salary, 9999999999.99), TO_NUMBER(:supervisorid, 99999), :password);

SELECT STAFF_ID_SEQ.CURRVAL FROM DUAL;

SELECT STAFF_ID_SEQ.NEXTVAL FROM DUAL;

UPDATE STAFF SET EMAIL = :email, PHONE_NUMBER = :phone WHERE STAFFID = :staffid;

UPDATE STAFF SET PASSWORD = :password WHERE STAFFID = :staffid;

SELECT PASSWORD FROM STAFF WHERE STAFFID = :staffid;

SELECT b.bookid, b.book_name, b.book_author, b.book_price, b.image_url, SUM(ib.quantity) AS purchase_count
        FROM inv_book ib
        JOIN Book b ON ib.bookid = b.bookid
        WHERE ROWNUM <= 10
        GROUP BY b.book_name, b.book_author, b.book_price, b.bookid, b.image_url
        ORDER BY purchase_count DESC;

SELECT * FROM Inventory;

SELECT * FROM Inventory WHERE INVID = :invid;

SELECT * FROM inv_book WHERE INVID = :invid;

SELECT * FROM inv_book ib
                JOIN Book b ON ib.bookid = b.bookid
                WHERE ib.invid = :invid;

SELECT I.INVID, b.bookid, b.book_name, ib.quantity,ib.purchase_price, b.book_price, i.purchase_date
        FROM Inventory i
        JOIN inv_book ib ON i.invid = ib.invid
        JOIN Book b ON ib.bookid = b.bookid
        WHERE i.staffid = :staffid;

SELECT I.INVID, b.bookid, b.book_name, ib.quantity,ib.purchase_price, b.book_price, i.purchase_date
        FROM Inventory i
        JOIN inv_book ib ON i.invid = ib.invid
        JOIN Book b ON ib.bookid = b.bookid
        WHERE i.INVID = :INVID AND b.bookid = :bookid;

UPDATE inv_book SET quantity = :quantity, purchase_price = :purchase_price WHERE invid = :invid AND bookid = :bookid;

INSERT INTO Inventory (INVID, STAFFID, PURCHASE_DATE) VALUES (INV_ID_SEQ.NEXTVAL, :staffid, SYSDATE);

INSERT INTO inv_book (INVID, BOOKID, QUANTITY, PURCHASE_PRICE) VALUES (:invid, :bookid, :quantity, :purchase_price);

SELECT INV_ID_SEQ.CURRVAL AS INVID FROM DUAL;

SELECT COUNT(*) AS total FROM Supplier;

SELECT * FROM Supplier;

SELECT supplier_id, supplier_name FROM Supplier;

SELECT * FROM Supplier WHERE supplier_id = :supplier_id;

UPDATE Supplier SET supplier_name = :supplier_name, supplier_address = :supplier_address, contact_person = :contact_person, phone_number = :phone_number WHERE supplier_id = :supplier_id;

INSERT INTO Supplier (supplier_id, supplier_name, supplier_address, contact_person, phone_number) VALUES (supplier_id_seq.nextval, :supplier_name, :supplier_address, :contact_person, :phone_number);

SELECT supplier_id_seq.currval AS supplier_id FROM dual;

DELETE FROM Supplier WHERE supplier_id = :supplier_id;

SELECT SUM(quantity) AS total FROM inv_book;

SELECT COUNT(*) AS total FROM inv_book;

SELECT COUNT(*) AS total FROM Book;

SELECT b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, SUM(ib.quantity) as quantity, b.image_url
        FROM inv_book ib
        RIGHT OUTER JOIN Book b ON ib.bookid = b.bookid
        JOIN Supplier s ON b.supplier_id = s.supplier_id
        GROUP BY b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, b.image_url;

SELECT b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, SUM(ib.quantity) as quantity, b.image_url
        FROM inv_book ib
        RIGHT OUTER JOIN Book b ON ib.bookid = b.bookid
        JOIN Supplier s ON b.supplier_id = s.supplier_id
        WHERE b.bookid = :bookid
        GROUP BY b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, b.image_url;

SELECT bookid, isbn, book_name, book_author, book_price, publication_date, image_url, supplier_id FROM Book WHERE bookid = :bookid;

UPDATE BOOK SET ISBN = :isbn, BOOK_NAME = :book_name, BOOK_AUTHOR = :book_author, BOOK_PRICE = :book_price, PUBLICATION_DATE = to_date(:publication_date, 'dd-mon-yyyy'), IMAGE_URL = :image_url, SUPPLIER_ID = :supplier_id WHERE BOOKID = :bookid;

DELETE FROM BOOK WHERE BOOKID = :bookid;

INSERT INTO BOOK (BOOKID, ISBN, BOOK_NAME, BOOK_AUTHOR, BOOK_PRICE, PUBLICATION_DATE, IMAGE_URL, SUPPLIER_ID) VALUES (book_id_seq.NEXTVAL, :isbn, :book_name, :book_author, :book_price, to_date(:publication_date, 'dd-mon-yyyy'), :image_url, :supplier_id);

SELECT book_id_seq.currval FROM DUAL;

SELECT DISTINCT BOOK_NAME, BOOKID FROM BOOK;

```
