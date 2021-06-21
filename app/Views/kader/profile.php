<?= $this->extend('kader/themplates/index'); ?>
<?= $this->section('content'); ?>
<!-- content -->
<div class="container-fluid">
    <div class="card shadow mb-4 mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Profile</h6>
        </div>
        <div class="card-body">
            <!-- start form -->
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td><?php echo $data['user_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $data['user_email'] ?></td>

                    </tr>
                    <tr>
                        <td>Nik</td>
                        <td><?php echo $data['user_nik'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?php echo $data['user_alamat'] ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Telphone</td>
                        <td><?php echo $data['user_phone'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="<?= base_url('kader/edit_profile') ?>" class="btn btn-primary btn-block">Edit Profile</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- end form -->
        </div>
    </div>
</div>
<!-- end content -->
<?= $this->endSection(); ?>