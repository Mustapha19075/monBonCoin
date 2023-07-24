<?php
use App\Db;
use Models\Users;


require_once ("Autoloader.php");

// test de l'autoloader
// $test = new Db;
// $test::getDb();
?>




<h1>index : fichier de test</h1>
<p>c'est ici que nous allons tester tous nos CRUD</p>
<!-- Pour utiliser les méthodes des CRUD il faut faire un require des class dont nous aurons besoin  -->
<!-- Comme ne nous voulons pas faire des require toutes  les deux minutes nous allons utiliser un autoloader-->

<h2>Utilisation de la méthode findALL sur users</h2>
<?php
$users = Users::findALL();
var_dump($users);

