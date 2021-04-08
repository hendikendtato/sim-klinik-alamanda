<?php
namespace PHPMaker2020\klinik_latest_08_04_21;
?>
<?php if ($nonjual->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_nonjualmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($nonjual->id_klinik->Visible) { // id_klinik ?>
		<tr id="r_id_klinik">
			<td class="<?php echo $nonjual->TableLeftColumnClass ?>"><?php echo $nonjual->id_klinik->caption() ?></td>
			<td <?php echo $nonjual->id_klinik->cellAttributes() ?>>
<span id="el_nonjual_id_klinik">
<span<?php echo $nonjual->id_klinik->viewAttributes() ?>><?php echo $nonjual->id_klinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($nonjual->tanggal->Visible) { // tanggal ?>
		<tr id="r_tanggal">
			<td class="<?php echo $nonjual->TableLeftColumnClass ?>"><?php echo $nonjual->tanggal->caption() ?></td>
			<td <?php echo $nonjual->tanggal->cellAttributes() ?>>
<span id="el_nonjual_tanggal">
<span<?php echo $nonjual->tanggal->viewAttributes() ?>><?php echo $nonjual->tanggal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($nonjual->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $nonjual->TableLeftColumnClass ?>"><?php echo $nonjual->keterangan->caption() ?></td>
			<td <?php echo $nonjual->keterangan->cellAttributes() ?>>
<span id="el_nonjual_keterangan">
<span<?php echo $nonjual->keterangan->viewAttributes() ?>><?php echo $nonjual->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>