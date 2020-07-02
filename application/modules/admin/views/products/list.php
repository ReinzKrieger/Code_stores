<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
                    <!-- DataTables -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <a href="<?php echo site_url('admin/products/add') ?>"><i class="fas fa-plus"></i> Add New</a>
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="<?php base_url('products') ?>" method="post">
                                        <div class="input-group mt-2">
                                            <input type="text" class="form-control" placeholder="Search keyword.." name="keyword" autocomplete="off">
                                            <div class="input-group-append">
                                                <input class="btn btn-outline-secondary" type="submit" name="submit"></input>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Photo</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($data->result())) : ?>
                                        <tr>
                                            <td colspan="5">
                                                <div class="alert alert-danger" role="alert">
                                                    Hasil tidak Ditemukan !
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php foreach ($data->result() as $product) : ?>
                                        <tr>
                                            <td width="150">
                                                <?php echo $product->name ?>
                                            </td>
                                            <td>
                                                <?php echo $product->price ?>
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url('gambar/' . $product->image) ?>" width="64" />
                                            </td>
                                            <td class="small">
                                                <?php echo substr($product->description, 0, 120) ?></td>
                                            <td><?php echo $product->category ?></td>
                                            <td width="250">
                                                <a href="<?php echo site_url('admin/products/edit/' . $product->product_id) ?>" class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
                                                <a onclick="deleteConfirm('<?php echo base_url('admin/products/delete/' . $product->product_id) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php echo $pagination; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- /.content-wrapper -->

        <!-- /#wrapper -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- Sticky Footer -->
        <?php $this->load->view("admin/_part/footer.php") ?>

    </div>




    <?php $this->load->view("admin/_part/modal.php") ?>
    <!-- jQuery -->
    <script src="<?php echo base_url('./assets/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('./assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('./assets/js/adminlte.min.js') ?>"></script>
    <script>
        function deleteConfirm(url) {
            $('#btn-delete').attr('href', url);
            $('#deleteModal').modal();
        }
    </script>

</body>

</html>