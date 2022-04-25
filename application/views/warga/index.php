<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Warga</h1>
                        <a href="<?= base_url() ?>warga/tambah" class="btn btn-primary mt-2">Tambah Data Warga</a>
                        <div class="mt-3">
                            <div class="flash-data" id="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>NEGARA</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <?php foreach ($warga as $row) { ?>
                    <tbody>
                        <tr>
                            <td><?= ++$start; ?></td>
                            <td><?= $row['nik_warga']; ?></td>
                            <td><?= $row['nama_warga']; ?></td>
                            <td><?= $row['negara']; ?></td>
                            <td>
                                <a href="<?= base_url('warga/hapus_warga/' . $row['id_warga']) ?>" class="badge bg-danger btn-hapus">Hapus Data</a>
                                <a href="<?= base_url('warga/edit_warga/' . $row['id_warga']) ?>" class="badge bg-warning">Edit Data</a>
                            </td>
                    </tbody>
                <?php } ?>
            </table>
            <?= $this->pagination->create_links() ?>
        </div>

        <!-- /.content-header -->
    </div>
    <!-- /.content-wrapper -->
</div>