<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/_part/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <?php $this->load->view("admin/_part/navbar.php") ?>

        <?php $this->load->view("admin/_part/sidebar.php") ?>

        <div class="content-wrapper">
            <div class="content-header">
                <?php $this->load->view("admin/_part/breadcrumb.php") ?>
            </div>

            <div class="content">
                <div class="container-fluid">

                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Card  -->
                    <div class="card mb-3">
                        <div class="card-header">

                            <a href="<?php echo site_url('admin/products/') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">

                            <form action="" method="post" enctype="multipart/form-data">
                                <!-- Note: atribut action dikosongkan, artinya action-nya akan diproses 
							oleh controller tempat vuew ini digunakan. Yakni index.php/admin/products/edit/ID --->

                                <input type="hidden" name="id" value="<?php echo $product->product_id ?>" />

                                <div class="form-group">
                                    <label for="name">Name*</label>
                                    <input class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" type="text" name="name" placeholder="Product name" value="<?php echo $product->name ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('name') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input class="form-control <?php echo form_error('price') ? 'is-invalid' : '' ?>" type="number" name="price" min="0" placeholder="Product price" value="<?php echo $product->price ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('price') ?>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="name">Photo</label>
                                    <input class="form-control-file <?php echo form_error('image') ? 'is-invalid' : '' ?>" type="file" name="image" />
                                    <input type="hidden" name="old_image" value="<?php echo $product->image ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('image') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Description*</label>
                                    <textarea class="form-control <?php echo form_error('description') ? 'is-invalid' : '' ?>" name="description" placeholder="Product description..."><?php echo $product->description ?></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('description') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Kategori*</label>
                                    <select class="form-control" name="category">
                                        <?php
                                        $arraylist = array('Perabotan', 'Entertainment', 'Lampu', 'Lainnya');
                                        sort($arraylist);
                                        foreach ($arraylist as $mkn) {                        //print arary kota untuk pilihannya
                                            echo "<option value=$mkn ";                    //pembuka option
                                            if ($mkn == $product->category) {
                                                echo "selected> $mkn </option>";
                                            }        //membuat value default dari database
                                            else {
                                                echo "> $mkn </option>";
                                            };                        //closing option
                                        }
                                        ?>
                                    </select>
                                </div>


                                <input class="btn btn-success" type="submit" name="btn" value="Save" />
                            </form>

                        </div>

                        <div class="card-footer small text-muted">
                            * required fields
                        </div>


                    </div>
                    <!-- /.container-fluid -->


                </div>
                <!-- /.content-wrapper -->

            </div>
        </div>
        <!-- /#wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php $this->load->view("admin/_part/footer.php") ?>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('./assets/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('./assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('./assets/js/adminlte.min.js') ?>"></script>
</body>

</html>