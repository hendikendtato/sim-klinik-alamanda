<?php
namespace PHPMaker2020\klinik_latest_09_04_21;
?>
<?php if ($mutasi_kas->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_mutasi_kasmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($mutasi_kas->no_bukti->Visible) { // no_bukti ?>
		<tr id="r_no_bukti">
			<td class="<?php echo $mutasi_kas->TableLeftColumnClass ?>"><?php echo $mutasi_kas->no_bukti->caption() ?></td>
			<td <?php echo $mutasi_kas->no_bukti->cellAttributes() ?>>
<span id="el_mutasi_kas_no_bukti">
<span<?php echo $mutasi_kas->no_bukti->viewAttributes() ?>><?php echo $mutasi_kas->no_bukti->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($mutasi_kas->tgl->Visible) { // tgl ?>
		<tr id="r_tgl">
			<td class="<?php echo $mutasi_kas->TableLeftColumnClass ?>"><?php echo $mutasi_kas->tgl->caption() ?></td>
			<td <?php echo $mutasi_kas->tgl->cellAttributes() ?>>
<span id="el_mutasi_kas_tgl">
<span<?php echo $mutasi_kas->tgl->viewAttributes() ?>><?php echo $mutasi_kas->tgl->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($mutasi_kas->id_klinik->Visible) { // id_klinik ?>
		<tr id="r_id_klinik">
			<td class="<?php echo $mutasi_kas->TableLeftColumnClass ?>"><?php echo $mutasi_kas->id_klinik->caption() ?></td>
			<td <?php echo $mutasi_kas->id_klinik->cellAttributes() ?>>
<span id="el_mutasi_kas_id_klinik">
<span<?php echo $mutasi_kas->id_klinik->viewAttributes() ?>><?php echo $mutasi_kas->id_klinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($mutasi_kas->id_kas->Visible) { // id_kas ?>
		<tr id="r_id_kas">
			<td class="<?php echo $mutasi_kas->TableLeftColumnClass ?>"><?php echo $mutasi_kas->id_kas->caption() ?></td>
			<td <?php echo $mutasi_kas->id_kas->cellAttributes() ?>>
<span id="el_mutasi_kas_id_kas">
<span<?php echo $mutasi_kas->id_kas->viewAttributes() ?>><?php echo $mutasi_kas->id_kas->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($mutasi_kas->tipe->Visible) { // tipe ?>
		<tr id="r_tipe">
			<td class="<?php echo $mutasi_kas->TableLeftColumnClass ?>"><?php echo $mutasi_kas->tipe->caption() ?></td>
			<td <?php echo $mutasi_kas->tipe->cellAttributes() ?>>
<span id="el_mutasi_kas_tipe">
<span<?php echo $mutasi_kas->tipe->viewAttributes() ?>><?php echo $mutasi_kas->tipe->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($mutasi_kas->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $mutasi_kas->TableLeftColumnClass ?>"><?php echo $mutasi_kas->keterangan->caption() ?></td>
			<td <?php echo $mutasi_kas->keterangan->cellAttributes() ?>>
<span id="el_mutasi_kas_keterangan">
<span<?php echo $mutasi_kas->keterangan->viewAttributes() ?>><?php echo $mutasi_kas->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>