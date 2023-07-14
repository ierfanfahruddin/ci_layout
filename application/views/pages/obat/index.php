<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0)" onclick="create()"
                                class="btn btn-sm btn-success mx-3">Tambah</a>
                            <div class="card-tools">
                                <form action="" method="get">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" value="<?= @$_GET['cari'] ?>" name="cari"
                                            class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <?php if (@$_SESSION['errors']) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= @$_SESSION['errors']; ?>
                            </div>
                            <?php endif; ?>
                            <?php if (@$_SESSION['success']) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= @$_SESSION['success']; ?>
                            </div>
                            <?php endif; ?>
                            <?php echo validation_errors(); ?>
                            <table id="mytable" class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis Obat</th>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Jumlah</th>
                                        <th>Tgl Exp</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <?= $this->pagination->create_links() ?>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="obat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="page"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    new DataTable('#mytable', {
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?= $this->config->base_url() ?>index.php/obat/get_obat_list'
        },
        'columns': [{
                data: 'nama_jenis_obat'
            },
            {
                data: 'nama_obat'
            },
            {
                data: 'satuan'
            },
            {
                data: 'harga'
            },
            {
                data: 'stok'
            },
            {
                data: 'jumlah'
            },
            {
                data: 'tgl_exp'
            },
            {
                data: 'action',
                searchable: false,
                orderable: false
            },
        ]
    });
});

function create() {
    $.get("<?= $this->config->base_url('index.php/obat/tambah') ?>", {}, function(data, status) {
        $('#judul').html('Tambah obat');
        $('#page').html(data);
        $('#obat').modal('show');
    });
}

function detail(id) {
    $.get("<?= $this->config->base_url('index.php/obat/detail/') ?>" + id, {}, function(data, status) {
        $('#judul').html('Detail obat');
        $('#page').html(data);
        $('#obat').modal('show');
    });
}

function edit(id) {
    $.get("<?= $this->config->base_url('index.php/obat/edit/') ?>" + id, {}, function(data, status) {
        $('#judul').html('Edit obat');
        $('#page').html(data);
        $('#obat').modal('show');
    });
}
</script>