<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Upload Bukti Pembayaran
            <small>
                <script type='text/javascript'>
                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth();
                    var thisDay = date.getDay(),
                        thisDay = myDays[thisDay];
                    var yy = date.getYear();
                    var year = (yy < 1000) ? yy + 1900 : yy;
                    document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                    //
                </script>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Upload Bukti Pembayaran</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Upload Bukti Pembayaran</h3>
                    </div>
                                <form action="upload_pembayaran.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Kode Anggota <small style="color: red;">* Wajib diisi</small></label>
                                        <input type="text" class="form-control" placeholder="Masukan Kode Anggota" name="kode_anggota" required>
                                    </div>
                                    <div class="form-group">
                                    <label for="bukti_pembayaran">Bukti Pembayaran:</label>
                                        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit">Upload Bukti Pembayaran</button>
                                    </div>
                                </div>    
                                </form>
                    <script>
                        function UploadPembayaran() {
                            $('#modalUploadPembayaran').modal('show');
                        }
                    </script>
                    
                </body>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>

<!-- jQuery 3 -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../assets/dist/js/sweetalert.min.js"></script>
