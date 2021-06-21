<?= $this->extend('kader/themplates/index'); ?>
<?= $this->section('content'); ?>
<!-- content -->
<div class="container-fluid">
    <div class="card shadow mb-4 mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">History Imunisasi <?= $anak['nama_anak']?></h6>
        </div>
        <div class="card-body">
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Minimum age:</td>
                        <td><input type="date" data-date="" data-date-format="YYYY-MM-DD" class="date-range-filter" id="min" name="min"></td>
                    </tr>
                    <tr>
                        <td>Maximum age:</td>
                        <td><input type="date" data-date="" data-date-format="YYYY-MM-DD" class="date-range-filter" id="max" name="max"></td>
                    </tr>
                </tbody>
            </table>
            <table id="anak" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Imunisasi</th>
                        <th>Tanggal</th>
                        <th>Vitamin</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($imunisasi as $key): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $key['nama_imunisasi']; ?></td>
                        <td><?= $key['tanggal_imunisasi']; ?></td>
                        <td><?= $key['vitamin']; ?></td>
                        <td>
                        <?php if ($key['is_imunisasi']) { ?>
                            <span class="badge badge-primary">Sudah di imunisasi</span>
                        <?php } else { ?>
                            <span class="badge badge-warning">Belum di imunisasi</span>
                        <?php }?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    var table = $('#anak').DataTable();
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min').val();
            var max = $('#max').val();
            var createdAt = data[2] || 0; // Our date column in the table

            if (
            (min == "" || max == "") ||
            (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
            ) {
            return true;
            }
            return false;
        }
    );
    
    
    $('.date-range-filter').change(function() {
        table.draw();
    });
    $("input").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change")

</script>

<!-- end content -->
<?= $this->endSection(); ?>