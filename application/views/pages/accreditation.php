<script>
    function updateAllTable() {
        table.ajax.reload(null, false);
    }

    $(document).ready(function() {
        table = $('#akreditasi').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/accreditation/getAllData') ?>",
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

    // Start Method add
    function add() {
        save_method = 'add';
        $('.modal-title').text(' Tambah Data Akreditasi');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalAkreditasi').modal('show');

    }


    // Start Method Update
    function update(id) {
        save_method = 'update';
        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/accreditation/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="accreditation_document_id"]').val(data.accreditation_document_id);
                $('[name="title"]').val(data.title);
                $('[name="link"]').val(data.link);
                $('[name="remarks"]').val(data.remarks);
                $('#modalAkreditasi').modal('show');
                $('.modal-title').text('Edit Data Akreditasi');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }
    // End Method Update

    // Start Method delete
    function hapus(id) {
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
                    url: "<?php echo site_url('administrator/accreditation/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        updateAllTable();
                        return swal({
                            content: true,
                            timer: 1300,
                            title: result['msg'],
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
            url = '<?php echo base_url() ?>administrator/accreditation/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/accreditation/update';
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
                    data: $('#form-akreditasi').serialize(),
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
                            $('#modalAkreditasi').modal('hide');
                            $("#form-akreditasi")[0].reset();

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
        <h5>Dokumen Akreditasi <small>List Data dokumen akreditasi akan di tampilkan pada halaman ini.</small></h5>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4><i class="fa fa-bars"></i> Akreditasi <small></small></h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Akreditasi</h2>

                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <button class="btn btn-success btn-xs" onclick="add()" type="button"><i class="fa fa-plus"></i> Add Data</button>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table id="akreditasi" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Dokumen</th>
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


    <div class="col-md-12 col-sm-12 col-xs-12">

    </div>
    <!-- Modal User -->
    <div class="modal fade" id="modalAkreditasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <form class="form-horizontal" id="form-akreditasi" action="" method="POST">
                    <input type="hidden" id="accreditation_document_id" name="accreditation_document_id">
                    <div class="modal-body">
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Judul Dokumen <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="title" name="title" placeholder="Judul Dokumen" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Link <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="link" name="link" required="required" placeholder="Link" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Remarks <span class="required">*</span>
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
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


</div>