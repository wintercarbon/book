<?php
session_start();    
// update bookid = 1
require_once('php/function.php');
$connect = new Connect();
$book = new BOOK();
if($r = $book->deleteBook(16)) {
    echo "Book deleted";
} else {
    echo "Book not deleted";
}

var_dump($r);
?>