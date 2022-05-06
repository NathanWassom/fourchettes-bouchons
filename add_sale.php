<?php
$page_title = 'Add Sale';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Rechercher</button>
          </span>
          <input type="text" id="sug_input" class="form-control" name="title" placeholder="Rechercher le nom">
        </div>
        <div id="result" class="list-group"></div>
      </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Modifier la Commande</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="POST" action="gestPanier.php?action=ajout">
          <table class="table table-bordered">
            <thead>
              <th> Produit </th>
              <th> Prix </th>
              <th> Qté </th>
              <!-- <th> Total </th> -->
              <!-- <th> Date</th> -->
              <th> Action</th>
            </thead>
            <tbody id="product_info"> </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>