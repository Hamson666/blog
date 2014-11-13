<?php
class ArticleManager {
	protected	$bdd;
	
	public function __construct(PDO $bdd)
	{
		$this->bdd = $bdd;
	}
	
	public function	add(Article $article)
	{
		$requete = $this->bdd->prepare('INSERT INTO shop(Nom, Categorie, Prix, Longueur, Largeur, Description, Image, Date) VALUES(:name, :category, :price, :long, :large, :description, :path_image, :date_add)');

		$requete->bindValue(':name', $article->getName());
		$requete->bindValue(':category', $article->getCateg());
		$requete->bindValue(':price', (int) $article->getPrice(), PDO::PARAM_INT);
		$requete->bindValue(':long', (int) $article->getLong(), PDO::PARAM_INT);
		$requete->bindValue(':large', (int) $article->getLarge(), PDO::PARAM_INT);
		$requete->bindValue(':description', $article->getDescription());
		$requete->bindValue(':path_image', $article->getImage());
		$requete->bindValue(':date_add', $article->getDate());

		$requete->execute;
		
		echo '<p>Article ajouté !</p>';
	}
	
	public function getAll()
	{
		$requete = $this->bdd->prepare('SELECT * FROM shop ORDER BY ID DESC');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		
		$listeArticles = $requete->fetchAll();
		
		$requete->closeCursor();
		
		return $listeArticles;
	}
	
	public function	getList($debut = -1, $limite = -1)
	{
		$sql = 'SELECT ID, Nom, Categorie, Prix, Longueur, Largeur, Description, Image, DATE_FORMAT(Date, \'%d/%m/%Y\') AS Date FROM shop ORDER BY ID Desc';
		
		if ($debut != -1 && $limite != -1) {
			$sql .= ' LIMIT ' . $debut . ', ' . $limite;
		}
		
		$requete = $this->bdd->query($sql);
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		
		$listeArticles = $requete->fetchAll();
		
		$requete->closeCursor();
		
		return $listeArticles;
	}
	
	public function	getUnique($id)
	{
		$requete = $this->bdd->prepare('SELECT ID, Nom, Categorie, Prix, Longueur, Largeur, Description, Image, DATE_FORMAT(Date, \'%d/%m/%Y\') AS Date FROM shop WHERE ID = :id');
		$requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$requete->execute();
		
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		
		$article = $requete->fetch();
		
		$requete->closeCursor();
		
		return $article;
	}
	
	public function delete($id)
	{
		$requete = $this->bdd->prepare('DELETE FROM shop WHERE ID = :id');
		$requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$requete->execute;
	}
}
?>