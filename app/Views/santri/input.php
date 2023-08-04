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
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['NIS']; ?>">
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="NIS">NIS</label>
                        <input type="text" name="NIS" id="NIS" value="<?php echo empty(set_value('NIS')) ? (empty($edit_data['NIS']) ? "":$edit_data['NIS']) : set_value['NIS']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_santri">Nama Santri</label>
                        <input type="text" name="nama_santri" id="nama_santri" value="<?php echo empty(set_value('nama_santri')) ? (empty($edit_data['nama_santri']) ? "":$edit_data['nama_santri']) : set_value['nama_santri']; ?>" class="form-control">                 
                    <div class="form-group">
                        <label for="tmpt_lahir">Tempat Lahir</label>
                        <input type="text" name="tmpt_lahir" id="tmpt_lahir" value="<?php echo empty(set_value('tmpt_lahir')) ? (empty($edit_data['tmpt_lahir']) ? "":$edit_data['tmpt_lahir']) : set_value['tmpt_lahir']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="text" name="tgl_lahir" id="tgl_lahir" value="<?php echo empty(set_value('tgl_lahir')) ? (empty($edit_data['tgl_lahir']) ? "":$edit_data['tgl_lahir']) : set_value['tgl_lahir']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" value="<?php echo empty(set_value('alamat')) ? (empty($edit_data['alamat']) ? "":$edit_data['alamat']) : set_value['alamat']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="asrama">Asrama</label>
                        <input type="text" name="asrama" id="asrama" value="<?php echo empty(set_value('asrama')) ? (empty($edit_data['asrama']) ? "":$edit_data['asrama']) : set_value['asrama']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama_ayah">Nama Ayah</label>
                        <input type="text" name="nama_ayah" id="nama_ayah" value="<?php echo empty(set_value('nama_ayah')) ? (empty($edit_data['nama_ayah']) ? "":$edit_data['nama_ayah']) : set_value['nama_ayah']; ?>" class="form-control">
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu</label>
                        <input type="text" name="nama_ibu" id="nama_ibu" value="<?php echo empty(set_value('nama_ibu')) ? (empty($edit_data['nama_ibu']) ? "":$edit_data['nama_ibu']) : set_value['nama_ibu']; ?>" class="form-control">
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