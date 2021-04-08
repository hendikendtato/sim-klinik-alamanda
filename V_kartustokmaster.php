<?php
namespace PHPMaker2020\klinik_latest_08_04_21;
?>
<?php if ($V_kartustok->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_V_kartustokmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($V_kartustok->nama_barang->Visible) { // nama_barang ?>
		<tr id="r_nama_barang">
			<td class="<?php echo $V_kartustok->TableLeftColumnClass ?>"><?php echo $V_kartustok->nama_barang->caption() ?></td>
			<td <?php echo $V_kartustok->nama_barang->cellAttributes() ?>>
<span id="el_V_kartustok_nama_barang">
<span<?php echo $V_kartustok->nama_barang->viewAttributes() ?>><?php echo $V_kartustok->nama_barang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>