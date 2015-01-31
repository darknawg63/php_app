<?php

// print_r(PDO::getAvailableDrivers());

header('Content-Type: application/json');

try {

  $handler = new PDO('mysql:host=localhost;dbname=sakila', 'root', 'password');
  $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    echo $e->getMessage();
    die();
    // die('Could not connect to database.');
}

class Actor {
  public $id, $first_name, $last_name, $full_name;

  public function __construct() {
    $this->full_name = "{$this->first_name} {$this->last_name}";
  }
}

if(isset($_GET['name'])) { 
      
  $name = $_GET['name'];

  $query = $handler->query("SELECT * FROM actor WHERE first_name LIKE '%$name%' LIMIT 6");

  $results = $query->fetchAll(PDO::FETCH_ASSOC);
  
  if(count($results)) { 

      echo json_encode($results);
  } else {

    echo "Query returned no results.";
  }
}

?>
