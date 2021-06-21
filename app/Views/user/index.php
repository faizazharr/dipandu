<?= $this->extend('user/themplates/index'); ?>
<?= $this->section('content'); ?>
<!-- content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Artikel Panduan Posyandu</h1>
    </div>

    <div class="card shadow mb-4 mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Jadwal Posyandu</h6>
        </div>
        <div class="card-body">
            <!-- start  -->
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1  ?>
                    <?php foreach ($posiandu as $key) : ?>
                    <?php 
                          $mulairaw = $key['waktu_mulai'];
                          $mulai = date('H:i', strtotime($mulairaw));
                          $selesairaw = $key['waktu_selesai'];
                          $selesai = date('H:i', strtotime($selesairaw));
                        ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $key['hari']; ?></td>
                        <td><?= $key['tanggal_posiandu']; ?></td>
                        <td><?= $mulai ?> - <?= $selesai ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- end form -->
        </div>
    </div>
    <!-- Content -->
    <div class="row">
        <?php foreach ($artikel as $key) : ?>
        <?php $slug = $key['judul'] ?>
        <?php $id = $key['id'] ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="<?= base_url() ?>/img/<?= $key['gambar']; ?>" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="<?= base_url('user/detailarticle/' . $id); ?>"><?= $key['judul']; ?></a>
                    </h4>
                    <h6 class="text-dark">penulis : <?= $key['penulis']; ?></h6>
                    <p class="card-text" style="width: 250px;  
                        white-space: nowrap;     
                        overflow: hidden;                    
                        text-overflow: ellipsis;">
                        <?= $key['body']; ?>
                    </p>
                </div>

                <div class="card-footer">
                    <small class="text-muted">
                        Di posting pada tanggal <?= $key['created_at']; ?>
                    </small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <!-- <nav aria-label="...">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link active" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav> -->
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