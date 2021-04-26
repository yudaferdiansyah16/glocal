<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SMARTONE</a></li>
        <li class="breadcrumb-item">Finance</li>
        <li class="breadcrumb-item">General Journal</li>
        <li class="breadcrumb-item"><?php echo $detail->no_trans ?></li>
        <li class="breadcrumb-item active">Detail</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Detail General Journal <small><?php echo $detail->no_trans ?></small>
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">No Trans</dt>
                        <dd class="col-sm-9"><?php echo $detail->no_trans ?></dd>
                        <dt class="col-sm-2">Transaction Date</dt>
                        <dd class="col-sm-9"><?php echo $detail->tgl_trans ?></dd>
                        <dt class="col-sm-2">Rate</dt>
                        <dd class="col-sm-9"><?php echo number_format($detail->rate, 2); ?></dd>
                    </dl>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped table-sm" role="grid" style="white-space: nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-left">Account</th>
                                            <th class="text-left">Description</th>
                                            <th class="text-left">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        foreach ($data as $row) :
                                            $count++;
                                        ?>
                                            <tr>
                                                <th class="text-center"><?php echo $count; ?></th>
                                                <th class="text-left"><?php echo $row->nama_akun ?></th>
                                                <th class="text-left"><?php echo $row->description ?></th>
                                                <th class="text-left"><?php echo number_format($row->amount, 2); ?></th>
                                            </tr>
                                        <?php
                                        	@$total += $row->amount;
                                    		endforeach;
                                    	?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-center">TOTAL</th>
                                            <th class="text-left"><?=number_format($total,2) ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div><hr>
                    <div class="form-group">
                        <a href="<?=base_url($_controller.'/'.$_method)?>" class="btn btn-sm btn-info waves-effect waves-themed"><i class="fal fa fa-times-circle"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>