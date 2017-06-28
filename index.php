<?php
	// $nom="dimitri";
	// $email="dim";
	// $password="llll";


	// //se connecter à my sql
	// try  
	// {
	//     $bdd = new PDO('mysql:host=localhost;dbname=ma_premiere_base;charset=utf8', 'root', 'bichon');
	// }
	// // en cas d'erreur on affiche un message :
	// catch (Exception $e)
	// {
	//         die('Erreur : ' . $e->getMessage());
	// }

	// //afficher la base de donnée
	// $reponse = $bdd->query('SELECT * FROM premiere_table');
	// while($donnees=$reponse->fetch()){
	//   echo '<p>Nom user= ' . $donnees['nom']. ' - Email user= ' . $donnees['email'];
	// }

	// enregistre dans la base de donnée
	// $req = $bdd->prepare('INSERT INTO premiere_table(nom, email, password) VALUES(:nom, :email, :password)');
	// $req->execute(array(
	//     'nom' => $nom,
	//     'email' => $email,
	//     'password' => $password,
	//     ));

	// //modifier dans base de données
	// $bdd->exec('UPDATE premiere_table SET nom = "oceane" WHERE nom = \'dimitri\''); 

	// //supprimer dans base de données
	// $bdd->exec('DELETE FROM premiere_table WHERE nom = \'oceane\'');



// Exercice

	try{
	    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', 'bichon');
	}
	// en cas d'erreur on affiche un message :
	catch (Exception $e){
	    die('Erreur : ' . $e->getMessage());
	}

	// N°1 et 3
	// $reponseClients = $bdd->query('SELECT * FROM clients LIMIT 20');

	// while($donneesClients=$reponseClients->fetch()){
	// 	echo '<p>Nom user= '.$donneesClients['lastName'].' '.$donneesClients['firstName'].'</p>';
		
	// }

	// N°2
	$reponseShowTypes = $bdd->query('SELECT * FROM showTypes');
	while($donneesShowTypes=$reponseShowTypes->fetch()){ ?>
		<p>Show type= <?= $donneesShowTypes['type'] ?></p>

	<?php
	}

	// N°4
	$reponseCardType = $bdd->query('SELECT clients.lastName, clients.firstName,clients.birthDate, cards.cardTypesId, cards.cardNumber FROM clients , cards WHERE cards.cardNumber = clients.cardNumber AND cardTypesId=1');
	
	while($donneesCardType=$reponseCardType->fetch()){
		
		echo '<p>Personne ayant carte de fidélité= '.$donneesCardType['lastName'].' '.$donneesCardType['firstName'].' '.$donneesCardType['birthDate'].' '.$donneesCardType['cardTypesId'].' '.$donneesCardType['cardNumber'].'</p>';
	}
		

	// N°5
	$reponseClients = $bdd->query('SELECT * FROM clients WHERE lastName like "M%" OR firstName like "M%" ORDER BY lastName ASC');
	while ($donneesClients=$reponseClients->fetch()) {
		echo '<p>Nom commencant par M '.$donneesClients['lastName'].' '.$donneesClients['firstName'].'</p>';
	}

	// N°6
	$reponseShows = $bdd->query('SELECT * FROM shows ORDER BY title ASC' );
	while ($donneesShows=$reponseShows->fetch()) {
		echo '<p>Titre spectacle'. ' '.$donneesShows['title'].' '.' par'.' '.$donneesShows['performer'].' '.'le'.' '.$donneesShows['date'].' '.'a'.' '.$donneesShows['startTime'].'</p>';
	}

	// N°7
	$reponseFidelite = $bdd->query('
		SELECT clients.lastName, clients.firstName,clients.birthDate, cards.cardTypesId, cards.cardNumber
		FROM clients 
			LEFT JOIN cards ON cards.cardNumber = clients.cardNumber
	');

	while( $donneesFidelite=$reponseFidelite->fetch() ){
		//var_dump($reponseFidelite);
		if ($donneesFidelite['cardTypesId']==1){
			$carteFidelite = "oui".$donneesFidelite['cardNumber'];
		}
		else
		{
			$carteFidelite = "non";
		}
		

		echo '<p>Personne ayant carte = '.$donneesFidelite['lastName']
			.' '.$donneesFidelite['firstName'].' '.$donneesFidelite['birthDate'].' '
			.'Types de cartes'.' '.$donneesFidelite['cardTypesId']
			.' '. $carteFidelite
			.'</p>';
	}


?>