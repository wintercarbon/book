<?php

class Connection
{

    public $user = "PROJECT502";
    public $host = "LOCALHOST";
    public $password = "SYSTEM";
    public $conn;

    public function __construct()
    {
        $this->conn = oci_connect($this->user, $this->password, $this->host);
        if (!$this->conn) {
            $e = oci_error();
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }
}

class Connect extends Connection
{

    public function login($email, $password)
    {

        // use password verify
        $sql = "SELECT EMAIL, PASSWORD FROM STAFF WHERE EMAIL = :email";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':email', $email);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        if ($row) {
            if (password_verify($password, $row['PASSWORD'])) {
                $staff = new Staff();
                $_SESSION['staffid'] = $staff->getStaffId($email);
                //echo 'success';
                return true;
            } else {
                //echo 'idk';
                return false;
            }
        } else {
            return false;
        }

    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['staffid']);
        // direct to index.html
        header('Location: index.php');
        return true;
    }

}

class Staff extends Connection
{

    // get staffid
    public function getStaffId($email)
    {
        $sql = "SELECT STAFFID FROM STAFF WHERE EMAIL = :email";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':email', $email);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['STAFFID'];
    }

    // get staff details
    public function getStaffDetails($staffid)
    {
        $data = array();
        $sql = "SELECT STAFFID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, SALARY, HIRE_DATE, POSITION, EMAIL, ADDRESS, SUPERVISOR_ID FROM STAFF WHERE STAFFID = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // get staff position
    public function getStaffPosition($staffid)
    {
        $sql = "SELECT POSITION FROM STAFF WHERE STAFFID = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['POSITION'];
    }

    // get staff FULL NAME
    public function getStaffFullName($staffid)
    {
        
        $sql = "SELECT FIRST_NAME || ' ' || LAST_NAME AS FULLNAME FROM STAFF WHERE STAFFID = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['FULLNAME'];
    }

    // gett total staff
    public function getTotalStaff()
    {
        $sql = "SELECT COUNT(*) AS TOTAL FROM STAFF";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['TOTAL'];
    }

    // get all staff
    public function getAllStaff()
    {
        $data = array();
        $sql = "SELECT STAFFID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, HIRE_DATE, EMAIL, POSITION, SUPERVISOR_ID FROM STAFF";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // GET SUPPERVISOR NAME
    public function getSupervisorName($supervisorid)
    {
        $sql = "SELECT FIRST_NAME || ' ' || LAST_NAME AS FULLNAME FROM STAFF WHERE STAFFID = :supervisorid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':supervisorid', $supervisorid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['FULLNAME'];
    }

    // get list of staff have position manager
    public function getManagerList()
    {
        $data = array();
        $sql = "SELECT STAFFID, FIRST_NAME || ' ' || LAST_NAME AS FULLNAME FROM STAFF WHERE POSITION = 'Manager'";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // update staff
    public function updateStaff($staffid, $firstname, $lastname, $phonenumber, $email, $address, $position, $salary, $supervisorid)
    {
        $sql = "UPDATE STAFF SET FIRST_NAME = :firstname, LAST_NAME = :lastname, PHONE_NUMBER = :phonenumber, EMAIL = :email, ADDRESS = :address, POSITION = :position, SALARY = :salary, SUPERVISOR_ID = :supervisorid WHERE STAFFID = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        oci_bind_by_name($stmt, ':firstname', $firstname);
        oci_bind_by_name($stmt, ':lastname', $lastname);
        oci_bind_by_name($stmt, ':phonenumber', $phonenumber);
        oci_bind_by_name($stmt, ':email', $email);
        oci_bind_by_name($stmt, ':address', $address);
        oci_bind_by_name($stmt, ':position', $position);
        oci_bind_by_name($stmt, ':salary', $salary);
        oci_bind_by_name($stmt, ':supervisorid', $supervisorid);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    } 
    // delete staff
    public function deleteStaff($staffid)
    {
        $sql = "DELETE FROM STAFF WHERE STAFFID = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    }

    // insert staff
    public function insertStaff($firstname, $lastname, $phonenumber, $hiredate, $email, $address, $position, $salary, $supervisorid, $password)
    {
        $salary = floatval($salary);
        $supervisorid = intval($supervisorid);
        $sql = "INSERT INTO STAFF (STAFFID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, HIRE_DATE, EMAIL, ADDRESS, POSITION, SALARY, SUPERVISOR_ID, PASSWORD) VALUES (STAFF_ID_SEQ.nextval, :firstname, :lastname, :phonenumber, TO_DATE(:hiredate), :email, :address, :position, TO_NUMBER(:salary, 9999999999.99), TO_NUMBER(:supervisorid, 99999), :password)";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':firstname', $firstname);
        oci_bind_by_name($stmt, ':lastname', $lastname);
        oci_bind_by_name($stmt, ':phonenumber', $phonenumber);
        oci_bind_by_name($stmt, ':hiredate', $hiredate);
        oci_bind_by_name($stmt, ':email', $email);
        oci_bind_by_name($stmt, ':address', $address);
        oci_bind_by_name($stmt, ':position', $position);
        oci_bind_by_name($stmt, ':salary', $salary);
        oci_bind_by_name($stmt, ':supervisorid', $supervisorid);
        oci_bind_by_name($stmt, ':password', $password);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    }

    // get staff id seq
    public function getStaffIdSeq()
    {
        $sql = "SELECT STAFF_ID_SEQ.CURRVAL FROM DUAL";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['CURRVAL'];
    }

    // cehck staff id next seq
    public function checkStaffIdNextSeq()
    {
        $sql = "SELECT STAFF_ID_SEQ.NEXTVAL FROM DUAL";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['NEXTVAL'];
    }

}

class Inventory extends Connection
{
    // FETCH FREQUENTLY PURCHASED BOOK

    public function getFrequentlyPurchasedBook()
    {
        // return array
        $data = array();
        $sql = "SELECT b.bookid, b.book_name, b.book_author, b.book_price, b.image_url, SUM(ib.quantity) AS purchase_count
        FROM inv_book ib
        JOIN Book b ON ib.bookid = b.bookid
        WHERE ROWNUM <= 10
        GROUP BY b.book_name, b.book_author, b.book_price, b.bookid, b.image_url
        ORDER BY purchase_count DESC";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;

    }

    // FETCH INVENTORY
    public function getInventory()
    {
        $sql = "SELECT * FROM Inventory";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row;
    }

    // FETCH INVENTORY DETAILS
    public function getInventoryDetails($invid)
    {
        $sql = "SELECT * FROM Inventory WHERE INVID = :invid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':invid', $invid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row;
    }

    // FETCH INVENTORY BOOK
    public function getInventoryBook($invid)
    {
        $sql = "SELECT * FROM inv_book WHERE INVID = :invid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':invid', $invid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row;
    }

    // FETCH INVENTORY BOOK DETAILS
    public function getInventoryBookDetails($invid)
    {
        $sql = "SELECT * FROM inv_book ib
                JOIN Book b ON ib.bookid = b.bookid
                WHERE ib.invid = :invid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':invid', $invid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row;
    }

    // get all staff managed inventory
    public function getStaffManagedInventory($staffid)
    {
        $data = array();
        $sql = "SELECT I.INVID, b.bookid, b.book_name, ib.quantity,ib.purchase_price, b.book_price, i.purchase_date
        FROM Inventory i
        JOIN inv_book ib ON i.invid = ib.invid
        JOIN Book b ON ib.bookid = b.bookid
        WHERE i.staffid = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // get by invid
    public function getInventoryByid($invid, $bookid)
    {
        $data = array();
        $sql = "SELECT I.INVID, b.bookid, b.book_name, ib.quantity,ib.purchase_price, b.book_price, i.purchase_date
        FROM Inventory i
        JOIN inv_book ib ON i.invid = ib.invid
        JOIN Book b ON ib.bookid = b.bookid
        WHERE i.INVID = :INVID AND b.bookid = :bookid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':INVID', $invid);
        oci_bind_by_name($stmt, ':bookid', $bookid);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // update inventory book
    public function updateInventoryBook($invid, $bookid, $quantity, $purchase_price)
    {
        $sql = "UPDATE inv_book SET quantity = :quantity, purchase_price = :purchase_price WHERE invid = :invid AND bookid = :bookid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':invid', $invid);
        oci_bind_by_name($stmt, ':bookid', $bookid);
        oci_bind_by_name($stmt, ':quantity', $quantity);
        oci_bind_by_name($stmt, ':purchase_price', $purchase_price);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    }
    // add inventory
    public function addInventory($staffid)
    {
        $sql = "INSERT INTO Inventory (INVID, STAFFID, PURCHASE_DATE) VALUES (INV_ID_SEQ.NEXTVAL, :staffid, SYSDATE)";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    }

    // add inv book
    public function addInvBook($invid, $bookid, $quantity, $purchase_price)
    {
        $sql = "INSERT INTO inv_book (INVID, BOOKID, QUANTITY, PURCHASE_PRICE) VALUES (:invid, :bookid, :quantity, :purchase_price)";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':invid', $invid);
        oci_bind_by_name($stmt, ':bookid', $bookid);
        oci_bind_by_name($stmt, ':quantity', $quantity);
        oci_bind_by_name($stmt, ':purchase_price', $purchase_price);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    }

    // get inv_id_seq currval
    public function getInvIdSeqCurrval()
    {
        $sql = "SELECT INV_ID_SEQ.CURRVAL AS INVID FROM DUAL";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['INVID'];
    }

}
class Supplier extends Connection {
    // get total supplier
    public function getTotalSupplier() {
        $sql = "SELECT COUNT(*) AS total FROM Supplier";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['TOTAL'];
    }

    // get all supplier details
    public function getAllSupplier() {
        $data = array();
        $sql = "SELECT * FROM Supplier";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // get all supplier_id and supplier_name
    public function getAllSupplierIDName() {
        $data = array();
        $sql = "SELECT supplier_id, supplier_name FROM Supplier";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
}

class INV_BOOK extends Connection {
    // get total purchase
    public function getTotalPurchase() {
        $sql = "SELECT SUM(quantity) AS total FROM inv_book";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['TOTAL'];
    }
    // get total inventory book
    public function getTotalInventoryBook() {
        $sql = "SELECT COUNT(*) AS total FROM inv_book";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['TOTAL'];
    }
}

class BOOK extends Connection {
    // get total unique book
    public function getTotalUniqueBook() {
        $sql = "SELECT COUNT(*) AS total FROM Book";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['TOTAL'];
    }

    // get All Book
    public function getAllBookDetails() {
        $data = array();
        $sql = "SELECT b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, SUM(ib.quantity) as quantity, b.image_url
        FROM inv_book ib
        RIGHT OUTER JOIN Book b ON ib.bookid = b.bookid
        JOIN Supplier s ON b.supplier_id = s.supplier_id
        GROUP BY b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, b.image_url";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // get book details by bookid
    public function getBookDetails($bookid) {
        $data = array();
        $sql = "SELECT b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, SUM(ib.quantity) as quantity, b.image_url
        FROM inv_book ib
        RIGHT OUTER JOIN Book b ON ib.bookid = b.bookid
        JOIN Supplier s ON b.supplier_id = s.supplier_id
        WHERE b.bookid = :bookid
        GROUP BY b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, b.image_url";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':bookid', $bookid);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // get book details by bookid for update
    public function getBookDetailsForUpdate($bookid) {
        $data = array();
        $sql = "SELECT bookid, isbn, book_name, book_author, book_price, publication_date, image_url, supplier_id FROM Book WHERE bookid = :bookid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':bookid', $bookid);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    // update book

    public function updateBook($bookid, $isbn, $book_name, $book_author, $book_price, $publication_date, $image_url, $supplier_id) {
        $sql = "UPDATE BOOK SET ISBN = :isbn, BOOK_NAME = :book_name, BOOK_AUTHOR = :book_author, BOOK_PRICE = :book_price, PUBLICATION_DATE = to_date(:publication_date, 'dd-mon-yyyy'), IMAGE_URL = :image_url, SUPPLIER_ID = :supplier_id WHERE BOOKID = :bookid";
        $stmt = oci_parse($this->conn, $sql);
        if (!$stmt) {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        oci_bind_by_name($stmt, ':bookid', $bookid);
        oci_bind_by_name($stmt, ':isbn', $isbn);
        oci_bind_by_name($stmt, ':book_name', $book_name);
        oci_bind_by_name($stmt, ':book_author', $book_author);
        oci_bind_by_name($stmt, ':book_price', $book_price);
        oci_bind_by_name($stmt, ':publication_date', $publication_date);
        oci_bind_by_name($stmt, ':image_url', $image_url);
        oci_bind_by_name($stmt, ':supplier_id', $supplier_id);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    }
    
    public function deleteBook($bookid) {
        $sql = "DELETE FROM BOOK WHERE BOOKID = :bookid";
        $stmt = oci_parse($this->conn, $sql);
        if (!$stmt) {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        oci_bind_by_name($stmt, ':bookid', $bookid);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    }

    // insert into book
    public function insertBook($isbn, $book_name, $book_author, $book_price, $publication_date, $image_url, $supplier_id) {
        $sql = "INSERT INTO BOOK (BOOKID, ISBN, BOOK_NAME, BOOK_AUTHOR, BOOK_PRICE, PUBLICATION_DATE, IMAGE_URL, SUPPLIER_ID) VALUES (book_id_seq.NEXTVAL, :isbn, :book_name, :book_author, :book_price, to_date(:publication_date, 'dd-mon-yyyy'), :image_url, :supplier_id)";
        $stmt = oci_parse($this->conn, $sql);
        if (!$stmt) {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        oci_bind_by_name($stmt, ':isbn', $isbn);
        oci_bind_by_name($stmt, ':book_name', $book_name);
        oci_bind_by_name($stmt, ':book_author', $book_author);
        oci_bind_by_name($stmt, ':book_price', $book_price);
        oci_bind_by_name($stmt, ':publication_date', $publication_date);
        oci_bind_by_name($stmt, ':image_url', $image_url);
        oci_bind_by_name($stmt, ':supplier_id', $supplier_id);
        $execresult = oci_execute($stmt);
        if($execresult) {
            $result = oci_commit($this->conn);
            oci_close($this->conn);
            return $result;
        } else {
            $e = oci_error($this->conn);
            //trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            oci_rollback($this->conn);
            oci_close($this->conn);
            return false;
        }
    }

    // get current book_id_seq
    public function getBookIdSeq() {
        $sql = "SELECT book_id_seq.currval FROM DUAL";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['CURRVAL'];
    }

    // get all unique book
    public function getAllUniqueBook() {
        $sql = "SELECT DISTINCT BOOK_NAME, BOOKID FROM BOOK";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }



}

?>