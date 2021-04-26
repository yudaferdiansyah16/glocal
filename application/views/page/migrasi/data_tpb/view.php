<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Migration</li>
		<li class="breadcrumb-item">Data TPB</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Data TPB <small><?=placeValue($_tpbsetting,'iphost')?></small>
        </h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
                <div class="card-header">
                    <?=placeValue($_checkData,'view')?>
                </div>
				<div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <p><b>TPB LOCAL</b></p>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered" role="grid">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Table</th>
                                            <th class="text-center">Numrows</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($_tpblocal as $key => $value) { ?>
                                        <tr>
                                            <td><?=strtoupper(str_replace('_',' ',$key))?></td>
                                            <td><?=number_format($value)?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <p><b>TPB ONLINE</b></p>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered" role="grid">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Table</th>
                                            <th class="text-center">Numrows</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($_tpbonline as $key => $value) { ?>
                                        <tr>
                                            <td><?=strtoupper(str_replace('_',' ',$key))?></td>
                                            <td><?=number_format($value)?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="card-footer">
                    <?=placeValue($_checkData,'button')?>
                </div>
			</div>
		</div>
	</div>
</main>