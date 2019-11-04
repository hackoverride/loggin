<!DOCTYPE html>
<html>
    <head>
        <title>
            
        </title>
        <style>
            body{background-color: #B8D2D5; width: 100%; height: 100%; margin: 20px; font-size: 300%;}
        </style>
    </head>
    <body>
        <?php

        $ny = $_POST["new"];
        if ($ny == "on"){
            
            //Sjekk om brukernavn allerede finnes.
            brukerSjekk("ny");
            
        } else {
            //sjekker DB om bruker eksisterer og om passord stemmer...
            
            if (brukerSjekk("sjekk")){
                echo 'Velkommen! Du har tastet riktig brukernavn og passord.';
            //Kode her!
            } else {
                echo 'Feil bruker eller passord.';
            }
        }
        
        function brukerSjekk($inn){
            $servername = "********";
            $username = "********";
            $password = "********";
            $dbname = "********";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            if($inn == "sjekk"){
            $sql = "SELECT Bruker, Passord FROM Brukere";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    if ($row["Bruker"] == $_POST["bruker"] && $row["Passord"] == $_POST["passord"]){
                        return true;
                    }
                }
            } else {
            return false;
            }
            
            } else if ($inn == "ny") {
                $kom = date("j F Y");
                $sql = "INSERT INTO `Brukere`(`Bruker`, `Fornavn`, `Etternavn`, `Passord`, `Kommentar`) VALUES ('".$_POST['bruker']."','".$_POST['fnavn']."','".$_POST["enavn"]."','".$_POST['passord']."','".$kom."')";
                $result = $conn->query($sql);
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
            return false;
        }
        ?>
        
    </body>
</html>
