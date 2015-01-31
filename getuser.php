<?php

// print_r(PDO::getAvailableDrivers());

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

if(isset($_POST['name'])) { 
      
  $name = $_POST['name'];

  $query = $handler->query("SELECT * FROM actor WHERE first_name = '$name'");
  $query->setFetchMode(PDO::FETCH_CLASS, 'Actor');
  $results = $query->fetchAll();
  
  if(count($results)) {
    foreach ($results as $r) {
      echo "<div>", $r->full_name, "</div>";
    }
  } else {
    echo "Query returned no results.";
  }
}

?>
