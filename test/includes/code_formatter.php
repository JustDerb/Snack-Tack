<?php
function printCode($source_code, $print = false)
{

    if (is_array($source_code))
        $source_code = print_r($source_code,true);
  
    $source_code = explode("\n", str_replace(array("\r\n", "\r"), "\n", $source_code));
    $line_count = 1;

    foreach ($source_code as $code_line)
    {
        $formatted_code .= '<tr><td style="background:#EEEEEE;color:#666666">'.$line_count.'</td>';
        $line_count++;
      
        if (@ereg('<\?(php)?[^[:graph:]]', $code_line))
            $formatted_code .= '<td>'. str_replace(array('<code>', '</code>'), '', highlight_string($code_line, true)).'</td></tr>';
        else
            $formatted_code .= '<td>'.@ereg_replace('(&lt;\?php&nbsp;)+', '', str_replace(array('<code>', '</code>'), '', highlight_string('<?php '.$code_line, true))).'</td></tr>';
    }

	$formatted_code = '<table style="font: 1em Consolas, \'andale mono\', \'monotype.com\', \'lucida console\', monospace;background:#FFFFFF;line-height:1em;padding:0;margin:0;width:100%">'.$formatted_code.'</table>';
	if ($print)
		print($formatted_code);
	else
    	return $formatted_code;
}
?>