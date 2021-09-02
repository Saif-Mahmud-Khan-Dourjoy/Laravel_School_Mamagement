<?php 

if(!function_exists('grade_calculation')){
	function grade_calculation($number, $return = 'grade'){
		if ($number >= 80)
		{
			return return_grade(5.00,'A+', $return);
		}
		elseif($number >= 70)
		{
			return return_grade(4.00,'A', $return);
		}
		elseif($number >= 60)
		{
			return return_grade(3.50,'A-', $return);
		}
		elseif($number >= 50)
		{
			return return_grade(3.00,'B', $return);
		}
		elseif($number >= 40)
		{
			return return_grade(2.00,'C', $return);
		}
		elseif($number >= 33)
		{
			return return_grade(1.00,'D', $return);
		}
		elseif($number < 33)
		{
			return return_grade(0.00,'F', $return);
		}
		
	}
}


if(!function_exists('cgpa_calculation')){
	function cgpa_calculation($point){
		if ($point >= 5)
		{
			return "A+";
		}
		elseif($point >= 4)
		{
			return "A";
		}
		elseif($point >= 3.50)
		{
			return 'A-';
		}
		elseif($point >= 3.00)
		{
			return 'B';
		}
		elseif($point >= 2)
		{
			return 'C';
		}
		elseif($point >= 1)
		{
			return 'D';
		}
		
		else
		{
			return 'F';
		}
	}
}

if(!function_exists('return_grade')){
	function return_grade($point,$grade, $type = 'letter'){
		if($type === 'point')
		{
			return $point;
		} 
		else{
			return $grade;
		}
	}
}

if(!function_exists('convert_marks')){
	function convert_marks($number, $divider, $multiple, $round = 1){
		if($divider > 0){
			if($round)
				return round(($number/$divider)*$multiple);
			else
				return ($number/$divider)*$multiple;
		}
		else{
			return 0.0;
		}
	}
}

if(!function_exists('look')){
	function look($array, $print_r = 1, $exit = 1){
		echo "<pre>";
		echo PHP_EOL."=========================".PHP_EOL;
		if($print_r == 1) print_r($array); else var_dump($array);
		echo PHP_EOL."=========================".PHP_EOL;
		echo "</pre>";

		if($exit)
			exit();
	}
}

if(!function_exists('hasAccess')){
	function hasAccess($permissions){
		// if(env('ROLE_ENABLE',0) == 1)
		// 	return (Auth::check() && Auth::user()->hasPermission($permissions)); 
		// else
		// 	return TRUE;
		return (Auth::check() && Auth::user()->hasPermission($permissions));
	}
}

?>