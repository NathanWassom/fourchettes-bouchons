<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sale = find_by_id('sales',(int)$_GET['id']);
if(!$sale){
  $session->msg("d","Missing product id.");
  redirect('sales.php');
}
?>
<?php $product = find_by_id('products',$sale['product_id']); ?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('title','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$product['id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = date("Y-m-d", strtotime($date));

          $sql  = "UPDATE sales SET";
          $sql .= " product_id= '{$p_id}',qty={$s_qty},price='{$s_total}',date='{$s_date}'";
          $sql .= " WHERE id ='{$sale['id']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                    update_product_qty($s_qty,$p_id);
                    $session->msg('s',"Sale updated.");
                    redirect('edit_sale.php?id='.$sale['id'], false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('sales.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('edit_sale.php?id='.(int)$sale['id'],false);
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
     <div class="pull-right">
     <a href="sales.php" class="btn btn-primary">Toutes les Commandes</a> <br><br>
     <a href="sales.php" class="btn btn-danger">Statut de la Commande</a>

     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          <th> Porduit</th>
          <th> Qté </th>
          <th> Prix </th>
          <th> Total </th>
          
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
                <td id="s_name">
                <?php echo remove_junk($product['name']); ?>
                  <div id="result" class="list-group"></div>
                </td>
                <td id="s_qty">
                <?php echo (int)$sale['qty']; ?>
                </td>
                <td id="s_price">
                <?php echo remove_junk($product['sale_price']); ?>
                </td>
                <td>
                <?php echo remove_junk($sale['price']); ?>
                </td>
               
               
              </form>
              </tr>
           </tbody>
       </table>
       <strong>Montant Total:</strong>
       <br>
       <br>

       <button type="submit" name="update_sale" class="btn btn-primary">Modifier la commande
       <span class="glyphicon glyphicon-edit"></span>
       </button>
                

    </div>
  </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
