<main id="js-page-content" role="main" class="page-content">
	<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item">Warehouse</li>
		<li class="breadcrumb-item active">Warehouse Stock</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
	</ol>
	<div class="subheader">
		<h1 class="subheader-title">Warehouse Stock</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_material" role="tab"
						aria-controls="tab_material" aria-selected="true">Material</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_fg" role="tab"
						aria-controls="tab_fg" aria-selected="false">FG</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_wip" role="tab"
						aria-controls="tab_wip" aria-selected="false">WIP</a>
				</li>

			</ul>
			<div class="tab-content" id="myTabContent">

				<div  class=" card mb-g tab-pane fade show active" id="tab_material" role="tabpanel" aria-labelledby="home-tab">
					<div class="card-body">
						<div class="row">
						</div>
						<div class="row" style="margin-top: 15px;">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt_material" class="table table-hover table-bordered table-striped table-sm"	role="grid" style="white-space: nowrap">
										<thead>
											<tr class="text-center">
												<th style="width: 30px;">No</th>
												<th style="width: 150px;">Material Code</th>
												<th>Material Item</th>
												<th>Size</th>
												<th>Classification</th>
												<th>Quantity Satuan Terbesar</th>
												<th>Quantity Satuan Terkecil</th>
												<!-- <th>Quantity</th> -->
												<th style="width: 50px;">Option</th>
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
				<div  class=" card mb-g tab-pane fade" id="tab_fg" role="tabpanel" aria-labelledby="profile-tab">
					<div class="card-body">
						<div class="row">
						</div>
						<div class="row" style="margin-top: 15px;">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt_fg" class="table table-hover table-bordered table-striped table-sm" role="grid" style="white-space: nowrap">
										<thead>
											<tr class="text-center">
												<th style="width: 30px;">No</th>
												<th style="width: 150px;">Material Coae</th>
												<th>Material Item</th>
												<th>Size</th>
												<th>Classification</th>
												<th>Quantity Satuan Terbesar</th>
												<th>Quantity Satuan Terkecil</th>
												<!-- <th>Quantity</th> -->
												<!-- <th style="width: 50px;">Option</th> -->
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
				<div  class=" card mb-g tab-pane fade" id="tab_wip" role="tabpanel" aria-labelledby="contact-tab">
					<div class="card-body">
						<div class="row">
						</div>
						<div class="row" style="margin-top: 15px;">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="dt_wip" class="table table-hover table-bordered table-striped table-sm" role="grid" style="white-space: nowrap">
										<thead>
											<tr class="text-center">
												<th style="width: 30px;">No</th>
												<th style="width: 150px;">Material Coae</th>
												<th>Material Item</th>
												<th>Size</th>
												<th>Classification</th>
												<th>Quantity Satuan Terbesar</th>
												<th>Quantity Satuan Terkecil</th>
												<!-- <th>Quantity</th> -->
												<!-- <th style="width: 50px;">Option</th> -->
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
	<div class="x-hidden" id="template-detail">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover table-sm dt-detail">
						<thead>
							<tr class="text-center">
								<th style="width: 30px;">No.</th>
								<th>Warehouse Name</th>
								<th style="width: 120px;">Coordinat</th>
								<th style="width: 100px;">Quantity</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>
