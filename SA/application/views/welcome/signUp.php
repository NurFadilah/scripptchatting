<body class="page-signin">
<div class="page-form">
<form method="post" action="<?php echo base_url() ?>Welcome/register" class="form">
        <div class="header-content text-center"><h1>Register new CriptApps account</h1></div>
        <div class="body-content">
            <div role="alert" class="alert alert-danger alert-dismissible alert-custom hide">
                <button type="button" data-dismiss="alert" class="close"><span>×</span></button>
                Enter any username and password.
            </div>
            <p class="text-muted">Enter your personal details below:</p>
<?php echo $this->session->userdata('status'); ?>
            <div class="list-group">
                <div class="list-group-item"><input type="text" placeholder="Input Name" name="nama" class="form-control" required></div>
                <div class="list-group-item"><input type="number" placeholder="Input Telepon" name="telepon" class="form-control" required></div>
                <div class="list-group-item"><input type="text" placeholder="User Name" name="username" class="form-control" required></div>
                <div class="list-group-item"><input type="text" value="<?php echo(mt_rand()) ?>" name="kode" class="form-control" required></div>
                <div class="list-group-item"><input type="password" placeholder="Password" name="password" class="form-control" required></div>
                <div class="list-group-item"><input type="email" placeholder="Email" name="email" class="form-control" required></div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="text-center btn btn-success btn-circle btn-block btn-shadow">Register
                    </button>
                </div>
            </div>
            <div class="clearfix"></div>
            <p class="text-muted mtm">You have an account already</p>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                </div>
                <div class="col-md-12"><p class="mtm text-left"><a href="<?php echo base_url() ?>Welcome"><i class="fa fa-long-arrow-left"></i>&nbsp;
                    Back</a></p></div>
            </div>
        </div>
    </form>
</div>