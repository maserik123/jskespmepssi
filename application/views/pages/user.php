<script>
    function updateAllTable() {
        table.ajax.reload(null, false);
    }

    function updateUserTable() {
        table_user.ajax.reload(null, false);
    }

    function updateLoginTable() {
        table_login.ajax.reload(null, false);
    }

    $(document).ready(function() {
        table_login = $('#userLogin').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/userLogin/getAllData') ?>",
                "type": "POST",
                "data": {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "className": "center"
            }]
        });
    });
    $(document).ready(function() {
        table_user = $('#userManagementTable').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/user/getAllData') ?>",
                "type": "POST",
                "data": {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "className": "center"
            }]
        });
    });
    $(document).ready(function() {
        table = $('#userRoleTable').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/userRole/getAllData') ?>",
                "type": "POST",
                "data": {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "className": "center"
            }]
        });
    });

    var save_method;
    var save_method_role;
    var save_method_login;


    // Start Method add
    function addUser() {
        save_method = 'add';
        $('.modal-title').text(' Add Data Users');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalUser').modal('show');

    }

    function addUserRole() {
        save_method_role = 'add';
        $('.modal-title').text(' Add Data Users Role');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalUserRole').modal('show');
    }

    function addUserLogin() {
        save_method_login = 'add';
        $('.modal-title').text(' Add Data Users Login');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalUserLogin').modal('show');
    }
    // End method add

    // Start Method Update
    function update_user(id) {
        save_method = 'update';
        $('#form-user')[0].reset();

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/user/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="userid"]').val(data.userid);
                $('[name="full_name"]').val(data.full_name);
                $('[name="nick_name"]').val(data.nick_name);
                $('[name="initial"]').val(data.initial);
                $('[name="NIP"]').val(data.NIP);
                $('[name="email"]').val(data.email);
                $('[name="address"]').val(data.address);
                $('[name="phone_number"]').val(data.phone_number);
                $('#modalUser').modal('show');
                $('.modal-title').text('Edit Data Pengguna');
                console.log(data.userid);
                updateAllTable();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function update_user_role(id) {
        save_method_role = 'update';
        $('#add-form-role')[0].reset();

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/userRole/getById/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="user_role_id"]').val(data.user_role_id);
                $('[name="role"]').val(data.role);
                $('[name="description"]').val(data.description);
                $('#modalUserRole').modal('show');
                $('.modal-title').text('Edit Data Role Pengguna');
                // console.log(data.user_role_id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function update_user_login(id) {
        save_method_login = 'update';
        $('#add-form-login')[0].reset();

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/userLogin/getById/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="user_login_id"]').val(data.user_login_id);
                $('[name="userid"]').val(data.userid);
                $('[name="username"]').val(data.username);
                $('[name="password"]').val(data.password);
                $('[name="user_role_id"]').val(data.user_role_id);
                $('[name="block_status"]').val(data.block_status);
                $('#modalUserLogin').modal('show');
                $('.modal-title').text('Edit Data Login Pengguna');
                // console.log(data.user_role_id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    // End Method Update

    // Start Method delete
    function delete_user(id) {
        swal({
            title: "Apakah Yakin Akan Dihapus?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }).then(
            function() {
                $.ajax({
                    url: "<?php echo site_url('administrator/user/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        updateUserTable();
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            }
        );
    }

    function delete_user_login(id) {
        swal({
            title: "Apakah Yakin Akan Dihapus?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }).then(
            function() {
                $.ajax({
                    url: "<?php echo site_url('administrator/userLogin/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        updateLoginTable();
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            }
        );
    }

    function delete_user_role(id) {
        swal({
            title: "Apakah Yakin Akan Dihapus?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }).then(
            function() {
                $.ajax({
                    url: "<?php echo site_url('administrator/userRole/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        updateAllTable();
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            }
        );
    }
    // End Method delete

    var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
    var csrf_hash = ''

    function save() {
        var url;
        if (save_method == 'add') {
            url = '<?php echo base_url() ?>administrator/user/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/user/update';
        }
        swal({
            title: "Apakah anda sudah yakin ?",
            icon: "warning",
            text: "Please ensure and then confirm!",
            showCancelButton: !0,
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(
            function(e) {
                if (e.value === true) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: $('#form-user').serialize(),
                        dataType: "JSON",
                        success: function(resp) {
                            data = resp.result;
                            // csrf_hash = resp.csrf['token']
                            // $('#add-form input[name=' + csrf_name + ']').val(csrf_hash);
                            if (data['status'] == 'success') {
                                updateUserTable();
                                $('.form-group')
                                    .removeClass('has-error')
                                    .removeClass('has-success')
                                    .find('#text-error')
                                    .remove();
                                $('#modalUser').modal('hide');
                                $("#form-user")[0].reset();

                            } else {
                                $.each(data['messages'], function(key, value) {
                                    var element = $('#' + key);
                                    element
                                        .closest('div.form-group')
                                        .removeClass('has-error')
                                        .addClass(
                                            value.length > 0 ?
                                            'has-error' :
                                            'has-success'
                                        )
                                        .find('#text-error')
                                        .remove();
                                    element.after(value);
                                });
                            }
                            return swal({
                                html: true,
                                timer: 1300,
                                showConfirmButton: false,
                                title: data['msg'],
                                icon: data['status']
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error adding/updating data');
                        }
                    });
                } else {
                    e.dismiss;
                }
            });
    }

    function saveUserRole() {
        var url;
        if (save_method_role == 'add') {
            url = '<?php echo base_url() ?>administrator/userRole/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/userRole/update';
        }
        swal({
            title: "Are you sure if the data is correct?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }).then(
            function(e) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $('#add-form-role').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result;
                        // csrf_hash = resp.csrf['token']
                        // $('#add-form input[name=' + csrf_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateAllTable();
                            $('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error')
                                .remove();
                            $('#modalUserRole').modal('hide');
                            $("#add-form-role")[0].reset();

                        } else {
                            $.each(data['messages'], function(key, value) {
                                var element = $('#' + key);
                                element
                                    .closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(
                                        value.length > 0 ?
                                        'has-error' :
                                        'has-success'
                                    )
                                    .find('#text-error')
                                    .remove();
                                element.after(value);
                            });
                        }
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding/updating data');
                    }
                });
            }
        );
    }

    function saveUserLogin() {
        var url;
        if (save_method_login == 'add') {
            url = '<?php echo base_url() ?>administrator/userLogin/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/userLogin/update';
        }
        swal({
            title: "Are you sure if the data is correct?",
            icon: "warning",
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "",
                closeModal: true,
            },
            confirm: {
                text: "OK",
                value: true,
                visible: true,
                className: "",
                closeModal: true
            }
        }).then(
            function(e) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $('#add-form-login').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result;
                        // csrf_hash = resp.csrf['token']
                        // $('#add-form input[name=' + csrf_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateLoginTable();
                            $('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error')
                                .remove();
                            $('#modalUserLogin').modal('hide');
                            $("#add-form-login")[0].reset();

                        } else {
                            $.each(data['messages'], function(key, value) {
                                var element = $('#' + key);
                                element
                                    .closest('div.form-group')
                                    .removeClass('has-error')
                                    .addClass(
                                        value.length > 0 ?
                                        'has-error' :
                                        'has-success'
                                    )
                                    .find('#text-error')
                                    .remove();
                                element.after(value);
                            });
                        }
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding/updating data');
                    }
                });
            }
        );
    }
</script>

<div class="page-title">
    <div class="title_left">
        <h5>Users <small>User page describe / list the user data.</small></h5>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4><i class="fa fa-bars"></i> Users Management <small>System</small></h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="user-tab" role="tab" data-toggle="tab" aria-expanded="true">User Login</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="user-role-tab" data-toggle="tab" aria-expanded="false">User Management</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <!-- Bagian TAB User Management -->
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>User <small>Login</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <button class="btn btn-success btn-xs" onclick="addUserLogin()" type="button"><i class="fa fa-plus"></i> Add Data</button>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table id="userLogin" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Lengkap</th>
                                                <th>Nama Panggilan</th>
                                                <th>Inisial</th>
                                                <th>NIP</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>No HP</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Block Status</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Bagian TAB User Role -->
                        <div role="tabpanel" class="fade" id="tab_content2" aria-labelledby="profile-tab">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Users <small>Managements</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <button class="btn btn-success btn-xs" onclick="addUser()" type="button"><i class="fa fa-plus"></i> Add Data</button>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table id="userManagementTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Lengkap</th>
                                                <th>Nama Panggilan</th>
                                                <th>Inisial</th>
                                                <th>NIP</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>No HP</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Users <small>Role</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <button class="btn btn-success btn-xs" onclick="addUserRole()" type="button"><i class="fa fa-plus"></i> Add Data</button>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table id="userRoleTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Role</th>
                                                <th>Deskripsi</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12">

    </div>
    <!-- Modal User -->
    <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <form class="form-horizontal" id="form-user" action="" method="POST">
                    <div class="modal-body">
                        <div class="item form-group">
                            <input type="hidden" name="userid" id="userid">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12 form-group">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                <input id="full_name" class="form-control col-md-3 col-xs-12" name="full_name" placeholder="Full Name" required="required" type="text">
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                <input id="nick_name" class="form-control col-md-3 col-xs-12" name="nick_name" placeholder="Nick Name" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12 form-group">Initial/NIP <span class="required">*</span>
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                <input type="text" id="initial" name="initial" required="required" placeholder="Initial" class="form-control col-md-3 col-xs-12 ">
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                <input type="text" id="NIP" name="NIP" required="required" placeholder="NIP" class="form-control col-md-3 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="email" id="email" name="email" data-validate-linked="email" placeholder="Email" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Address <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="address" name="address" required="required" placeholder="Address" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Phone <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="phone_number" name="phone_number" required="required" placeholder="Phone Number" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal User Role-->
    <div class="modal fade" id="modalUserRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <form class="form-horizontal" id="add-form-role" action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name='user_role_id' value="" id='user_role_id'>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="role" name="role" placeholder="Role" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="description" name="description" required="required" placeholder="Description" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveUserRole()">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal User Login-->
    <div class="modal fade" id="modalUserLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <form class="form-horizontal" id="add-form-login" action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name='user_login_id' id='user_login_id'>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih User <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="userid" id="userid" class="form-control col-md-7 col-xs-12">
                                    <option value="">Pilih Pengguna</option>
                                    <?php foreach ($listUser as $row) { ?>
                                        <option value="<?php echo $row->userid ?>"><?php echo $row->full_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="username" name="username" required="required" placeholder="Username" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="password" name="password" required="required" placeholder="Password" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Role Pengguna <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="user_role_id" id="user_role_id" class="form-control col-md-7 col-xs-12">
                                    <option value="">Pilih Role Pengguna</option>
                                    <?php foreach ($listUserRole as $row) { ?>
                                        <option value="<?php echo $row->user_role_id ?>"><?php echo $row->role; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status Blokir <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="block_status" id="block_status" class="form-control col-md-7 col-xs-12">
                                    <option value="0">Un Blocked</option>
                                    <option value="1"> Blocked</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveUserLogin()">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>