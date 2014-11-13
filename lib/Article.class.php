<?php
class Article {
	protected 	$erreurs = array(),
				$ID,
				$Name,
				$Price,
				$Description,
				$Long,
				$Large,
				$Categ,
				$Image,
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

	public function setId($id)
	{
		$this->ID = (int)$id;
	}
	
	public function setName($name)
	{
		if (!is_string($name) || empty($name)) {
			$this->erreurs[] = 1;
		}
		else {
			$this->Name = $name;
		}
	}

	public function setPrice($price)
	{
		$this->Price = (int) $price;
	}
	
	public function setDescription($description)
	{
		if (!is_string($description) || empty($description)) {
			$this->erreurs[] = 2;
		}
		else {
			$this->Description = $descrpition;
		}
	}

	public function setLong($long)
	{
		$this->Long = (int) $long;
	}	

	public function setLarge($large)
	{
		$this->Large = (int) $large;
	}
	
	public function setCateg($category)
	{
		if (!is_string($category) || empty($category)) {
			$this->erreurs[] = 3;
		}
		else {
			$this->Categ = $category;
		}
	}
	
	public function setPath($path_image)
	{
		if (!is_string($path_image) || empty($path_image)) {
			$this->erreurs[] = 4;
		}
		else {
			$this->Image = $path_image;
		}
	}
	
	public function setDate($date)
	{
		if (is_string($date) && preg_match('`[0-3][0-9]/[0-1][0-2]/[0-2][0-9]{3}`', $date)) {
			$this->Date = $date;
		}
	}
	
	public function getErrors() {
		return $this->erreurs;
	}
	
	public function getId() {
		return $this->ID;
	}

	public function getName() {
		return $this->Name;
	}

	public function getPrice() {
		return $this->Price;
	}

	public function getDescription() {
		return $this->Description;
	}

	public function getLong() {
		return $this->Long;
	}

	public function getLarge() {
		return $this->Large;
	}

	public function getCateg() {
		return $this->Categ;
	}

	public function getImage() {
		return $this->Image;
	}

	public function getDate() {
		return $this->Date;
	}
}
?>