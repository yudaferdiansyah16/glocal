<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Warehouse</li>
        <li class="breadcrumb-item">Adjust Material</li>
        <li class="breadcrumb-item active">Detail</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Detail Adjust Material
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-header">
                    <?php if ($t_wh->approval_2 == 1) { ?>
                        <button type="button" disabled class="btn btn-primary btn-sm btn-pills waves-effect waves-themed">
                            <i class="fa fal fa-check"></i> Approved 2
                        </button>
                    <?php } else if ($t_wh->approval_1 == 1) { ?>
                        <button type="button" disabled class="btn btn-success btn-sm btn-pills waves-effect waves-themed">
                            <i class="fa fal fa-check"></i> Approved 1
                        </button>
                    <?php } else if ($t_wh->approval_1 == 0) { ?>
                        <button type="button" disabled class="btn btn-default btn-sm btn-pills waves-effect waves-themed">
                            <i class="fa fal fa-hourglass"></i> Ready
                        </button>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-2">Transaction Number</dt>
                                <dd class="col-sm-9"><?= $t_wh->kode_mutasi ?></dd>
                                <dt class="col-sm-2">Adjust Date</dt>
                                <dd class="col-sm-9"><?= date('d-m-Y', strtotime($t_wh->tanggal_terima)) ?></dd>
                                <dt class="col-sm-2">Issue Type</dt>
                                <dd class="col-sm-9"><?= $t_wh->nama_jenis_mutasi ?></dd>
                            </dl>                        
                        </div>
                        <div class="col-md-6">
                            <dt class="col-sm-2">Adjust Note</dt>
                            <textarea class="form-control form-control-sm" readonly=""><?= $t_wh->deskripsi ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">DN Number</th>
                                        <th class="text-center">Job</th>
                                        <th class="text-center">Item Material</th>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">Qty Adjust</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($t_wh_detail as $i => $detail): ?>
                                        <tr>
                                            <td class="text-center"><?= ($i + 1) ?></td>
                                            <td>
                                                <?= $detail->no_sj ?><br>
                                                <small>Arrived Date: <?= date('d-m-Y', strtotime($detail->tgl_kedatangan)) ?></small>
                                            </td>
                                            <td>
                                                <?= $detail->no_job ?>
                                            </td>
                                            <td>
                                                <?= $detail->nama_barang ?><br>
                                                <small><?= $detail->kode_barang ?></small>
                                            </td>
                                            <td>
                                                <?= $detail->nama_gudang ?><br>
                                                <small><?= $detail->nama_koordinat ?></small>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                if ($detail->qty >= 0) {
                                                    echo '+' . number_format($detail->qty, 2);
                                                } else {
                                                    echo number_format($detail->qty, 2);
                                                }
                                                ?><br>
                                                <small><?= $detail->kode_satuan_terkecil ?></small>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($t_wh->approval_2 == 0): ?>
                                <form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url($_controller . '/' . $_method . '/approve') ?>">
                                    <input type="hidden" name="id_wh" value="<?= $t_wh->id_wh ?>">
                                    <input type="hidden" name="approval_1" value="<?= ($t_wh->approval_1 == 0 ? 1 : 0) ?>">
                                    <?php if ($t_wh->approval_1 == 0): ?>
                                        <button type="submit" class="btn btn-sm btn-success btn_approve"><i class="fal fa fa-check-circle"></i> Approve 1
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-sm btn-secondary btn_approve"><i class="fal fa fa-circle"></i> Disapprove 1
                                        </button>
                                    <?php endif; ?>
                                </form>
                            <?php endif; ?>
                            <?php if ($t_wh->approval_1 == 1): ?>
                                <form class="form-inline" style="float:left; margin-left: 5px;" method="post" action="<?= base_url($_controller . '/' . $_method . '/approve2') ?>">
                                    <input type="hidden" name="id_wh" value="<?= $t_wh->id_wh ?>">
                                    <input type="hidden" name="approval_2" value="<?= ($t_wh->approval_2 == 0 ? 1 : 0) ?>">
                                    <?php if ($t_wh->approval_2 == 0): ?>
                                        <button type="submit" class="btn btn-sm btn-primary btn_approve"><i class="fal fa fa-check-circle"></i> Approve 2
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-sm btn-secondary btn_approve"><i class="fal fa fa-circle"></i> Disapprove 2
                                        </button>
                                    <?php endif; ?>
                                </form>
                            <?php endif; ?>
                            <a href="<?= base_url($_controller . '/' . $_method) ?>" style="margin-left: 5px;" class="btn btn-sm btn-danger"><i class="fal fa-times-circle"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
