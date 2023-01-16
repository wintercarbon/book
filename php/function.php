<?php

class Connection {

    public $user = "PROJECT502";
    public $host = "LOCALHOST";
    public $password = "SYSTEM";
    public $conn;
    
    public function __construct() {
        $this->conn = oci_connect($this->user, $this->password, $this->host);
        if (!$this->conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }
}

class Connect extends Connection {
    
    public function login($email, $password) {

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

    public function logout() {
        session_destroy();
        unset($_SESSION['staffid']);
        // direct to index.html
        header('Location: index.php');
        return true;
    }

}

class Staff extends Connection {

    // get staffid
    public function getStaffId($email) {
        $sql = "SELECT STAFFID FROM STAFF WHERE EMAIL = :email";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':email', $email);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['STAFFID'];
    }

    // get staff details
    public function getStaffDetails($staffid) {
        $sql = "SELECT * FROM STAFF WHERE STAFFID = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row;
    }

    // get staff position
    public function getStaffPosition($staffid) {
        $sql = "SELECT POSITION FROM STAFF WHERE STAFFID = :staffid";
        $stmt = oci_parse($this->conn, $sql);
        oci_bind_by_name($stmt, ':staffid', $staffid);
        oci_execute($stmt);
        $row = oci_fetch_array($stmt, OCI_ASSOC);
        return $row['POSITION'];
    }

}

?>