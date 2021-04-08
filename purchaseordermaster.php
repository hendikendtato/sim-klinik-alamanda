<?php
namespace PHPMaker2020\klinik_latest_08_04_21;
?>
<?php if ($purchaseorder->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_purchaseordermaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($purchaseorder->no_po->Visible) { // no_po ?>
		<tr id="r_no_po">
			<td class="<?php echo $purchaseorder->TableLeftColumnClass ?>"><?php echo $purchaseorder->no_po->caption() ?></td>
			<td <?php echo $purchaseorder->no_po->cellAttributes() ?>>
<span id="el_purchaseorder_no_po">
<span<?php echo $purchaseorder->no_po->viewAttributes() ?>><?php echo $purchaseorder->no_po->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($purchaseorder->tgl_po->Visible) { // tgl_po ?>
		<tr id="r_tgl_po">
			<td class="<?php echo $purchaseorder->TableLeftColumnClass ?>"><?php echo $purchaseorder->tgl_po->caption() ?></td>
			<td <?php echo $purchaseorder->tgl_po->cellAttributes() ?>>
<span id="el_purchaseorder_tgl_po">
<span<?php echo $purchaseorder->tgl_po->viewAttributes() ?>><?php echo $purchaseorder->tgl_po->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($purchaseorder->idklinik->Visible) { // idklinik ?>
		<tr id="r_idklinik">
			<td class="<?php echo $purchaseorder->TableLeftColumnClass ?>"><?php echo $purchaseorder->idklinik->caption() ?></td>
			<td <?php echo $purchaseorder->idklinik->cellAttributes() ?>>
<span id="el_purchaseorder_idklinik">
<span<?php echo $purchaseorder->idklinik->viewAttributes() ?>><?php echo $purchaseorder->idklinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($purchaseorder->id_supplier->Visible) { // id_supplier ?>
		<tr id="r_id_supplier">
			<td class="<?php echo $purchaseorder->TableLeftColumnClass ?>"><?php echo $purchaseorder->id_supplier->caption() ?></td>
			<td <?php echo $purchaseorder->id_supplier->cellAttributes() ?>>
<span id="el_purchaseorder_id_supplier">
<span<?php echo $purchaseorder->id_supplier->viewAttributes() ?>><?php echo $purchaseorder->id_supplier->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($purchaseorder->status_po->Visible) { // status_po ?>
		<tr id="r_status_po">
			<td class="<?php echo $purchaseorder->TableLeftColumnClass ?>"><?php echo $purchaseorder->status_po->caption() ?></td>
			<td <?php echo $purchaseorder->status_po->cellAttributes() ?>>
<span id="el_purchaseorder_status_po">
<span<?php echo $purchaseorder->status_po->viewAttributes() ?>><?php echo $purchaseorder->status_po->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($purchaseorder->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $purchaseorder->TableLeftColumnClass ?>"><?php echo $purchaseorder->keterangan->caption() ?></td>
			<td <?php echo $purchaseorder->keterangan->cellAttributes() ?>>
<span id="el_purchaseorder_keterangan">
<span<?php echo $purchaseorder->keterangan->viewAttributes() ?>><?php echo $purchaseorder->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>