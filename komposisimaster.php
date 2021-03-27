<?php
namespace PHPMaker2020\klinik_latest_26_03_21;
?>
<?php if ($komposisi->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_komposisimaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($komposisi->id_komposisi->Visible) { // id_komposisi ?>
		<tr id="r_id_komposisi">
			<td class="<?php echo $komposisi->TableLeftColumnClass ?>"><?php echo $komposisi->id_komposisi->caption() ?></td>
			<td <?php echo $komposisi->id_komposisi->cellAttributes() ?>>
<span id="el_komposisi_id_komposisi">
<span<?php echo $komposisi->id_komposisi->viewAttributes() ?>><?php echo $komposisi->id_komposisi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($komposisi->id_barang->Visible) { // id_barang ?>
		<tr id="r_id_barang">
			<td class="<?php echo $komposisi->TableLeftColumnClass ?>"><?php echo $komposisi->id_barang->caption() ?></td>
			<td <?php echo $komposisi->id_barang->cellAttributes() ?>>
<span id="el_komposisi_id_barang">
<span<?php echo $komposisi->id_barang->viewAttributes() ?>><?php echo $komposisi->id_barang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>