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
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
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
        $sql = "SELECT * FROM STAFF WHERE STAFFID = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row;
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
        $sql = "SELECT b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, ib.quantity
        FROM inv_book ib
        JOIN Book b ON ib.bookid = b.bookid
        JOIN Supplier s ON b.supplier_id = s.supplier_id";
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
        $sql = "SELECT b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, ib.quantity, b.image_url
        FROM inv_book ib
        JOIN Book b ON ib.bookid = b.bookid
        JOIN Supplier s ON b.supplier_id = s.supplier_id
        WHERE b.bookid = :bookid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':bookid', $bookid);
        oci_execute($stmt);
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

}

?>