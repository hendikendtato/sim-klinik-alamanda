<?php
namespace PHPMaker2020\klinik_latest_26_03_21;
?>
<?php if ($rekmeddokter->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_rekmeddoktermaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($rekmeddokter->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
		<tr id="r_kode_rekmeddok">
			<td class="<?php echo $rekmeddokter->TableLeftColumnClass ?>"><?php echo $rekmeddokter->kode_rekmeddok->caption() ?></td>
			<td <?php echo $rekmeddokter->kode_rekmeddok->cellAttributes() ?>>
<span id="el_rekmeddokter_kode_rekmeddok">
<span<?php echo $rekmeddokter->kode_rekmeddok->viewAttributes() ?>><?php echo $rekmeddokter->kode_rekmeddok->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rekmeddokter->tanggal->Visible) { // tanggal ?>
		<tr id="r_tanggal">
			<td class="<?php echo $rekmeddokter->TableLeftColumnClass ?>"><?php echo $rekmeddokter->tanggal->caption() ?></td>
			<td <?php echo $rekmeddokter->tanggal->cellAttributes() ?>>
<span id="el_rekmeddokter_tanggal">
<span<?php echo $rekmeddokter->tanggal->viewAttributes() ?>><?php echo $rekmeddokter->tanggal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rekmeddokter->id_pelanggan->Visible) { // id_pelanggan ?>
		<tr id="r_id_pelanggan">
			<td class="<?php echo $rekmeddokter->TableLeftColumnClass ?>"><?php echo $rekmeddokter->id_pelanggan->caption() ?></td>
			<td <?php echo $rekmeddokter->id_pelanggan->cellAttributes() ?>>
<span id="el_rekmeddokter_id_pelanggan">
<span<?php echo $rekmeddokter->id_pelanggan->viewAttributes() ?>><?php echo $rekmeddokter->id_pelanggan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rekmeddokter->id_dokter->Visible) { // id_dokter ?>
		<tr id="r_id_dokter">
			<td class="<?php echo $rekmeddokter->TableLeftColumnClass ?>"><?php echo $rekmeddokter->id_dokter->caption() ?></td>
			<td <?php echo $rekmeddokter->id_dokter->cellAttributes() ?>>
<span id="el_rekmeddokter_id_dokter">
<span<?php echo $rekmeddokter->id_dokter->viewAttributes() ?>><?php echo $rekmeddokter->id_dokter->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rekmeddokter->id_be->Visible) { // id_be ?>
		<tr id="r_id_be">
			<td class="<?php echo $rekmeddokter->TableLeftColumnClass ?>"><?php echo $rekmeddokter->id_be->caption() ?></td>
			<td <?php echo $rekmeddokter->id_be->cellAttributes() ?>>
<span id="el_rekmeddokter_id_be">
<span<?php echo $rekmeddokter->id_be->viewAttributes() ?>><?php echo $rekmeddokter->id_be->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>