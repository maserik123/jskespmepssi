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
               $('#modalAccreditationTeam').modal('show');
               $("#form-team")[0].reset();
           }
           // End method add

           // Start Method Update
           function update(id) {
               save_method = 'update';

               //Load data dari ajax
               $.ajax({
                   url: "<?php echo base_url('administrator/accreditationTeam/getById/'); ?>/" + id,
                   type: "GET",
                   dataType: "JSON",
                   success: function(resp) {
                       data = resp.data
                       $('[name="accreditation_members_id"]').val(data.accreditation_members_id);
                       $('[name="userid"]').val(data.userid);
                       $('[name="user_role_id"]').val(data.user_role_id);
                       $('#modalAccreditationTeam').modal('show');
                       $('.modal-title').text('Edit Dokumen Pendukung');
                   },
                   error: function(jqXHR, textStatus, errorThrown) {
                       alert('Error Get Data From Ajax');
                   }
               });
           }
           // End Method Update

           // Start Method delete
           function deleteTeam(id) {
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
                           url: "<?php echo site_url('administrator/accreditationTeam/delete'); ?>/" + id,
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
                   url = '<?php echo base_url() ?>administrator/accreditationTeam/insert';
               } else {
                   url = '<?php echo base_url() ?>administrator/accreditationTeam/update';
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
                           data: $('#form-team').serialize(),
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
                                   $('#modalAccreditation').modal('hide');
                                   $("#form-team")[0].reset();

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
               <h3>Tim Akreditasi</h3>
           </div>
           <div class="title_right">
               <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                   <div class="input-group">
                   </div>
               </div>
           </div>
       </div>
       <div class="clearfix"></div>
       <div class="row">
           <div class="col-md-12">
               <div class="x_panel">
                   <div class="x_content">
                       <div class="clearfix"></div>
                       <span class="input-group-btn">
                           <button class="btn btn-primary" onclick="add()" type="button">
                               <li class="fa fa-plus"></li> Add Data
                           </button>
                           <button class="btn btn-warning" onclick="menu('accreditationTeam')" type="button">
                               <li class="fa fa-recycle"></li> Refresh
                           </button>
                       </span>
                       <br>
                       <?php foreach ($getMember as $row) { ?>
                           <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                               <div class="well profile_view">
                                   <div class="col-sm-12">
                                       <h4 class="brief"><i><?php echo $row->role ?></i></h4>
                                       <div class="left col-xs-7">
                                           <h2><?php echo $row->full_name ?></h2>
                                           <p><strong>Inisial : </strong> <?php echo $row->initial; ?> </p>
                                           <p><strong>NIP : </strong> <?php echo $row->NIP; ?> </p>
                                           <ul class="list-unstyled">
                                               <li><i class="fa fa-envelope"></i> <?php echo $row->email; ?> </li>
                                               <li><i class="fa fa-phone"></i> Kontak : <?php echo $row->phone_number; ?> </li>
                                           </ul>
                                       </div>
                                       <div class="right col-xs-5 text-center">
                                           <img src="images/user.png" alt="" class="img-circle img-responsive">
                                       </div>
                                   </div>
                                   <div class="col-xs-12 bottom text-center">
                                       <div class="col-xs-12 col-sm-6 emphasis">
                                           <button type="button" onclick="update(<?php echo $row->accreditation_members_id; ?>)" class="btn btn-success btn-xs">
                                               <i class="fa fa-pencil"></i> Ubah
                                           </button>
                                           <button type="button" onclick="deleteTeam(<?php echo $row->accreditation_members_id; ?>)" class="btn btn-primary btn-xs">
                                               <i class="fa fa-trash"> </i> Hapus
                                           </button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       <?php } ?>
                   </div>
               </div>
           </div>
       </div>
       <div class="modal fade" id="modalAccreditationTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-md" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                       <h5 class="modal-title" id="modal-title"></h5>
                   </div>
                   <form class="form-horizontal" id="form-team" action="" method="POST">
                       <div class="modal-body">
                           <input type="hidden" name='accreditation_members_id' value="" id='accreditation_members_id'>
                           <div class="item form-group">
                               <label id="label-userid" class="control-label col-md-3 col-sm-3 col-xs-12">Kriteria <span class="required">*</span>
                               </label>
                               <div class="col-md-9 col-sm-9 col-xs-12">
                                   <select name="userid" id="userid" class="form-control">
                                       <option value="">Pilih Pegawai</option>
                                       <?php foreach ($listUser as $row) { ?>
                                           <option value="<?php echo $row->userid; ?>"><?php echo $row->full_name; ?></option>
                                       <?php } ?>
                                   </select>
                               </div>
                           </div>
                           <div class="item form-group">
                               <label id='label-level' class="control-label col-md-3 col-sm-3 col-xs-12">Standard <span class="required">*</span>
                               </label>
                               <div class="col-md-9 col-sm-9 col-xs-12">
                                   <select name="user_role_id" id="user_role_id" class="form-control">
                                       <option value="">Pilih Standard</option>
                                       <?php foreach ($listUserRole as $b) { ?>
                                           <option value="<?php echo $b->user_role_id; ?>"><?php echo $b->role; ?></option>
                                       <?php } ?>
                                   </select>
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