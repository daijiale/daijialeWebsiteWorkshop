<?php

    function shortcode_highlight( $atts, $content = null ) {
		if ( !empty($atts) && in_array( 'alternative', $atts ) ) {
			$class = 'highlight2';
		} else {
			$class = 'highlight1';
		}
		return '<span class="' . $class . '">' . $content . '</span>';
    }

    function shortcode_line ( $atts, $content = null ) {
		return '<hr />';
    }
	
    add_shortcode('highlight', 'shortcode_highlight');
    add_shortcode('line', 'shortcode_line');
	
?>
