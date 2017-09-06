<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){
	background-color: #f2f2f2
}

th {
    background-color: #4CAF50;
    color: white;
}
</style>

<?php
	// The start and end of nighttime hours
	$SETTINGS_nighttime_start = '22:00';
	$SETTINGS_nighttime_end   = '07:00';
	
	// Employees and their shifts
	$EMPLOYEES = array(
		
		'0' => array(
			'name'        => 'Bernice Lyons',
			'shift_start' => '15:15',
			'shift_end'   => '23:45'
		),
		
		'1' => array(
			'name'        => 'Gregg Santos',
			'shift_start' => '10:00',
			'shift_end'   => '22:00'
		),
		
		'2' => array(
			'name'        => 'Bennie Montgomery',
			'shift_start' => '22:30',
			'shift_end'   => '08:00'
		),
		
		'3' => array(
			'name'        => 'Nelson Austin',
			'shift_start' => '20:00',
			'shift_end'   => '10:00'
		),
		
		'4' => array(
			'name'        => 'Garrett Sims',
			'shift_start' => '09:00',
			'shift_end'   => '17:00'
		),
		
		'5' => array(
			'name'        => 'Joanna Pratt',
			'shift_start' => '23:00',
			'shift_end'   => '06:00'
		),
        
        '6' => array(
			'name'        => 'Bernice Lyons',
			'shift_start' => '15:15',
			'shift_end'   => '23:40'
		)		
	);

foreach($EMPLOYEES AS  $emp){        
    echo    '<table><tr><th>'.strtoupper('Name: '.$emp['name']).'</th></tr>
			<tr><td><ul><li>Shift Start:'.$emp['shift_start'].'</li>
            <li>Shift End:'.$emp['shift_end'].'</li>';
    echo    calc_hour('am', $emp['shift_start'], $emp['shift_end']);
    echo    calc_hour('pm', $emp['shift_start'], $emp['shift_end']);
    echo    '</ul></td></tr></table>';
 }
 
/**
 * @author Engr. Nayab Bukhari, Syed
 * @copyright 2017
 * @output: 
 * how much of the shift is daytime hours
 * how much of the shift is nighttime hours
 * The results should be displayed with a 15 minute (0.25h) precision, both “x.25” 
 * and “x:15” formats are allowed.
 * All times are in the 24 hour HH:MM format. Times are with 15 minute precision 
 * (for example, 15:00, 16:15, 17:30 are allowed values, whereas 18:02 and 19:41 are not).
 *  
 **/
  
function calc_hour($shift, $shiftStart, $shiftEnd){

    $shift_start=explode(":", $shiftStart);
    $shift_end=explode(":", $shiftEnd);
    
    if(($shift_start[1]% 15 != 0) && ($shift_start[1] != 00 )){
        $result  = '<li>Night Time Hours : Invalid shift start time </li>';
        $shift = 'error';
    }elseif(($shift_end[1]% 15 != 0) && ($shift_end[1] != 00 )){
        $result  = '<li>Night Time Hours : Invalid shift end time </li>';
        $shift = 'error';
    }
    
    switch($shift){
        case 'pm':
            if(($shift_start[0] > 12) && ($shift_end[0] < 12)){
                if($shift_start[1] == 00){
                    $night_hour = 24 - $shift_start[0];
                }else{
                    $night_hour = 23 - $shift_start[0];
                }
                $result  = '<li>Night Time Hours:'.$night_hour.':'. $shift_start[1] * 100 / 60 .'</li>';
                break;
            }
        
            if(($shift_start[0] > 12) && ($shift_end[0] > 12)){
                $night_time = $shift_start[0];
                if($shift_start[1] + $shift_end[1] == 60 ){
                    $shift_end[0]= $shift_end[0]+1;
                    $shift_end[1]= "00";
                }
            }else{
                $night_time = 12;
            }
            
            if($shift_end[0] > 12){
                $night_hour = abs($shift_end[0] - $night_time); 
                $result  = '<li>Night Time Hours:'.$night_hour.':'.$shift_end[1].'</li>';
                }else{
                    $result = '<li>Night Time Hours: NILL</li>';
                }
            break;
            
        case 'am':
            if($shift_end[0] - $shift_start[0] < 0){
                $shift_start[0]= "00";
                $shift_start[1] ="00";
            }
        
            if($shift_end[0] < 12){
                $day_time = $shift_end[0];
                if($shift_start[1] + $shift_end[1] * 100 / 60 == 100 ){
                    $shift_start[0]= $shift_start[0]+1;
                    $shift_start[1]= "00";
                }
            }else{
                $day_time = 12;
            }
            
            if($shift_start[0] < 12){
                $day_hour = abs($shift_start[0]-$day_time); 
                $result = '<li>Day Time Hours:'.$day_hour.':'.$shift_start[1].'</li>';
                }else{
                    $result = '<li>Day Time Hours: NILL</li>';
                }
            break;
        
        default:
            return $result;    
    }  
    
    return $result;
}

?>