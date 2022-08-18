<?php include('pdf_style.php'); ?>
<div class="lead_container">
	
	
	<div class="head align-center col-md-12" style="font-size:18px;color:#059649">
		<?php echo $title; ?>
	</div>
	<hr>
	<br>
	
	 <table id="lead_list" class="table table-border"  cellpadding = "5">
			<thead>
				<tr>
				<?php if(isset($row_header)&& !empty($row_header)){ ?>
					<?php foreach ($row_header as $key => $val){ ?>
						<th class="thead" align="<?php if(!empty($val['align'])) echo $val['align']; ?>" width="<?php if(!empty($val['width'])) echo $val['width']; ?>"><?php if(!empty($val['name'])) echo $val['name']; ?></th>
					<?php } ?>
				<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($row_data)&& !empty($row_data)){ ?>
				<?php foreach ($row_data as $key => $val){ ?>			
				<tr>
					<?php $i = 0; foreach ($val as $v){ ?>
						<td align="<?php echo $row_header[$i]['align']; ?>" width="<?php echo $row_header[$i]['width']; ?>"><?php echo $v; ?></td>
					<?php $i++; } ?>
				</tr>	
					<?php   } ?>
				<?php } ?>	
			</tbody>	
		</table>
	</div>	
</body></html>
