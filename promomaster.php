<?php
namespace PHPMaker2020\sim_klinik_alamanda;
?>
<?php if ($promo->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_promomaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($promo->id_promo->Visible) { // id_promo ?>
		<tr id="r_id_promo">
			<td class="<?php echo $promo->TableLeftColumnClass ?>"><?php echo $promo->id_promo->caption() ?></td>
			<td <?php echo $promo->id_promo->cellAttributes() ?>>
<span id="el_promo_id_promo">
<span<?php echo $promo->id_promo->viewAttributes() ?>><?php echo $promo->id_promo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($promo->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td class="<?php echo $promo->TableLeftColumnClass ?>"><?php echo $promo->nama->caption() ?></td>
			<td <?php echo $promo->nama->cellAttributes() ?>>
<span id="el_promo_nama">
<span<?php echo $promo->nama->viewAttributes() ?>><?php echo $promo->nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($promo->tanggal_mulai->Visible) { // tanggal_mulai ?>
		<tr id="r_tanggal_mulai">
			<td class="<?php echo $promo->TableLeftColumnClass ?>"><?php echo $promo->tanggal_mulai->caption() ?></td>
			<td <?php echo $promo->tanggal_mulai->cellAttributes() ?>>
<span id="el_promo_tanggal_mulai">
<span<?php echo $promo->tanggal_mulai->viewAttributes() ?>><?php echo $promo->tanggal_mulai->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($promo->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
		<tr id="r_tanggal_berakhir">
			<td class="<?php echo $promo->TableLeftColumnClass ?>"><?php echo $promo->tanggal_berakhir->caption() ?></td>
			<td <?php echo $promo->tanggal_berakhir->cellAttributes() ?>>
<span id="el_promo_tanggal_berakhir">
<span<?php echo $promo->tanggal_berakhir->viewAttributes() ?>><?php echo $promo->tanggal_berakhir->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>