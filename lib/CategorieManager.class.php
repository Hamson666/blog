<?php
class CategorieManager {
	protected	$bdd;
	
	public function __construct(PDO $bdd)
	{
		$this->bdd = $bdd;
	}
	
	
}
?>