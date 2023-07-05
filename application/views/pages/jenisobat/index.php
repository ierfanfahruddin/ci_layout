<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title" style="margin-bottom:-20px;">Responsive Hover Table</h3> -->
                            <a href="javascript:void(0)" onclick="create()"
                                class="btn btn-sm btn-success mx-3">Tambah</a>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <?php
                            if (@$_SESSION['errors']) {
                            }
                            ?>
                            <?php if (@$_SESSION['errors']) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= @$_SESSION['errors']; ?>
                            </div>
                            <?php endif; ?>
                            <?php
                            if (@$_SESSION['success']) {
                            }
                            ?>

                            <?php echo validation_errors(); ?>
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis Obat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($jenisobat as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['nama_jenis_obat'] ?></td>
                                        <td>
                                            <a href="#" onclick="edit('<?= $row['id'] ?>')"
                                                class="btn btn-sm btn-info">Edit</a>
                                            <a onclick="return confirm('apa anda yakin')"
                                                href="<?= $this->config->base_url('index.php/jenisobat/delete/') . $row['id'] ?>"
                                                class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endforeach;   ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="jenisobat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul"></h5>
                <i class="bi bi-x-lg" style="font-size: 20px;" data-dismiss="modal" aria-label="Close"></i>
                <!-- <button type="button" class="btn btn-sm-close"></button> -->
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
<?= @$_SESSION['success'] ?>
<?php if (@$_SESSION['success']) : ?>
<script>
new Noty({
    type: 'success',
    theme: 'sunset',
    text: " <?= @$_SESSION['success'] ?> ",
    animation: {
        open: function(promise) {
            var n = this;
            var Timeline = new mojs.Timeline();
            var body = new mojs.Html({
                el: n.barDom,
                x: {
                    500: 0,
                    delay: 0,
                    duration: 500,
                    easing: 'elastic.out'
                },
                isForce3d: true,
                onComplete: function() {
                    promise(function(resolve) {
                        resolve();
                    })
                }
            });

            var parent = new mojs.Shape({
                parent: n.barDom,
                width: 200,
                height: n.barDom.getBoundingClientRect().height,
                radius: 0,
                x: {
                    [150]: -150
                },
                duration: 1.2 * 500,
                isShowStart: true
            });

            n.barDom.style['overflow'] = 'visible';
            parent.el.style['overflow'] = 'hidden';

            var burst = new mojs.Burst({
                parent: parent.el,
                count: 10,
                top: n.barDom.getBoundingClientRect().height + 75,
                degree: 90,
                radius: 75,
                angle: {
                    [-90]: 40
                },
                children: {
                    fill: '#EBD761',
                    delay: 'stagger(500, -50)',
                    radius: 'rand(8, 25)',
                    direction: -1,
                    isSwirl: true
                }
            });

            var fadeBurst = new mojs.Burst({
                parent: parent.el,
                count: 2,
                degree: 0,
                angle: 75,
                radius: {
                    0: 100
                },
                top: '90%',
                children: {
                    fill: '#EBD761',
                    pathScale: [.65, 1],
                    radius: 'rand(12, 15)',
                    direction: [-1, 1],
                    delay: .8 * 500,
                    isSwirl: true
                }
            });

            Timeline.add(body, burst, fadeBurst, parent);
            Timeline.play();
        },
        close: function(promise) {
            var n = this;
            new mojs.Html({
                el: n.barDom,
                x: {
                    0: 500,
                    delay: 10,
                    duration: 500,
                    easing: 'cubic.out'
                },
                skewY: {
                    0: 10,
                    delay: 10,
                    duration: 500,
                    easing: 'cubic.out'
                },
                isForce3d: true,
                onComplete: function() {
                    promise(function(resolve) {
                        resolve();
                    })
                }
            }).play();
        }
    }
}).show();
</script>
<?php endif; ?>
<script>
function create() {
    $.get("<?= $this->config->base_url('index.php/jenisobat/tambah') ?>", {}, function(data, status) {
        $('#judul').html('Tambah jenisobat');
        $('#page').html(data);
        $('#jenisobat').modal('show');
    });
}

function detail(id) {
    $.get("<?= $this->config->base_url('index.php/jenisobat/detail/') ?>" + id, {}, function(data, status) {
        $('#judul').html('Detail jenisobat');
        $('#page').html(data);
        $('#jenisobat').modal('show');
    });
}

function edit(id) {
    $.get("<?= $this->config->base_url('index.php/jenisobat/edit/') ?>" + id, {}, function(data, status) {
        $('#judul').html('Edit jenisobat');
        $('#page').html(data);
        $('#jenisobat').modal('show');
    });
}
</script>