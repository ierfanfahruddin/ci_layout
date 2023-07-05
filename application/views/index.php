<?php include('layout/menu.php'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $obat ?></h3>

                            <h3>Obat</h3>
                            <p>jenis obat: <?= $jenis_obat ?></p>
                            <p>obat exp: <?= $obatexp ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $users ?></h3>

                            <h3>User</h3>
                            <p>User aktif: <?= $usersactive ?></p>
                            <p>User non aktif: <?= $usersnonactive ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <!-- <h3 class="card-title" style="margin-bottom:-20px;">Responsive Hover Table</h3> -->
                        <!-- <a href="javascript:void(0)" onclick="create()" class="btn btn-success mx-3">Tambah</a> -->
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
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

                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>jumlah</th>
                                    <th>Tgl Exp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($dataobat as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['nama_jenis_obat'] ?></td>
                                        <td><?= $row['nama_obat'] ?></td>
                                        <td><?= $row['satuan'] ?></td>
                                        <td>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                        <td><?= $row['stok'] ?></td>
                                        <td>Rp. <?= number_format($row['stok'] * $row['harga'], 0, ',', '.') ?></td>
                                        <td>
                                            <?php if ($row['tgl_exp'] < date('Y-m-d')) { ?>
                                                <span class="text-danger"><?= $row['tgl_exp'] ?></span>
                                            <?php } else { ?>
                                                <?= $row['tgl_exp'] ?>
                                            <?php } ?>
                                        </td>

                                    </tr>
                                <?php endforeach;   ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <!-- Left col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
</div>
<script src="https://cdn.jsdelivr.net/npm/@mojs/core"></script>
<script>
    new Noty({
        type: 'success',
        theme: 'sunset',
        text: "Selamat datang <?= @$_SESSION['username'] ?> ",
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
<?php
include('layout/footer.php')
?>