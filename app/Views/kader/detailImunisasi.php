<?= $this->extend('kader/themplates/index'); ?>
<?= $this->section('content'); ?>
<!-- content -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<!-- content -->
<div class="container-fluid">

    <div class="card shadow mb-4 mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Daftar anak</h6>
        </div>
        <div class="card-body">
            <!-- start form -->
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama anak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($detail as $key): ?>
                    <?php $id = $key['id']; ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $key['nama_anak']; ?></td>
                        <td>
                            <?php if ($key['is_imunisasi'] == 0) { ?>
                                <a class="btn btn-primary btn-circle" data-toggle="modal"
                                    data-target="#editmodal<?= $id; ?>" data-whatever="@mdo">
                                    <i class="fas fa-stethoscope"></i>
                                </a>
                            <?php } else { ?>
                                <a class="btn btn-success btn-circle">
                                    <i class="fas fa-stethoscope"></i>
                                </a>
                            <?php }?>
                        </td>
                    </tr>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editmodal<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pemeriksaan
                                        <?= $imunisasi; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Content -->
                                    <form action="/kader/periksaimunisasi" method="POST">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Nama Anak</label>
                                            <input type="text" class="form-control" id="nama" name="nama" readonly
                                                value="<?= $key['nama_anak']; ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">No KK</label>
                                                    <input type="hidden" class="form-control"  id="id_anak" name="id_anak" value="<?= $key['id']; ?>">
                                                    <input type="hidden" class="form-control"  id="id_anak" name="idpemeriksaan" value="<?= $id; ?>">
                                                    <input type="text" class="form-control" readonly id="no_kk" name="no_kk" value="<?= $key['no_kk']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Tanggal Imunisasi</label>
                                                    <input type="text" class="form-control" id="tanggal_imunisasi"
                                                        name="tanggal_imunisasi" readonly
                                                        value="<?= $tanggal; ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Nama Imunisasi</label>
                                                    <input type="text" class="form-control" id="nama_imunisasi" readonly
                                                        name="nama_imunisasi" value="<?= $imunisasi; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="formGroupExampleInput">Jenis Vitamin</label>
                                                    <input type="text" class="form-control" id="vitamin" name="vitamin"
                                                        placeholder="Masukan jenis vitamin">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <div><button type="submit" class="btn btn-primary">Submit</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <?php endforeach; ?>
                </tbody>
            </table>


            <!-- Hapus Modal -->
            <div class="modal fade" id="hapusmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Content -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->

            <!-- Tambah Modal -->
            <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Content -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->

            <!-- end form -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
$('#example').DataTable();
</script>

<!-- end content -->
<?= $this->endSection(); ?>