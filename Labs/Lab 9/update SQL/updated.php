<?php
try { 
$pdo = new PDO('mysql:host=localhost;dbname=videos; charset=utf8', 'root', ''); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'update customers set NAME=:cname,ADDRESS = :caddress WHERE custid = :cid';
$result = $pdo->prepare($sql);
$result->bindValue(':cid', $_POST['ud_id']); 
$result->bindValue(':cname', $_POST['ud_name']); 
$result->bindValue(':caddress', $_POST['ud_address']); 
$result->execute();
     
//For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
     
$count = $result->rowCount();
if ($count > 0)
{
echo "You just updated customer no: " . $_POST['ud_id'] ."  click<a href='selectupdate.php'> here</a> to go back ";
}
else
{
echo "nothing updated. click<a href='selectupdate.php'> here</a> to go back ";
}
}
 
catch (PDOException $e) { 

$output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 

}
