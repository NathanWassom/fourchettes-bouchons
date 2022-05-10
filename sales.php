<?php
$page_title = 'All sale';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>
<?php
$sales = find_all_sale();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Toutes les commandes</span>
        </strong>
        <div class="pull-right">
          <a href="add_sale.php" class="btn btn-primary">Ajouter une Commande</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">Ref</th>
              <!-- <th class="text-center" style="width: 15%;"> Quantité</th> -->
              <th class="text-center" style="width: 10%;"> Total </th>
              <th class="text-center" style="width: 20%;"> Date </th>
              <th> Statut </th>
              <th class="text-center" style="width: 100px;"> Action </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale) : ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
                <td class="text-center"><?php echo $sale['date']; ?></td>
                <td>
                  <?php if ($sale['status'] == 0) { ?>
                    <span class="label label-warning">
                      En cours
                    </span>
                  <?php } else { ?>
                    <span class="label label-success">
                      Traitée
                    </span>
                  <?php } ?>

                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-warning btn-xs" title="Détail" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-danger btn-xs" title="Supprimer" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>