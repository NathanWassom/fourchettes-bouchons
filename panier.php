<?php
$page_title = 'Add Sale';
require_once('includes/load.php');
// Checkin What level user has permission to view this page

page_require_level(3);
// var_dump($_SESSION['panier'][]);
// exit;
?>
<?php


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
        <form method="post" action="add_sale.php">
          <table class="table table-bordered">
            <thead>
              <th> Produit </th>
              <th> Prix </th>
              <th> Qté </th>
              <th> Total </th>
            </thead>
            <tbody id="product_info">
              <?php if (!empty($_SESSION['panier']['libelleProduit'])) { ?>
                <?php for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) : ?>
                  <tr>
                    <td> <?= $_SESSION['panier']['libelleProduit'][$i] ?></td>
                    <td><?= $_SESSION['panier']['prixProduit'][$i] ?> </td>
                    <td><input type="number" class="qty" name="<?= $_SESSION['panier']['libelleProduit'][$i] ?>" min="1" value="<?= $_SESSION['panier']['qteProduit'][$i] ?>"></td>
                    <td><?= $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i] ?> </td>
                  </tr>
                <?php endfor; ?>
              <?php } else { ?>
              <?php } ?>

            </tbody>
          </table>
          <?php if (!empty($_SESSION['panier']['libelleProduit'])) { ?>
            <h4><strong>Montant: <?= MontantGlobal() ?> FCFA</strong></h4>
          <?php } ?>
          <button type="submit" <?php if (empty($_SESSION['panier']['libelleProduit'])) { ?> disabled <?php } ?> class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> VALIDER LA COMMANDE</button>
        </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>