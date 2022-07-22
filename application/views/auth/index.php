<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('assets') ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <?php echo form_open("auth", array('method' => 'POST', 'class' => 'form-vertical')); ?>
                    <!-- <form action="auth/index" method="POST" class="form-vertical"> -->
                    <h1>Login Form</h1>
                    <div class="control-group normal_text">
                        <h3>Sistem Penjaminan Mutu External PSSI</h3>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="main_input_box">
                                <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                                <input type="text" name="username" id="username" placeholder="Username" />
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="main_input_box">
                                <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                                <input type="password" name="password" id="password" placeholder="Password" />
                            </div>
                        </div>
                    </div>
                    <label class="text-left">
                        <?php
                        $message = $this->session->flashdata('result_login');
                        if ($message) { ?>
                            <div style="color: red;"><?php echo $message; ?></div>
                        <?php } ?>
                    </label>
                    <div class="form-actions">
                        <!-- <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span> -->
                        <span class="pull-right"><button type="submit" class="btn btn-success" />
                            Masuk Disini </a></span>
                    </div>

                    <!-- </form> -->
                    <?php echo form_close(); ?>
                </section>
            </div>
        </div>
    </div>
</body>

</html>