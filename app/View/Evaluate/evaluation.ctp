<div class="row">
	<div class="container">
		<div class="row container first-Div">
		</div>
		
		<div>
			<table class="table table-striped">
				<thead>
					<tr>
						<td><?php echo __('Core Competencies'); ?></td>
						<td><?php echo __('CSR Expected'); ?></td>
						<td><?php echo __('Your Expected'); ?></td>
						<td><?php echo __('Notes/Comments'); ?></td>
					</tr>
				</thead>
				<tbody>
					<?php for ( $i=0; $i<count($dd); $i++) { ?>
					<tr>
						<td><?php echo $dd[$i]['DataDictionary']['dd_desc_th']; ?></td>
						<td><?php echo $dd[$i]['DataDictionary']['exp_value']; ?></td>
						<td>
							<select class="form-group">
								<?php for ($j=0.5; $j<=5; $j+=0.5) { ?>
								<option value="<?php echo $j; ?>"><?php echo number_format($j, 1, '.', ','); ?></option>
								<?php } ?>
							</select>
						</td>
						<td><input type="text" /></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>