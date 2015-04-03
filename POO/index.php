<?php
//inclusion de fichier
include "Moderateur.php";

//création de 3 objets User
$user1 = new User('Perrotton', 'Elodie','elodie.perrotton@gmail.com',29);
$user2 = new User('Chada', 'Said','said.chada@gmail.com',26);
$user3 = new User('Corroy', 'Alexandre','corroy.alexandre@gmail.com',28);

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

