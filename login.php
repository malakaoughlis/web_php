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



  //connexion a un compte existant

if (isset($_POST['check'])) //verifier que les checkbox sont bien check
 {  
  $choix = $_POST['check']; //user ou fournisseur ?

  //utilisateur
 if ($choix === 'Utilisateur') {

	$email_u=$_POST['email'];
	$password_u = $_POST['password'];
	$sql = "SELECT * FROM utilisateur WHERE email = '$email_u'";
	$result = $lien->query($sql);

	if ($result->num_rows > 0) {
		// L'e-mail existe déjà, verifie si email et mdp compatible
		$query = "SELECT * FROM utilisateur WHERE email='$email_u' AND password='$password_u'";
	    $resultat = mysqli_query($lien, $query);
		//true
		   if (mysqli_num_rows($resultat) == 1) {
			    // redirection  
				session_start(); 
				$_SESSION['session_id']="SELECT ID from user";
			    header('Location: +compte.html');
			    exit;}
		//false
		   else {
			     echo "<p > email ou mot de passe invalide.</p>";
				 header('Location: index.html');
		    }
			mysqli_close($lien); //ferme le flux de connexion
	    }
	 else {
		// L'e-mail n'existe pas
		header('Location: user.html');
	     }
	
} //fournisseur
elseif ($choix === 'Fournisseur') {

	$email_f=$_POST['email'];
	$password_f = $_POST['password'];
	$sql = "SELECT * FROM utilisateur WHERE email = '$email_f'";
	$result = $lien->query($sql);

	if ($result->num_rows > 0) {
		// L'e-mail existe déjà, verifie si email et mdp compatible
		$query = "SELECT * FROM fournisseur WHERE email='$email_f' AND password='$password_f'";
	    $resultat = mysqli_query($lien, $query);
		//true
		   if (mysqli_num_rows($resultat) == 1) {
			    // redirection  
				session_start(); 
				$_SESSION['session_id']=$resulat[0];
			    header('Location: fourn2.html');
			    exit;}
		//false
		   else {
			     echo "<p > email ou mot de passe invalide.</p>";
				 header('Location: index.html');
		    }
			mysqli_close($lien); //ferme le flux de connexion
	    }
	 else {
		// L'e-mail n'existe pas
		header('Location: fournisseur.html');
	     }
}

}
else{
	 header('Location: index.html');
}




//partie creation de compte

//user
if (isset($_POST['user'])) {
	// recuperer les donnees
	$nom_u=$_POST["nom_u"];
	$prenom_u=$_POST["prenom_u"];
	$mail_u=$_POST["email_u"];
	$mdp_u=$_POST["password_u"];
	$dn_u=$_POST["date_naissance_u"];
	$poids_u=$_POST["poids_u"];
	$taille_u=$_POST["taille_u"];
	$imc_u=(($poids_u -20)*15+1500)/1000;
	

	// insert into BDD
	$sql = "INSERT INTO utilisateur (nom, prenom, email, motdepasse, poids, taille) VALUES ('$nom_u', '$prenom_u', '$mail_u', '$mdp_u', '$poids_u', '$taille_u')";
	if (mysqli_query($lien, $sql)) {
		// redirection
		header('Location: +compte.html');
		exit();
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($lien);
	}
	mysqli_close($lien); //fermer le flux de connexion
}
else{
	header('Location: user.html');
}

//fournisseur
if (isset($_POST['fournisseur'])) {
	// recuperer les donnees
	$nom_f=$_POST["nom_f"];
	$prenom_f=$_POST["prenom_f"];
	$mail_f=$_POST["email_f"];
	$mdp_f=$_POST["password_f"];
	$dn_f=$_POST["date_naissance_f"];
	$wilaya_f=$_POST["wilaya_f"];

	// insert into BDD
	$sql = "INSERT INTO fournisseur (nom, prenom, email, motdepasse, wilaya) VALUES ('$nom_f', '$prenom_f', '$mail_f', '$mdp_f', '$wilaya_f')";
	if (mysqli_query($lien, $sql)) {
		// redirection
		header('Location: +fourn2.html');
		exit();
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($lien);
	}
	mysqli_close($lien); //fermer le flux de connexion
}
else{
	header('Location: fournisseur.html');
}





//logout
if (isset($_POST['logout_u'])) {
	session_destroy();
}

if (isset($_POST['logout_f'])) {
	session_destroy();
}




//ajouter une eau pour un fournisseur
if (isset($_POST['ajouteau'])) {
	
		// insert into BDD
		$sql = "INSERT INTO eau (nom, litres, potassium, magnesium, wilaya) VALUES ('$nom_f', '$prenom_f', '$mail_f', '$mdp_f', '$wilaya_f')";
		if (mysqli_query($lien, $sql)) {
			// redirection
			header('Location: +fourn2.html');
			exit();}
}


?>
