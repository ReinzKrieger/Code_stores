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
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block"><img src="<?php echo base_url('./assets/img/user.png'); ?>" style="background-position:center;background-size:cover;" /></div>

                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <form>
                                            <div class="form-group">
                                                <label for="fullname">Full Name</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username">
                                            </div>
                                            <div class="form-group">
                                                <p class="mb-1">
                                                    <a href="forgot-password.html">I forgot my password</a>
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="fotoprofil">Change Profil Picture</label>
                                                <input type="file" class="form-control-file" id="fotoprofil">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->


            </div>
            <!-- /.content-wrapper -->


        </div>
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
</body>

</html>