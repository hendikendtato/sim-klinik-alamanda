<?php
namespace PHPMaker2020\klinik_latest_26_03_21;
?>
<?php if ($jurnal->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jurnalmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($jurnal->id_jurnal->Visible) { // id_jurnal ?>
		<tr id="r_id_jurnal">
			<td class="<?php echo $jurnal->TableLeftColumnClass ?>"><?php echo $jurnal->id_jurnal->caption() ?></td>
			<td <?php echo $jurnal->id_jurnal->cellAttributes() ?>>
<span id="el_jurnal_id_jurnal">
<span<?php echo $jurnal->id_jurnal->viewAttributes() ?>><?php echo $jurnal->id_jurnal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jurnal->tgl_jurnal->Visible) { // tgl_jurnal ?>
		<tr id="r_tgl_jurnal">
			<td class="<?php echo $jurnal->TableLeftColumnClass ?>"><?php echo $jurnal->tgl_jurnal->caption() ?></td>
			<td <?php echo $jurnal->tgl_jurnal->cellAttributes() ?>>
<span id="el_jurnal_tgl_jurnal">
<span<?php echo $jurnal->tgl_jurnal->viewAttributes() ?>><?php echo $jurnal->tgl_jurnal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jurnal->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $jurnal->TableLeftColumnClass ?>"><?php echo $jurnal->keterangan->caption() ?></td>
			<td <?php echo $jurnal->keterangan->cellAttributes() ?>>
<span id="el_jurnal_keterangan">
<span<?php echo $jurnal->keterangan->viewAttributes() ?>><?php echo $jurnal->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>