<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Migration</li>
		<li class="breadcrumb-item">Backup & Restore</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">
			Backup & Restore
        </h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-6 col-xl-6">
			<div class="card mb-g">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" role="grid">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">BACKUP DATE</th>
                                    <th class="text-center">RESTORE</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($_backupdata as $row) { ?>
                                <tr>
                                    <td class="text-center"><?=$row->no?></td>
                                    <td class="text-left"><?=$row->datetime?></td>
                                    <td class="text-center"><?=$row->option?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</main>