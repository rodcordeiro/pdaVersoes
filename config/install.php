<?php 
include_once '../db/db.class.php';

try 
{
  $dbclass = new Database(); 
  $connection = $dbclass->getConnection();
  $sql = file_get_contents("database/database.sql"); 
  $connection->exec($sql);
  echo "Database and tables created successfully!";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}?>
