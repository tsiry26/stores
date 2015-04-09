<html>
<head>
<meta charset="utf-8"/>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
<?php
//inclusion de fichier
/*include "Moderateur.php";
include "Editeur.php";
include "Commercial.php";
include "Ecrivain.php";*/

//inclusion de l'autoload

require_once __DIR__.'/vendor/autoload.php';

use Application\User;
use Application\Editeur;
use Application\Commercial;
use Application\Moderateur;
use Application\Ecrivain;
use Libraries\User as Userlib;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

//use Monolog
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//création de 3 objets User
$user1 = new User('Perrotton', 'Elodie','elodie.perrotton@gmail.com',29);
$user2 = new User('Chada', 'Said','said.chada@gmail.com',26);
$user3 = new User('Corroy', 'Alexandre','corroy.alexandre@gmail.com',28);

echo"<br/>";
//Utiliser la fonction tostring
echo $user1;
echo"<br/>";
//Appel à la méthode commenter()
$user1->commenter('Francois Hollande est un bon président');

echo"<br/>";

$user2->commenter('Rico aussi, mais François est aussi grand que sa réputation');

echo"<br/>";

//l'envoi l'objet $user2 issue de ma classe User
$user1->repondre($user2);

echo"<br/>";

/**
 * Attributs de mon objet
 */

echo "Email de l'utilisateur 1 : " .$user1->getEmail();

echo"<br/>";

echo "Age de l'utilisateur 2 : " .$user2->getAge();

echo"<br/>";

//j'accede à ma constante Pays
echo $user1::PAYS;

echo"<br/>";

//j'accede à ma constante Langues
echo $user1::LANGUES;

echo"<br/>";

/**
 * SETTER
 */
$user1->setAge(26);

echo "Elodie a vraiment".$user1->getAge();

echo "<br/>";

$user2->setEmail('said26@live.fr');
echo "le mail de Said est ",$user2->getEmail();

echo "<br/>";

$user1 = clone $user2; //cloner l'objet dans un nouvel espace mémoire
$user1->setAge(10);

echo $user2->getAge();
echo $user1->getAge();

echo'<br/>';

$moderateur1=new Moderateur("Dos Santos", "Leonel", "leonel@gmail.com", 32, 4, 'Voici ma life');

echo'<br/>';
echo $moderateur1->getNom();

echo '<br/>';
echo $moderateur1->getPrenom();

echo '<br/>';
echo $moderateur1->getDescription();

echo '<br/>';
$editeur1=new Editeur("RAVALOSON","Tsiry","nialy@live.fr", "presse");
$editeur2=new Editeur("RALISON","Tsiory","ralisontsiory@live.fr", "presse");
$editeur3=new Editeur("RAJAONARIVONY","Tita","rajaonarivonytita@live.fr", "presse");

echo $editeur1->getNom();
echo '<br/>';
echo $editeur1->getEmail();
echo '<br/>';
echo $editeur1->getAge();
echo '<br/>';
echo $editeur1->getPresse();
echo '<br/>';
echo $editeur2->getNom();
echo '<br/>';
echo $editeur2->getEmail();
echo '<br/>';
echo $editeur2->getAge();
echo '<br/>';
echo $editeur2->getPresse();
echo '<br/>';
echo $editeur3->getNom();
echo '<br/>';
echo $editeur3->getEmail();
echo '<br/>';
$editeur3->setAge(13);
echo $editeur3->getAge();
echo '<br/>';
echo $editeur3->getPresse();
echo '<br/>';

$commercial1=new Commercial("RAVALOSON","Tsiry","nialy@live.fr", "Cachan","expert");
echo "Point de Vente : ".$commercial1->getMag();
echo "<br/>";
echo $commercial1->repondre($editeur1);
echo "<br/>";
echo $commercial1->noter(8);
echo "<br/>";
echo $editeur1->noter(5);
echo"<br/>";
echo"<br/>";
echo $moderateur1->blamer($user1);
$ecrivain1=new Ecrivain();
$ecrivain1->setNom("Boyer");
$ecrivain1->setPrenom("Julien");
$ecrivain1->setAge(31);
$ecrivain1->setEmail("boyerjulien@gmail.com");
echo "<br />";
echo $ecrivain1->getNom();
echo"<br />";
$ecrivain2=new Ecrivain();
$ecrivain2->setNom("JOHNE");
$ecrivain2->setPrenom("Ludo");
$ecrivain2->setAge(24);
$ecrivain2->setEmail("johnludo@gmail.com");
echo"<br />";
echo $ecrivain2->getNom();
echo "<br />";
echo $ecrivain1->deconnexion();
echo "<br />";
echo $commercial1->blamer($user3);
echo"<br/>";
echo beautiful("blablabla");
$essais1= new Essais("","","","","");
echo $essais1-> index();
$userlib=new Userlib("jojo","bobo");
echo"<br/>";

// je crée un objet date time instancié à la date d'aujourd'hui
$date=new \Datetime('now');

//J'affiche la date au format date/mois/année.
echo $date->format('d/m/Y');
echo"<br/>";
$date->modify('+1 year -3 month');
echo $date-> format('d/m/Y h:i:s');
echo "<br/>";
$datefrom=\DateTime::createFromFormat('d/m/Y',"06/04/2011");
echo "Date ". $datefrom->format('Y-m-d');
echo"<br/>";
echo $moderateur1;
echo"<br/>";
echo $commercial1;
echo "<br/>";
echo "<h3>Composer Finder</h3>";
echo "<br/>";
//Je crée un objet de ma classe Finder
$finder=new Finder();

//Je vais récupérer les fichiers (files()) dans mon dossier images(in())
$finder->files()->in('images/');

//Je parcours tous mes fichiers du dossier img/
foreach ($finder as $file){
    //J'affiche chaque image de mon dossier
    echo "<img src='images/".$file->getRelativePathname()."'/>";
}

echo "<br/>";
echo "<h3>Composer Yaml</h3>";
echo "<br/>";

//création de mon objet parser
$yaml=new Parser();

//parser le fichier app.yml dans config
$value=$yaml->parse(file_get_contents('config/app.yml'));

//explorer ma variable $value
var_dump($value);

echo "<br/>";
echo "<h3>Composer Monolog</h3>";
echo "<br/>";

//create a log channel
$log = new Logger('3WA utilise le composant Monolog');
//créer un message de log

$log->pushHandler(new StreamHandler('config/dev.log',Logger::WARNING));
//Envoi le message préparé dans mon fichier de log dev.log

// add records to the log
$log->addWarning('Foo');
?>
</div>
</body>
</html>
