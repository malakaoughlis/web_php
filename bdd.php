<?php

	  
//db config
$servername=;
$username=;
$password=;
$dbname=;

//connexion
$lien=mysqli_connect($servername,$username,$password,$dbname);

//verifier la connexion 
if(mysqli_connect_error())
{
  echo"La connexion a echoue ! <br>" ;
}


//form de la BDD
if(isset($_POST['bdd']))
{
  $sql="SELECT * FROM EAU ";
  $result = $lien->query($sql);

    // Vérifier si des résultats ont été trouvés
    if ($result->num_rows > 0) {
      // Afficher les instances
      while ($row = $result->fetch_assoc()) {
          // Afficher les données de chaque instance
          echo "Nom : " . $row['nom'] . "<br>";
          echo "Disponibilite des litres : " . $row['litres'] . "<br>";
          echo "Potassium : " . $row['potassium'] . "<br>";
          echo "Calcium : " . $row['calcium'] . "<br>";
          echo "Magnesium : " . $row['magnesium'] . "<br>";
          echo "Sodium : " . $row['sodium'] . "<br>";
          echo "Bicarbonate : " . $row['bicarbonate'] . "<br>";
          echo "Sulfates : " . $row['sulfates'] . "<br>";
          echo "Chlorure : " . $row['chlorure'] . "<br>";
          echo "Nitrate : " . $row['nitrate'] . "<br>";
          echo "Nitrite : " . $row['nitrite'] . "<br>";
          echo "PH : " . $row['ph'] . "<br>";
          echo "<br>";
          echo "<br>";
      }
  } else {
      echo "Aucun résultat trouvé.";
  }
  
}




//form de composants d'une marque
if(isset($_POST['reseign']))
{
  $marqueau=$_POST['renseignements'];
  $sql="SELECT * FROM EAU WHERE NOM=$marqueau";
  $result = $lien->query($sql);

  // Vérifier si des résultats ont été trouvés
  if ($result->num_rows > 0) {
    // Afficher les instances
    while ($row = $result->fetch_assoc()) {
        // Afficher les données de chaque instance
        echo "Nom : " . $row['nom'] . "<br>";
        echo "Potassium : " . $row['potassium'] . "<br>";
        echo "Calcium : " . $row['calcium'] . "<br>";
        echo "Magnesium : " . $row['magnesium'] . "<br>";
        echo "Sodium : " . $row['sodium'] . "<br>";
        echo "Bicarbonate : " . $row['bicarbonate'] . "<br>";
        echo "Sulfates : " . $row['sulfates'] . "<br>";
        echo "Chlorure : " . $row['chlorure'] . "<br>";
        echo "Nitrate : " . $row['nitrate'] . "<br>";
        echo "Nitrite : " . $row['nitrite'] . "<br>";
        echo "PH : " . $row['ph'] . "<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}
}




//form pour l'equivalent d'une marque
if(isset($_POST['compare']))
{

  //recupere les donnees
  $marque = $_POST['equiva'];
  $composant = $_POST['choix'];

      // Vérifier si la marque d'eau existe dans la base de données
      $checkMarque= "SELECT * FROM EAU WHERE marque = '$marque'";
      $checkMarqueResult = $lien->query($checkMarque);
  
      if ($checkMarqueResult->num_rows > 0) {
          // La marque d'eau existe dans la base de données, Requête SQL pour trouver l'eau la plus proche
  $sql = "SELECT * FROM EAU WHERE marque = '$marque' ORDER BY ABS(composant - $composant) LIMIT 1";
  $result = $lien->query($sql);

  // Vérifier si un résultat a été trouvé
  if ($result->num_rows > 0) {
      // Afficher les détails de l'eau la plus proche
      while ($row = $result->fetch_assoc()) {
          echo "Nom de la marque d'eau minerale equivalente: " . $row['nom'] . "<br>";
         
      }
  } 
  echo "<a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.</p>";
}  else {
  echo "Nous sommes navres mais cette marque n'existe pas dans notre base de données." ;
  echo "<a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
}

  }


  //partie +
if(isset($_POST['recherche+'])){
  $attribut = $_POST['choix+'];
  $inputString = (string) $attribut;

  // Exécuter la requête pour trouver l'eau avec l'attribut choisi ayant la valeur la plus élevée
  $sql = "SELECT * FROM EAU WHERE $inputString = '$attribut' ORDER BY valeur DESC LIMIT 1";
  $result = $lien->query($sql);

  // Vérifier si un résultat a été trouvé
  if ($result->num_rows ==1) {
      // Afficher les détails de l'eau ayant l'attribut choisi avec la valeur la plus élevée
      while ($row = $result->fetch_assoc()) {
          echo "Nom : " . $row['nom'] . "<br>";
        
      }
    }
    echo " <br> <a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
  }



  //partie -
if(isset($_POST['recherche-'])){
  $attribut = $_POST['choix-'];
  $inputString = (string) $attribut;

  // Exécuter la requête pour trouver l'eau avec l'attribut choisi ayant la valeur la plus élevée
  $sql = "SELECT * FROM EAU WHERE $inputString = '$attribut' ORDER BY valeur ASC DESC LIMIT 1";
  $result = $lien->query($sql);

  // Vérifier si un résultat a été trouvé
  if ($result->num_rows ==1) {
      // Afficher les détails de l'eau ayant l'attribut choisi avec la valeur la plus élevée
      while ($row = $result->fetch_assoc()) {
          echo "Nom : " . $row['nom'] . "<br>";
        
      }
    }
    echo " <br> <a href='javascript:history.go(-1)'>Cliquez ici pour revenir</a>.";
  }


  
// Fermer la connexion à la base de données
$lien->close();


?>