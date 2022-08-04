<script>
    var id;
    var id_criteria;

    function updateAllTable() {
        table.ajax.reload(null, false);
    }

    function getData(criteria_id) {
        table.destroy();

        table = $('#lkpsDoc').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "dataType": 'JSON',
            "ajax": {

                "url": "<?php echo site_url('administrator/getSupportDocLKPS/'); ?>" + criteria_id,
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
                "className": "center",

            }]
        });

    }

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
            }
        );
    }
</script>

<div class="page-title">
    <div class="title_left">
        <h5>Dokumen Pendukung <small>Dokumen Pendukung akan ditampilkan pada halaman ini.</small></h5>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4><i class="fa fa-bars"></i> Dokumen Pendukung <small>System</small></h4>
                <div class="clearfix"></div>
                <button class="btn btn-success btn-xs" onclick="underMaintenance()" type="button"><i class="fa fa-plus"></i> Add Data</button>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?php $no = 0;
                        foreach ($getDocument as $row) { ?>
                            <li role="presentation" class=""><a href="#tab_content<?php echo ++$no; ?>" id="user-tab" role="tab" data-toggle="tab" aria-expanded="true"><?php echo $row->title; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <!-- Bagian TAB User Management -->
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Dokumen Pendukung LKPS <small></small></h2>

                                    <ul class="nav navbar-right panel_toolbox">
                                        <?php foreach ($getListCriteria as $b) { ?>
                                            <li>
                                                <button class="btn btn-primary btn-xs" onclick="getData(<?php echo $b->support_criteria_id; ?>)" type="button"><i class="fa fa-list"></i> <?php echo $b->title; ?></button>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table id="lkpsDoc" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nomor</th>
                                                <th>Nama Dokumen</th>
                                                <th>Link</th>
                                                <th>Keterangan</th>
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
                                    <ul class="nav navbar-right panel_toolbox">
                                        <ul class="nav navbar-right panel_toolbox">
                                            <?php foreach ($getListCriteria as $b) { ?>
                                                <li>
                                                    <button class="btn btn-primary btn-xs" onclick="getData(<?php echo $b->support_criteria_id; ?>)" type="button"><i class="fa fa-list"></i> <?php echo $b->title; ?></button>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </ul>
                                    <h2>Dokumen Pendukung LED <br><small></small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table id="LED%20Documents" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nomor</th>
                                                <th>Nama Dokumen</th>
                                                <th>Link</th>
                                                <th>Keterangan</th>
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
                            <input type="hidden" name="support_master_id" id="support_master_id">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12 form-group">Kriteria/Standard <span class="required">*</span>
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                <input id="support_criteria_id" class="form-control col-md-3 col-xs-12" name="support_criteria_id" placeholder="Kriteria" required="required" type="text">
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                                <input id="support_standard_id" class="form-control col-md-3 col-xs-12" name="support_standard_id" placeholder="Standar" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Pilih Dokumen Pendukung <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <select name="support_documents_id" id="support_documents_id" class="form-control"></select>
                                <input type="email" id="email" name="email" data-validate-linked="email" placeholder="Email" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nomor <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="number" name="number" required="required" placeholder="Address" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Judul <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="title" name="title" required="required" placeholder="Phone Number" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Link <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="link" name="link" required="required" placeholder="Phone Number" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Keterangan <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="remarks" name="remarks" required="required" placeholder="Phone Number" class="form-control col-md-7 col-xs-12">
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