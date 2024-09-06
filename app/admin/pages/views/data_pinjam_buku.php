<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Data Peminjaman Buku
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
            <li class="active">Daftar Peminjaman Buku</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Data Peminjaman Buku</h3>
                        <div class="form-group m-b-2 text-right" style="margin-top: -20px; margin-bottom: -5px;">
                            <button type="button" onclick="tambahPeminjaman()" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Peminjaman</button>
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
                                    <th>Judul Buku</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Batas Pengembalian</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Denda</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            include "../../config/koneksi.php";

                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='Pinjam'");
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['kode_anggota']; ?></td>
                                        <td><?php echo $row['nama_lengkap']; ?></td>
                                        <td><?php echo $row['judul_buku']; ?></td>
                                        <td><?php echo $row['tanggal_pinjam']; ?></td>
                                        <td><?php echo $row['batas_pinjam']; ?></td>
                                        <td> 
                                           <form method="POST" action="kembali_buku.php"> <!-- Adjust action attribute as needed -->
                                           <input type="date" name="tanggal_kembali" required>
                                           <input type="hidden" name="id_peminjaman" value="<?php echo $row['id_peminjaman']; ?>">
                                           <a href="pages/function/data_pinjam_buku.php?aksi=hapus&id=<?= $row['id_peminjaman']; ?>">
                                           Kembalikan Buku
                                            </a>
                                            </form>
                                        </td>
                                        <td>
                                        <?php
                                            if (isset($_POST['tanggal_kembali'])) {
                                                $tanggal_kembali = strtotime($_POST['tanggal_kembali']);
                                                $tanggal_dateline = strtotime($row['batas_pinjam']);
                                                $terlambat = ($tanggal_kembali - $tanggal_dateline) / (60 * 60 * 24);
                                                $denda = max($terlambat, 0) * 1000;

                                                if ($terlambat < 21) {
                                                    echo "Tidak ada denda";
                                                } else {
                                                    echo $denda;
                                                }
                                            }
                                        ?>    
                                        </td>  
                                        <td><?php echo $row['status']; ?></td>
                                        <td>
                                            <a href="pages/function/data_pinjam_buku.php?aksi=hapus&id=<?= $row['id_peminjaman']; ?>" class="btn btn-danger btn-sm btn-del" onclick="hapusPeminjaman()"><i class="fa fa-trash"></i></a>
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
<!-- Modal Tambah Peminjaman Buku -->
<div class="modal fade" id="modaltambahPeminjaman">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Tambah Peminjaman</h4>
            </div>
            <form action="pages/function/data_pinjam_buku.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- -->
                    <input type="hidden" name="role" value="Admin">
                    <div class="form-group">
                        <label>Kode Anggota <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Kode Anggota" name="kode_anggota" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Anggota <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Anggota" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Judul Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Judul Buku" name="judul_buku" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="tanggal_pinjam" required>
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
    function tambahPeminjaman() {
        $('#modaltambahPeminjaman').modal('show');
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
                text: 'Apakah anda yakin ingin menghapus data peminjaman ini ?',
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
                        text: 'Data peminjaman tersebut tetap aman !'
                    })
                }
            });
    })
</script>