<?php
namespace PHPMaker2020\klinik_latest_26_03_21;
?>
<?php if ($perpindahanbarang->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_perpindahanbarangmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($perpindahanbarang->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<tr id="r_id_perpindahanbarang">
			<td class="<?php echo $perpindahanbarang->TableLeftColumnClass ?>"><?php echo $perpindahanbarang->id_perpindahanbarang->caption() ?></td>
			<td <?php echo $perpindahanbarang->id_perpindahanbarang->cellAttributes() ?>>
<span id="el_perpindahanbarang_id_perpindahanbarang">
<span<?php echo $perpindahanbarang->id_perpindahanbarang->viewAttributes() ?>><?php echo $perpindahanbarang->id_perpindahanbarang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($perpindahanbarang->tanggal->Visible) { // tanggal ?>
		<tr id="r_tanggal">
			<td class="<?php echo $perpindahanbarang->TableLeftColumnClass ?>"><?php echo $perpindahanbarang->tanggal->caption() ?></td>
			<td <?php echo $perpindahanbarang->tanggal->cellAttributes() ?>>
<span id="el_perpindahanbarang_tanggal">
<span<?php echo $perpindahanbarang->tanggal->viewAttributes() ?>><?php echo $perpindahanbarang->tanggal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($perpindahanbarang->asal->Visible) { // asal ?>
		<tr id="r_asal">
			<td class="<?php echo $perpindahanbarang->TableLeftColumnClass ?>"><?php echo $perpindahanbarang->asal->caption() ?></td>
			<td <?php echo $perpindahanbarang->asal->cellAttributes() ?>>
<span id="el_perpindahanbarang_asal">
<span<?php echo $perpindahanbarang->asal->viewAttributes() ?>><?php echo $perpindahanbarang->asal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($perpindahanbarang->tujuan->Visible) { // tujuan ?>
		<tr id="r_tujuan">
			<td class="<?php echo $perpindahanbarang->TableLeftColumnClass ?>"><?php echo $perpindahanbarang->tujuan->caption() ?></td>
			<td <?php echo $perpindahanbarang->tujuan->cellAttributes() ?>>
<span id="el_perpindahanbarang_tujuan">
<span<?php echo $perpindahanbarang->tujuan->viewAttributes() ?>><?php echo $perpindahanbarang->tujuan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>