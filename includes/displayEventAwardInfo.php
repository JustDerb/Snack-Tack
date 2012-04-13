<?php

function printEventAwardInfo($typeIcon, $typeName, $eventName, $eventDescription, $eventDate, $url = "", $short = false)
{
	if ($short)
	{
		print('<li><div>');
		if ($url != "")
		{
			print('<a href="' . $url . '">');
		}
		print('
				<table>
					<tr>
						<td rowspan="4" valign="top" width="50"><img src="' . $typeIcon . '" alt="' . $typeName . '" /></td>
					</tr>
					<tr>
						<td><p class="nameShort">' . $eventName . '</p></td>
					</tr>
					<tr>
						<td><p class="timeNormal">@ ' . $eventDate->format("h:ia") . '</p></td>
					</tr>
					<tr>
						<td><p class="descriptionShort">' . $eventDescription . '</p></td>
					</tr>
				</table>
			</a></div></li>
		');
	}
	else
	{
		print('<li><div>');
		if ($url != "")
		{
			print('<a href="' . $url . '">');
		}
		print('
				<table>
					<tr>
						<td rowspan="4" valign="top" width="50"><img src="' . $typeIcon . '" alt="' . $typeName . '" /></td>
					</tr>
					<tr>
						<td><p class="nameNormal">' . $eventName . '</p></td>
					</tr>
					<tr>
						<td><p class="descriptionNormal">' . $eventDescription . '</p></td>
					</tr>
					<tr>');
		if (is_object($eventDate))
		{
			print('<td><p class="timeSmall">Received (' . $eventDate->format("m/d/y") . ')</p></td>');
		}
		else
		{
			print('<td><p class="timeSmall">' . $eventDate . '</p></td>');
		}
		print('
					</tr>
				</table>
			</div></li>
		');
	}
}
?>
