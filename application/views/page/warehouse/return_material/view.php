<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Warehouse</li>
        <li class="breadcrumb-item active">Return Material</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Return Material
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-header">
                    <a href="<?= base_url($_controller . '/' . $_method . '/add') ?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?= $this->lang->line('button_add') ?></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped table-sm" id="dt" role="grid">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Mutation Code</th>
                                    <th class="text-center">Return Date</th>
                                    <th class="text-center">Return Note</th>
                                    <th class="text-center">Total Item</th>
                                    <th class="text-center"></th>
                                    <th class="text-center">Status Approval</th>
                                    <th class="text-center">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
