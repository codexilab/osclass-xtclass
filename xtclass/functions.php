<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

if (OC_ADMIN)
    require_once dirname(__FILE__) . '/includes/classes/scssphp/scss.inc.php';
    use ScssPhp\ScssPhp\Compiler;

define('XTCLASS_THEME_VERSION', '1.0.1');
define('XTCLASS_THEME_FOLDER', 'xtclass');
define('XTCLASS_THEME_PATH', osc_themes_path() . XTCLASS_THEME_FOLDER . '/');

// CUSTOM CLASSES      
require XTCLASS_THEME_PATH . 'includes/classes/XTClassifiedsAutoLoader.php';
XTClassifiedsAutoLoader::addFolder(XTCLASS_THEME_PATH . 'includes/classes');
XTClassifiedsAutoLoader::addFolder(XTCLASS_THEME_PATH . 'includes/frm');
XTClassifiedsAutoLoader::register();

if (!OC_ADMIN) {
    // Custom fonts for this template
    osc_enqueue_style('fontawesome', 'https://cdn.jsdelivr.net/gh/FortAwesome/Font-Awesome@5.12.0/css/all.min.css');
    osc_enqueue_style('fonts-googleapis', 'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i');

    // Custom styles for this template
    osc_enqueue_style('sb-admin-2', osc_current_web_theme_url('css/sb-admin-2.min.css'));
    osc_enqueue_style('datepicker', osc_current_web_theme_url('vendor/datepicker/css/bootstrap-datepicker3.min.css'));
    osc_enqueue_style('jquery-ui', osc_current_web_theme_url('css/jquery-ui.custom.css'));

    if (file_exists(XTCLASS_THEME_PATH . 'scss/style.css')) {
        osc_enqueue_style('css-style', osc_current_web_theme_url('scss/style.css'));
    } else {
        osc_enqueue_style('css-style', osc_current_web_theme_url('css/style.min.css'));
    }

    // Bootstrap core JavaScript
    osc_register_script('jquery', osc_current_web_theme_url('vendor/jquery/jquery.min.js'));
    osc_enqueue_script('jquery');
    osc_register_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js');
    osc_enqueue_script('jquery-ui');
    osc_register_script('jquery-validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js');
    osc_enqueue_script('jquery-validate');
    osc_register_script('bootstrap-bundle', osc_current_web_theme_url('vendor/bootstrap/js/bootstrap.bundle.min.js'));
    osc_enqueue_script('bootstrap-bundle');
    osc_register_script('jquery-easing', osc_current_web_theme_url('vendor/jquery-easing/jquery.easing.min.js'));
    osc_enqueue_script('jquery-easing');

    // Custom scripts for all pages
    osc_register_script('sb-admin-2', osc_current_web_theme_url('js/sb-admin-2.js'));
    osc_enqueue_script('sb-admin-2');
    osc_register_script('global', osc_current_web_theme_url('js/global.js'));
    osc_enqueue_script('global');
    osc_register_script('datepicker', osc_current_web_theme_url('vendor/datepicker/js/bootstrap-datepicker.min.js'));
    osc_enqueue_script('datepicker');
    osc_enqueue_script('php-date');

    if (osc_is_publish_page() || osc_is_edit_page()) {
        osc_enqueue_style('fine-uploader-css', osc_assets_url('js/fineuploader/fineuploader.css'));
        osc_enqueue_style('bender-fine-uploader-css', osc_current_web_theme_url('css/ajax-uploader.css'));
        osc_enqueue_script('jquery-fineuploader');
    }
}

if ((string) osc_get_preference('keyword_placeholder', 'bender') == "") {
    Params::setParam('keyword_placeholder', __('ie. PHP Programmer', XTCLASS_THEME_FOLDER));
}

// Install options
if (!function_exists('xtclass_theme_install')) {
    function xtclass_theme_install() {
        osc_set_preference('version', XTCLASS_THEME_VERSION, 'xtclass');
        //osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'bender');
        //osc_set_preference('defaultShowAs@all', 'list', 'bender');
        //osc_set_preference('defaultShowAs@search', 'list');
        //osc_set_preference('defaultLocationShowAs', 'dropdown', 'bender'); // dropdown / autocomplete
        osc_reset_preferences();
    }
}

if (!function_exists('xtclass_images_uploads_path')) {
    /**
     * Get images folder path.
     *
     * @param string $file Get ~/oc-content/themes/xtclass/images/uploads/logo.jpg
     * @return string ~/oc-content/themes/xtclass/images/uploads/
     */
    function xtclass_images_uploads_path($file = null) {
        return XTCLASS_THEME_PATH . 'images/uploads/' . $file;
    }
}

if (!function_exists('xtclass_images_uploads_url')) {
   /**
    * Get images folder URL.
    *
    * @param string $file Get sitename.com/oc-content/themes/xtclass/images/uploads/logo.png
    * @return string sitename.com/oc-content/themes/xtclass/images/uploads/
    */
    function xtclass_images_uploads_url($file = null) {
        return osc_current_web_theme_url('images/uploads/') . $file;
    }
}

if (!function_exists('xtclass_show_premiums_home')) {
    function xtclass_show_premiums_home() {
        return (bool) osc_get_preference('show_premiums_home', 'xtclass');
    }
}

if (!function_exists('xtclass_num_premiums_home')) {
    function xtclass_num_premiums_home() {
        return (int) osc_get_preference('num_premiums_home', 'xtclass');
    }
}

if (!function_exists('xtclass_nofollow_construct')) {
    /**
     * Hook for header, meta tags robots nofollow
     */
    function xtclass_nofollow_construct() {
        echo '<meta name="robots" content="noindex, nofollow, noarchive" />' . PHP_EOL;
        echo '<meta name="googlebot" content="noindex, nofollow, noarchive" />' . PHP_EOL;
    }
}

if (!function_exists('xtclass_follow_construct')) {
    /**
     * Hook for header, meta tags robots follow
     */
    function xtclass_follow_construct() {
        echo '<meta name="robots" content="index, follow" />' . PHP_EOL;
        echo '<meta name="googlebot" content="index, follow" />' . PHP_EOL;
    }
}

function xtclass_add_body_class_construct($classes) {
    $customBodyClass = customBodyClass::newInstance();
    $classes = array_merge($classes, $customBodyClass->get());
    return $classes;
}

function xtclass_add_wrapper_class_construct($classes) {
    $customWrapperClass = customWrapperClass::newInstance();
    $classes = array_merge($classes, $customWrapperClass->get());
    return $classes;
}

/**
 * Print body classes.
 *
 * @param string $echo Optional parameter.
 * @return print string with all body classes concatenated
 */
function xtclass_body_class($echo = true) {
    osc_add_filter('xtclass_bodyClass', 'xtclass_add_body_class_construct');
    $classes = osc_apply_filter('xtclass_bodyClass', array());
    if ($echo && count($classes)) {
        echo 'class="'.implode(' ', $classes).'"';
    } else {
        return $classes;
    }
}

/**
 * Print wrapper classes.
 *
 * @param string $echo Optional parameter.
 * @return print string with all classes concatenated
 */
function xtclass_wrapper_class($echo = true) {
    osc_add_filter('xtclass_wrapperClass', 'xtclass_add_wrapper_class_construct');
    $classes = osc_apply_filter('xtclass_wrapperClass', array());
    if ($echo && count($classes)) {
        echo 'class="'.implode(' ', $classes).'"';
    } else {
        return $classes;
    }
}

/**
 * Add new body class to body class array.
 *
 * @param string $class required parameter.
 */
function xtclass_add_body_class($class) {
    $customElementClass = customBodyClass::newInstance();
    $customElementClass->add($class);
}

// For add  new classes after .row
function xtclass_add_wrapper_class($class) {
    $customElementClass = customWrapperClass::newInstance();
    $customElementClass->add($class);
}
xtclass_add_wrapper_class('row');

if (!function_exists('check_php_tags')) {
    /**
     * Detect if a string is PHP script
     * with only the PHP tags is opened and closed
     * and without white spaces blank before or after of string
     *
     * @param $str
     * @return bool
     */
    function check_php_tags($str) {
        $str = str_replace("\r", "", $str); // Minify

        $opened_php_tag = preg_match('/^<\?php/i', $str);
        $closed_php_tag = preg_match('/\?>$/i', $str);

        return (bool) $opened_php_tag && (bool) $closed_php_tag;
    }
}

if (!function_exists('eval_nice')) {
    /**
     * Remove PHP tags for eval,
     * prevent it print errors/warnings
     *
     * @param $php
     */
    function eval_nice($php) {
        $code_str = preg_replace('/<\?php(.+?)\?>/is', '$1', $php);

        try {
            $result = @eval($code_str);
            return eval($result);
        } catch (ParseError $e) {
            return '<!-- PHP Error -->';
        }

    }
}

if (!function_exists('apply_eval_nice')) {
    function apply_eval_nice($preference) {
        return check_php_tags($preference) ? eval_nice($preference) : $preference;
    }
}

// ads SEARCH
if (!function_exists('search_ads_listing_top_fn')) {
    function search_ads_listing_top_fn() {
        if (osc_get_preference('search-results-top-728x90', 'bender')!='') {
            echo '<div class="col-md-12 text-center mb-2"><div class="ads_728">' . PHP_EOL;
            echo apply_eval_nice(osc_get_preference('search-results-top-728x90', 'bender'));
            echo '</div></div>' . PHP_EOL;
        }
    }
    //osc_add_hook('search_ads_listing_top', 'search_ads_listing_top_fn');
}

if (!function_exists('search_ads_listing_medium_fn')) {
    function search_ads_listing_medium_fn() {
        if (osc_get_preference('search-results-middle-728x90', 'bender')!='') {
            echo '<div class="col-md-12 text-center mt-2 mb-2"><div class="ads_728">' . PHP_EOL;
            echo apply_eval_nice(osc_get_preference('search-results-middle-728x90', 'bender'));
            echo '</div></div>' . PHP_EOL;
        }
    }
    osc_add_hook('search_ads_listing_medium', 'search_ads_listing_medium_fn');
}

if (!function_exists('xtclass_logged_username')) {
    function xtclass_logged_username() {
        $user = User::newInstance()->findByPrimaryKey(osc_logged_user_id());
        return (string) (isset($user['s_username']) && $user['s_username']) ? $user['s_username'] : '';
    }
}

if (!function_exists('osc_uploads_url')) {
    function osc_uploads_url($item = '') {
        $logo = osc_get_preference('logo', 'bender');
        if ($logo != '' && file_exists(osc_uploads_path() . $logo)) {
            $path = str_replace(ABS_PATH, '', osc_uploads_path() . '/');
            return osc_base_url() . $path . $item;
        }
    }
}

if (!function_exists('xtclass_logo_url')) {
    function xtclass_logo_url() {
        $logo = osc_get_preference('logo', 'xtclass');
        if ($logo) {
            return xtclass_images_uploads_url($logo).'?'.filemtime(xtclass_images_uploads_path($logo));
        }
        return false;
    }
}

if (!function_exists('xtclass_logo_nav')) {
    function xtclass_logo_nav() {
        $logo = osc_get_preference('logo', 'xtclass');

        $html = '<a class="navbar-brand font-weight-bold" href="'.osc_base_url().'">';
        
        if (!osc_is_home_page()) { // for scrollFunctionJS()
            $html .= '<img id="logo" style="max-width: 166px;" src="'.xtclass_logo_url().'" class="img-fluid" alt="'.osc_page_title().'">';
        } else {
            $html .= '<img id="logo" src="'.xtclass_logo_url().'" class="img-fluid" alt="'.osc_page_title().'">';
        }
        
        $html .= '</a>';

        if($logo != '' && file_exists(xtclass_images_uploads_path($logo))) {
            return $html;
        } else {
            return '<a class="navbar-brand font-weight-bold" href="'.osc_base_url().'">'.osc_page_title().'</a>';
        }
    }
}

if (!function_exists('xtclass_logo_header')) {
    function xtclass_logo_header() {
        $logo = osc_get_preference('logo', 'xtclass');
        if ($logo != '' && file_exists(xtclass_images_uploads_path($logo))) {
            return '<a href="'.osc_base_url().'"><img class="img-fluid" border="0" alt="' . osc_page_title() . '" src="' . xtclass_logo_url() . '"></a>';
        }
        return '<a href="'.osc_base_url().'">'.osc_page_title().'</a>';
    }
}

if (!function_exists('xtclass_logo_footer')) {
    function xtclass_logo_footer() {
        $logo = osc_get_preference('footer-logo', 'xtclass');
        if ($logo != '' && file_exists(xtclass_images_uploads_path($logo))) {
            $src = xtclass_images_uploads_url($logo).'?'.filemtime(xtclass_images_uploads_path($logo));
            return '<a href="'.osc_base_url().'"><img id="logo-footer" class="img-fluid" alt="'.osc_page_title().'" src="'.$src.'" /></a>';
        }
        return '';
    }
}

if (!function_exists('get_breadcrumb_lang')) {
    function get_breadcrumb_lang() {
        $lang = array();
        $lang['item_add']               = __('Publish a listing', XTCLASS_THEME_FOLDER);
        $lang['item_edit']              = __('Edit your listing', XTCLASS_THEME_FOLDER);
        $lang['item_send_friend']       = __('Send to a friend', XTCLASS_THEME_FOLDER);
        $lang['item_contact']           = __('Contact publisher', XTCLASS_THEME_FOLDER);
        $lang['search']                 = __('Search results', XTCLASS_THEME_FOLDER);
        $lang['search_pattern']         = __('Search results: %s', XTCLASS_THEME_FOLDER);
        $lang['user_dashboard']         = __('Dashboard', XTCLASS_THEME_FOLDER);
        $lang['user_dashboard_profile'] = __("%s's profile", XTCLASS_THEME_FOLDER);
        $lang['user_account']           = __('Account', XTCLASS_THEME_FOLDER);
        $lang['user_items']             = __('Listings', XTCLASS_THEME_FOLDER);
        $lang['user_alerts']            = __('Alerts', XTCLASS_THEME_FOLDER);
        $lang['user_profile']           = __('Update account', XTCLASS_THEME_FOLDER);
        $lang['user_change_email']      = __('Change email', XTCLASS_THEME_FOLDER);
        $lang['user_change_username']   = __('Change username', XTCLASS_THEME_FOLDER);
        $lang['user_change_password']   = __('Change password', XTCLASS_THEME_FOLDER);
        $lang['login']                  = __('Login', XTCLASS_THEME_FOLDER);
        $lang['login_recover']          = __('Recover password', XTCLASS_THEME_FOLDER);
        $lang['login_forgot']           = __('Change password', XTCLASS_THEME_FOLDER);
        $lang['register']               = __('Create a new account', XTCLASS_THEME_FOLDER);
        $lang['contact']                = __('Contact', XTCLASS_THEME_FOLDER);
        return $lang;
    }
}

/**
 * @param string $separator
 * @param bool   $echo
 * @param array  $lang
 *
 * @return string|void
 */
function xtclass_breadcrumb($separator = '&raquo;', $echo = true, $lang = array()) {
    $br = new CustomBreadcrumb($lang);
    $br->init();
    if ($echo) {
        echo $br->render($separator);
        return;
    }
    return $br->render($separator);
}

// Add breadcrumb to all pages
if (!function_exists('breadcrumb')) {
    function breadcrumb() {
        $breadcrumb = xtclass_breadcrumb('', false, get_breadcrumb_lang());
        if ($breadcrumb !== '') {
echo <<<FB
        <div class="row">
            <div class="col-md-12">
            $breadcrumb
            </div>
        </div>
FB;
        }
    }
    //osc_add_hook('before-main', 'breadcrumb');
}

if (!function_exists('user_thumb_url')) {
    function user_thumb_url() {
        return osc_current_web_theme_url('images/user-icon.png');
    }
}

if (!function_exists('xtclass_default_location_show_as')) {
    function xtclass_default_location_show_as() {
        return osc_get_preference('defaultLocationShowAs','bender');
    }
}

if (!function_exists('xtclass_search_number')) {
    /**
     * @return array
     */
    function xtclass_search_number() {
        $search_from = ((osc_search_page() * osc_default_results_per_page_at_search()) + 1);
        $search_to   = ((osc_search_page() + 1) * osc_default_results_per_page_at_search());
        if ($search_to > osc_search_total_items()) {
            $search_to = osc_search_total_items();
        }

        return [
            'from' => $search_from,
            'to'   => $search_to,
            'of'   => osc_search_total_items()
        ];
    }
}

if (!function_exists('xtclass_item_title')) {
    /**
     * Helpers used at view.
     */
    function xtclass_item_title() {
        $title = osc_item_title();
        foreach( osc_get_locales() as $locale ) {
            if (Session::newInstance()->_getForm('title') != "") {
                $title_ = Session::newInstance()->_getForm('title');
                if (@$title_[$locale['pk_c_code']] != "") {
                    $title = $title_[$locale['pk_c_code']];
                }
            }
        }
        return $title;
    }
}

if (!function_exists('xtclass_item_description')) {
    function xtclass_item_description() {
        $description = osc_item_description();
        foreach (osc_get_locales() as $locale) {
            if (Session::newInstance()->_getForm('description') != "") {
                $description_ = Session::newInstance()->_getForm('description');
                if (@$description_[$locale['pk_c_code']] != "") {
                    $description = $description_[$locale['pk_c_code']];
                }
            }
        }
        return $description;
    }
}

if (!function_exists('related_listings')) {
    function related_listings() {
        View::newInstance()->_exportVariableToView('items', array());

        $mSearch = new Search();
        $mSearch->addCategory(osc_item_category_id());
        $mSearch->addRegion(osc_item_region());
        $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
        $mSearch->limit('0', '3');

        $aItems      = $mSearch->doSearch();
        $iTotalItems = count($aItems);
        if( $iTotalItems == 3 ) {
            View::newInstance()->_exportVariableToView('items', $aItems);
            return $iTotalItems;
        }
        unset($mSearch);

        $mSearch = new Search();
        $mSearch->addCategory(osc_item_category_id());
        $mSearch->addItemConditions(sprintf("%st_item.pk_i_id != %s ", DB_TABLE_PREFIX, osc_item_id()));
        $mSearch->limit('0', '3');

        $aItems = $mSearch->doSearch();
        $iTotalItems = count($aItems);
        if( $iTotalItems > 0 ) {
            View::newInstance()->_exportVariableToView('items', $aItems);
            return $iTotalItems;
        }
        unset($mSearch);

        return 0;
    }
}

if (!function_exists('delete_user_js')) {
    function delete_user_js() {
        $location = Rewrite::newInstance()->get_location();
        $section  = Rewrite::newInstance()->get_section();
        if (($location === 'user' && in_array($section, array('dashboard', 'profile', 'alerts', 'change_email', 'change_username',  'change_password', 'items'))) || (Params::getParam('page') ==='custom' && Params::getParam('in_user_menu')==true )) { 
            // user_info_js()
            $user = User::newInstance()->findByPrimaryKey(Session::newInstance()->_get('userId'));
            View::newInstance()->_exportVariableToView('user', $user); ?> 
            <script>
            user = {};
            user.id = '<?php echo osc_user_id(); ?>';
            user.secret = '<?php echo osc_user_field("s_secret"); ?>';

            // delete_user.js
            $(document).ready(function() {
                function delete_user() {
                    window.location = '<?php echo osc_base_url(true); ?>' + '?page=user&action=delete&id=' + user.id  + '&secret=' + user.secret;
                }

                $('a[href="#delete_account"]').click(function() {
                    $('#genModal').modal('show');
                    $('#genModal').on('shown.bs.modal', function(e) {
                        $("#genModal .modal-header").html('<h5 class="modal-title"><?php echo osc_esc_js(__('Delete account', XTCLASS_THEME_FOLDER)); ?></h5>');
                        $("#genModal .modal-body").html('<?php echo osc_esc_js(__('Are you sure you want to delete your account?', XTCLASS_THEME_FOLDER)); ?>');
                        $("#genModal .modal-footer").html('<button class="btn btn-secondary" type="button" onClick="genModalHide();return false;"><?php echo osc_esc_js(__('Cancel', XTCLASS_THEME_FOLDER)); ?></button> <button class="btn btn-primary" type="button" onClick="delete_user();return false;"><?php echo osc_esc_js(__('Delete', XTCLASS_THEME_FOLDER)); ?></button>');
                    });
                });
            });
            </script>
<?php
        }
    }
    osc_add_hook('footer', 'delete_user_js', 1);
}

if (!function_exists('xtclass_default_show_as')) {
    function xtclass_default_show_as() {
        return getPreference('defaultShowAs@all','bender');
    }
}

if (!function_exists('xtclass_show_as')) {
    function xtclass_show_as() {
        $p_sShowAs    = Params::getParam('sShowAs');
        $aValidShowAsValues = array('list', 'gallery');
        if (!in_array($p_sShowAs, $aValidShowAsValues)) {
            $p_sShowAs = xtclass_default_show_as();
        }
        return $p_sShowAs;
    }
}

if (!function_exists('xtclass_draw_item')) {
    function xtclass_draw_item($class = false,$admin = false, $premium = false) {
        $filename = 'loop-single';
        if ($premium) {
            $filename .='-premium';
        }
        require XTCLASS_THEME_PATH . $filename . '.php';
    }
}

if (!function_exists('html_option_nav_menu')) {
    /**
     * Get html option to nav menu.
     *
     * @param $n to use in switch structure
     * @return $html
     */
    function html_option_nav_menu($n) {
        switch ($n) {
            case 'publish_btn':
                return  '<div class="dropdown-row d-flex align-items-center ml-auto d-lg-none">
                            <a class="btn btn-danger btn-lg btn-block" href="' . osc_item_post_url_in_category() . '">' . __('Publish your ad for free', XTCLASS_THEME_FOLDER) . '</a>
                        </div>';
                break;

            case 'logout_link':
                return  '<a class="dropdown-item logout" href="javascript:void(0);">
                            <i class="fas fa-sign-out-alt fa-dm fa-fw mr-2 text-gray-900"></i>
                            ' . __('Logout') . '
                        </a>';
                break;
        }
    }
}

if (!function_exists('get_user_nav_menu')) {
    function get_user_nav_menu() {
        $options = array();
        if (osc_users_enabled()) {
            if (osc_is_web_user_logged_in()) {
                $options[] = array(
                    'name'  => __('My listings'),
                    'url'   => osc_user_dashboard_url(),
                    'class' => 'fas fa-th-list fa-dm fa-fw mr-2 text-gray-900'
                );

                $options[] = array(
                    'name'  => __('Alerts'),
                    'url'   => osc_user_alerts_url(),
                    'class' => 'fas fa-bell fa-dm fa-fw mr-2 text-gray-900'
                );

                $options[] = array(
                    'name'  => __('My account', XTCLASS_THEME_FOLDER),
                    'url'   => osc_user_profile_url(),
                    'class' => 'fas fa-user-circle fa-dm fa-fw mr-2 text-gray-900'
                );

                $options[] = array('custom' => '<div class="dropdown-divider"></div>');
            }
        }

        $options[] = array(
            'name'  => __('Home', XTCLASS_THEME_FOLDER),
            'url'   => osc_base_url(),
            'class' => 'fas fa-home fa-dm fa-fw mr-2 text-gray-900'
        );

        $options[] = array(
            'name'  => __('Contact'),
            'url'   => osc_contact_url(),
            'class' => 'far fa-address-book fa-dm fa-fw mr-2 text-gray-900'
        );

        $options[] = array('custom' => '<div class="dropdown-divider d-lg-none"></div>');

        if (osc_users_enabled() || (!osc_users_enabled() && !osc_reg_user_post())) {
            $options[] = array('custom' => html_option_nav_menu('publish_btn'));
        }
        
        if (osc_users_enabled()) {
            if (osc_is_web_user_logged_in()) {
                $options[] = array('custom' => '<div class="dropdown-divider"></div>');
                $options[] = array('custom' => html_option_nav_menu('logout_link'));
            }
        }

        return $options;
    }
}

/**
 * Prints the user's account nav menu
 *
 * @param array $options array with options of the form 
 *  array(
 *   'name'             => 'display name',
 *   'url'              => 'url of link',
 *   'class'            => 'css class of item',
 *   'custom'           => 'custom html'
 * @return void
 */
function xtclass_user_nav_menu($options = null) {
    if($options == null) {
        $options = array();
        if (osc_users_enabled()) {
            if (osc_is_web_user_logged_in()) {
                $options[] = array('name' => __('My listings'), 'url' => osc_user_dashboard_url(), 'class' => 'fas fa-th-list fa-dm fa-fw mr-2 text-gray-900');
                $options[] = array('custom' => '<div class="dropdown-divider"></div>');
            }
        }
        $options[] = array('name' => __('Home', XTCLASS_THEME_FOLDER), 'url' => osc_base_url(), 'class' => 'fas fa-home fa-dm fa-fw mr-2 text-gray-900');
        $options[] = array('name' => __('Contact'), 'url' => osc_contact_url(), 'class' => 'far fa-address-book fa-dm fa-fw mr-2 text-gray-900');
        
        $options[] = array('custom' => '<div class="dropdown-divider d-lg-none"></div>');

        if (osc_users_enabled() || (!osc_users_enabled() && !osc_reg_user_post())) {
            $options[] = array('custom' => html_option_nav_menu('publish_btn'));
        }
        
        if (osc_users_enabled()) {
            if (osc_is_web_user_logged_in()) {
                $options[] = array('custom' => '<div class="dropdown-divider"></div>');
                $options[] = array('custom' => html_option_nav_menu('logout_link'));
            }
        }
    }

    $options = osc_apply_filter('user_nav_menu_filter', $options);

    $var_l = count($options);
    for($var_o = 0; $var_o < ($var_l); $var_o++) {

        if (isset($options[$var_o]['custom']) && $options[$var_o]['custom']) {
            echo $options[$var_o]['custom'];
        } else {
            echo '<a class="dropdown-item" href="' . $options[$var_o]['url'] . '"><i class="' . $options[$var_o]['class'] . '"></i> ' . $options[$var_o]['name'] . '</a>';
        }

    }

    osc_run_hook('user_nav_menu');
}

if (!function_exists('get_user_menu')) {
    function get_user_menu() {
        $options   = array();
        $options[] = array(
            'name'  => __('Public Profile'),
             'url'  => osc_user_public_profile_url(osc_logged_user_id()),
           'class'  => 'far fa-user-circle fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Listings'),
            'url'   => osc_user_list_items_url(),
            'class' => 'fas fa-th-list fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Alerts'),
            'url'   => osc_user_alerts_url(),
            'class' => 'far fa-bell fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Account'),
            'url'   => osc_user_profile_url(),
            'class' => 'fas fa-cogs fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Change email', XTCLASS_THEME_FOLDER),
            'url'   => osc_change_user_email_url(),
            'class' => 'far fa-envelope fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Change username', XTCLASS_THEME_FOLDER),
            'url'   => osc_change_user_username_url(),
            'class' => 'fas fa-user-tag fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => __('Change password'),
            'url'   => osc_change_user_password_url(),
            'class' => 'fas fa-key fa-lg fa-fw text-gray-600'
        );
        $options[] = array(
            'name'  => ' ' . __('Delete account', XTCLASS_THEME_FOLDER),
            'url'   => '#delete_account',
            'class' => 'fas fa-user-times fa-lg fa-fw text-gray-600'
        );

        return $options;
    }
}

if (!function_exists('xtclass_private_user_menu')) {
    /**
     * Prints the user's account menu
     *
     * @param array $options array with options of the form array('name' => 'display name', 'url' => 'url of link')
     * @return void
     */
    function xtclass_private_user_menu($options = null) {
        if($options == null) {
            $options = array();
            $options[] = array('name' => __('Public Profile'), 'url' => osc_user_public_profile_url(osc_logged_user_id()), 'class' => 'opt_publicprofile');
            $options[] = array('name' => __('Dashboard'), 'url' => osc_user_dashboard_url(), 'class' => 'opt_dashboard');
            $options[] = array('name' => __('Manage your listings'), 'url' => osc_user_list_items_url(), 'class' => 'opt_items');
            $options[] = array('name' => __('Manage your alerts'), 'url' => osc_user_alerts_url(), 'class' => 'opt_alerts');
            $options[] = array('name' => __('My profile'), 'url' => osc_user_profile_url(), 'class' => 'opt_account');
            $options[] = array('name' => __('Logout'), 'url' => osc_user_logout_url(), 'class' => 'opt_logout');
        }

        $options = osc_apply_filter('user_menu_filter', $options);


        echo '<div class="scroll-h-auto"><div style="width: max-content"><ul class="user_menu nav nav-pills flex-md-column">';

        $var_l = count($options);
        for($var_o = 0; $var_o < ($var_l-1); $var_o++) {
            echo '<li class="nav-item"><a class="nav-link" href="' . $options[$var_o]['url'] . '"><i class="' . $options[$var_o]['class'] . '"></i> ' . $options[$var_o]['name'] . '</a></li>';
        }

        osc_run_hook('user_menu');

        echo '<li class="nav-item"><a class="nav-link" href="' . $options[$var_l-1]['url'] . '"><i class="' . $options[$var_l-1]['class'] . '"></i>' . $options[$var_l-1]['name'] . '</a></li>';

        echo '</ul></div></div>';
    }
}

/*if (!function_exists('user_dashboard_redirect')) {
    function user_dashboard_redirect() {
        if(osc_is_user_dashboard()) {
            header('Location: ' . osc_user_list_items_url());
            exit;
        }
    }
    osc_add_hook('init', 'user_dashboard_redirect');
}*/

if (!function_exists('osc_item_category_url')) {
    function osc_item_category_url($category_id) {
        View::newInstance()->_erase('subcategories');
        View::newInstance()->_erase('categories') ;
        View::newInstance()->_exportVariableToView('category', Category::newInstance()->findByPrimaryKey($category_id) ) ;
        $url = osc_search_category_url() ;
        View::newInstance()->_erase('category') ;

        return $url;
    }
}

if (!function_exists('xtclass_print_sidebar_category_search')) {
    function xtclass_print_sidebar_category_search($aCategories, $current_category = null, $i = 0) {
        $class = 'list-unstyled';
        if (!isset($aCategories[$i])) {
            return null;
        }

        if ($i!=0) {
            $class = $class . ' ml-3';
        }

        $c = $aCategories[$i];
        $i++;
        if(!isset($c['pk_i_id'])) {
            echo '<ul class="'.$class.'">';
            if($i==1) {
                echo '<li><a href="'.osc_esc_html(osc_update_search_url(array('sCategory'=>null, 'iPage'=>null))).'">'.__('All categories', XTCLASS_THEME_FOLDER)."</a></li>";
            }
            foreach($c as $key => $value) {
        ?>
                <li>
                    <a id="cat_<?php echo osc_esc_html($value['pk_i_id']);?>" href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=> $value['pk_i_id'], 'iPage'=>null))); ?>">
                    <?php if(isset($current_category) && $current_category == $value['pk_i_id']){ echo '<strong>'.$value['s_name'].'</strong>'; }
                    else{ echo $value['s_name']; } ?>
                    </a>
                </li>
        <?php
            }
            if ($i==1) {
                echo "</ul>";
            } else {
                echo "</ul>";
            }
        } else {
        ?>
        <ul class="<?php echo $class;?>">
            <?php if ($i==1) : ?>
            <li><a href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=>null, 'iPage'=>null))); ?>"><?php _e('All categories', XTCLASS_THEME_FOLDER); ?></a></li>
            <?php endif; ?>
            <li>
                <a id="cat_<?php echo osc_esc_html($c['pk_i_id']);?>" href="<?php echo osc_esc_html(osc_update_search_url(array('sCategory'=> $c['pk_i_id'], 'iPage'=>null))); ?>">
                <?php if (isset($current_category) && $current_category == $c['pk_i_id']) : ?>
                <strong><?php echo $c['s_name']; ?></strong>
                <?php else: ?>
                <?php echo $c['s_name']; ?>
                <?php endif; ?>
            </a>
            <?php xtclass_print_sidebar_category_search($aCategories, $current_category, $i); ?>
            </li>
            <?php if ($i==1) ?>
        </ul>
    <?php
        }
    }
}

if (!function_exists('xtclass_sidebar_category_search')) {
    function xtclass_sidebar_category_search($catId = null) {
        $aCategories = array();
        if($catId==null) {
            $aCategories[] = Category::newInstance()->findRootCategoriesEnabled();
        } else {
            // if parent category, only show parent categories
            $aCategories = Category::newInstance()->toRootTree($catId);
            end($aCategories);
            $cat = current($aCategories);
            // if is parent of some category
            $childCategories = Category::newInstance()->findSubcategoriesEnabled($cat['pk_i_id']);
            if(count($childCategories) > 0) {
                $aCategories[] = $childCategories;
            }
        }

        if(count($aCategories) == 0) {
            return "";
        }

        xtclass_print_sidebar_category_search($aCategories, $catId);
    }
}

if (!function_exists('xtclass_search_pagination')) {
    /**
     * Gets the pagination links of search pagination
     *
     * @return string pagination links
     * @throws \Exception
     */
    function xtclass_search_pagination() {
        $params = array();
        if (View::newInstance()->_exists('search_uri') ) { // CANONICAL URL
            $params['url'] = osc_base_url().View::newInstance()->_get('search_uri') . '/{PAGE}';
            $params['first_url'] = osc_base_url().View::newInstance()->_get('search_uri');
        } else {
            $params['first_url'] = osc_update_search_url(array('iPage' => null));
        }
        $pagination = new CustomPagination($params);
        return $pagination->doPagination();
    }
}

if (!function_exists('xtclass_pagination_items')) {
    /**
     * @param array $extraParams
     * @param bool  $field
     *
     * @return string
     */
    function xtclass_pagination_items($extraParams = array (), $field = false) {
        if (osc_is_public_profile()) {
            $url = osc_user_list_items_pub_profile_url('{PAGE}', $field);
            $first_url = osc_user_public_profile_url();
        } elseif(osc_is_list_items()) {
            $url = osc_user_list_items_url('{PAGE}', $field);
            $first_url = osc_user_list_items_url();
        }

        $params = [
            'total'     => osc_search_total_pages(),
            'selected'  => osc_search_page(),
            'url'       => $url,
            'first_url' => $first_url
        ];

        if (is_array($extraParams) && !empty($extraParams)) {
            foreach($extraParams as $key => $value) {
                $params[$key] = $value;
            }
        }
        $pagination = new CustomPagination($params);
        return $pagination->doPagination();
    }
}

if (!function_exists('xtclass_meta_description')) {
    function xtclass_meta_description() {
        if (osc_is_public_profile()) {
            return osc_highlight(osc_user_info(), 120);
        }
    }
    osc_add_filter('meta_description_filter', 'xtclass_meta_description');
}

/**
 *
 * All CF will be searchable
 *
 * @param null $catId
 */
osc_remove_hook('search_form', 'osc_meta_search');

function xtclass_meta_search($catId = null) {
    CustomFieldForm::meta_fields_search($catId);
}
osc_add_hook('search_form', 'xtclass_meta_search');

/**
 * @param null $catId
 */
function xtclass_meta_publish($catId = null) {
    //osc_enqueue_script( 'php-date' );
    CustomFieldForm::meta_fields_input($catId);
}

/**
 * @param null $catId
 * @param null $item_id
 */
function xtclass_meta_edit($catId = null, $item_id = null) {
    //osc_enqueue_script( 'php-date' );
    CustomFieldForm::meta_fields_input($catId , $item_id);
}

osc_remove_hook('item_form', 'osc_meta_publish');
osc_remove_hook('item_edit', 'osc_meta_edit');

osc_add_hook('item_form', 'xtclass_meta_publish');
osc_add_hook('item_edit', 'xtclass_meta_edit');

if (!function_exists('xtclass_show_flash_message')) {
    /**
     * Shows all the pending flash messages in session and cleans up the array.
     *
     * @param $section
     * @param $class
     * @param $id
     * @return void
     */
    function xtclass_show_flash_message($section = 'pubMessages', $class = 'fade show alert-dismissible alert' , $id = 'flashmessage' ) {
        $messages = Session::newInstance()->_getMessage($section);
        if (is_array($messages)) {

            foreach ($messages as $message) {
                if (isset($message['msg']) && $message['msg'] != '') {

                    if ($message['type'] == 'ok') $message['type'] = 'success';
                    if ($message['type'] == 'error') $message['type'] = 'danger';

                    echo '<div id="' . $id . '" class="' . strtolower($class) . ' alert-' . $message['type'] . '" role="alert">';
                    echo osc_apply_filter('flash_message_text', $message['msg']);
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                } else if($message!='') {
                    echo '<div id="' . $id . '" class="' . $class . ' alert-secondary" role="alert">';
                    echo osc_apply_filter('flash_message_text', $message);
                    echo '</div>';
                } else {
                    echo '<div id="' . $id . '" class="' . $class . ' alert-secondary" style="display:none;" role="alert">';
                    echo osc_apply_filter('flash_message_text', '');
                    echo '</div>';
                }
            }
        }
        Session::newInstance()->_dropMessage($section);
    }
}

if (!function_exists('xtclass_comment_author')) {
    function xtclass_comment_author():string {
        if (osc_comment_user_id() > 0) {
           return '<a href="'.osc_user_public_profile_url(osc_comment_user_id()).'">'.osc_comment_author_name().'</a>';
        }
        return osc_comment_author_name();
    }
}

if (!function_exists('xtclass_delete')) {
    function xtclass_delete() {
        Preference::newInstance()->delete(array('s_section' => 'xtclass'));
    }
    osc_add_hook('theme_delete_xtclass', 'xtclass_delete');
}


if (!function_exists('xtclass_upload_images')) {
    /**
     * Process to upload images
     */
    function xtclass_upload_images($filename, $preference = null) {
        $package = Params::getFiles('file');
        if ($package['error'] == UPLOAD_ERR_OK) {
            if (class_exists('ImageResizer')) {
                $img = ImageResizer::fromFile($package['tmp_name']);
            }

            if (class_exists('ImageProcessing')) {
                $img = ImageProcessing::fromFile($package['tmp_name']);
            }
            
            $ext = $img->getExt();
            $logoname = $filename . '.' . $ext;
            $path = xtclass_images_uploads_path($logoname);
            //$img->saveToFile($path);
            if (move_uploaded_file($package['tmp_name'], $path)) {
                if ($preference) osc_set_preference($filename, $logoname, 'xtclass');
                osc_add_flash_ok_message(_m('The image has been uploaded correctly'), 'admin');
            } else {
                osc_add_flash_error_message(_m("An error has occurred, please try again"), 'admin');
            }
        } else {
            osc_add_flash_error_message(_m("An error has occurred, please try again"), 'admin');
        }
        ob_get_clean();
    }
}

if (!function_exists('xtclass_scss_style_path')) {
    function xtclass_scss_style_path() {
        return XTCLASS_THEME_PATH . 'scss/style.scss';
    }
}

if (!function_exists('xtclass_css_style_path')) {
    function xtclass_css_style_path($min = false) {
        if (!$min) {
            return XTCLASS_THEME_PATH . 'css/style.css';
        } else {
            return XTCLASS_THEME_PATH . 'css/style.min.css';
        }
    }
}

if (!function_exists('theme_xtclass_actions_admin')) {
    function theme_xtclass_actions_admin() {
        if (OC_ADMIN)
            switch (Params::getParam('action_specific')) {
                case 'settings':
                    osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'bender');
                    osc_set_preference('defaultShowAs@all', Params::getParam('defaultShowAs@all'), 'bender');
                    osc_set_preference('defaultShowAs@search', Params::getParam('defaultShowAs@all'));

                    osc_set_preference('slogan', trim(Params::getParam('slogan', false, false, false)), 'xtclass');
                    osc_set_preference('show_premiums_home', Params::getParam('show_premiums_home'), 'xtclass');
                    if (is_numeric(Params::getParam('num_premiums_home'))) {
                        osc_set_preference('num_premiums_home', Params::getParam('num_premiums_home'), 'xtclass');
                    }
                    osc_set_preference('defaultLocationShowAs', Params::getParam('defaultLocationShowAs'), 'bender');

                    osc_set_preference('header-728x90',         trim(Params::getParam('header-728x90', false, false, false)), 'bender');
                    osc_set_preference('homepage-728x90',       trim(Params::getParam('homepage-728x90', false, false, false)), 'bender');
                    osc_set_preference('sidebar-300x250',       trim(Params::getParam('sidebar-300x250', false, false, false)), 'bender');
                    osc_set_preference('search-results-top-728x90',     trim(Params::getParam('search-results-top-728x90', false, false, false)), 'bender');
                    osc_set_preference('search-results-middle-728x90',  trim(Params::getParam('search-results-middle-728x90', false, false, false)), 'bender');

                    //osc_set_preference('rtl', (Params::getParam('rtl') ? '1' : '0'), 'bender');

                    ob_get_clean();
                    osc_add_flash_ok_message(__('Theme settings updated correctly', XTCLASS_THEME_FOLDER), 'admin');
                    osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/'.XTCLASS_THEME_FOLDER.'/admin/settings.php'));
                    break;

                case 'upload_logo':
                    $target = Params::getParam('target'); // ie. footer-logo
                    xtclass_upload_images($target, true); // preference register
                    osc_redirect_to($_SERVER['HTTP_REFERER']);
                    break;

                case 'upload_image':
                    $target = Params::getParam('target');   // ie. 800x893-intro-bg.jpg
                    xtclass_upload_images($target);         // no preference register
                    osc_redirect_to($_SERVER['HTTP_REFERER']);
                    break;

                case 'remove_image':
                    $target = Params::getParam('target');               // ie. footer-logo or 800x893-intro-bg.jpg
                    $image  = osc_get_preference($target, 'xtclass');   // ie. footer-logo.png
                    $path   = xtclass_images_uploads_path((($image) ? $image : $target));
                    if (file_exists($path)) {
                        @unlink($path);
                        osc_delete_preference($target, 'xtclass');
                        osc_reset_preferences();
                        osc_add_flash_ok_message(__('The image has been removed', XTCLASS_THEME_FOLDER), 'admin');
                    } else {
                        osc_add_flash_error_message(__("Image not found", XTCLASS_THEME_FOLDER), 'admin');
                    }
                    ob_get_clean();
                    osc_redirect_to($_SERVER['HTTP_REFERER']);
                    break;

                case 'compile_scss':
                    $scss_content       = Params::getParam('scss', false, false, false);
                    $scss_file_path     = xtclass_scss_style_path();    // scss/style.scss
                    $css_file_path      = xtclass_css_style_path();     // css/style.css
                    $cssmin_file_path   = xtclass_css_style_path(true); // css/style.min.css

                    $error  = 0;
                    $msg    = '';

                    // Save style.scss with $scss_content
                    file_put_contents($scss_file_path, $scss_content);
                    
                    // Read style.scss with $scss_content saved
                    #$scss_content = file_get_contents($scss_file_path);

                    // Compile for style.css
                    try {
                        $scss = new Compiler();
                        //$scss->setImportPaths(XTCLASS_THEME_PATH . 'scss/');
                        $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Expanded');
                        $css_content = $scss->compile($scss_content);
                        file_put_contents($css_file_path, $css_content);
                        $msg .= __('The style.css file has been successfully modified.', XTCLASS_THEME_FOLDER)."\n";
                    } catch (\Exception $e) {
                        $error++;
                        $msg .= __('scssphp: Unable to compile content at style.css.', XTCLASS_THEME_FOLDER)."\n";
                    }

                    // Compile for style.min.css
                    try {
                        $scss = new Compiler();
                        //$scss->setImportPaths(XTCLASS_THEME_PATH . 'scss/');
                        $scss->setFormatter('ScssPhp\ScssPhp\Formatter\Crunched');
                        $cssmin_content = $scss->compile($scss_content);
                        file_put_contents($cssmin_file_path, $cssmin_content);
                        $msg .= __('The style.min.css file has been successfully modified.', XTCLASS_THEME_FOLDER)."\n";
                    } catch (\Exception $e) {
                        $error++;
                        $msg .= __('scssphp: Unable to compile content at style.min.css.', XTCLASS_THEME_FOLDER)."\n";
                    }

                    if ($error == 0) {
                        osc_add_flash_ok_message(__('Ok!', XTCLASS_THEME_FOLDER), 'admin');
                    } else {
                        osc_add_flash_error_message($msg, 'admin');
                    }
                    
                    ob_get_clean();
                    osc_redirect_to($_SERVER['HTTP_REFERER']);
                    break;
            }
    }
    osc_add_hook('init_admin', 'theme_xtclass_actions_admin');
}

osc_admin_menu_appearance(__('Navbar logo', XTCLASS_THEME_FOLDER), osc_admin_render_theme_url('oc-content/themes/'.XTCLASS_THEME_FOLDER.'/admin/navbar.php'), 'navbar_xtclass');
osc_admin_menu_appearance(__('Header images', XTCLASS_THEME_FOLDER), osc_admin_render_theme_url('oc-content/themes/'.XTCLASS_THEME_FOLDER.'/admin/header.php'), 'header_xtclass');
osc_admin_menu_appearance(__('Footer logo', XTCLASS_THEME_FOLDER), osc_admin_render_theme_url('oc-content/themes/'.XTCLASS_THEME_FOLDER.'/admin/footer.php'), 'footer_xtclass');
osc_admin_menu_appearance(__('CSS style editor', XTCLASS_THEME_FOLDER), osc_admin_render_theme_url('oc-content/themes/'.XTCLASS_THEME_FOLDER.'/admin/scss-compiler/scss-compiler.php'), 'scss-compiler_xtclass');
osc_admin_menu_appearance(__('Theme settings', XTCLASS_THEME_FOLDER), osc_admin_render_theme_url('oc-content/themes/'.XTCLASS_THEME_FOLDER.'/admin/settings.php'), 'settings_bender');