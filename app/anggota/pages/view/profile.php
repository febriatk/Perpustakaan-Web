<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Profil Saya
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
            <li class="active">Profil Saya</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Edit Profil Saya</h3>
                    </div>
                    <!-- /.box-header -->
                    <form action="pages/function/profile.php?aksi=edit" method="POST" enctype="multipart/form-data">
                        <?php
                        include "../../config/koneksi.php";

                        $nama = $_SESSION['nama'];
                        $query = mysqli_query($koneksi, "SELECT * FROM anggota WHERE nama_lengkap = '$nama'");
                        $row = mysqli_fetch_assoc($query);
                        ?>
                        <div class="box-body">
                            <input name="id_anggota" type="hidden" value="<?= $row['id_anggota']; ?>">
                            <div class="form-group">
                                <label>Kode Anggota <small style="color: red;">* Tidak dapat dirubah</small></label>
                                <input type="text" class="form-control" value="<?= $row['kode_anggota']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap <small style="color: red;">* Wajib diisi</small></label>
                                <input type="text" class="form-control" value="<?= $row['nama_lengkap']; ?>" name="nama_lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Email <small style="color: red;">* Wajib diisi</small></label>
                                <input type="text" class="form-control" value="<?= $row['email']; ?>" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Password <small style="color: red;">* Wajib diisi</small></label>
                                <input type="text" class="form-control" value="<?= $row['password']; ?>" name="password" required>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon <small style="color: red;">* Wajib diisi</small></label>
                                <input type="text" class="form-control" value="<?= $row['no_telepon']; ?>" name="no_telepon" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap <small style="color: red;">* Wajib diisi</small></label>
                                <textarea class="form-control" style="height: 80px; resize: none;" name="alamat" required><?= $row['alamat']; ?></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Profil Saya</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Animasi -->
                        <img src="../../assets/dist/img/avatar01.png" style="width: 125px; height: 125px; display: block; margin-left: auto; margin-right: auto; margin-top: -5px; margin-bottom: 15px;" loop autoplay></lottie-player>
                        <!-- -->
                        <p style="font-weight: bold;">Kode Anggota : <?= $row['kode_anggota']; ?></p>
                        <p style="font-weight: bold;">Nama Lengkap : <?= $row['nama_lengkap']; ?></p>
                        <p style="font-weight: bold;">Email : <?= $row['email']; ?></p>
                        <p style="font-weight: bold;">Password : <?= $row['password']; ?></p>
                        <p style="font-weight: bold;">Nomor Telepon : <?= $row['no_telepon']; ?></p>
                        <p style="font-weight: bold;">Alamat Lengkap : <?= $row['alamat']; ?></p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
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