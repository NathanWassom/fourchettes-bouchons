<?php
require_once('includes/sql.php');
$erreur = false;

$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null));
if ($action !== null) {
  if (!in_array($action, array('ajout', 'suppression', 'refresh')))
    $erreur = true;

  //récuperation des variables en POST ou GET
  $l = (isset($_POST['name']) ? $_POST['name'] : (isset($_GET['name']) ? $_GET['name'] : null));
  $p = (isset($_POST['price']) ? $_POST['price'] : (isset($_GET['price']) ? $_GET['price'] : null));
  $q = (isset($_POST['quantity']) ? $_POST['quantity'] : (isset($_GET['quantity']) ? $_GET['quantity'] : null));

  //Suppression des espaces verticaux
  $l = preg_replace('#\v#', '', $l);
  //On vérifie que $p soit un float
  $p = floatval($p);

  //On traite $q qui peut être un entier simple ou un tableau d'entiers

  if (is_array($q)) {
    $QteArticle = array();
    $i = 0;
    foreach ($q as $contenu) {
      $QteArticle[$i++] = intval($contenu);
    }
  } else
    $q = intval($q);

  if (!$erreur) {
    switch ($action) {
      case "ajout":
        ajouterArticle($l, $q, $p);
        header('Location: add_sale.php');
        break;

      case "suppression":
        supprimerArticle($l);
        break;

      case "refresh":
        // for ($i = 0; $i < count($QteArticle); $i++) {
        //   modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i], round($QteArticle[$i]));
        // }
        return json_encode(modifierQTeArticle($l, $q));

        break;

      default:
        break;
    }
  }
}
