<script>
    var id;
    var id_criteria;

    function updateTableLKPS() {
        table.ajax.reload(null, false);
    }

    function updateTableLED() {
        tableLED.ajax.reload(null, false);
    }

    function updateTableCriteria() {
        tableKriteria.ajax.reload(null, false);
    }

    function updateTableStandard() {
        tableStandard.ajax.reload(null, false);
    }

    $(document).ready(function() {
        tableKriteria = $('#kriteria').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/getSupportCriteria/getAllData') ?>",
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
        tableStandard = $('#standard').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/getSupportStandard/getAllData') ?>",
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
        table = $('#lkpsDoc').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/getSupportDocLKPS') ?>",
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
        tableLED = $('#ledDoc').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/getSupportDocLED') ?>",
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

    function getDataLKPS(criteria_id) {
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

    function getDataLED(criteria_id) {
        tableLED.destroy();

        tableLED = $('#ledDoc').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "dataType": 'JSON',
            "ajax": {

                "url": "<?php echo site_url('administrator/getSupportDocLED/'); ?>" + criteria_id,
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
    var save_method_criteria;
    var save_method_standard;

    // Start Method add
    function add() {
        save_method = 'add';
        $('#label-support_criteria_id').show();
        $('#label-support_standard_id').show();
        $('#label-support_documents_id').show();
        $('#label-number').show();
        $('#label-link').hide();
        $('#label-title').show();
        $('#label-remarks').show();

        $('#support_criteria_id').show();
        $('#support_standard_id').show();
        $('#support_documents_id').show();
        $('#number').show();
        $('#link').hide();
        $('#title').show();
        $('#remarks').show();
        $('.modal-title').text(' Add Data Support Documents');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalDoc').modal('show');
        $("#form-doc")[0].reset();
        $('#label-link').hide();
        $('#link').hide();
    }

    // Start Method add
    function addStandard() {
        $('.modal-title').text(' Data Standard dan Kriteria');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalKriteriaStandard').modal({
            backdrop: 'static',
            keyboard: false,
        });

        $('#modalKriteriaStandard').modal('show');
    }

    function addDataStandard() {
        $('.modal-title').text(' Data Standard dan Kriteria');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalStandard').modal({
            backdrop: 'static',
            keyboard: false,
        });
        $("#form-standard")[0].reset();

        $('#modalStandard').modal('show');
    }

    function addDataCriteria() {
        $('.modal-title').text(' Data Standard dan Kriteria');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalKriteria').modal({
            backdrop: 'static',
            keyboard: false,
        });
        $("#form-criteria")[0].reset();

        $('#modalKriteria').modal('show');
    }
    // End method add

    // Start Method Update
    function update(id) {
        save_method = 'update';

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/supportDocuments/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {

                $('#label-support_criteria_id').show();
                $('#label-support_standard_id').show();
                $('#label-support_documents_id').show();
                $('#label-number').show();
                $('#label-link').hide();
                $('#label-title').show();
                $('#label-remarks').show();

                $('#support_criteria_id').show();
                $('#support_standard_id').show();
                $('#support_documents_id').show();
                $('#number').show();
                $('#link').hide();
                $('#title').show();
                $('#remarks').show();
                data = resp.data
                $('[name="support_master_id"]').val(data.support_master_id);
                $('[name="support_criteria_id"]').val(data.support_criteria_id);
                $('[name="support_standard_id"]').val(data.support_standard_id);
                $('[name="support_documents_id"]').val(data.support_documents_id);
                $('[name="number"]').val(data.number);
                $('[name="title"]').val(data.title);
                $('[name="link"]').val(data.link);
                $('[name="remarks"]').val(data.remarks);
                $('#modalDoc').modal('show');
                $('.modal-title').text('Edit Dokumen Pendukung');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function update_link(id) {
        save_method = 'update';

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/supportDocuments/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {

                $('#label-support_criteria_id').hide();
                $('#label-support_standard_id').hide();
                $('#label-support_documents_id').hide();
                $('#label-number').hide();
                $('#label-title').hide();
                $('#label-remarks').hide();
                $('#label-link').show();
                $('#label-link').text(' Dokumen Upload');
                $('#link').show();

                $('#support_criteria_id').hide();
                $('#support_standard_id').hide();
                $('#support_documents_id').hide();
                $('#number').hide();
                $('#title').hide();
                $('#remarks').hide();
                data = resp.data
                $('[name="support_master_id"]').val(data.support_master_id);
                $('[name="support_criteria_id"]').val(data.support_criteria_id);
                $('[name="support_standard_id"]').val(data.support_standard_id);
                $('[name="support_documents_id"]').val(data.support_documents_id);
                $('[name="number"]').val(data.number);
                $('[name="title"]').val(data.title);
                $('[name="link"]').val(data.link);
                $('[name="remarks"]').val(data.remarks);
                $('#modalDoc').modal('show');
                $('.modal-title').text('Tambahkan Link Dokumen Anda');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function updateCriteria(id) {
        save_method_criteria = 'update';

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/getSupportCriteria/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {

                data = resp.data
                $('[name="support_criteria_id"]').val(data.support_criteria_id);
                $('[name="title"]').val(data.title);
                $('[name="description"]').val(data.description);
                $('#modalKriteria').modal('show');
                $('.modal-title').text('Edit Data');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function updateStandard(id) {
        save_method_standard = 'update';

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/getSupportStandard/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {

                data = resp.data
                $('[name="support_standard_id"]').val(data.support_standard_id);
                $('[name="title"]').val(data.title);
                $('[name="remarks"]').val(data.remarks);
                $('#modalStandard').modal('show');
                $('.modal-title').text('Edit Data');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    // End Method Update

    // Start Method delete
    function deleteDocument(id) {
        swal({
            title: "Apakah Yakin Akan Dihapus?",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then((result) => {
            if (result == true) {
                $.ajax({
                    url: "<?php echo site_url('administrator/supportDocuments/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        updateTableLKPS();
                        updateTableLED();
                        return swal({
                            content: true,
                            timer: 1300,
                            title: data['msg'],
                            icon: 'success'
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            } else {
                return swal({
                    content: true,
                    title: 'Transaksi telah dibatalkan !',
                    timer: 1300,
                    icon: 'error'
                });
            }
        });

    }

    function deleteCriteria(id) {
        swal({
            title: "Apakah Yakin Akan Dihapus?",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then((result) => {
            if (result == true) {
                $.ajax({
                    url: "<?php echo site_url('administrator/getSupportCriteria/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        updateTableCriteria();
                        return swal({
                            content: true,
                            timer: 1300,
                            title: data['msg'],
                            icon: 'success'
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            } else {
                return swal({
                    content: true,
                    title: 'Transaksi telah dibatalkan !',
                    timer: 1300,
                    icon: 'error'
                });
            }
        });

    }

    function deleteStandard(id) {
        swal({
            title: "Apakah Yakin Akan Dihapus?",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then((result) => {
            if (result == true) {
                $.ajax({
                    url: "<?php echo site_url('administrator/getSupportStandard/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        updateTableStandard();
                        return swal({
                            content: true,
                            timer: 1300,
                            title: data['msg'],
                            icon: 'success'
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            } else {
                return swal({
                    content: true,
                    title: 'Transaksi telah dibatalkan !',
                    timer: 1300,
                    icon: 'error'
                });
            }
        });

    }

    // End Method delete

    var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
    var csrf_hash = ''

    function save() {
        var url;
        if (save_method == 'add') {
            url = '<?php echo base_url() ?>administrator/supportDocuments/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/supportDocuments/update';
        }
        swal({
            title: "Apakah anda sudah yakin ?",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then((result) => {
            if (result == true) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $('#form-doc').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result;
                        // csrf_hash = resp.csrf['token']
                        // $('#add-form input[name=' + csrf_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateTableLKPS();
                            updateTableLED();
                            $('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error')
                                .remove();
                            $('#modalDoc').modal('hide');
                            $("#form-doc")[0].reset();

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
                            content: true,
                            timer: 1300,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding/updating data');
                    }
                });
            } else {
                return swal({
                    title: 'Transaksi telah dibatalkan !',
                    content: true,
                    timer: 1300,
                    icon: 'error'
                });
            }
        });
    }

    function saveCriteria() {
        var url;
        if (save_method_criteria == 'add') {
            url = '<?php echo base_url() ?>administrator/getSupportCriteria/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/getSupportCriteria/update';
        }
        swal({
            title: "Apakah anda sudah yakin ?",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then((result) => {
            if (result == true) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $('#form-criteria').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result;
                        // csrf_hash = resp.csrf['token']
                        // $('#add-form input[name=' + csrf_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateTableCriteria();
                            $('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error')
                                .remove();
                            $('#modalKriteria').modal('hide');
                            $("#form-criteria")[0].reset();

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
                            content: true,
                            timer: 1300,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding/updating data');
                    }
                });
            } else {
                return swal({
                    title: 'Transaksi telah dibatalkan !',
                    content: true,
                    timer: 1300,
                    icon: 'error'
                });
            }
        });
    }

    function saveStandard() {
        var url;
        if (save_method_standard == 'add') {
            url = '<?php echo base_url() ?>administrator/getSupportStandard/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/getSupportStandard/update';
        }
        swal({
            title: "Apakah anda sudah yakin ?",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then((result) => {
            if (result == true) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $('#form-standard').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result;
                        // csrf_hash = resp.csrf['token']
                        // $('#add-form input[name=' + csrf_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateTableStandard();
                            $('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error')
                                .remove();
                            $('#modalStandard').modal('hide');
                            $("#form-standard")[0].reset();

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
                            content: true,
                            timer: 1300,
                            title: data['msg'],
                            icon: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding/updating data');
                    }
                });
            } else {
                return swal({
                    title: 'Transaksi telah dibatalkan !',
                    content: true,
                    timer: 1300,
                    icon: 'error'
                });
            }
        });
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
                <button class="btn btn-warning btn-xs" onclick="menu('supportDocuments')" type="button"><i class="fa fa-recycle"></i> Refresh Page</button>
                <button class="btn btn-success btn-xs" onclick="add()" type="button"><i class="fa fa-plus"></i> Tambah Data Pendukung</button>
                <button class="btn btn-danger btn-xs" onclick="addStandard()" type="button"><i class="fa fa-plus"></i> Data Standard dan Kriteria</button>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?php $no = 0;
                        foreach ($getKindDocument as $row) { ?>
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
                                                <button class="btn btn-primary btn-xs" onclick="getDataLKPS(<?php echo $b->support_criteria_id; ?>)" type="button"><i class="fa fa-list"></i> <?php echo $b->title; ?></button>
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
                                                    <button class="btn btn-primary btn-xs" onclick="getDataLED(<?php echo $b->support_criteria_id; ?>)" type="button"><i class="fa fa-list"></i> <?php echo $b->title; ?></button>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </ul>
                                    <h2>Dokumen Pendukung LED <br><small></small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table id="ledDoc" class="table table-striped table-bordered">
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

    <!-- Modal Standard-->
    <div class="modal fade" id="modalKriteriaStandard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                    <div class="col-md-6">
                        <div class="x_title">
                            <h4>Management Standard</h4>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <button class="btn btn-info btn-xs" onclick="addDataStandard()" type="button"><i class="fa fa-plus"></i> Tambah Data Standard</button>

                            <table id="standard" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Keterangan</th>
                                        <th>Tools</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="x_title">
                            <h4>Management Kriteria</h4>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <button class="btn btn-warning btn-xs" onclick="addDataCriteria()" type="button"><i class="fa fa-plus"></i> Tambah Data Kriteria</button>

                            <table id="kriteria" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
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

    <!-- Modal User Role-->
    <div class="modal fade" id="modalDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <form class="form-horizontal" id="form-doc" action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name='support_master_id' value="" id='support_master_id'>
                        <div class="item form-group">
                            <label id="label-support_criteria_id" class="control-label col-md-3 col-sm-3 col-xs-12">Kriteria <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="support_criteria_id" id="support_criteria_id" class="form-control">
                                    <option value="">Pilih Kriteria</option>
                                    <?php foreach ($getListCriteria as $row) { ?>
                                        <option value="<?php echo $row->support_criteria_id; ?>"><?php echo $row->title; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-support_standard_id' class="control-label col-md-3 col-sm-3 col-xs-12">Standard <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="support_standard_id" id="support_standard_id" class="form-control">
                                    <option value="">Pilih Standard</option>
                                    <?php foreach ($getStandard as $b) { ?>
                                        <option value="<?php echo $b->support_standard_id; ?>"><?php echo $b->title; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-support_documents_id' class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Dokumen <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="support_documents_id" id="support_documents_id" class="form-control">
                                    <option value="">Pilih Jenis Dokumen</option>
                                    <?php foreach ($getKindDocument as $r) { ?>
                                        <option value="<?php echo $r->support_documents_id; ?>"><?php echo $r->title; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-number' class="control-label col-md-3 col-sm-3 col-xs-12">Butir Ke <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="number" name="number" required="required" placeholder="Butir ke" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-title' class="control-label col-md-3 col-sm-3 col-xs-12">Judul <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="title" name="title" required="required" placeholder="Judul" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-link' class="control-label col-md-3 col-sm-3 col-xs-12">Link <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="link" name="link" required="required" placeholder="Link" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-remarks' class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="remarks" name="remarks" required="required" placeholder="Keterangan" class="form-control col-md-7 col-xs-12">
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
    <div class="modal fade" id="modalStandard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <form class="form-horizontal" id="form-standard" action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name='support_standard_id' value="" id='support_standard_id'>
                        <div class="item form-group">
                            <label id="label-support_criteria_id" class="control-label col-md-3 col-sm-3 col-xs-12">Kriteria <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="title" name="title" required="required" placeholder="Judul" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-support_documents_id' class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Dokumen <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="remarks" name="remarks" required="required" placeholder="Keterangan" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveStandard()">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal User Role-->
    <div class="modal fade" id="modalKriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <form class="form-horizontal" id="form-criteria" action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name='support_criteria_id' value="" id='support_criteria_id'>
                        <div class="item form-group">
                            <label id="label-support_criteria_id" class="control-label col-md-3 col-sm-3 col-xs-12">Kriteria <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="title" name="title" required="required" placeholder="Judul" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-support_documents_id' class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="description" name="description" required="required" placeholder="Keterangan" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveCriteria()">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>