<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Data Koleksi Buku
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
            <li class="active">Data Koleksi Buku</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Data Koleksi Buku</h3>
                        <div class="form-group m-b-2 text-right" style="margin-top: -20px; margin-bottom: -5px;">
                            <button type="button" onclick="tambahkoleksi_buku()" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Koleksi Buku</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis Buku</th>
                                    <th>Penerbit Buku</th>
                                    <th>Sinopsis Buku</th>
                                    <th>Cover Buku</th>
                                    <th>Ketesediaan</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            include "../../config/koneksi.php";

                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM buku");
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['judul_buku']; ?></td>
                                        <td><?php echo $row['penulis_buku']; ?></td>
                                        <td><?php echo $row['penerbit_buku']; ?></td>
                                        <td><?php echo $row['bahasa']; ?></td>
                                        <td><?php echo $row['jenis_buku']; ?></td>
                                        <td><?php echo $row['isbn']; ?></td>
                                        <td><?php echo $row['sinopsis_buku']; ?></td>
                                        <td><?php echo $row['cover_buku']; ?></td>
                                        <td><?php echo $row['ketersediaan']; ?></td>
                                        <td>
                                            <a href="pages/function/koleksibuku.php?act=hapus&id=<?= $row['id_buku']; ?>" class="btn btn-danger btn-sm btn-del" onclick="hapuskoleksi_buku()"><i class="fa fa-trash"></i></a>
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
<!-- Modal Tambah Koleksi Buku -->
<div class="modal fade" id="modalTambahKoleksiBuku">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Tambah Koleksi Buku</h4>
            </div>
            <form action="pages/function/koleksi_buku.php?act=tambah" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- -->
                    <input type="hidden" name="role" value="Admin">
                    <div class="form-group">
                        <label>Judul Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Judul Buku" name="judul_buku" required>
                    </div>
                    <div class="form-group">
                        <label>Penulis Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Penulis Buku" name="penulis_buku" required>
                    </div>
                    <div class="form-group">
                        <label>Penerbit Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Penerbit Buku" name="penerbit_buku" required>
                    </div>
                    <div class="form-group">
                        <label>Bahasa <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Bahasa Buku" name="bahasa" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Jenis Buku" name="jenis_buku" required>
                    </div>
                    <div class="form-group">
                        <label>ISBN Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan ISBN Buku" name="isbn" required>
                    </div>
                    <div class="form-group">
                        <label>Sinopsis Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Sinopsis Buku" name="sinopsis_buku" required>
                    </div>
                    <div class="form-group">
                        <label>Cover Buku</label>
                        <input type="file" class="form-control" name="cover_buku" accept=".jpg, .jpeg, .png">
                        <span class="glyphicon glyphicon-file form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label>Ketersediaan Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Ketersediaan Buku" name="ketersediaan" required>
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
    function tambahkoleksi_buku() {
        $('#modalTambahKoleksiBuku').modal('show');
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
                text: 'Apakah anda yakin ingin menghapus data buku ini ?',
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
                        text: 'Data buku tersebut tetap aman !'
                    })
                }
            });
    })
</script>