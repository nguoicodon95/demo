<?php
	function nameRand() {
		$s = strtoupper(md5(uniqid(rand(),true)));
		$guidText =
			substr($s,0,8) . '-' .
			substr($s,8,4) . '-' .
			substr($s,12,4). '-' .
			substr($s,16,4). '-' .
			substr($s,20);
		return $guidText;
	}

	
	if (! function_exists('_formatPrice')) {
	    function _formatPrice($price)
	    {
	        $price = number_format($price, 0, ',', '.');
            return $price . ' đ';
	    }
	}

	
	if (! function_exists('_setName')) {
	    function _setName($state, $city, $country)
	    {
			$name = '';
	        if($state != '') :
				$name .= $state .', ';
			else :
				$name .= '';
			endif;

			if($city != '') :
				$name .= $city .', ';
			else :
				$name .= '';
			endif;

			if($country != '') :
				$name .= $country;
			else :
				$name .= '';
			endif;

			return $name;
	    }
	}

	
	if (! function_exists('_menuHtml')) {
	    function _menuHtml($name, $type)
	    {
	        return \App\Models\Menu::display($name, $type);
	    }
	}

	
?>