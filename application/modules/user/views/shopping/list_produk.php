<h2>Daftar Produk</h2>
<?php foreach ($data->result() as $product) { ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="kotak">
      <form method="post" action="<?php echo base_url(); ?>shopping/tambah" method="post" accept-charset="utf-8">
        <a href="#"><img class="img-thumbnail" src="<?php echo base_url() . 'gambar/' . $product->image; ?>" /></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#"><?php echo $product->name; ?></a>
          </h4>
          <h5>Rp. <?php echo number_format($product->price, 0, ",", "."); ?></h5>
          <p class="card-text"><?php echo $product->description; ?></p>
        </div>
        <div class="card-footer">
          <a href="<?php echo base_url(); ?>user/detail_produk/<?php echo $product->product_id; ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-search"></i> Detail</a>

          <input type="hidden" name="product_idid" value="<?php echo $product->product_id; ?>" />
          <input type="hidden" name="name" value="<?php echo $product->name; ?>" />
          <input type="hidden" name="price" value="<?php echo $product->price; ?>" />
          <input type="hidden" name="image" value="<?php echo base_url('gambar/' . $product->image) ?>" />
          <input type="hidden" name="qty" value="1" />
          <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Beli</button>
        </div>
      </form>
    </div>
  </div>
<?php
}
?>
<div class="row">
  <div class="col">
    <?php echo $pagination; ?>
  </div>
</div>