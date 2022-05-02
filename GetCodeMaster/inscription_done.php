<!DOCTYPE html>
<!--
    
 $$$$$$\            $$\     $$$$$$\                 $$\           $$\      $$\                      $$\                              $$\       
$$  __$$\           $$ |   $$  __$$\                $$ |          $$$\    $$$ |                     $$ |                             $$ |      
$$ /  \__| $$$$$$\$$$$$$\  $$ /  \__|$$$$$$\   $$$$$$$ | $$$$$$\  $$$$\  $$$$ | $$$$$$\   $$$$$$$\$$$$$$\   $$$$$$\   $$$$$$\        $$ |      
$$ |$$$$\ $$  __$$\_$$  _| $$ |     $$  __$$\ $$  __$$ |$$  __$$\ $$\$$\$$ $$ | \____$$\ $$  _____\_$$  _| $$  __$$\ $$  __$$\       $$ |      
$$ |\_$$ |$$$$$$$$ |$$ |   $$ |     $$ /  $$ |$$ /  $$ |$$$$$$$$ |$$ \$$$  $$ | $$$$$$$ |\$$$$$$\   $$ |   $$$$$$$$ |$$ |  \__|      \__|      
$$ |  $$ |$$   ____|$$ |$$\$$ |  $$\$$ |  $$ |$$ |  $$ |$$   ____|$$ |\$  /$$ |$$  __$$ | \____$$\  $$ |$$\$$   ____|$$ |                      
\$$$$$$  |\$$$$$$$\ \$$$$  \$$$$$$  \$$$$$$  |\$$$$$$$ |\$$$$$$$\ $$ | \_/ $$ |\$$$$$$$ |$$$$$$$  | \$$$$  \$$$$$$$\ $$ |            $$\       
 \______/  \_______| \____/ \______/ \______/  \_______| \_______|\__|     \__| \_______|\_______/   \____/ \_______|\__|            \__|      
                                                                                                                                                                                                                                                                                                                                                                                                                                     
-->
<?php
$host = 'localhost';
$user = 'root';
$mdp = 'root';
$bdd = 'codemaster';
$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$email  = $_POST["email"];
$motdepasse = generateMotdepasse();
$idcon = new mysqli($host, $user, $mdp, $bdd);
	if ( $idcon ->connect_errno ) {
		exit("Impossible de se connecter à la base de données '$bdd' à cause de l'erreur suivant : " . $idcon->connect_error . "." ) ;
	}
	else {
		$pseudo = pseudo($prenom, $nom, $email, $idcon);
		$sql = "INSERT INTO profils (nom, prenom, email, pseudo, motdepasse) VALUES ('$nom', '$prenom', '$email', '$pseudo', '$motdepasse')";
		if ($idcon->query($sql) == TRUE) {
			;
		} else {
			echo "Error in ".$req."<br>".$idcon->error;
		}
	};


function generateMotdepasse() {
	$numberbytes = openssl_random_pseudo_bytes(6);
	$motdepasse = bin2hex($numberbytes);
	echo $motdepasse;
	return $motdepasse;
}
function pseudo($prenom, $nom, $email, $idcon) {
		
		$pseudo = $prenom[0].$nom;
		$req = "SELECT * FROM profils WHERE pseudo='$pseudo';" ;
		$addition = $idcon->query($req);
		$lignes = $addition->num_rows;
		


	$result=$idcon->query($req);
		if($result){
			if ($result->num_rows> 0) {
          
				$fetchUserData = $result->fetch_assoc(); 
			}
		}
		else{
			echo "Error in ".$req."<br>".$idcon->error;
		}
	
	
	
		if (($lignes ) == 0) {
			return $pseudo;
		}	
		else {
			$pseudo = $pseudo.'-'.$lignes;
			return $pseudo;
		}
}



?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>
      GetCodeMaster :: Votre espace d'elearning lié au monde de la tech
    </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="mdb.min.css" />
    <link rel="stylesheet" href="style.css" />
  </head>
  
  <body>
    <!-- Corps de la page -->
  
    <nav class="navbar navbar-expand-lg bg-light navbar-light" id="mainNav">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="index.html"><img src="Logo.png" height="40" alt="logo" loading="lazy" />
        </a>
  
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
  
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- Link -->
            <li class="nav-item">
              <a class="nav-link" href="Cours.html">Cours</a>
            </li>
  
            <li class="nav-item">
              <a class="nav-link" href="Tutoriels.html">Tutoriels</a>
            </li>
  
            <li class="nav-item">
              <a class="nav-link" href="Inscription.html">Inscription</a>
            </li>
  
            <li class="nav-item">
              <a class="nav-link" href="Contact.html">Contact</a>
            </li>
          </ul>
  
          <!-- Icons -->
  
          <ul class="navbar-nav d-flex flex-row me-1">
            <li class="nav-item me-3 me-lg-0">
              <a class="nav-link" href="#"><i class="fab fa-github"></i></a>
            </li>
            <li class="nav-item me-3 me-lg-0">
              <a class="nav-link" href="#"><i class="fab fa-twitter"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  
    
<header>

</header>

<section id="confirmed">
<br>
	<h2 style="text-align:center">Votre inscription a bien été prise en compte!<h1>
	<h2 style="text-align:center">Bienvenue à CodeMaster!<h1>
	<h2 style="text-align:center">Voici votre pseudo:<?php echo " ".$pseudo?></h1>
	<h2 style="text-align:center">Voici votre mot de passe:<?php echo " ".$motdepasse?></h1>
<br>
</section>
    <!-- Footer -->
    <footer class="
          d-flex
          flex-wrap
          justify-content-between
          align-items-center
          py-3
          my-4
          border-top
        ">
      <p class="col-md-4 mb-0 text-muted">&copy; 2021 GetCodeMaster, Inc</p>
  
      <a class="navbar-brand" href="index.html"><img src="Logo.png" height="40" alt="logo" loading="lazy" />
      </a>
  
      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item">
          <a href="CGU.html" class="nav-link px-2 text-muted">CGU</a>
        </li>
        <li class="nav-item">
          <a href="Privacy.html" class="nav-link px-2 text-muted">Privacy</a>
        </li>
        <li class="nav-item">
          <a href="FAQ.html" class="nav-link px-2 text-muted">FAQ</a>
        </li>
        <li class="nav-item">
          <a href="QuiSommesNous.html" class="nav-link px-2 text-muted">Qui Sommes Nous ?</a>
        </li>
      </ul>
    </footer>
    <!-- Footer -->
  </body>
  
  </html>
