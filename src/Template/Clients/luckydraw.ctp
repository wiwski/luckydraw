<div>
<span class="stfk_title">And the winners are...</span>
<?php foreach($winners as $key => $winner): ?>
<div>
	<span class="stfk_heading">Category: <?=$key?></span>
	<table>
<?php foreach($winner as $name => $value): ?>
<tr>
	<td><?=$name?></td>
	<td><?=$value?></td>
</tr>
<?php endforeach; ?>
	</table>
		</div>
<?php endforeach; ?>
</div>
