<body class="page-signin">
<div class="page-form">
    <form method="POST" action="<?php echo base_url() ?>MyAcount/actLogin" class="form">
        <div class="header-content text-center"><h1>Login to your CriptApps account</h1></div>
        <div class="body-content">
            <div role="alert" class="alert alert-danger alert-dismissible alert-custom hide">
                <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
                Enter any username and password.
            </div>
            <div class="list-group">
                <div class="list-group-item"><input type="text" name="username" placeholder="Username" class="form-control"></div>
                <div class="list-group-item"><input type="password" name="password" placeholder="Password" class="form-control"></div>
            </div>
            <div class="form-group pull-right"><a href="#" class="btn-link">Forgotten your Password?</a></div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-success btn-circle btn-block btn-shadow mbs">Log in</button>
                </div>
                <div class="col-sm-7">
                <a href="#"class="btn btn-social btn-google-plus btn-circle btn-block btn-shadow mbs">
                	<i class="fa fa-google-plus"></i>Login with Google</a></div>
            </div>
            <hr>
            <div class="form-group"><p>Don't have an account? 
            	<a id="btn-register" href="<?php echo base_url() ?>Welcome/SignUp"class="btn-link">Create an account</a></p></div>
        </div>
    </form>
</div>