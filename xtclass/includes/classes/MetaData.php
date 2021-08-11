<?php
/**
 * MetaData v0.1
 *
 * Meta data generator from JSON file
 */
class MetaData
{
	public static $json_name = 'metadata.json';

	protected static $location;
	protected static $section;

	/**
	 * Get full path
	 *
	 * @param $json_name string
	 * @return string
	 */
	public static function path($json_name = null) {
        return WebThemes::newInstance()->getCurrentThemePath().'admin/metatags/'.$json_name;
    }

	/**
	 * Load locations
	 */
	protected static function locations()
	{
		self::$location = Rewrite::newInstance()->get_location();
		if (self::$location)
			self::$section = Rewrite::newInstance()->get_section();
	}

	public static function default_meta_data()
	{
		return [
			'item' => [
				['name' => 'title', 'content' => '{ITEM_TITLE} - {PAGE_TITLE}'],
				['name' => 'description', 'content' => '{ITEM_DESCRIPTION}'],
				['name' => 'twitter:title', 'content' => '{ITEM_TITLE} - {PAGE_TITLE}'],
				['name' => 'twitter:card', 'content' => '{ITEM_DESCRIPTION}'],
				['name' => 'twitter:description', 'content' => '{ITEM_DESCRIPTION}'],
				['name' => 'twitter:image', 'content' => '{ITEM_IMAGE}'],
				['property' => 'og:title', 'content' => '{ITEM_TITLE} - {PAGE_TITLE}'],
				['property' => 'og:type', 'content' => 'article'],
				['property' => 'og:url', 'content' => '{ITEM_URL}'],
				['property' => 'og:image', 'content' => '{ITEM_IMAGE}'],
				['property' => 'og:description', 'content' => '{ITEM_DESCRIPTION}']
			],
			'item/item_add' => [
				['name' => 'title', 'content' => '{PUBLISH_LISTING_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'item/item_edit' => [
				['name' => 'title', 'content' => '{EDIT_LISTING_TEXT} - {PAGE_TITLE}'],
				['name' => 'description', 'content' => '{ITEM_DESCRIPTION}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'item/contact' => [
				['name' => 'title', 'content' => '{CONTACT_SELLER_TEXT} - {ITEM_TITLE} - {PAGE_TITLE}'],
				['name' => 'description', 'content' => '{CONTACT_SELLER_TEXT}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow']
			],
			'page' => [
				['name' => 'title', 'content' => '{STATIC_PAGE_TITLE} - {PAGE_TITLE}'],
				['name' => 'description', 'content' => '{PAGE_TEXT}'],
				['name' => 'robots', 'content' => 'index, follow'],
				['name' => 'googlebot', 'content' => 'index, follow']
			],
			'error' => [
				['name' => 'title', 'content' => '{ERROR_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'search' => [
				['name' => 'title', 'content' => '{TITLE_SEARCH_RESULT} - {PAGE_TITLE}'],
				['name' => 'description', 'content' => '{DESCRIPTION_SEARCH_RESULT}']
			],
			'login' => [
				['name' => 'title', 'content' => '{LOGIN_TEXT} - {PAGE_TITLE}'],
				['name' => 'description', 'content' => '{LOGIN_TEXT}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'login/recover' => [
				['name' => 'title', 'content' => '{RECOVER_YOUR_PASSWORD_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'login/forgot' => [
				['name' => 'title', 'content' => '{RECOVER_MY_PASSWORD_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'register' => [
				['name' => 'title', 'content' => '{CREATE_NEW_ACCOUNT_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'user' => [
				['name' => 'title', 'content' => '{USER_NAME}\'s profile - {PAGE_TITLE}'],
				['name' => 'description', 'content' => '{USER_INFO}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'user/dashboard' => [
				['name' => 'title', 'content' => '{DASHBOARD_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow, noarchive'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'user/items' => [
				['name' => 'title', 'content' => '{MANAGE_MY_LISTING_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'user/alerts' => [
				['name' => 'title', 'content' => '{MANAGE_MY_ALERTS_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow, noarchive'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'user/profile' => [
				['name' => 'title', 'content' => '{UPDATE_MY_PROFILE_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'user/pub_profile' => [
				['name' => 'title', 'content' => '{USER_NAME}\'s {PUBLIC_PROFILE_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'index, follow']
			],
			'user/change_email' => [
				['name' => 'title', 'content' => '{CHANGE_MY_EMAIL_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'user/change_username' => [
				['name' => 'title', 'content' => '{CHANGE_MY_USERNAME_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'user/change_password' => [
				['name' => 'title', 'content' => '{CHANGE_MY_PASSWORD_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive']
			],
			'contact' => [
				['name' => 'title', 'content' => '{CONTACT_TEXT} - {PAGE_TITLE}'],
				['name' => 'robots', 'content' => 'noindex, nofollow, noarchive'],
				['name' => 'googlebot', 'content' => 'noindex, nofollow, noarchive'],
			],
			'home' => [
				['name' => 'title', 'content' => '{PAGE_TITLE}'],
				['name' => 'description', 'content' => '{PAGE_DESCRIPTION}'],
				['name' => 'robots', 'content' => 'index, follow'],
				['name' => 'googlebot', 'content' => 'index, follow'],
				['name' => 'twitter:title', 'content' => '{PAGE_TITLE}'],
				['name' => 'twitter:card', 'content' => '{PAGE_DESCRIPTION}'],
				['name' => 'twitter:description', 'content' => '{PAGE_DESCRIPTION}'],
				['name' => 'twitter:image', 'content' => '{LOGO}'],
				['property' => 'og:title', 'content' => '{PAGE_TITLE}'],
				['property' => 'og:type', 'content' => 'article'],
				['property' => 'og:url', 'content' => '{BASE_URL}'],
				['property' => 'og:image', 'content' => '{LOGO}'],
				['property' => 'og:description', 'content' => '{PAGE_DESCRIPTION}']
			]
		];
	}

	/**
	 * Generate JSON file from default metadata
	 *
	 * @return bool
	 */
	public static function generate_json_file()
	{
		// Full path of route JSON file
		$json_file_path = self::path(self::$json_name);
		$metadata = self::default_meta_data();

		$metadata = json_encode($metadata, JSON_UNESCAPED_SLASHES);
		$handler = @fopen($json_file_path, "w");
		if ($handler) {
			fwrite($handler, $metadata);
		}
		fclose($handler);

		if (file_exists($json_file_path)) {
			return true;
		}
		return false;
	}

	/**
	 * Get content of JSON file
	 *
	 * @param string $json_file_path
	 * @return array
	 */
	public static function read_json_file($json_file_path)
	{
		if (file_exists($json_file_path)) {
			$jsonstr = file_get_contents($json_file_path);
			$metadata = json_decode($jsonstr, true);
			if ($metadata) {
				return $metadata;
			}
		}
		return array();
	}

	/**
	 * Read source file to display its data of especific page
	 * 
	 * NOTE: An aditional param could be added (like $page before $kwords, $rwords)
	 * for select a custom json file e.g.: $page.'.json';
	 *
	 * @param array $rwords
	 * @param array $kwords
	 * @param string $page File name of json
	 * @return array
	 */
    protected static function get_meta_data($kwords, $rwords)
    {
    	// Get full path of metadata.json
    	$json_file_path = self::path(self::$json_name);

    	$metadata = self::read_json_file($json_file_path);
    	if (!$metadata)
    		$metadata = self::default_meta_data();


		self::locations(); $page = array();

		// Get metadata of specific page with array_elice
		if (self::$location === '' && isset($metadata['home'])) {
			
			// home page
			$page = array_slice($metadata['home'], 0);

		} else if (self::$location && !self::$section && isset($metadata[self::$location])) {

			// e.g.: $metadata['item']
			$page = array_slice($metadata[self::$location], 0);

		} else if (isset($metadata[self::$location.'/'.self::$section])) {
			
			// e.g.: $metadata['item/item_add']
			$page = array_slice($metadata[self::$location.'/'.self::$section], 0);

		}


		// Replacing flags
		$replace_flags = function($string) use ($kwords, $rwords) {
			return str_ireplace($kwords, $rwords, $string);
		};

		// This aux array must be same that $page but with flags replaced!
		$_page = array();

		if ($page) {
			foreach ($page as $array) {
				$keys 	= array_map($replace_flags, array_keys($array));
				$values = array_map($replace_flags, array_values($array));
				$_page[] = array_combine($keys, $values);
			}
		}

		return $_page;

    }

    /**
     * @return array
     */
	protected static function meta_data()
	{
		$text = array();

		self::locations();

		$kwords = ['{BASE_URL}', '{PAGE_TITLE}', '{PAGE_DESCRIPTION}', '{LOGO}', '{META_TAG_FILTER}', '{META_TITLE_FILTER}', '{META_DESCRIPTION_FILTER}'];
		$rwords = [osc_base_url(), osc_page_title(), osc_page_description(), xtclass_logo_url(), osc_apply_filter('meta_tag_filter', $data = ''), osc_apply_filter('meta_title_filter', $text = ''), osc_apply_filter('meta_description_filter', $text = '')];

		switch (self::$location) {
			case 'item':
				$kwords = array_merge($kwords, ['{ITEM_TITLE}', '{ITEM_CATEGORY}', '{ITEM_CITY}', '{ITEM_URL}', '{ITEM_DESCRIPTION}']); 
				$rwords = array_merge($rwords, [osc_item_title(), osc_item_category(), osc_item_city(), osc_item_url(), osc_highlight(strip_tags(osc_item_description()), 140).' ']); 
				switch (self::$section) {
					case 'item_add':
						$kwords = array_merge($kwords, ['{PUBLISH_LISTING_TEXT}']); // For PHP7.4 [...$kwords, osc_user_name()]
						$rwords = array_merge($rwords, [__('Publish a listing')]);	// For PHP7.4 [...$rwords, osc_user_name()]
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'item_edit':
						$kwords = array_merge($kwords, ['{EDIT_LISTING_TEXT}']);
						$rwords = array_merge($rwords, [__('Edit your listing')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'send_friend':
						$kwords = array_merge($kwords, ['{SEND_FRIEND_TEXT}']);
						$rwords = array_merge($rwords, [__('Send to a friend')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'contact':
						$kwords = array_merge($kwords, ['{CONTACT_SELLER_TEXT}']);
						$rwords = array_merge($rwords, [__('Contact seller')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					// listing
					default:
						// For {ITEM_IMAGE} flag
						$item_image = null;
						View::newInstance()->_erase('resources');
						if (osc_count_item_resources() > 0) {
							$num = 0;
							while(osc_has_item_resources()) {
								$num++;
								if ($num) {
									$item_image = osc_resource_url();
									break;
								}
							}
						}
						$kwords = array_merge($kwords, ['{ITEM_IMAGE}']);
						$rwords = array_merge($rwords, [$item_image]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
				}
				break;
			// static page
			case 'page':
				$kwords = array_merge($kwords, ['{STATIC_PAGE_TITLE}', '{STATIC_PAGE_TEXT}']);
				$rwords = array_merge($rwords, [osc_static_page_title(), osc_highlight(strip_tags(osc_static_page_text()), 140, '', '')]);
				$meta = self::get_meta_data($kwords, $rwords);
				$text = $meta;
				break;
			case 'error':
				$kwords = array_merge($kwords, ['{ERROR_TEXT}']);
				$rwords = array_merge($rwords, [__('Error')]);
				$meta = self::get_meta_data($kwords, $rwords);
				$text = $meta;
				break;
			// search
			case 'search':
				// For {TITLE_SEARCH_RESULT} flag
				$region   = osc_search_region();
				$city     = osc_search_city();
				$pattern  = osc_search_pattern();
				$category = osc_search_category_id();
				$s_page   = '';
				$i_page   = Params::getParam( 'iPage' );

				if ( $i_page != '' && $i_page > 1 ) {
					$s_page = ' - ' . __( 'page' ) . ' ' . $i_page;
				}

				$b_show_all = ( $region == '' && $city == '' && $pattern == '' && empty( $category ) );
				$b_category = ! empty( $category );
				$b_pattern  = ( $pattern != '' );
				$b_city     = ( $city != '' );
				$b_region   = ( $region != '' );

				if ( $b_show_all ) {
					$title_search_result = __( 'Show all listings' ) . ' - ' . $s_page . osc_page_title();
				}

				$result = '';
				if ( $b_pattern ) {
					$result .= $pattern . ' &raquo; ';
				}

				if ( $b_category && is_array( $category ) && count( $category ) > 0 ) {
					$cat = Category::newInstance()->findByPrimaryKey( $category[ 0 ] );
					if ( $cat ) {
						$result .= $cat[ 's_name' ] . ' ';
					}
				}

				if ( $b_city ) {
					$result .= $city . ' &raquo; ';
				} else if ( $b_region ) {
					$result .= $region . ' &raquo; ';
				}

				$result = preg_replace( '|\s?&raquo;\s$|' , '' , $result );

				if ( $result == '' ) {
					$result = __( 'Search results' );
				}

				$title_search_result = '';
				if ( osc_get_preference( 'seo_title_keyword' ) != '' ) {
					$title_search_result .= osc_get_preference( 'seo_title_keyword' ) . ' ';
				}
				$title_search_result .= $result . $s_page;


				// For {DESCRIPTION_SEARCH_RESULT} flag
				if(osc_count_items() == 0) {
					$description_search_result = '';
				}
				if(osc_has_items ()) {
					$description_search_result = osc_item_category() . ' ' . osc_item_city() . ', ' . osc_highlight( osc_item_description() , 120 );
				}

				// For {ITEM_CATEGORY} flag
				$item_category = '';
				if(osc_has_items()) {
					$item_category = osc_item_category();
				}

				osc_reset_items();

				$kwords = array_merge($kwords, ['{ITEM_CATEGORY}', '{ITEM_CITY}', '{TITLE_SEARCH_RESULT}', '{DESCRIPTION_SEARCH_RESULT}']);
				$rwords = array_merge($rwords, [$item_category, osc_item_city(), $title_search_result, $description_search_result]);
				$meta = self::get_meta_data($kwords, $rwords);
				$text = $meta;
				break;
			case 'login':
				switch (self::$section) {
					case('recover'):
						$kwords = array_merge($kwords, ['{RECOVER_YOUR_PASSWORD_TEXT}']);
						$rwords = array_merge($rwords, [__('Recover your password')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case('forgot'):
						$kwords = array_merge($kwords, ['{RECOVER_MY_PASSWORD_TEXT}']);
						$rwords = array_merge($rwords, [__('Recover my password')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					default:
						$kwords = array_merge($kwords, ['{LOGIN_TEXT}']);
						$rwords = array_merge($rwords, [__('Login')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
				}
				break;
			case 'register':
				$kwords = array_merge($kwords, ['{CREATE_NEW_ACCOUNT_TEXT}']);
				$rwords = array_merge($rwords, [__('Create a new account')]);
				$meta = self::get_meta_data($kwords, $rwords);
				$text = $meta;
				break;
			break;
			case 'user':
				switch (self::$section) {
					case 'dashboard':
						$kwords = array_merge($kwords, ['{DASHBOARD_TEXT}']);
						$rwords = array_merge($rwords, [__('Dashboard')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'items':
						$kwords = array_merge($kwords, ['{MANAGE_MY_LISTING_TEXT}']);
						$rwords = array_merge($rwords, [__('Manage my listings')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'alerts':
						$kwords = array_merge($kwords, ['{MANAGE_MY_ALERTS_TEXT}']);
						$rwords = array_merge($rwords, [__('Manage my alerts')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'profile':
						$kwords = array_merge($kwords, ['{UPDATE_MY_PROFILE_TEXT}']);
						$rwords = array_merge($rwords, [__('Update my profile')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'pub_profile':
						$kwords = array_merge($kwords, ['{PUBLIC_PROFILE_TEXT}', '{USER_NAME}']);
						$rwords = array_merge($rwords, [__( 'Public profile' ), osc_user_name()]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'change_email':
						$kwords = array_merge($kwords, ['{CHANGE_MY_EMAIL_TEXT}']);
						$rwords = array_merge($rwords, [__('Change my email')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'change_username':
						$kwords = array_merge($kwords, ['{CHANGE_MY_USERNAME_TEXT}']);
						$rwords = array_merge($rwords, [__('Change my username')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					case 'change_password':
						$kwords = array_merge($kwords, ['{CHANGE_MY_PASSWORD_TEXT}']);
						$rwords = array_merge($rwords, [__('Change my password')]);
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
					default:
						$kwords = array_merge($kwords, ['{USER_NAME}', '{USER_INFO}']);
						$rwords = array_merge($rwords, [osc_user_name()], osc_user_info());
						$meta = self::get_meta_data($kwords, $rwords);
						$text = $meta;
						break;
				}
				break;
			case 'contact':
				$kwords = array_merge($kwords, ['{CONTACT_TEXT}']);
				$rwords = array_merge($rwords, [__('Contact')]);
				$meta = self::get_meta_data($kwords, $rwords);
				$text = $meta;
				break;
			case 'custom':
				$kwords = array_merge($kwords, ['{CUSTOM_PAGE_TITLE}']);
				$rwords = array_merge($rwords, [Rewrite::newInstance()->get_title()]);
				$meta = self::get_meta_data($kwords, $rwords);
				$text = $meta;
				break;
			default:
				$meta = self::get_meta_data($kwords, $rwords);
				$text = $meta;
				break;
		}

		return $text;
	}
}