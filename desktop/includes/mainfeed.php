<table class="table table-hover" style="margin-bottom:0">
	<thead>
		<tr>
			<th colspan="3">Upcoming Events</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$event = <<<EOT
		<tr>
			<td><img src="../img/types/box.png" alt="Event Icon"></td>
			<td>
			<span class="event-title">Bacon Charity</span> <span class="event-location muted">(Ag Building)</span>
			<div class="event-description">Bacon ipsum dolor sit amet tail ex reprehenderit shank enim cillum velit. Et aliquip short ribs, prosciutto labore excepteur corned beef ad sunt veniam. Est pork chop ad veniam excepteur. Aliquip ut aute, ball tip brisket et fugiat...</div>
			<div class="expand muted"><a href="#">Expand...</a></div>
			</td>
			<td class="muted">
			<time></time>
			<div class="event-time pull-right">Thu Sep 4th</div>
			<div class="event-time pull-right">@ 4:00pm-7:00pm</div>
			</td>
		</tr>
EOT;
		for ($i=0; $i<4; $i++)
			echo $event;
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3"><button class="btn btn-large btn-block" type="button">Load More Events</button></td>
		</tr>
	</tfoot>
</table>

