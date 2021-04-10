<?php
namespace PHPMaker2020\klinik_latest_09_04_21;
?>
<?php if ($permintaanpembelian->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_permintaanpembelianmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($permintaanpembelian->id_pp->Visible) { // id_pp ?>
		<tr id="r_id_pp">
			<td class="<?php echo $permintaanpembelian->TableLeftColumnClass ?>"><?php echo $permintaanpembelian->id_pp->caption() ?></td>
			<td <?php echo $permintaanpembelian->id_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_id_pp">
<span<?php echo $permintaanpembelian->id_pp->viewAttributes() ?>><?php echo $permintaanpembelian->id_pp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($permintaanpembelian->no_pp->Visible) { // no_pp ?>
		<tr id="r_no_pp">
			<td class="<?php echo $permintaanpembelian->TableLeftColumnClass ?>"><?php echo $permintaanpembelian->no_pp->caption() ?></td>
			<td <?php echo $permintaanpembelian->no_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_no_pp">
<span<?php echo $permintaanpembelian->no_pp->viewAttributes() ?>><?php echo $permintaanpembelian->no_pp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($permintaanpembelian->namapaket_pp->Visible) { // namapaket_pp ?>
		<tr id="r_namapaket_pp">
			<td class="<?php echo $permintaanpembelian->TableLeftColumnClass ?>"><?php echo $permintaanpembelian->namapaket_pp->caption() ?></td>
			<td <?php echo $permintaanpembelian->namapaket_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_namapaket_pp">
<span<?php echo $permintaanpembelian->namapaket_pp->viewAttributes() ?>><?php echo $permintaanpembelian->namapaket_pp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($permintaanpembelian->tgl_pp->Visible) { // tgl_pp ?>
		<tr id="r_tgl_pp">
			<td class="<?php echo $permintaanpembelian->TableLeftColumnClass ?>"><?php echo $permintaanpembelian->tgl_pp->caption() ?></td>
			<td <?php echo $permintaanpembelian->tgl_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_pp">
<span<?php echo $permintaanpembelian->tgl_pp->viewAttributes() ?>><?php echo $permintaanpembelian->tgl_pp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($permintaanpembelian->tgl_kebutuhan->Visible) { // tgl_kebutuhan ?>
		<tr id="r_tgl_kebutuhan">
			<td class="<?php echo $permintaanpembelian->TableLeftColumnClass ?>"><?php echo $permintaanpembelian->tgl_kebutuhan->caption() ?></td>
			<td <?php echo $permintaanpembelian->tgl_kebutuhan->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_kebutuhan">
<span<?php echo $permintaanpembelian->tgl_kebutuhan->viewAttributes() ?>><?php echo $permintaanpembelian->tgl_kebutuhan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($permintaanpembelian->tgl_persetujuan->Visible) { // tgl_persetujuan ?>
		<tr id="r_tgl_persetujuan">
			<td class="<?php echo $permintaanpembelian->TableLeftColumnClass ?>"><?php echo $permintaanpembelian->tgl_persetujuan->caption() ?></td>
			<td <?php echo $permintaanpembelian->tgl_persetujuan->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_persetujuan">
<span<?php echo $permintaanpembelian->tgl_persetujuan->viewAttributes() ?>><?php echo $permintaanpembelian->tgl_persetujuan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($permintaanpembelian->staf_pengajuan->Visible) { // staf_pengajuan ?>
		<tr id="r_staf_pengajuan">
			<td class="<?php echo $permintaanpembelian->TableLeftColumnClass ?>"><?php echo $permintaanpembelian->staf_pengajuan->caption() ?></td>
			<td <?php echo $permintaanpembelian->staf_pengajuan->cellAttributes() ?>>
<span id="el_permintaanpembelian_staf_pengajuan">
<span<?php echo $permintaanpembelian->staf_pengajuan->viewAttributes() ?>><?php echo $permintaanpembelian->staf_pengajuan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($permintaanpembelian->staf_validasi->Visible) { // staf_validasi ?>
		<tr id="r_staf_validasi">
			<td class="<?php echo $permintaanpembelian->TableLeftColumnClass ?>"><?php echo $permintaanpembelian->staf_validasi->caption() ?></td>
			<td <?php echo $permintaanpembelian->staf_validasi->cellAttributes() ?>>
<span id="el_permintaanpembelian_staf_validasi">
<span<?php echo $permintaanpembelian->staf_validasi->viewAttributes() ?>><?php echo $permintaanpembelian->staf_validasi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>