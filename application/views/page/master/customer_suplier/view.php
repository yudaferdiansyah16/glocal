<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_view'))?>
    <div class="subheader">
        <h1 class="subheader-title">
			Customer & Supplier
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-header">
                    <a href="<?= base_url('master/customer_suplier/add') ?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> <?=$this->lang->line('button_add')?></a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="customer-tab" data-toggle="tab" href="#tab_customer" role="tab" aria-controls="tab_customer" aria-selected="true">CUSTOMER</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="supplier-tab" data-toggle="tab" href="#tab_supplier" role="tab" aria-controls="tab_supplier" aria-selected="false">SUPPLIER</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab_customer" role="tabpanel" aria-labelledby="customer-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-g">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered table-striped table-sm" id="dt_customer" role="grid" style="white-space: nowrap;" widht="99%">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Code</th>
                                                            <th class="text-center">Old Code</th>
                                                            <th class="text-center">Country</th>
                                                            <th class="text-center">Name</th>
                                                            <th class="text-center">Address</th>
                                                            <!-- <th class="text-center">Consignee</th> -->
                                                            <th class="text-center">Consignee Address</th>
							    <th class="text-center">Nama Consignee</th>
                                                            <th class="text-center">NPWP</th>
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
                        </div>
                        <div class="tab-pane fade" id="tab_supplier" role="tabpanel" aria-labelledby="supplier-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-g">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered table-striped table-sm" id="dt_supplier" role="grid" style="white-space: nowrap;" widht="99%">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Code</th>
                                                            <th class="text-center">Old Code</th>
                                                            <th class="text-center">Country</th>
                                                            <th class="text-center">Name</th>
                                                            <th class="text-center">Address</th>
                                                            <!-- <th class="text-center">Consignee</th> -->
                                                            <th class="text-center">Consignee Address</th>
							    <th class="text-center">Nama Consignee</th>
                                                            <th class="text-center">NPWP</th>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <h3><b>CUSTOMER</b></h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped table-sm" id="dt_customer" role="grid" style="white-space: nowrap;" widht="99%">
                            <thead>
                                <tr>
									<th class="text-center">Code</th>
									<th class="text-center">Old Code</th>
									<th class="text-center">Country</th>
									<th class="text-center">Name</th>
									<th class="text-center">Address</th>
									<th class="text-center">Consignee</th>
									<th class="text-center">Consignee Address</th>
									<th class="text-center">NPWP</th>
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
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="card mb-g">
                <div class="card-body">
                    <h3><b>SUPPLIER</b></h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped table-sm" id="dt_supplier" role="grid" style="white-space: nowrap;" widht="99%">
                            <thead>
                                <tr>
									<th class="text-center">Code</th>
									<th class="text-center">Old Code</th>
									<th class="text-center">Country</th>
									<th class="text-center">Name</th>
									<th class="text-center">Address</th>
									<th class="text-center">Consignee</th>
									<th class="text-center">Consignee Address</th>
									<th class="text-center">NPWP</th>
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
    </div> -->
</main>
