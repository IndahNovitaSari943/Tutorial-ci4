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
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['tanggal']; ?>">
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" name="tanggal" id="tanggal" value="<?php echo empty(set_value('tanggal')) ? (empty($edit_data['tanggal']) ? "":$edit_data['tanggal']) : set_value['tanggal']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kd_petugas">Kode Petugas</label>
                        <input type="text" name="kd_petugas" id="kd_petugas" value="<?php echo empty(set_value('kd_petugas')) ? (empty($edit_data['kd_petugas']) ? "":$edit_data['kd_petugas']) : set_value['kd_petugas']; ?>" class="form-control">                 
                    <div class="form-group">
                        <label for="NIS">NIS</label>
                        <input type="text" name="NIS" id="NIS" value="<?php echo empty(set_value('NIS')) ? (empty($edit_data['NIS']) ? "":$edit_data['NIS']) : set_value['NIS']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lama">Lama</label>
                        <input type="text" name="lama" id="lama" value="<?php echo empty(set_value('lama')) ? (empty($edit_data['lama']) ? "":$edit_data['lama']) : set_value['lama']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="alasan">Alasan</label>
                        <input type="text" name="alasan" id="alasan" value="<?php echo empty(set_value('alasan')) ? (empty($edit_data['alasan']) ? "":$edit_data['alasan']) : set_value['alasan']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tujuan">Tujuan</label>
                        <input type="text" name="tujuan" id="tujuan" value="<?php echo empty(set_value('tujuan')) ? (empty($edit_data['tujuan']) ? "":$edit_data['tujuan']) : set_value['tujuan']; ?>" class="form-control">
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