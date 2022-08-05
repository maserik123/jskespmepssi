<script>
    var save_method;
    // Start Method add
    function add() {
        save_method = 'add';
        $('.modal-title').text(' Add Data Support Documents');
        $('.reset-btn').show();
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error')
            .remove();
        $('#modalVideo').modal('show');
        $("#form-team")[0].reset();
    }
    // End method add

    // Start Method Update
    function update(id) {
        save_method = 'update';

        //Load data dari ajax
        $.ajax({
            url: "<?php echo base_url('administrator/configuration/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="configuration_video_id"]').val(data.configuration_video_id);
                $('[name="title"]').val(data.title);
                $('[name="url"]').val(data.url);
                $('#modalVideo').modal('show');
                $('.modal-title').text('Edit Dokumen Pendukung');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }
    // End Method Update

    // Start Method delete
    function deleteVideo(id) {
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
                    url: "<?php echo site_url('administrator/configuration/delete'); ?>/" + id,
                    type: "POST",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
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
            url = '<?php echo base_url() ?>administrator/configuration/insert';
        } else {
            url = '<?php echo base_url() ?>administrator/configuration/update';
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
                    data: $('#form-video').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result;
                        // csrf_hash = resp.csrf['token']
                        // $('#add-form input[name=' + csrf_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            $('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error')
                                .remove();
                            $('#modalVideo').modal('hide');
                            $("#form-video")[0].reset();

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
                            title: 'Data Berhasil di proses !',
                            text: 'Silahkan refresh untuk melihat hasil!',
                            icon: 'success'
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
        <h5>Users <small>User page describe / list the user data.</small></h5>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4><i class="fa fa-bars"></i> Video Configuration <small>System</small></h4>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <div id="myTabContent" class="tab-content">
                        <!-- Bagian TAB Banner-->
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Video <small>Managements</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <button class="btn btn-warning btn-xs" onclick="menu('configuration')" type="button"><i class="fa fa-recycle"></i> Refresh</button>
                                            <!-- <button class="btn btn-success btn-xs" onclick="add()" type="button"><i class="fa fa-plus"></i> Add Data</button> -->
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <?php foreach ($listVideo as $row) { ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="product-image">
                                            <iframe width="500" height="315" src="https://www.youtube.com/embed/<?php echo $row->url ?>" frameborder="10" allowfullscreen></iframe>
                                        </div>
                                        <form class="form-horizontal" id="video" action="" method="POST">
                                            <div class="modal-body">
                                                <div class="item form-group">
                                                    <label id="label-title" class="control-label col-md-3 col-sm-3 col-xs-12">Judul <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <input id="title1" disabled value="<?php echo $row->title; ?>" class="form-control col-md-3 col-xs-12" name="title1" placeholder="Judul" required="required" type="text">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label id='label-url' class="control-label col-md-3 col-sm-3 col-xs-12">Token Youtube <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <input id="url1" disabled value="<?php echo $row->url; ?>" class="form-control col-md-3 col-xs-12" name="url1" placeholder="Token Youtube" required="required" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" onclick="update(<?php echo $row->configuration_video_id; ?>)">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12">

    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <form class="form-horizontal" id="form-video" action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name='configuration_video_id' value="" id='configuration_video_id'>
                        <div class="item form-group">
                            <label id="label-title" class="control-label col-md-3 col-sm-3 col-xs-12">Judul <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="title" class="form-control col-md-3 col-xs-12" name="title" placeholder="Judul" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label id='label-url' class="control-label col-md-3 col-sm-3 col-xs-12">Token Youtube <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="url" class="form-control col-md-3 col-xs-12" name="url" placeholder="Token Youtube" required="required" type="text">
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