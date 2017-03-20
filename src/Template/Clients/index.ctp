<?= $this->Form->create(null, ['url' => ['action' => 'luckydraw']]) ?>

<div style="margin: 98px 0 0 48px;">
<div class="stfk_title" style="margin-bottom:24px;"> Ready to pick a winner? </div>
<div class="stfk_body2" style="margin-bottom:14px;">Select the date and time of the beginning of the event:</div>
<div style="width:200px"><?= $this->Form->datetime('started', [
	'maxYear' => date('Y'), 
	'empty' => [
			'year' => 'Year',
			'month' => 'Month',
			'day' => 'Day',
			'hour' => 'Hour',
			'minute' => 'Minute'
		]
		
	
])?></div>
<button>Who's the winner?</button>
</div>

