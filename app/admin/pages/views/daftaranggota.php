<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Data Anggota
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
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Daftar Anggota</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Data Anggota</h3>
                        <div class="form-group m-b-2 text-right" style="margin-top: -20px; margin-bottom: -5px;">
                            <button type="button" onclick="tambahAnggota()" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Anggota</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            include "../../config/koneksi.php";

                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM anggota");
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['kode_anggota']; ?></td>
                                        <td><?php echo $row['nama_lengkap']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['no_telepon']; ?></td>
                                        <td><?php echo $row['alamat']; ?></td>
                                        <td>
                                            <a href="pages/function/daftar_anggota.php?aksi=hapus&id=<?= $row['id_anggota']; ?>" class="btn btn-danger btn-sm btn-del"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modalTambahAnggota">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Tambah Anggota</h4>
            </div>
            <form action="pages/function/daftar_anggota.php?aksi=tambah" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Anggota <small style="color: red;">* Otomatis Terisi</small></label>
                        <?php
                        include "../../config/koneksi.php";

                        $query = mysqli_query($koneksi, "SELECT max(kode_anggota) as kodeTerakhir FROM anggota");
                        $data = mysqli_fetch_array($query);
                        $kodeTerakhir = $data['kodeTerakhir'];

                        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
                        // dan diubah ke integer dengan (int)
                        $urutan = (int) substr($kodeTerakhir, 3, 3);

                        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                        $urutan++;

                        // membentuk kode barang baru
                        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
                        $huruf = "A";
                        $Anggota = $huruf . sprintf("%03s", $urutan);
                        ?>
                        <input type="text" class="form-control" value="<?php echo $Anggota ?>" name="kodeAnggota" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Lengkap" name="namaLengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Email <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Email" name="mail" required>
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>No Telepon <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan No Telepom" name="telp" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat <small style="color: red;">* Wajib diisi</small></label>
                        <textarea class="form-control" style="resize: none; height: 70px;" name="alamat" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    function tambahAnggota() {
        $('#modalTambahAnggota').modal('show');
    }
</script>
<!-- jQuery 3 -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../assets/dist/js/sweetalert.min.js"></script>
<!-- Swal Hapus Data -->
<script>
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Apakah anda yakin ingin menghapus data anggota ini ?',
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
                        text: 'Data anggota tersebut aman !'
                    })
                }
            });
    })
</script>