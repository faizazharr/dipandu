<?= $this->extend('kader/themplates/index'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<!-- content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4 mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Rekap Perkembangan Anak</h6>
        </div>
        <div class="card-body">
            <!-- start form -->
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
            <table id="laporan" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Berat</th>
                        <th>Tinggi</th>
                        <th>Lingkar Badan</th>
                        <th>Lingkar Kepala</th>
                        <th>umur</th>
                        <th>Ibu</th>
                        <th>bapak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($laporan as $key) : ?>    
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $key['tanggal_posiandu']; ?></td>
                        <td><?= $key['nama_anak']; ?></td>
                        <td><?= $key['berat']; ?> kg</td>
                        <td><?= $key['tinggi']; ?> cm</td>
                        <td><?= $key['lingkarbadan']; ?> cm</td>
                        <td><?= $key['lingkarkepala']; ?> cm</td>
                        <td><?= $key['umur']; ?></td>
                        <td><?= $key['ibu']; ?></td>
                        <td><?= $key['bapak']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
<!-- Data tables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    var table = $('#laporan').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'pdf',
            text: 'Cetak'
        }

        ],
    });
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min').val();
            var max = $('#max').val();
            var createdAt = data[1] || 0; // Our date column in the table

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