<script>
    function updateAllTable() {
        table.ajax.reload(null, false);
    }

    // Assessment Schedule
    $(document).ready(function() {
        table = $('#assessment_schedule').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/assessment/getDataAssessment') ?>",
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


        // Program Study
        table = $('#programStudy').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/assessment/getDataProdi') ?>",
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

        // Dosen Program Study
        table = $('#programStudyLecturer').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": false,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('administrator/assessment/getDataProdi') ?>",
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

    function add() {
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
        save_method = 'add';
        $('.modal-title').text(' Add Data Users Role');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalUserRole').modal('show');
    }

    function showProdi(id) {
        $('.modal-title').text(' Ubah Data Prodi');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#Modal_prodi').modal('show');
        $.ajax({
            url: "<?php echo base_url('administrator/prestasi/getProdiIDByPrestasiId/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data.id_prestasi);
            }
        });
    }

    function update_prestasi(id) {
        var url = '<?php echo base_url("administrator/prestasi/formUpdate/") ?>' + id;
        $(location).attr('href', url);
    }

    function ubah(id) {
        save_method = 'update';
        $('#form_prestasi')[0].reset();

        //Load data dari ajax
        $.ajax({
            url: "<?php echo site_url('administrator/prestasi/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="pr_id"]').val(data.pr_id);
                $('[name="pr_tanggal"]').val(data.pr_tanggal);
                $('[name="pr_penghargaan"]').val(data.pr_penghargaan);
                $('[name="pr_kategori"]').val(data.pr_kategori);
                $('[name="pr_agenda"]').val(data.pr_agenda);
                $('[name="pr_tingkat"]').val(data.pr_tingkat);
                $('[name="pr_pemberi_penghargaan"]').val(data.pr_pemberi_penghargaan);
                $('[name="pr_tempat"]').val(data.pr_tempat);
                $('[name="pr_tahun"]').val(data.pr_tahun);
                $('[name="pr_penerima_penghargaan"]').val(data.pr_penerima_penghargaan);
                $('[name="prodi_id"]').html('<button type="button" onclick="showProdi(' + data.pr_id + ')" class="btn btn-primary btn-xs">Program Studi</button>');
                $('#btn_prodi').show();
                $('#list_prodi').hide();
                $('#Modal_prestasi').modal('show');
                $('.modal-title').text('Edit Data Prestasi');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function detail(id) {
        save_method = 'update';
        $('#form_detail_prestasi')[0].reset();

        //Load data dari ajax
        $.ajax({
            url: "<?php echo site_url('administrator/prestasi/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="pr_id1"]').html(data.pr_id);
                $('[name="pr_tanggal1"]').html(data.pr_tanggal);
                $('[name="pr_penghargaan1"]').html(data.pr_penghargaan);
                $('[name="pr_kategori1"]').html(data.pr_kategori);
                $('[name="pr_agenda1"]').html(data.pr_agenda);
                $('[name="pr_tingkat1"]').html(data.pr_tingkat);
                $('[name="pr_pemberi_penghargaan1"]').html(data.pr_pemberi_penghargaan);
                $('[name="pr_tempat1"]').html(data.pr_tempat);
                $('[name="pr_tahun1"]').html(data.pr_tahun);
                $('[name="pr_penerima_penghargaan1"]').html(data.pr_penerima_penghargaan);
                $('[name="prodi_nama1"]').html('<button>' + data.prodi_nama + '</button>');

                $('#Detail_prestasi').modal('show');
                $('.modal-title').text('Detail Data Prestasi');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function hapus(id) {
        swal({
            title: "Apakah Yakin Akan Dihapus?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        }, function() {
            $.ajax({
                url: "<?php echo site_url('administrator/prestasi/delete'); ?>/" + id,
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
                        type: data['status']
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error Deleting Data');
                }
            });
        });

    }

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
                    data: $('#add-form').serialize(),
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
                            $('#modalUser').modal('hide');
                            $("#add-form")[0].reset();

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
                <h4><i class="fa fa-bars"></i> Penjadwalan Assesment</h4>
                <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Penjadwalan Asesmen</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Program Study</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                            <div class="x_title">
                                <h2>Penjadwalan Asesmen</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <button class="btn btn-success btn-xs" onclick="add()" type="button"><i class="fa fa-plus"></i> Add Data</button>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="assessment_schedule" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Program Study</th>
                                            <th>Periode</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Tim</th>
                                            <th>Tools</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="fade" id="tab_content22" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="x_title">
                                    <h2>Program Study</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <button class="btn btn-success btn-xs" onclick="add()" type="button"><i class="fa fa-plus"></i> Add Data</button>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="programStudy" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Program Study</th>
                                                <th>Abbr</th>
                                                <th>Akreditasi</th>
                                                <th>Tahun Berdiri</th>
                                                <th>Ka-Prodi</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="x_title">
                                    <h2>Dosen Program Study</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <button class="btn btn-success btn-xs" onclick="add()" type="button"><i class="fa fa-plus"></i> Add Data</button>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="programStudyLecturer" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>Nick Name</th>
                                                <th>Initial</th>
                                                <th>NIP</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Phone Number</th>
                                                <th>Picture</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="fade" id="tab_lecturer" aria-labelledby="profile-tab">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>