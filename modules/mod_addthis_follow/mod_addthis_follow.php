<?php
/*
 * +--------------------------------------------------------------------------+
 * | Copyright (c) 2010 Add This, LLC                                         |
 * +--------------------------------------------------------------------------+
 * | This program is free software; you can redistribute it and/or modify     |
 * | it under the terms of the GNU General Public License as published by     |
 * | the Free Software Foundation; either version 3 of the License, or        |
 * | (at your option) any later version.                                      |
 * |                                                                          |
 * | This program is distributed in the hope that it will be useful,          |
 * | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
 * | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            |
 * | GNU General Public License for more details.                             |
 * |                                                                          |
 * | You should have received a copy of the GNU General Public License        |
 * | along with this program.  If not, see <http://www.gnu.org/licenses/>.    |
 * +--------------------------------------------------------------------------+
 */

	/**
	 *
	 * Creates AddThis Follow Tool and appends it to the user selected pages.
	 * Reads the user settings and creates the button accordingly.
	 *
	 * @author AddThis Team - Sol, Vipin
	 * @version 1.0.0
	 */

    // no direct access
	defined('_JEXEC') or die('Restricted access');
	
	appendAddThisJsFollow($params);
	
    //Adds AddThis Follow to page	
    appendAddThisFollowTool($params);

	/**
	 * appendAddThisFollowTool
	 *
	 * Reads settings page, creates AddThis Follow Tool,
	 *
	 * @param object $params
	 * @return void
	 *
	 */
	function appendAddThisFollowTool($params)
	{

    	//Creating div elements for AddThis
		$followScript = "<div class='joomla_addthis_follow'>" . PHP_EOL;
		$followScript .= "<!-- AddThis Follow BEGIN -->" . PHP_EOL;
		
		$btn_style = getFollowBtnStyle($params);
		
		if($params->get("atf_header"))
			$followScript.= "<p>".$params->get("atf_header")."</p>" . PHP_EOL;
		
		$followScript .= '<div class="addthis_toolbox'.$btn_style.'">' . PHP_EOL;
		
		$buttonSet = generateButtonSet($params);
		
		$followScript .= $buttonSet;
				
		$followScript .= '</div>'. PHP_EOL;

		$followScript .= "<!-- AddThis Follow END -->". PHP_EOL;
		$followScript .= "</div>". PHP_EOL;
		
		//Creates addthis configuration script
	    $followScript .= "<script type='text/javascript'>". PHP_EOL;
	    $followScript .= "var addthis_product = 'jfp-1.0';". PHP_EOL;
	    $followScript .= "</script>". PHP_EOL;

		echo $followScript;
	}

	/**
     * Generate Follow Button Set
     *
     * Return Follow button set.
     *
     * @return string returns the button html
     */
    function generateButtonSet($params)
    {
        $arrServices = array("facebook", "twitter", "linkedin", "linkedin_comp", "google", "youtube", "flickr", "vimeo", "pinterest", "instagram", "foursquare", "tumblr", "rss");
		
        $button_set = "";
        foreach ($arrServices as $key => $value) {
        	if($params->get("atf_".$value)){
				if($value == "linkedin_comp")
					$button_set .= '<a class="addthis_button_linkedin_follow" addthis:userid="'.$params->get("atf_".$value).'" addthis:usertype="company"></a>' . PHP_EOL;
				else
					$button_set .= '<a class="addthis_button_'.$value.'_follow" addthis:userid="'.$params->get("atf_".$value).'"></a>' . PHP_EOL;
			}	
		}
		
		return $button_set;
    }

    /**
     * Generate Follow Button Set
     *
     * Return Follow button set.
     *
     * @return string returns the style
     */
    function getFollowBtnStyle($params)
    {
    	switch($params->get("atf_design")){
    		case 'horizontal_large':
    			$design = " addthis_32x32_style addthis_default_style ";
    			break;
    		case 'horizontal_small':
    			$design = " addthis_default_style ";
    			break;
    		case 'vertical_large':
    			$design = " addthis_32x32_style addthis_vertical_style ";
    			break;
    		case 'vertical_small':
    			$design = " addthis_vertical_style ";
    			break;    			
    	}
    	
    	return $design;
    }    

	/**
	 * Appending addthis main script to the head
	 *
	 * @return void
	 */    
    function appendAddThisJsFollow($params){
    	
    	//Creates addthis configuration script
	    $at_flw_script = "<script type='text/javascript'>". PHP_EOL;
	    $at_flw_script .= "window.onload = function() {". PHP_EOL;
	    $at_flw_script .= "\tif(typeof addthis_conf == 'undefined'){". PHP_EOL;
	    $at_flw_script .= "\t\tvar script = document.createElement('script');". PHP_EOL;
	    $at_flw_script .= "\t\tscript.src = '//s7.addthis.com/js/300/addthis_widget.js#pubid=".urlencode($params->get("atf_profile_id"))."';". PHP_EOL;
	    $at_flw_script .= "\t\tdocument.getElementsByTagName('head')[0].appendChild(script);". PHP_EOL;	    
	    $at_flw_script .= "\t\tvar addthis_product = 'jfp-1.0';". PHP_EOL;
	    $at_flw_script .= "\t}". PHP_EOL;
	    $at_flw_script .= "}". PHP_EOL;
	    $at_flw_script .= "</script>". PHP_EOL;
	    
	    echo $at_flw_script;   	
    }  