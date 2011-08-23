<?php
/*
Plugin Name: Incorrect Datetime Bug Fix
Version: 1.0
Description: Fixes sql_modes that cause error: "Incorrect datetime value: '0000-00-00 00:00:00' for column 'post_date_gmt' at row 1"sage: [Incorrect datetime value: '0000-00-00 00:00:00' for column 'post_date_gmt' at row 1]".
Author: Eddie Moya
Author URI: http://eddiemoya.com/
Plugin URI: http://eddiemoya.com/plugins/incorrect-datetime-bug-fix-wordpress/
/*
Copyright (C) 2010 Eddie Moya (eddie.moya+wp@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

class Incorrect_Datetime_Bug_Fix {
    function init(){
        add_action('init', array( __CLASS__, 'strip_sql_modes' ) );
    }
    
    function strip_sql_modes(){
        global $wpdb;

        $sql_modes = $wpdb->get_col( "SELECT @@SESSION.sql_mode" );
        $sql_modes = preg_replace( '/(,?NO_ZERO_DATE|,?NO_ZERO_IN_DATE|,?TRADITIONAL)/', '', $sql_modes[0] );
        $wpdb->query( $wpdb->prepare( "SET SESSION sql_mode = '" . $sql_modes . "'" ) );          
    }   
		
}
Incorrect_Datetime_Bug_Fix::init();