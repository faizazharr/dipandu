<?= $this->extend('kader/themplates/index'); ?>
<?= $this->section('content'); ?>
<!-- content -->
<div class="container-fluid">
    <!-- Flash Data -->
    <?php if (!empty(session()->getFlashdata('tambah'))) { ?>
        <div class="alert alert-success">
            <?php echo session()->getFlashdata('tambah') ?>
        </div>
    <?php }else if (!empty(session()->getFlashdata('edit'))) { ?>
        <div class="alert alert-success">
            <?php echo session()->getFlashdata('edit') ?>
        </div>
    <?php }else if (!empty(session()->getFlashdata('hapus'))) { ?>
        <div class="alert alert-success">
            <?php echo session()->getFlashdata('hapus') ?>
        </div>
    <?php } ?>
    <!-- End Flash Data -->
    <div class="card shadow mb-4 mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Data Orangtua</h6>
        </div>
        <div class="card-body">
            <!-- start  -->
            <table id="orangtua" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nik</th>
                        <th>Alamat</th>
                        <th>No Tlp</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($orangtua as $key => $value): 
                            $is_parent = $value->is_parent;
                            if ($is_parent == 1) {
                                $is_parent = "Ibu";
                            } else if($is_parent == 2) {
                                $is_parent = "Ayah";
                            }
                        ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $value->user_name; ?></td>
                        <td><?= $value->user_nik; ?></td>
                        <td><?= $value->user_alamat; ?></td>
                        <td><?= $value->user_phone; ?></td>
                        <td><?= $is_parent;  ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- end form -->
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#tambahmodal" data-whatever="@mdo">
            <i class="fas fa-plus fa-sm text-white-50">
            </i>Tambah Data Anak</button>
    </div>

    <div class="card shadow mb-4 mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Data Anak</h6>
        </div>
        <div class="card-body">
            <!-- start form -->
            <!-- start  -->
            <table id="anak" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nik</th>
                        <th>tanggal lahir</th>
                        <th>umur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($detail as $key): ?>
                    <?php $id = $key['id'] ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $key['nama_anak']; ?></td>
                        <td><?= $key['nik']; ?></td>
                        <td><?= $key['tanggal_lahir']; ?></td>
                        <td><?= $key['umur']; ?></td>
                        <td>
                            <a href="" class="btn btn-success btn-circle" data-toggle="modal"
                                data-target="#editmodal<?= $id; ?>" data-whatever="@mdo"> 
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="" class="btn btn-danger btn-circle" data-toggle="modal"
                                data-target="#hapusmodal<?= $id; ?>" data-whatever="@mdo">
                                <i class="fas fa-trash"></i>
                            </a>
                            <form action="<?= base_url('/kader/imunisasiKeluarga')?>" method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?= $id?>">
                                <button type="submit" class="btn btn-primary btn-circle">
                                    <i class="fas fa-calendar-day"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="hapusmodal<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                    <p>apakah anda akan menghapus <?= $key['nama_anak']; ?></p>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <div>
                                        <a href="<?= base_url('/kader/deleteanak/'.$id) ?>"
                                            class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editmodal<?= $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit data <?= $key['nama_anak']; ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Content -->
                                    <form action="<?= base_url('/kader/editanak/' . $id); ?>" method="POST">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Nama</label>
                                            <input type="text" class="form-control" id="nama" placeholder="masukan nama"
                                                name="nama" value="<?= $key['nama_anak']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Tanggal Lahir</label>
                                            <input type="date" class="tm form-control" id="date" data-date-format="YYYY-MM-DD" placeholder="YYYY-MM-DD" value="<?= $key['tanggal_lahir']; ?>"
                                                placeholder="pilih tanggal" name="date">
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Umur</label>
                                            <input type="text" class="form-control" id="umur"
                                                placeholder="masukan umur" name="umur" value="<?= $key['umur']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">NIK</label>
                                            <input type="text" class="form-control" id="nik"
                                                placeholder="masukan nik" name="nik" value="<?= $key['nik']; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- end form -->
        </div>
    </div>

    <!-- Tambah Modal -->
    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data anak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content -->
                    <form action="/kader/addanak" method="POST">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="masukan nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="dateadd" placeholder="pilih tanggal" onchange="getAge()"
                                name="date">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Umur</label>
                            <input type="text" name="umur" class="form-control" id="umuradd" placeholder="masukan umur" readonly >
                        </div>
                        <div class="form-group" hidden>
                            <label for="formGroupExampleInput2">No KK</label>
                            <input type="text" class="form-control" id="kk" placeholder="masukan no kk" name="id_k"
                                value="<?= $orangtua[0]->id_keluarga ?>">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">NIK</label>
                            <input type="text" class="form-control" id="nik" placeholder="masukan nik" name="nik">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<script>
$('#orangtua').DataTable();

$('#anak').DataTable();
  
$(".tm").on("change", function() {
    this.setAttribute(
        "data-date",
        moment(this.value, "YYYY-MM-DD")
        .format( this.getAttribute("data-date-format") )
    )
}).trigger("change")

function getAge() {
    var dateString = document.getElementById("dateadd").value;
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    var umur = "";
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if (age >= 1) {
        umur = age + " Tahun";   
    }
    if (m > 0) {
        umur += " "+ m +" Bulan"
    }else if(m < 0){
        umur += " "+ (m + 12) +" Bulan"
    }
    
    $("#umuradd").attr("value",umur);
}
</script>

<!-- end content -->
<?= $this->endSection(); ?>