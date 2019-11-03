<!DOCTYPE html>
<html>
<head>
<title>
</title>
</head>
<body>

<?php
  $access = false;
  $name = $_POST["brukernavn"];
  $pass = $_POST["passord"];
  
  /*HARDCODE: if ($name == "Admin" && $pass == "Password1") {
  echo '';
  } else {
  echo 'Wrong password';
  }*/
  
  //Code to check a MySql server:
  
  $servername = "localhost";
  $username = "username";
  $password = "password";
  $dbname = "myDB";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT id, brukernavn, passord FROM tabell";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          echo "id: " . $row["id"]. " - Name: " . $row["brukernavn"]. " " . $row["passord"]. "<br>";
          if ($row["brukernavn] == $name && $row["passord"] == $pass) {
          echo 'Welcome ' .$name;
          $access = true;
          }
      }
  } else {
      echo "0 results";
  }
  $conn->close();
  
  if ($access){
  //send user to correct area
  } else {
  echo 'Feil passord eller brukernavn! ';
  }

  
?>


</body>
</html>
