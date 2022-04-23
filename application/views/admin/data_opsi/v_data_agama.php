<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Agama</h1>
</div>
<?php show_alert()?>
		<!-- Content Row -->
		<div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Agama</h6>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url().'admin/agama_add'?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="agama" placeholder="Nama Agama" required>
                            </div>
                            <?php echo form_error('agama', '<div class="form-error">', '</div>'); ?>

                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
                        </form>
                    </div>
                </div>
		    </div>

            <div class="col-lg-7 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Agama</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Agama</th>
                                <th width="20%">Opsi</th>
                                </tr>
                            </thead> 
                            <tbody>
                               <?php foreach ($agama as $ag ) {?>
                                   <tr>
                                    <td><?php echo $ag->agama?></td>
                                   
                                    <td>
                                        <a href="<?php echo base_url().'admin/agama_edit/'.$ag->id ?>"> <i class="fas fa-pen-alt    "></i></a>
                                        <a href="<?php echo base_url().'admin/agama_delete/'.$ag->id?>"> <i class="fas fa-trash-alt    "></i></a>
                                    </td>

                                   </tr>

                              <?php }?> 
                            </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
		    </div>
		</div>
</div>
