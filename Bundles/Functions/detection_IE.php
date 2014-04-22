<?php
/**
 * Detection du NAVIGATEUR CLIENT
 */
function if_nav_IE () {
	if ( stristr ( getenv( "HTTP_USER_AGENT" ), "MSIE" ) || stristr (getenv("HTTP_USER_AGENT" ), "Internet Explorer" ) ) {
	  	return TRUE;
	} else {
		return FALSE;
	}
}




?>