<?php
require 'Membre.class.php';

class MembreManager {
	protected	$bdd;
	
	public function __construct(PDO $bdd) {
		$this->bdd = $bdd;
	}
	
	public function getMembrePseudo($pseudo) {
		$requete = $this->bdd->prepare('SELECT ID, Pseudo, Password, Mail, Admin, DATE_FORMAT(Date, \'%d/%m/%Y\') AS Date FROM membres WHERE Pseudo = :pseudo');
		$requete->bindValue(':pseudo', $pseudo);
		$requete->execute();
		
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Membre');
		
		$membre =  $requete->fetch();
		
		return $membre;
	}
	
	public function getMembreMail($mail) {
		$requete = $this->bdd->prepare('SELECT ID, Pseudo, Password, Mail, Admin, DATE_FORMAT(Date, \'%d/%m/%Y\') AS Date FROM membres WHERE Mail = :mail');
		$requete->bindValue(':mail', $mail);
		$requete->execute();
		
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Membre');
		
		$membre =  $requete->fetch();
		
		return $membre;	
	}
	
	public function connect($pseudo, $pass, $membre) {
		$pass = sha1($pass);
		$membre = self::getMembrePseudo($pseudo);
		
		if (!$membre) {
			echo '<p>Login ou mot de passe incorrect<br />Pas encore inscrit ? Rendez-vous à cette adresse : <a href="">Inscription</a></p>';
		}
		else {
			if ($pass == $membre->getPassword())
			{
				$_SESSION['ID'] = $membre->getID();
				$_SESSION['Pseudo'] = $membre->getPseudo();
				$_SESSION['Mail'] = $membre->getMail();
				$_SESSION['Admin'] = $membre->getAdmin();
				$_SESSION['Panier'] = array();
				$_SESSION['Prix'] = 0;
				echo '<p>Vous êtes maintenant connecté !</p>';
			}
			else {
				echo '<p>Login ou mot de passe incorrect<br />Pas encore inscrit ? Rendez-vous à cette adresse : <a href="">Inscription</a></p>';
			}
		}
	}
		
	public function disconnect() {
		if ($_SESSION['ID'] != "") {
			$_SESSION = array();
			session_destroy();
			echo '<p>Vous êtes maintenant deconnecté !</p>';
		}
		else {
			echo '<p>Vous n\'êtes pas connecté !</p>';
		}
	}
	
	public function register(Membre $membre) {
		$verif = self::getMembreMail($membre->getMail());
		$verif2 = self::getMembrePseudo($membre->getPseudo());
		
		if (!$verif && !$verif2) {
			$requete = $this->bdd->prepare('INSERT INTO membres(Pseudo, Mail, Password, Admin, Date) VALUES (:pseudo, :mail, :password, :admin, NOW())');

			$requete->bindValue(':pseudo', $membre->getPseudo());
			$requete->bindValue(':mail', $membre->getMail());
			$requete->bindValue(':password', $membre->getPassword());
			$requete->bindValue(':admin', 0);

			$requete->execute;

			echo '<p>Vous êtes désormais inscris !</p>';
		}
		else {
			echo '<p>Vous êtes déjà inscrit !<br />Pour vous connecter, c\'est ici : <a href="connexion.php">Connexion</a></p>';
		}
	}
	
	public function update(Membre $membre) {
		$verif = self::getMembrePseudo($membre->getPseudo());
		
		if ($verif) {
			$requete = $this->bdd->prepare('UPDATE membres SET Mail = :mail, Password = :password, Admin = :admin');
			
			$requete->bindValue(':mail', $membre->getMail());
			$requete->bindValue(':password', $membre->getPassword());
			$requete->bindValue(':admin', $membre->getAdmin());
		}
	}
}
?>