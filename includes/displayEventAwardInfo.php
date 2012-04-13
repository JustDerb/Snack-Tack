<?php

function printEventAwardInfo($typeIcon, $typeName, $eventName, $eventDescription, $eventDate, $url = "", $short = false, $multipleTypes = false)
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
						<td height="50" rowspan="4" valign="top" width="50">
							<div class="imgContainer">
								<img class="type" src="' . $typeIcon . '" alt="' . $typeName . '" />');
		// Check if there are more than one food types
		if ($multipleTypes)
		{
			print('<span class="more"><img src="img/types/icons/plus.png" alt="+" /></span>');
		}

		/* Check for ratings (true = valid, false = invalid)
		if ($rating)
		{
			print('<span class="check"><img src="img/types/icons/check.png" alt="C" /></span>');
		}
		else
		{
			print('<span class="poop"><img src="img/types/icons/poop.png" alt="P" /></span>');
		}*/
		
		print('				</div>
							<div id="clear"></div>
						</td>
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
		// If it is a DateTime object, we need to format it
		if (is_object($eventDate))
		{
			print('<td><p class="timeSmall">Received (' . $eventDate->format("m/d/y") . ')</p></td>');
		}
		// Otherwise it's just a string, so print it
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
