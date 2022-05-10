<?php
$page_title = 'Add Sale';
require_once('includes/load.php');
// Checkin What level user has permission to view this page

page_require_level(3);
// var_dump($_SESSION['user_id']);
// exit;
$user_connected = $_SESSION['user_id'];
?>
<?php
if (isset($_POST['add_sales'])) {
  // ADD SALES
  $price = MontantGlobal();
  $date = date('d/m/y');
  $requete = $db->query("INSERT INTO sales(user_id, price, date, status) values({$user_connected},{$price},{$date},0)");

  $lastInsertSalesId = $db->insert_id();

  // ADD LIGNE_COMMANDE
  for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
    $requete = $db->query("INSERT INTO ligne_commande(sales_id, product_id, qty) values({$lastInsertSalesId},{$_SESSION['panier']['idProduct'][$i]},{$_SESSION['panier']['qteProduit'][$i]})");
  }

  // DELETE CART
  supprimePanier();
  header('Location: panier.php');
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">

    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Panier</span>
        </strong>
      </div>
      <div class="panel-body">

        <?php if (!empty($_SESSION['panier']['libelleProduit'])) { ?>
          <table class="table table-bordered">
            <thead>
              <th> Produit </th>
              <th> Prix </th>
              <th> Qté </th>
              <th> Total </th>
            </thead>
            <tbody id="product_info">

              <?php for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) : ?>
                <tr>
                  <td> <?= $_SESSION['panier']['libelleProduit'][$i] ?></td>
                  <td><?= $_SESSION['panier']['prixProduit'][$i] ?> </td>
                  <td>
                    <a href="gestPanier.php?action=suppression&name=<?= $_SESSION['panier']['libelleProduit'][$i] ?>" class="btn btn-default"><span class="glyphicon glyphicon-remove text-danger"></span></a>
                    <form action="gestPanier.php?action=refresh" method="POST">
                      <input type="number" name="quantity" min="1" value="<?= $_SESSION['panier']['qteProduit'][$i] ?>">
                      <input type="hidden" name="name" value="<?= $_SESSION['panier']['libelleProduit'][$i] ?>">
                      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-check text-primary"></span></button>
                    </form>
                  </td>
                  <td><?= $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i] ?> </td>
                </tr>
              <?php endfor; ?>

            </tbody>
          </table>
          <?php if (!empty($_SESSION['panier']['libelleProduit'])) { ?>
            <h4><strong>Montant: <?= MontantGlobal() ?> FCFA</strong></h4>
          <?php } ?>
          <form method="post" action="panier.php">
            <button name="add_sales" type="submit" <?php if (empty($_SESSION['panier']['libelleProduit'])) { ?> disabled <?php } ?> class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> VALIDER LA COMMANDE</button>
          </form>

        <?php } else { ?>
          <center><span class="text-warning">Aucun produit ajouté dans votre panier</span></center>
        <?php } ?>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>