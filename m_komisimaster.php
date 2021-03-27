<?php
namespace PHPMaker2020\klinik_latest_26_03_21;
?>
<?php if ($m_komisi->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_m_komisimaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($m_komisi->id_komisi->Visible) { // id_komisi ?>
		<tr id="r_id_komisi">
			<td class="<?php echo $m_komisi->TableLeftColumnClass ?>"><?php echo $m_komisi->id_komisi->caption() ?></td>
			<td <?php echo $m_komisi->id_komisi->cellAttributes() ?>>
<span id="el_m_komisi_id_komisi">
<span<?php echo $m_komisi->id_komisi->viewAttributes() ?>><?php echo $m_komisi->id_komisi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($m_komisi->id_jabatan->Visible) { // id_jabatan ?>
		<tr id="r_id_jabatan">
			<td class="<?php echo $m_komisi->TableLeftColumnClass ?>"><?php echo $m_komisi->id_jabatan->caption() ?></td>
			<td <?php echo $m_komisi->id_jabatan->cellAttributes() ?>>
<span id="el_m_komisi_id_jabatan">
<span<?php echo $m_komisi->id_jabatan->viewAttributes() ?>><?php echo $m_komisi->id_jabatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>