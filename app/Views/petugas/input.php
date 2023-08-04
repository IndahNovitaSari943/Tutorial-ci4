<?php
echo $this->extend('template/index');
echo $this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <?php echo $title_card; ?> </h3>
            </div>
            <!-- /.card-header -->
            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if (validation_list_errors()){
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <?php echo validation_list_errors() ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if(session()->getFlashdata('error')){
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-warning"></i> Error</h5>
                            <?php echo session()->getFlashdata('error') ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php echo csrf_field() ?>
                    <?php
                    if(current_url(true)->getSegment(2) == 'edit'){
                        ?>
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kd_petugas']; ?>">
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="kd_petugas">Kode Petugas</label>
                        <input type="text" name="kd_petugas" id="kd_petugas" value="<?php echo empty(set_value('kd_petugas')) ? (empty($edit_data['kd_petugas']) ? "":$edit_data['kd_petugas']) : set_value['kd_petugas']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_petugas">Nama Petugas</label>
                        <input type="text" name="nama_petugas" id="nama_petugas" value="<?php echo empty(set_value('nama_petugas')) ? (empty($edit_data['nama_petugas']) ? "":$edit_data['nama_petugas']) : set_value['nama_petugas']; ?>" class="form-control">                 
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan </button>
                </div>
            </form>
        </div>
    </div>  
</div>
<?php
echo $this->endSection();