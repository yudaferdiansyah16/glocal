<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">

        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item active">Setting Saldo Awal</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Setting Saldo Awal
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" action="<?= base_url('finance/saldo_awal/store') ?>">
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="form-label">Date</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control form-control-sm x-datepicker x-readonly" readonly placeholder="Select date" name="tgl_trans" value="<?= date('d-m-Y') ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text fs-xl">
                                                <i class="fa fal fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover table-bordered table-striped table-sm" role="grid">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-left">Name</th>
                                        <th class="text-right">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($data as $row) :
                                        $count++;
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $count; ?></td>
                                            <td align="center"><?php echo $row->kode_akun; ?></td>
                                            <td><?php echo $row->nama_akun; ?></td>
                                            <td>
                                                <input type="text" class="form-control form-control form-control-sm x-readonly jumlah_rp" name="jumlah_rp[]" value="<?php echo $row->jumlah_rp; ?>" data-inputmask="'alias': 'currency', 'prefix': ''" required>
                                                <input type="text" class="form-control form-control form-control-sm x-readonly " name="id_akun[]" value="<?php echo $row->id_akun; ?>" hidden>
                                                <input type="hidden" class="form-control form-control form-control-sm x-readonly " name="id_finance" value="<?php echo $row->id_finance; ?>">
                                            </td>
                                        </tr>
                                    <?php @$total += $row->jumlah_rp;
                                    endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="text-align: right; font-weight: bold;">Grand Total :</th>
                                        <td style="text-align: right; font-weight: bold"><?php echo 'Rp. '.number_format($total, 2, '.', ','); ?></th>
                                    </tr>
                                </tfoot>
                            </table><hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fal fa fa-save"></i> Save</button>
                            </div><hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
