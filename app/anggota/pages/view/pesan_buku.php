<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Pemesanan Koleksi Buku
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
            <li class="active">Pemesanan Koleksi Buku</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tgl-pinjam" data-toggle="tab">Formulir Pemesanan Buku</a></li>
                        <li><a href="#tgl-pengembalian" data-toggle="tab">Riwayat Pemesanan Buku</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="tgl-pinjam">
                            <section id="new">
                                <?php
                                include "../../config/koneksi.php";

                                $nama = $_SESSION['nama'];
                                $sql = mysqli_query($koneksi, "SELECT * FROM pemesanan_buku WHERE nama_lengkap = '$nama'");
                                $hasil = mysqli_num_rows($sql);
                                ?>

                                <?php
                                if ($hasil > 0) {
                                    $sql3 = mysqli_query($koneksi, "SELECT * FROM pemesanan_buku WHERE nama_lengkap = '$nama'");
                                    $row = mysqli_num_rows($sql3);
                                    echo "
                                    <div class='alert alert-danger small'>
                                        Kamu saat ini telah memesan sebanyak " . $hasil . " Buku
                                    </div>";
                                } else {
                                    //
                                }
                                ?>
                                <form action="pages/function/pesan_buku.php" method="POST">
                                    <?php
                                    include "../../config/koneksi.php";
                                    $id_anggota = $_SESSION['id_akun'];
                                    $query_nama_lengkap = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_akun = '$id'");
                                    $row1 = mysqli_fetch_array($query_nama_lengkap);
                                    ?>
                                    <div class="form-group">
                                        <label>Nama Anggota</label>
                                        <input type="text" class="form-control" name="nama_lengkap" value="<?= $row1['nama']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Judul Buku</label>
                                        <select class="form-control" name="judul_buku">
                                            <option selected disabled> -- Silahkan pilih buku yang akan di pinjam -- </option>
                                            <?php
                                            include "../../config/koneksi.php";

                                            $sql = mysqli_query($koneksi, "SELECT * FROM buku");
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <option value="<?= $data['judul_buku']; ?>"> <?= $data['judul_buku']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Pemesanan</label>
                                        <input type="date" class="form-control" name="tanggal_pemesanan" value="<?= date('d-m-Y'); ?>"
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                                    </div>
                                </form>
                            </section>
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div class="tab-pane" id="tgl-pengembalian">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pemesanan</th>
                                    </tr>
                                </thead>
                                <?php
                                include "../../config/koneksi.php";

                                $no = 1;
                                $nama = $_SESSION['nama'];
                                $query = mysqli_query($koneksi, "SELECT * FROM pemesanan_buku WHERE nama_lengkap = '$nama'");
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nama_lengkap']; ?></td>
                                            <td><?= $row['judul_buku']; ?></td>
                                            <td><?= $row['tanggal_pemesanan']; ?></td>
                                        </tr>
                                    </tbody>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                        <!-- /#tgl-pengembalian] -->

                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
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
<!-- Pesan Berhasil Edit -->
<script>
    <?php
    if (isset($_SESSION['berhasil']) && $_SESSION['berhasil'] <> '') {
        echo "swal({
            icon: 'success',
            title: 'Berhasil',
            text: '$_SESSION[berhasil]'
        })";
    }
    $_SESSION['berhasil'] = '';
    ?>
</script>
<!-- Pesan Gagal Edit -->
<script>
    <?php
    if (isset($_SESSION['gagal']) && $_SESSION['gagal'] <> '') {
        echo "swal({
                icon: 'error',
                title: 'Gagal',
                text: '$_SESSION[gagal]'
              })";
    }
    $_SESSION['gagal'] = '';
    ?>
</script>
<!-- Swal Hapus Data -->
<script>
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Apakah anda yakin ingin menghapus data administrator ini ?',
                buttons: true,
                dangerMode: true,
                buttons: ['Tidak, Batalkan !', 'Iya, Hapus']
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = href;
                } else {
                    swal({
                        icon: 'error',
                        title: 'Dibatalkan',
                        text: 'Data administrator tersebut tetap aman !'
                    })
                }
            });
    })
</script>