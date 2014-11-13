<?php
class Membre {
	protected	$erreurs = array(),
				$ID,
				$Pseudo,
				$Password,
				$Mail,
				$Admin,
				$Date;

	public function __construct($valeurs = array()) {
		if (!empty($valeurs)) {
			$this->hydrate($valeurs);
		}
	}
	
	public function hydrate($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			$methode = 'set'.ucfirst($attribut);
			
			if (is_callable(array($this, $methode))) {
				$this->$methode($valeur);
			}
		}
	}
	
	public function	isConnected() {
		return isset($_SESSION[ID]);
	}
	
	// SETTERS
	
	public function setID($id) {
		$this->ID = (int) $id;
	}
	
	public function setPseudo($pseudo) {
		if (!is_string($pseudo) || empty($pseudo)) {
			$this->erreur[] = 1;
		}
		else {
			$this->Pseudo = $pseudo;
		}
	}
	
	public function setPassword($pass) {
		if (!is_string($pass) || empty($pass)) {
			$this->erreur[] = 1;
		}
		else {
			$this->Password = $pass;
		}
	}

	public function setMail($mail) {
		if (!is_string($mail) || empty($mail)) {
			$this->erreur[] = 1;
		}
		else {
			$this->Mail = $mail;
		}
	}

	public function setAdmin($admin) {
		$this->Admin = (int) $admin;
	}
	
	public function setDate($date) {
		if (is_string($date) && preg_match('`[0-3][0-9]/[0-1][0-2]/[0-2][0-9]{3}`', $date)) {
			$this->Date = $date;
		}
	}
	
	// GETTERS
	
	public function getID() {
		return $this->ID;
	}
	
	public function getPseudo() {
		return $this->Pseudo;
	}

	public function getPassword() {
		return $this->Password;
	}

	public function getMail() {
		return $this->Mail;
	}

	public function getAdmin() {
		return $this->Admin;
	}
	
	public function getDate() {
		return $this->Date;
	}
}
?>