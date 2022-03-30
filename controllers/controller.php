<?php
class Controller
{

  // Connection instance
  private $connection;

  // table name
  private $table_name = "pda_version";

  // table columns
  public $id;
  public $id_sistema;
  public $sistema;
  public $cliente;
  public $versao;
  public $createdAt;
  public $updatedAt;

  public function __construct($connection)
  {
    $this->connection = $connection;
  }

  //C
  public function create()
  {
    $query = "INSERT INTO `" . $this->table_name . "`(`id_sistema`,`sistema`,`cliente`,`versao`) VALUES ('" . $this->id_sistema . "','" . $this->sistema . "','" . $this->cliente . "','" . $this->versao . "');";
    $stmt = $this->connection->prepare($query);
    try {
      $result = $stmt->execute();
      echo "stmt";
      print_r($stmt);
      echo "<br/>result";
      print_r($result);
      $sistema = $stmt->fetchone();
      echo "<br/>sistema";
      print_r($sistema);
    } catch (PDOException $exception) {
      echo "Error: " . $exception->getMessage();
    }
    return $result;
  }
  //R
  public function read()
  {
    $query = "SELECT * FROM `" . $this->table_name . "` ORDER BY `cliente` ASC;";
    $stmt = $this->connection->prepare($query);

    $stmt->execute();
    $count = $stmt->rowCount();

    $result = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $p = array(
        "id" => $id,
        "id_sistema" => $id_sistema,
        "sistema" => $sistema,
        "cliente" => $cliente,
        "versao" => $versao,
        "createdAt" => $createdAt,
        "updatedAt" => $updatedAt,
      );
      array_push($result, $p);
    }
    return $result;
  }
  //U
  public function update()
  {
    $query = "UPDATE `" . $this->table_name . "` SET `id_sistema`='" . $this->id_sistema . "',`sistema` = '" . $this->sistema . "',`cliente` = '" . $this->cliente . "',`versao` = '" . $this->versao . "' WHERE `id`='" . $this->id . "' ;";

    $stmt = $this->connection->prepare($query);
    try {
      $stmt->execute();
    } catch (PDOException $exception) {
      echo "Error: " . $exception->getMessage();
    }
    return $stmt;
  }
  //D
  public function delete()
  {
    $query = "DELETE FROM `" . $this->table_name . "` WHERE `id` = '" . $this->id . "';";
    $stmt = $this->connection->prepare($query);

    try {
      $stmt->execute();
    } catch (PDOException $exception) {
      echo "Error: " . $exception->getMessage();
    }
  }
  //R
  public function findById($id)
  {
    $query = "SELECT * FROM `" . $this->table_name . "` WHERE `id` = '" . $id . "' ORDER BY `cliente` ASC;";
    $stmt = $this->connection->prepare($query);

    $stmt->execute();
    $count = $stmt->rowCount();

    $result = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $p = array(
        "id" => $id,
        "id_sistema" => $id_sistema,
        "sistema" => $sistema,
        "cliente" => $cliente,
        "versao" => $versao,
        "createdAt" => $createdAt,
        "updatedAt" => $updatedAt,
      );
      array_push($result, $p);
    }
    return $result;
  }
}
