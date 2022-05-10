<?php
$page_title = 'Edit sale';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>
<?php
$sale = find_by_id('sales', (int)$_GET['id']);
if (!$sale) {
  $session->msg("d", "Missing product id.");
  redirect('sales.php');
}
$products = find_all_ligne_commande_by_sale_id((int)$_GET['id']);
?>
<?php // $product = find_by_id('ligne_commande', $sale['user_id']); 
?>
<?php
// print_r($products);
// exit;
if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == 'update_sale') {
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sale_id = (int) $_GET['id'];
    $new_status = 1;

    $sql  = "UPDATE sales SET";
    $sql .= " status= '{$new_status}'";
    $sql .= " WHERE id ='{$sale_id}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Le statut de la commande a changé.");
      redirect('edit_sale.php?id=' . $sale['id'], false);
    } else {
      $session->msg('s', ' Désolé erreur de mise à jour!');
      redirect('edit_sale.php?id=' . $sale['id'], false);
    }
  }
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Toutes les Commandes</span>
        </strong>

      </div>

      <div class="panel-body">
        <div class="pull-left">
          <?php if ($sale['status'] == 0) { ?>
            <span class="label label-warning">
              En cours
            </span>
          <?php } else { ?>
            <span class="label label-success">
              Traitée
            </span>
          <?php } ?>
        </div>
        <div class="pull-right">
          <a href="sales.php" class="btn btn-primary">Voir toutes les Commandes</a> <br><br>
        </div>
        <table class="table table-bordered">
          <thead>
            <th> Porduit</th>
            <th> Qté </th>
            <th> Prix Unit. </th>
            <th> Total </th>

          </thead>
          <tbody id="product_info">
            <?php foreach ($products as $product) : ?>
              <tr>

                <td id="s_name">
                  <?php echo remove_junk($product['name']); ?>
                  <div id="result" class="list-group"></div>
                </td>
                <td id="s_qty">
                  <?php echo $product['qty']; ?>
                </td>
                <td id="s_price">
                  <?php echo remove_junk($product['sale_price']); ?>
                </td>
                <td>
                  <?php echo $product['sale_price'] * $product['qty']; ?>
                </td>


                </form>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <strong>Montant Total: <?php echo remove_junk($product['price']); ?>F</strong>
        <br>
        <br>

        <?php if ($sale['status'] == 0) { ?>
          <a href="edit_sale.php?action=update_sale&id=<?= $sale['id'] ?>" class="btn btn-success">Valider la commande
            <span class="glyphicon glyphicon-check"></span>
          </a>
        <?php } ?>


      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>