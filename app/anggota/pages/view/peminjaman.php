<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Peminjaman Buku
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
            <li class="active">Peminjaman Buku</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
        
        <?php
        // session_start();
         if (!isset($_SESSION['kode_anggota'])) {
             //header("Location: ../../login.php");
             exit();
         }
        include "../../../../config/koneksi.php";

        $kode_anggota = $_SESSION['kode_anggota'];
        $query = mysqli_query($koneksi, "SELECT judul_buku, tanggal_pinjam, batas_pinjam, tanggal_kembali, denda FROM peminjaman WHERE kode_anggota = '$kode_anggota'");
        $dataPeminjaman = mysqli_fetch_all($query, MYSQLI_ASSOC);

        mysqli_close($koneksi);
        ?>

        <?php
            $no = 1;
            foreach ($dataPeminjaman as $peminjaman) {
        ?>
            <tbody>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $peminjaman['judul_buku']; ?></td>
                    <td><?php echo $peminjaman['tanggal_pinjam']; ?></td>
                    <td><?php echo $peminjaman['batas_pinjam']; ?></td>
                    <td><?php echo $peminjaman['tanggal_kembali']; ?></td>
                    <td><?php echo $peminjaman['denda']; ?></td>
                </tr>
            </tbody>
        <?php
        }
        ?>
    </table>
    </div>
    </div>
</div>
    </section>
