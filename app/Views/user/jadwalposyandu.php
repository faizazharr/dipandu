<?= $this->extend('user/themplates/index'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<!-- content -->
<div class="container-fluid">
    <div class="card shadow mb-4 mb-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Jadwal Posyandu</h6>
        </div>
        <div class="card-body">
            <!-- start  -->
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

<script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>
    var table = $('#example').DataTable();
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