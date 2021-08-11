<?php
/**
 * Meta Tag generator
 */
class MetaTag extends MetaData
{

	/**
     * Generate HTML meta tag
     *
     * @param array $attrs | ['name' => 'description', 'content' => 'Hello world']
     * @return string | <meta name="description" content="Hello world">
     */
    public static function render_meta($attrs = array())
    {
        if ($attrs) {
            $html = '<meta '. implode(' ', array_map(
                function ($k, $v) { return $k .'="'. $v .'"'; },
                array_keys($attrs), $attrs
            )) .'>';

            echo $html;
        } else {
            echo '';
        }
    }

    public static function render_meta_tags()
    {
    	$metadata = parent::meta_data();

    	$sanitize_key = function($key) {
			return preg_replace('|([^_a-zA-Z0-9-]+)|', '', strip_tags($key));
		};

		$sanitize_value = function($value) {
			return osc_esc_html(htmlentities($value, ENT_COMPAT, 'UTF-8'));
		};

		if (!empty($metadata)) {
			foreach ($metadata as $attrs) {
				if (isset($attrs['META_TAG_FILTER']))
					$meta_tag_filter = $attrs['META_TAG_FILTER'];
					unset($attrs['META_TAG_FILTER']);

	    		$keys 	= array_map($sanitize_key, array_keys($attrs));
				$values = array_map($sanitize_value, array_values($attrs));
				$attrs 	= array_combine($keys, $values);

				// <title> tag
	    		if (isset($attrs['name']) && isset($attrs['content']) && $attrs['name'] == 'title')
					echo '<title>'.$attrs['content'].'</title>';

				// <meta> tags
	    		self::render_meta($attrs);

	    		// custom content
	    		if (isset($meta_tag_filter))
	    			echo $meta_tag_filter;

	    	}
		}
    }

}