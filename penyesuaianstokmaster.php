<?php
namespace PHPMaker2020\sim_klinik_alamanda;
?>
<?php if ($penyesuaianstok->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_penyesuaianstokmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($penyesuaianstok->kode_penyesuaian->Visible) { // kode_penyesuaian ?>
		<tr id="r_kode_penyesuaian">
			<td class="<?php echo $penyesuaianstok->TableLeftColumnClass ?>"><?php echo $penyesuaianstok->kode_penyesuaian->caption() ?></td>
			<td <?php echo $penyesuaianstok->kode_penyesuaian->cellAttributes() ?>>
<span id="el_penyesuaianstok_kode_penyesuaian">
<span<?php echo $penyesuaianstok->kode_penyesuaian->viewAttributes() ?>><?php echo $penyesuaianstok->kode_penyesuaian->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penyesuaianstok->tanggal->Visible) { // tanggal ?>
		<tr id="r_tanggal">
			<td class="<?php echo $penyesuaianstok->TableLeftColumnClass ?>"><?php echo $penyesuaianstok->tanggal->caption() ?></td>
			<td <?php echo $penyesuaianstok->tanggal->cellAttributes() ?>>
<span id="el_penyesuaianstok_tanggal">
<span<?php echo $penyesuaianstok->tanggal->viewAttributes() ?>><?php echo $penyesuaianstok->tanggal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penyesuaianstok->id_klinik->Visible) { // id_klinik ?>
		<tr id="r_id_klinik">
			<td class="<?php echo $penyesuaianstok->TableLeftColumnClass ?>"><?php echo $penyesuaianstok->id_klinik->caption() ?></td>
			<td <?php echo $penyesuaianstok->id_klinik->cellAttributes() ?>>
<span id="el_penyesuaianstok_id_klinik">
<span<?php echo $penyesuaianstok->id_klinik->viewAttributes() ?>><?php echo $penyesuaianstok->id_klinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penyesuaianstok->lampiran->Visible) { // lampiran ?>
		<tr id="r_lampiran">
			<td class="<?php echo $penyesuaianstok->TableLeftColumnClass ?>"><?php echo $penyesuaianstok->lampiran->caption() ?></td>
			<td <?php echo $penyesuaianstok->lampiran->cellAttributes() ?>>
<span id="el_penyesuaianstok_lampiran">
<span<?php echo $penyesuaianstok->lampiran->viewAttributes() ?>><?php echo GetFileViewTag($penyesuaianstok->lampiran, $penyesuaianstok->lampiran->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penyesuaianstok->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $penyesuaianstok->TableLeftColumnClass ?>"><?php echo $penyesuaianstok->keterangan->caption() ?></td>
			<td <?php echo $penyesuaianstok->keterangan->cellAttributes() ?>>
<span id="el_penyesuaianstok_keterangan">
<span<?php echo $penyesuaianstok->keterangan->viewAttributes() ?>><?php echo $penyesuaianstok->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>