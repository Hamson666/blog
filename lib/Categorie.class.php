<?php
class Categorie {
	protected 	$erreurs = array(),
				$ID,
				$Name,
				$Description,
				$Date;
				
	public function	__construct($valeurs = array()) {
		if (!empty($valeurs)) {
			$this->hydrate($valeurs);
		}
	}
	
	public function	hydrate($donnees) {
		foreach ($donnees as $attribut => $valeur) {
			$methode = 'set'.ucfirst($attribut);
			
			if (is_callable(array($this, $methode))) {
				$this->$methode($valeur);
			}
		}
	}

	public function setId($id) {
		$this->ID = (int)$id;
	}
	
	public function setName($name) {
		if (!is_string($name) || empty($name)) {
			$this->erreurs[] = 1;
		}
		else {
			$this->Name = $name;
		}
	}
	
	public function setDescription($description) {
		if (!is_string($description) || empty($description)) {
			$this->erreurs[] = 1;
		}
		else {
			$this->Description = $description;
		}
	}
	
	public function setDate($date)
	{
		if (is_string($date) && preg_match('`[0-3][0-9]/[0-1][0-2]/[0-2][0-9]{3}`', $date)) {
			$this->Date = $date;
		}
	}
	
	public function getId() {
		return $this->ID;
	}
	
	public function getName() {
		return $this->Name;
	}

	public function getDescription() {
		return $this->Description;
	}

	public function getDate() {
		return $this->Date;
	}
}
?>