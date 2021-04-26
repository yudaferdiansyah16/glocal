<main id="js-page-content" role="main" class="page-content">
	<?=generateBreadcrumb($this->lang->line('breadcrumb_view'))?>
	<div class="subheader">
		<h1 class="subheader-title">
			<?=$this->lang->line('title_view')?>
		</h1>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-12 col-xl-12">
			<div class="card mb-g">
				<div class="card-header">
					<a href="<?= base_url('setting/module/add') ?>" class="btn btn-sm btn-primary"><i class="fal fa fa-plus-circle"></i> Add Module</a>
				</div>
				<div class="card-body">
					<?php
					$lang_code = $this->session->userdata('lang_code');
					$suffix = "";
					switch ($lang_code) {
						case "indonesia":
							$suffix = "id";
							break;
						default:
							$suffix = "en";
							break;
					}
					$query = $this->db->query("WITH RECURSIVE cte AS ( SELECT id_modul, nama_modul_$suffix, icon_class, url, tag, id_modul_parent, id_status, order_menu, 1 AS depth, CAST( LPAD(order_menu, 3, '0') AS CHAR ( 255 )) AS path FROM m_modul WHERE id_modul_parent = '0' UNION ALL SELECT c.id_modul, c.nama_modul_$suffix, c.icon_class, c.url, c.tag, c.id_modul_parent, c.id_status, c.order_menu, cte.depth + 1, CONCAT( cte.path, \",\", LPAD(c.order_menu, 3, '0') ) FROM m_modul c JOIN cte ON cte.id_modul = c.id_modul_parent ) SELECT * FROM cte WHERE id_status = '1' ORDER BY path");
					$arrmodul = array();
					foreach ($query->result() as $modul) {
						if (!isset($arrmodul[$modul->id_modul_parent]))
							$arrmodul[$modul->id_modul_parent] = array();
						array_push($arrmodul[$modul->id_modul_parent], array(
								'id_modul' => $modul->id_modul,
								'nama_modul' => $modul->{'nama_modul_' . $suffix},
								'url' => $modul->url,
								'tag' => $modul->tag,
								'icon_class' => $modul->icon_class
						));
					}

					function generateNestedMenu($_controller, $_method, $arrmodul, $id_modul_parent = 0) {
						$stringMenu = "";
						if (isset($arrmodul[$id_modul_parent])) {
							foreach ($arrmodul[$id_modul_parent] as $modul) {
								$txtClass = "";
								if (!isset($arrmodul[$modul['id_modul']])) {
									$arrurl = explode('/', $modul['url']);
									if ($_controller == $arrurl[0] && $_method == $arrurl[0]) {
										$txtClass = "class='active'";
									}
								}
								$stringMenu .= "<li class='dd-item dd3-item' data-id='$modul[id_modul]'>";
								$stringMenu .= "<div class='dd-handle dd3-handle'></div>";
								$stringMenu .= "<div class='dd3-content'>";
								$stringMenu .= "<i class='$modul[icon_class]'></i> $modul[nama_modul]";
								$stringMenu .= "<span style='float: right'>/<span>$modul[url]</span>&nbsp;&nbsp;";
								$stringMenu .= "<a style='cursor: pointer;' href='".base_url($_controller . '/' . $_method . '/edit/' . $modul['id_modul'])."'><i class='fal fa-edit'></i> Edit</a>";
								$stringMenu .="</span>";
								$stringMenu .= "</div>";
								if (isset($arrmodul[$modul['id_modul']])) {
									$stringMenu .= "<ol class='dd-list'>";
									$stringMenu .= generateNestedMenu($_controller, $_method, $arrmodul, $modul['id_modul']);
									$stringMenu .= "</ol>";
								}
								$stringMenu .= "</li>";
							}
						}
						return $stringMenu;
					}
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="dd">
								<ol class="dd-list">
									<?=generateNestedMenu($_controller, $_method, $arrmodul, 0)?>
								</ol>
							</div>
							<input type="hidden" id="nestable-output">
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-sm btn-success" id="btn-save"><i class="fal fa-save"></i> Save Changes</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
