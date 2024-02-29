<?php
/**
 * Options config file
 */
/** remove redux menu under the tools **/
function arcadexls_remove_redux_menu() {
  remove_submenu_page('tools.php','redux-about');
}
add_action( 'admin_menu', 'arcadexls_remove_redux_menu', 12 );

// Deactivate News Flash
$GLOBALS['redux_notice_check'] = 1;

// This is your option name where all the Redux data is stored.
$opt_name = "arcadexlscnf";

// Add compiler filter
add_filter( 'redux/options/' . $opt_name . '/compiler', 'arcadexls_compiler_action' );

/**
 * Compile custom css settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @access  public
 * @param   array $options
 * @param   array $css
 * @param   bool $changed_values
 * @return  array
 */
function arcadexls_compiler_action( $options ) {
  $filename = get_stylesheet_directory(). '/create.css';
  global $wp_filesystem;
  if( empty( $wp_filesystem ) ) {
    require_once( ABSPATH .'/wp-admin/includes/file.php' );
    WP_Filesystem();
  }

  if($options['mt-color-body']==''){$options['mt-color-body']='#32353C';}
  if($options['mt-color-hfwtb']['from']==''){$options['mt-color-hfwtb']['from']='#555b67';}
  if($options['mt-color-hfwtb']['to']==''){$options['mt-color-hfwtb']['to']='#434650';}
  if($options['mt-color-bgco1']==''){$options['mt-color-bgco1']='#26292E';}
  if($options['mt-color-bgco2']==''){$options['mt-color-bgco2']='#fff';}
  if($options['mt-color-bgco3']==''){$options['mt-color-bgco3']='#2BA4D6';}
  if($options['mt-color-socialbtfb']==''){$options['mt-color-socialbtfb']='#4F62AE';}
  if($options['mt-color-socialbttw']==''){$options['mt-color-socialbttw']='#2396CD';}
  if($options['mt-color-socialbtgp']==''){$options['mt-color-socialbtgp']='#BE4661';}
  if($options['mt-color-socialbtyt']==''){$options['mt-color-socialbtyt']='#CE2029';}
  if($options['mt-color-signup']==''){$options['mt-color-signup']='#8CB91E';}
  if($options['mt-color-logout']==''){$options['mt-color-logout']='#EC5465';}
  if($options['mt-plbtbg']==''){$options['mt-plbtbg']='#F2C510';}
  if($options['mt-plbttxt']==''){$options['mt-plbttxt']='#AD7D0B';}
  if($options['mt-plbtsh']==''){$options['mt-plbtsh']='#FFF300';}
  if($options['mt-webkitscrollbg']==''){$options['mt-webkitscrollbg']='#E6E7EB';}
  if($options['mt-webkitscrollth']==''){$options['mt-webkitscrollth']='#F2C510';}
  if($options['mt-body-color']==''){$options['mt-body-color']='#666';}
  if($options['mt-lgbgtxt']==''){$options['mt-lgbgtxt']='#fff';}
  if($options['mt-lgbglnk']['regular']==''){$options['mt-lgbglnk']['regular']='#fff';}
  if($options['mt-lgbglnk']['hover']==''){$options['mt-lgbglnk']['hover']='#fff';}
  if($options['mt-lnkscl']['regular']==''){$options['mt-lnkscl']['hover']='#333';}
  if($options['mt-lnkscl']['hover']==''){$options['mt-lnkscl']['hover']='#2BA4D6';}
  if($options['mt-gc1']==''){$options['mt-gc1']='#fff';}
  if($options['mt-gc2']==''){$options['mt-gc2']='#F2C510';}
  if($options['mt-gc3']==''){$options['mt-gc3']='#aaa';}
  if($options['mt-frmrtfb']==''){$options['mt-frmrtfb']='#F2F3F7';}
  if($options['mt-frmftfb']==''){$options['mt-frmftfb']='#fff';}
  if($options['mt-frmftxtr']==''){$options['mt-frmftxtr']='#999';}
  if($options['mt-frmftxtrf']==''){$options['mt-frmftxtrf']='#666';}
  if($options['mt-delclnks']==''){$options['mt-delclnks']='#EC5465';}

  $css='';
  $css.='body{background-color:'.$options['mt-color-body'].';color:'.$options['mt-body-color'].'}'."\r";
  $css.='[class*="bgdg1"],.bltitl,.game_opts{background:'.$options['mt-color-hfwtb']['from'].';background:linear-gradient(to bottom,  '.$options['mt-color-hfwtb']['from'].' 0%,'.$options['mt-color-hfwtb']['to'].' 100%)}'."\r";
  $css.='[class*="bgco1"],.pstcnt header,.pstcnt .iconb-game,.wp-pagenavi a,.wp-pagenavi span,.widget_mabp_recent_games .bx-controls a,.navcom a,.navcom span,.imgcnt,.lstabs>li>a>span>strong,.gamecnt,.game_opts a:hover{background-color:'.$options['mt-color-bgco1'].'}'."\r";
  $css.='@media screen and (min-width: 1061px)
  {
  .menucn>ul>li:hover>a,.menucn ul ul{background-color: '.$options['mt-color-bgco1'].';}
  }'."\r";
  $css.='[class*="bgco2"],.bltitl.lstabs a.active,.bltitl.lstabs li.active a,#progressbar>div>span,.padder,ul#activity-stream li.activity-item{background-color:'.$options['mt-color-bgco2'].'}'."\r";
  $css.='[class*="botn"],a[class*="botn"],button,input[type="reset"],input[type="submit"],.iconb-menu:hover,.iconb-btop:hover,.widget_calendar caption,.widget_calendar tbody a,.tagcloud a:hover,.widget_display_stats dd strong,.menusr ul,.lstabs>li>a.active>span>strong,.item-list-tabs li a span,[class*="generic-button"] a,li.load-more a{background-color:'.$options['mt-color-bgco3'].'}'."\r";
  $css.='.iconb-face:hover{background-color:'.$options['mt-color-socialbtfb'].'}'."\r";
  $css.='.iconb-twit:hover{background-color:'.$options['mt-color-socialbttw'].'}'."\r";
  $css.='.iconb-goog:hover{background-color:'.$options['mt-color-socialbtgp'].'}'."\r";
  $css.='.iconb-yout:hover{background-color:'.$options['mt-color-socialbtyt'].'}'."\r";
  $css.='.botn.iconb-user{background-color:'.$options['mt-color-signup'].'}'."\r";
  $css.='.botn.iconb-lgot,[class*="botn"].logout{background-color:'.$options['mt-color-logout'].'}'."\r";
  $css.='.pstcnt .iconb-game span{background-color:'.$options['mt-plbtbg'].'}'."\r";
  $css.='.pstcnt .iconb-game:before{color: '.$options['mt-plbttxt'].';text-shadow:1px 1px 0 '.$options['mt-plbtsh'].'}'."\r";
  $css.='::-webkit-scrollbar{background-color:'.$options['mt-webkitscrollbg'].'}'."\r";
  $css.='.mCSB_draggerRail{background-color:'.$options['mt-webkitscrollbg'].'}'."\r";
  $css.='::-webkit-scrollbar-thumb{background-color:'.$options['mt-webkitscrollth'].'}'."\r";
  $css.='#progressbar>div,.mCSB_dragger_bar{background-color:'.$options['mt-webkitscrollth'].'}'."\r";
  $css.='.ft .ftxt,.brdcrm,.shrpst{color: '.$options['mt-lgbgtxt'].';}'."\r";
  $css.='.ft .ftxt a,.brdcrm a{color: '.$options['mt-lgbglnk']['regular'].';}'."\r";
  $css.='.ft .ftxt a:hover,.brdcrm a:hover{color: '.$options['mt-lgbglnk']['hover'].';}'."\r";
  $css.='a,.bltitl.lstabs a.active,.bltitl.lstabs li.active a{color:'.$options['mt-lnkscl']['regular'].'}'."\r";
  $css.='a:hover,.bltitl+ul>li>a:hover:before,#today,.widget_nav_menu a:hover:before,.lstfavgms>li:hover>a,.widget_bp_core_members_widget .item-options a.selected,code,abbr[title],.usrcmt a,.comment-reply-link:hover:before,.infcmt a:hover,.game-info footer a:hover,.lstabcn .navcom span.current,.lstabcn .navcom a:hover,.checkbox.checked .mt_input:before,.pagination-links span.current,.widget_bp_groups_widget .item-options a.selected,.picker-checkbox.checked .picker-flag:before,.activity-meta .acomment-reply:hover,.acomment-options .acomment-reply:hover{color:'.$options['mt-lnkscl']['hover'].'}'."\r";
  $css.='.hdcn,.hdcn a,.ft,.ft a,.pstcnt a,.loadcn,.sldrgmcnt,.bx-controls a,.bx-controls a.disabled:hover,.title,.brdcrm,.brdcrm a,.wp-pagenavi,.wp-pagenavi a,.bltitl,.bltitl a,.widget_calendar caption,.widget_calendar tbody a,.tagcloud a:hover,.widget_display_stats dd strong,.menusr ul a,.navcom,.navcom a,.game-brcn,.shrpst,.title-play>span a,.bltitl.lstabs a,.lstabs>li>a>span>strong,.lstabs>li>a.active>span>strong,.game_opts a,.item-list-tabs li a span,#bordeswf,[class*="botn"],a[class*="botn"],button,input[type="reset"],input[type="submit"],[class*="generic-button"] a,li.load-more a{color: '.$options['mt-gc1'].';}'."\r";
  $css.='.usrbx p+p a,.menucn>ul>li:hover>a:before,.pstcnt header h2 a:hover,.iconb-load:before,.sldr-title:before,.bx-controls a:hover,.brdcrm a:before,.wp-pagenavi a:hover,.wp-pagenavi span.current,.bltitl>span,.bltitl>h3>span,.navcom a:hover,.navcom span.current,.game-brcn :before,.shrpst :before,.title-play>span:hover,.title-play>span a:hover,.lstabs>li>a>span>strong,.game_opts a:hover{color: '.$options['mt-gc2'].';}
'."\r";
  $css.='span.activity,.widget_ratings-widget ul li,.info-ics,.infcmt,.infcmt a,.game-info footer,.game-info footer a,.srchbx input[type="text"]:focus,.widget_display_replies li div,.widget_display_topics li div,.widget_recent_entries .post-date{color: '.$options['mt-gc3'].';}
'."\r";
  $css.='input,select,textarea,.slctbx,.widget_calendar thead th,.tagcloud a,img.avatar{background-color:'.$options['mt-frmrtfb'].';border-color: '.$options['mt-frmrtfb'].';}'."\r";
  $css.='input:focus,select:focus,textarea:focus,.slctbx.focus{background-color:'.$options['mt-frmftfb'].';}'."\r";
  $css.='::-webkit-input-placeholder{color:'.$options['mt-frmftxtr'].';}'."\r";
  $css.=':-moz-placeholder{color:'.$options['mt-frmftxtr'].';}'."\r";
  $css.='::-moz-placeholder{color:'.$options['mt-frmftxtr'].';}'."\r";
      $css.=':-ms-input-placeholder{color:'.$options['mt-frmftxtr'].';}'."\r";
      $css.='input,select,textarea,.slctbx{color: '.$options['mt-frmftxtr'].';}'."\r";
  $css.='input:focus,select:focus,textarea:focus,.slctbx.focus{color:'.$options['mt-frmftxtrf'].';}'."\r";
  $css.='.modal-header .close,.logout-link,.logout,a.remove-parent,.lstfavgms>li:hover>a+a,a.button.fav, a.button.unfav,.activity-meta .delete-activity-single:hover,.acomment-options .acomment-delete:hover,.activity-meta .delete-activity:hover,.ui-icon-closethick:before{color: '.$options['mt-delclnks'].';}'."\r";
  $css.='.lstabcn .navcom a,.lstabcn .navcom span{color: #999;}'."\n";
  $css.=$options['mt-css-custom']."\n";

  if( $wp_filesystem ) {
    $wp_filesystem->put_contents( $filename, $css, FS_CHMOD_FILE );
  }
}

// Get theme settings
$theme = wp_get_theme();

$args = array(
  // TYPICAL -> Change these values as you need/desire
  'opt_name'             => $opt_name,
  // This is where your data is stored in the database and also becomes your global variable name.
  'display_name'         => $theme->get( 'Name' ),
  // Name that appears at the top of your panel
  'display_version'      => $theme->get( 'Version' ),
  // Version that appears at the top of your panel
  'menu_type'            => 'submenu',
  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
  'allow_sub_menu'       => true,
  // Show the sections below the admin menu item or not
  'menu_title'           => __( 'Theme options', 'arcadexls' ),
  'page_title'           => __( 'Theme options', 'arcadexls' ),
  // You will need to generate a Google API key to use this feature.
  // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
  'google_api_key'       => '',
  // Set it you want google fonts to update weekly. A google_api_key value is required.
  'google_update_weekly' => false,
  // Must be defined to add google fonts to the typography module
  'async_typography'     => true,
  // Use a asynchronous font on the front end or font string
  //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
  'admin_bar'            => true,
  // Show the panel pages on the admin bar
  'admin_bar_icon'       => 'dashicons-portfolio',
  // Choose an icon for the admin bar menu
  'admin_bar_priority'   => 50,
  // Choose an priority for the admin bar menu
  'global_variable'      => '',
  // Set a different name for your global variable other than the opt_name
  'dev_mode'             => false,
  /*'forced_dev_mode_off'  => true,*/
  'ajax_save'            => true,
  'allow_tracking'       => false,
  'tour'                 => false,
  // Show the time the page took to load, etc
  'update_notice'        => true,
  // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
  'customizer'           => true,
  // Enable basic customizer support
  //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
  //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

  // OPTIONAL -> Give you extra features
  'page_priority'        => null,
  // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
  'page_parent'          => 'themes.php',
  // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
  'page_permissions'     => 'manage_options',
  // Permissions needed to access the options panel.
  'menu_icon'            => '',
  // Specify a custom URL to an icon
  'last_tab'             => '',
  // Force your panel to always open to a specific tab (by id)
  'page_icon'            => 'icon-themes',
  // Icon displayed in the admin panel next to your menu_title
  'page_slug'            => 'arcadexls_options',
  // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
  'save_defaults'        => true,
  // On load save the defaults to DB before user clicks save or not
  'default_show'         => false,
  // If true, shows the default value next to each field that is not the default value.
  'default_mark'         => '',
  // What to print by the field's title if the value shown is default. Suggested: *
  'show_import_export'   => true,
  // Shows the Import/Export panel when not used as a field.

  // CAREFUL -> These options are for advanced use only
  'transient_time'       => 60 * MINUTE_IN_SECONDS,
  'output'               => true,
  // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
  'output_tag'           => true,
  // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
  'footer_credit'     => 'ArcadeXLS by <a href="http://exells.com/">Exells</a>',

  // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
  'database'             => '',
  // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
  'use_cdn'              => true,
  // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

  // HINTS
  'hints'                => array(
      'icon'          => 'el el-question-sign',
      'icon_position' => 'right',
      'icon_color'    => 'lightgray',
      'icon_size'     => 'normal',
      'tip_style'     => array(
          'color'   => 'red',
          'shadow'  => true,
          'rounded' => false,
          'style'   => 'bootstrap',
      ),
      'tip_position'  => array(
          'my' => 'top left',
          'at' => 'bottom right',
      ),
      'tip_effect'    => array(
          'show' => array(
              'effect'   => 'fade',
              'duration' => '100',
              'event'    => 'click mouseover',
          ),
          'hide' => array(
              'effect'   => 'slide',
              'duration' => '500',
              'event'    => 'click mouseleave',
          ),
      ),
  )
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args['share_icons'][] = array(
  'url'   => 'https://facebook.com/ExellsCom',
  'title' => __('Like us on Facebook', 'arcadexls'),
  'icon'  => 'el-icon-facebook'
);

$args['share_icons'][] = array(
  'url'   => 'https://twitter.com/ExellsCom',
  'title' => __('Follow us on Twitter', 'arcadexls'),
  'icon'  => 'el-icon-twitter'
);

$args['share_icons'][] = array(
  'url'   => 'https://www.youtube.com/user/ExellsCom',
  'title' => __('Visit us on YouTube', 'arcadexls'),
  'icon'  => 'el-icon-youtube'
);

// Set Arguments
Redux::setArgs( $opt_name, $args );

// General Settings
Redux::setSection( $opt_name, array(
  'title'     => __('General Settings', 'arcadexls'),
  'desc'      => __('This section customizes the global theme options.', 'arcadexls'),
  'icon'      => 'el-icon-cogs',
  'fields'    => array(
	array(
      'id'        => 'layout',
      'type'      => 'image_select',
      'compiler'  => false,
      'title'     => __('Main Layout', 'arcadexls'),
      'subtitle'  => __('Choose a sidebar position.', 'arcadexls'),
      'options'   => array(
        '1' => array('alt' => __('2 Column Left', 'arcadexls'),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
        '2' => array('alt' => __('2 Column Right', 'arcadexls'), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
        ),
      'default'   => '2'
    ),
   array(
      'id'=>'sticky-sidebar',
      'type' => 'switch',
      'title' => __('Sticky Sidebars', 'arcadexls'),
      'subtitle'=> __('Enable this option to make your sidebars sticky.', 'arcadexls'),
      'desc' => __('This allows the sidebars to flow down the screen when you scroll down on a page.', 'arcadexls'),
      "default" => 0,
    ),
  array(
      'id'=>'lazy_load',
      'type' => 'switch',
      'title' => __('Lazy Load', 'arcadexls'),
      'subtitle'=> __('If enabled, this option will delay loading of images. Images outside the viewport are not loaded until user scolls to them.', 'arcadexls'),
      'desc' => __('This can greatly improve the performance of your website.', 'arcadexls'),
      "default" => 1,
    ),
  array(
      'id'=>'lazy_load_animation',
      'type' => 'switch',
      'title' => __('Lazy Load Animation', 'arcadexls'),
      'subtitle'=> __('If enabled, an image loading animation will be displayed during the loading.', 'arcadexls'),
      "default" => 0,
    ),
    array(
      'id'=>'blogcat',
      'type' => 'select',
      'data' => 'categories',
      'multi' => true,
      'title' => __('Blog category', 'arcadexls'),
      'desc' => __('Select a category that should be used as the regular blog.', 'arcadexls'),
    ),

  )
));

// Header & Footer
Redux::setSection( $opt_name, array(
  'title'     => __('Header & Footer', 'arcadexls'),
  'icon'      => 'el-icon-website',
  'fields'    => array(
   array(
      'id'=>'logohd',
      'type' => 'media',
      'preview'=> false,
      'title' => __('Custom Logo', 'arcadexls'),
      'desc'=> __('Upload to your logo.', 'arcadexls'),
      'default'  => array(
        'url'=> get_template_directory_uri().'/img/arcadexls.png',
      ),
    ),
    array(
      'id'=>'logologin',
      'type' => 'media',
      'preview'=> false,
      'title' => __('Login Logo', 'arcadexls'),
      'desc'=> __('Upload a logo for your login page.', 'arcadexls'),
      'default'  => array(
        'url'=> get_template_directory_uri().'/img/arcadexls.png',
      ),
    ),
   array(
      'id'=>'favicon',
      'type' => 'media',
      'title' => __('Custom Favicon', 'arcadexls'),
      'desc'=> __('Upload to your favicon.', 'arcadexls'),
    ),
  array(
      'id'=>'show_loginform',
      'type' => 'switch',
      'title' => __('Show LoginForm', 'arcadexls'),
      'subtitle'=> __('Enable this option if you want to activate login form in header.', 'arcadexls'),
      "default" => 1,
      "desc" => ''
    ),
   array(
      'id'=>'slider-header',
      'type' => 'switch',
      'title' => __('Slider Settings', 'arcadexls'),
      'subtitle'=> __('Header', 'arcadexls'),
      'desc' => __('Enable or disable the slider.', 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
   array(
      'id'=>'categories-sliderhd',
      'type' => 'select',
      'data' => 'categories',
      'multi' => true,
      'empty' => true,
      'title' => __('Categories', 'arcadexls'),
      'desc' => __('Select game categories that should be displayed on the slider.', 'arcadexls'),
      'required' => array('slider-header','equals','1'),
    ),
   array(
      'id'=>'sortable-sliderhd',
      'type' => 'spinner',
      'title' => __('Game Count', 'arcadexls'),
      'desc' => __('Set how many games should be displayed on the slider. (Default: 20)', 'arcadexls'),
      'default' => "20",
      "min"     => "3",
      "step"    => "1",
      "max"     => "50",
      'required' => array('slider-header','equals','1'),
    ),
   array(
      'id'=>'slider-footer',
      'type' => 'switch',
      'title' => __('Slider Settings', 'arcadexls'),
      'subtitle'=> __('Footer', 'arcadexls'),
      'desc' => __('Enable or disable the slider.', 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
   array(
      'id'=>'categories-sliderft',
      'type' => 'select',
      'data' => 'categories',
      'multi' => true,
      'empty' => true,
      'title' => __('Categories', 'arcadexls'),
      'desc' => __('Select game categories that should be displayed on the slider.', 'arcadexls'),
      'required' => array('slider-footer','equals','1'),
    ),
   array(
      'id'=>'sortable-sliderft',
      'type' => 'spinner',
      'title' => __('Game Count', 'arcadexls'),
      'desc' => __('Set how many games should be displayed on the slider. (Default: 20)', 'arcadexls'),
      'default' => "20",
      "min"     => "3",
      "step"    => "1",
      "max"     => "50",
      'required' => array('slider-footer','equals','1'),
    ),
    array(
      'id' => 'footer_copyright',
      'type' => 'text',
      'title' => __('Footer Copyright', 'arcadexls'),
      'hint' => array(
        'title' => __('Footer Copyright', 'arcadexls'),
        'content' => __("Here you can customize the copyright message displayed in the footer.", 'arcadexls'),
      ),
      'default' => sprintf( __('Powered by %sMyArcadePlugin%s', 'arcadexls'), '<a target="_blank" href="http://myarcadeplugin.com/" title="WordPress Arcade" itemprop="url">', '</a>' )
    ),
    array(
      'id'=>'custom_header_code',
      'type' => 'textarea',
      'title' => __('Custom Header Code', 'arcadexls'),
      'subtitle' => __('Enter special code. ( e.g.: Mochi Verification).', 'arcadexls'),
      'default' => ''
    ),
    array(
      'id'=>'custom_footer_code',
      'type' => 'textarea',
      'title' => __('Custom Footer Code', 'arcadexls'),
      'subtitle' => __('Enter special code ( e.g.: Google Analytics).', 'arcadexls'),
      'default' => ''
    ),
  )
));
// Game Page
Redux::setSection( $opt_name, array(
  'title'     => __('Game Page', 'arcadexls'),
  'desc'      => sprintf( __('%sThis section customizes the game presentation and play page of your site.%s', 'arcadexls'), '<p class="description">', '</p>'),
  'icon'      => 'el-icon-eye-open',
  'fields'    => array(
    array(
      'id'=>'pregame-page',
      'type' => 'switch',
      'title' => __('Pre-Game Page', 'arcadexls'),
      'desc'=> __('Enable this if you want to display a pre-game / game landing page. User will need to click on a play button.', 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
    array(
      'id'=>'game-play-permalink-endpoint',
      'type' => 'text',
      'title' => __('Game Play Permalink Endpoint', 'arcadexls'),
      'subtitle' => __("Define the permalink endpoint for the game play page.", 'arcadexls'),
      'desc' => sprintf( __('When you change this then you MUST visit the %sPermalinks Settings%s page once!', 'arcadexls'), '<a target="_blank" href="'.get_option('home').'/wp-admin/options-permalink.php">', '</a>'),
      'default' => 'play',
      'required' => array('pregame-page','equals','1'),
    ),
    array(
      'id'=>'game-embed-box',
      'type' => 'switch',
      'title' => __('Game Embed Box', 'arcadexls'),
      'desc'=> __("Enable or disable the game embed box ('Embed this game on your site..').", 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
    array(
      'id'=>'display-game-screen-shots',
      'type' => 'switch',
      'title' => __('Display Game Screen Shots', 'arcadexls'),
      'desc'=> __("Enable this if you want to display game screenshots on single game pages (only when available)", 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
    array(
      'id'=>'display-game-video',
      'type' => 'switch',
      'title' => __('Display Game Video', 'arcadexls'),
      'desc'=> __("Enable this if you want to display game video on single game pages (only when available)", 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
    array(
      'id'=>'fullscreen-button',
      'type' => 'switch',
      'title' => __('Fullscreen Button', 'arcadexls'),
      'desc'=> __("Enable this if you want to display the fullscreen button.", 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
    array(
      'id'=>'lights-button',
      'type' => 'switch',
      'title' => __('Lights On / Off Button', 'arcadexls'),
      'desc'=> __("Enable this if you want to display the lights button.", 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
    array(
      'id'=>'favorite-button',
      'type' => 'switch',
      'title' => __('Favorite Button', 'arcadexls'),
      'desc'=> __("Enable this if you want to display the favorite button.", 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
    array(
      'id'=>'report-button',
      'type' => 'switch',
      'title' => __('Report Button', 'arcadexls'),
      'desc'=> __("Enable this if you want to report button.", 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
    array(
      'id'=>'progress-bar',
      'type' => 'switch',
      'title' => __('Progress Bar', 'arcadexls'),
      'desc'=> __("Enable or disable the progress bar.", 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
  )
));

// Advertisements
Redux::setSection( $opt_name, array(
  'icon'      => 'el-icon-list-alt',
  'title'     => __('Advertisement Banner', 'arcadexls'),
  'fields'    => array(
    array(
      'id'=>'mtheaderbanner-switch',
      'type' => 'switch',
      'title' => __('Show Header Banner', 'arcadexls'),
      'subtitle'=> __('Enable or disable the Header Banner Ad', 'arcadexls'),
      'on' => 'Enabled',
      'off' => 'Disabled',
      'default' => 1
    ),
    array(
      'id'=>'mtheaderbanner',
      'type' => 'textarea',
      'title' => __('Header Banner', 'arcadexls'),
      'subtitle' => __('Put your code for 728x90 banner here.', 'arcadexls'),
      'default' => '<img src="'.get_template_directory_uri().'/img/cnt/bnr728.png" alt="bnr">',
    ),
    array(
      'id'=>'mtlastlbanner-switch',
      'type' => 'switch',
      'title' => __('Show Latest Games Banner Left', 'arcadexls'),
      'subtitle'=> __('Enable or disable the Latest Games Banner Left Ad', 'arcadexls'),
      'on' => 'Enabled',
      'off' => 'Disabled',
      'default' => 1
    ),
    array(
      'id'=>'mtlastlbanner',
      'type' => 'textarea',
      'title' => __('Latest Games Banner Left', 'arcadexls'),
      'subtitle' => __('Put your code for 300x250 banner here.', 'arcadexls'),
      'default' => '<img src="'.get_template_directory_uri().'/img/cnt/bnr300.png" alt="bnr">',
    ),
    array(
      'id'=>'mtpregamebanner-switch',
      'type' => 'switch',
      'title' => __('Show Pre-Game Banner', 'arcadexls'),
      'subtitle'=> __('Enable or disable the Pre-Game Banner Ad', 'arcadexls'),
      'on' => 'Enabled',
      'off' => 'Disabled',
      'default' => 1
    ),
    array(
      'id'=>'mtpregamebanner',
      'type' => 'textarea',
      'title' => __('Pre-Game Banner', 'arcadexls'),
      'subtitle' => __('Put your code for 200x200 banner here.', 'arcadexls'),
      'default' => '<img src="'.get_template_directory_uri().'/img/cnt/bnr200.png" alt="bnr">',
    ),
    array(
      'id'=>'mtgameprebanner-switch',
      'type' => 'switch',
      'title' => __('Show Game Preloader Banner', 'arcadexls'),
      'subtitle'=> __('Enable or disable the Game Preloader Banner Ad', 'arcadexls'),
      'on' => 'Enabled',
      'off' => 'Disabled',
      'default' => 1
    ),
    array(
      'id'=>'mtgameprebanner',
      'type' => 'textarea',
      'title' => __('Game Preloader Banner', 'arcadexls'),
      'subtitle' => __('Put your advertisement code for the game preloader here.', 'arcadexls'),
      'default' => '<img src="'.get_template_directory_uri().'/img/cnt/bnr300.png" alt="bnr">',
    ),
    array(
      'id'=>'mtfooterbanner-switch',
      'type' => 'switch',
      'title' => __('Show Footer Banner', 'arcadexls'),
      'subtitle'=> __('Enable or disable the Footer Banner Ad', 'arcadexls'),
      'on' => 'Enabled',
      'off' => 'Disabled',
      'default' => 1
    ),
    array(
      'id'=>'mtfooterbanner',
      'type' => 'textarea',
      'title' => __('Footer Banner', 'arcadexls'),
      'subtitle' => __('Put your code for 728x90 banner here.', 'arcadexls'),
      'default' => '<img src="'.get_template_directory_uri().'/img/cnt/bnr728.png" alt="bnr">',
    ),
  )
));

// Mobile Options
Redux::setSection( $opt_name, array(
  'icon'      => 'el-icon-view-mode',
  'title'     => __('Mobile Options', 'arcadexls'),
  'desc'      => sprintf( __('%sThis section allows you to set the theme behavior for mobile devices.%s', 'arcadexls'), '<p class="description">', '</p>'),
  'fields'    => array(
    array(
      'id' => 'mobile',
      'type' => 'switch',
      'title' => __('Mobile Games', 'arcadexls'),
      'hint' => array(
        'title' => __("Mobile games for mobile devices", 'arcadexls'),
        'content' => __("If enabled, only games that are tagged with 'mobile' will be displayed if a mobile device has been detected. Otherwise all game types will be displayed for all devices.", 'arcadexls' )
      ),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),
   array(
      'id' => 'mobile_sidebar',
      'type' => 'switch',
      'title' => __('Hide Sidebar', 'arcadexls'),
      'hint' => array(
        'title' => __("Hide Sidebar On Mobile", 'arcadexls'),
        'content' => __("If enabled the sidebar will be hidden on mobile devices. This can improve load time and user experience on mobile devices.", 'arcadexls' )
      ),
      "default" => 0,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),

    array(
      'id' => 'mobile_header_slider',
      'type' => 'switch',
      'title' => __('Hide Header Slider', 'arcadexls'),
      'hint' => array(
        'title' => __("Hide Header Slider Sidebar On Mobile", 'arcadexls'),
        'content' => __("If enabled the header slider will be hidden on mobile devices. This can improve load time and user experience on mobile devices.", 'arcadexls' )
      ),
      "default" => 0,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),

    array(
      'id' => 'mobile_footer_slider',
      'type' => 'switch',
      'title' => __('Hide Footer Slider', 'arcadexls'),
      'hint' => array(
        'title' => __("Hide Footer Slider Sidebar On Mobile", 'arcadexls'),
        'content' => __("If enabled the footer slider will be hidden on mobile devices. This can improve load time and user experience on mobile devices.", 'arcadexls' )
      ),
      "default" => 0,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
    ),

  )
));

// Styling Options
Redux::setSection( $opt_name, array(
  'icon'      => 'el-icon-brush',
  'title'     => __('Styling Options', 'arcadexls'),
  'fields'    => array(
    array(
      'id'        => 'mt-select-stylesheet',
      'type'      => 'select',
      'title'     => __('Theme Stylesheet', 'arcadexls'),
      'subtitle'  => __('Select your themes alternative color scheme.', 'arcadexls'),
      'options'   => array(1 => __('Default', 'arcadexls'), 2 => __('Earth', 'arcadexls'), 3 => __('Light', 'arcadexls')),
      'default'   => 1,
      'desc' => __('For everything to work properly with the chosen color, off Custom CSS', 'arcadexls')
    ),
    array(
      'id'        => 'mt-choose-size',
      'type'      => 'select',
      'title'     => __('Choose Size', 'arcadexls'),
      'options'   => array(1 => __('Full Size', 'arcadexls'), 2 => __('Boxed', 'arcadexls')),
      'default'   => 1,
    ),
    array(
      'id'        => 'toolbar-color',
      'type'      => 'color',
      'compiler'  => false,
      'title'     => __('Toolbar Color', 'arcadexls'),
      'subtitle'  => __('Choose the toolbar color for mobile devices.', 'arcadexls'),
      'transparent' => false,
      'default'  => '#555b67',
    ),
    array(
      'id'=>'responsiveness',
      'type' => 'switch',
      'title' => __('Responsiveness', 'arcadexls'),
      'subtitle'=> __('Enable this option if you want to activate responsiveness.', 'arcadexls'),
      "default" => 1,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls')
    ),
    array(
      'id'=>'custom-css-status',
      'type' => 'switch',
      'title' => __('Custom CSS', 'arcadexls'),
      'subtitle'=> __('Enable this option if you want to activate custom css.', 'arcadexls'),
      "default" => 0,
      'on' => __('Enabled', 'arcadexls'),
      'off' => __('Disabled', 'arcadexls'),
      'desc' => __('Use the default style for customization', 'arcadexls')
    ),
    array(
      'id'        => 'mt-color-body',
      'type'      => 'color',
      'compiler' => array(''),
      'title'     => __('Body Background', 'arcadexls'),
      'subtitle'  => __('Choose a background (default: #32353C).', 'arcadexls'),
      'transparent' => false,
      'default'  => '#32353C',
      'required' => array('custom-css-status','equals','1'),
    ),
    array(
      'id'       => 'mt-color-hfwtb',
      'type'     => 'color_gradient',
      'compiler' => array(''),
      'title'    => __('Header/Footer/Widget Title Background', 'arcadexls'),
      'subtitle' => __('Choose a background (default: #555b67/#434650)', 'arcadexls'),
      'validate' => 'color',
      'transparent' => false,
      'default'  => array(
        'from' => '#555b67',
        'to'   => '#434650',
      ),
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-bgco1',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Background General 1', 'arcadexls'),
      'subtitle'  => __('Small Buttons/Headers (default: #26292E)', 'arcadexls'),
      'default'  => '#26292E',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-bgco2',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Background General 2', 'arcadexls'),
      'subtitle'  => __('Background content (default: #fff)', 'arcadexls'),
      'default'  => '#fff',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-bgco3',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Background General 3', 'arcadexls'),
      'subtitle'  => __('Buttons/Links (default: #2BA4D6)', 'arcadexls'),
      'default'  => '#2BA4D6',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-socialbtfb',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Background - Social Buttons', 'arcadexls'),
      'subtitle'  => __('Facebook (default: #4F62AE)', 'arcadexls'),
      'default'  => '#4F62AE',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-socialbttw',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Background - Social Buttons', 'arcadexls'),
      'subtitle'  => __('Twitter (default: #2396CD)', 'arcadexls'),
      'default'  => '#2396CD',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-socialbtgp',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Background - Social Buttons', 'arcadexls'),
      'subtitle'  => __('Google + (default: #BE4661)', 'arcadexls'),
      'default'  => '#BE4661',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-socialbtyt',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Background - Social Buttons', 'arcadexls'),
      'subtitle'  => __('Youtube (default: #CE2029)', 'arcadexls'),
      'default'  => '#CE2029',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-signup',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Button Header Signup', 'arcadexls'),
      'subtitle'  => __('Choose a background for Signup button (default: #8CB91E)', 'arcadexls'),
      'default'  => '#8CB91E',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-color-logout',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Buttons Header Logout', 'arcadexls'),
      'subtitle'  => __('Choose a background for Logout button (default: #EC5465)', 'arcadexls'),
      'default'  => '#EC5465',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-plbtbg',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Play Botton Background', 'arcadexls'),
      'subtitle'  => __('Background (default: #F2C510)', 'arcadexls'),
      'default'  => '#F2C510',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-plbttxt',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Play Botton Text', 'arcadexls'),
      'subtitle'  => __('Text (default: #AD7D0B)', 'arcadexls'),
      'default'  => '#AD7D0B',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-plbtsh',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Play Botton Text Shadow', 'arcadexls'),
      'subtitle'  => __('Text (default: #FFF300)', 'arcadexls'),
      'default'  => '#FFF300',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-webkitscrollbg',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Customizing Browser Scroll Bar', 'arcadexls'),
      'subtitle'  => __('Background (default: #E6E7EB)', 'arcadexls'),
      'default'  => '#E6E7EB',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-webkitscrollth',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Customizing Browser Scroll Bar', 'arcadexls'),
      'subtitle'  => __('Thumb (default: #F2C510)', 'arcadexls'),
      'default'  => '#F2C510',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-body-color',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Body Text Color', 'arcadexls'),
      'subtitle'  => __('Choose a color (default: #666)', 'arcadexls'),
      'default'  => '#666',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-lgbgtxt',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Light background? (Text)', 'arcadexls'),
      'subtitle'  => __('Fix the color of the header & footer if you apply a light background (For example: #fff, #eee, etc...) in your theme. (Default: #fff)', 'arcadexls'),
      'default'  => '#fff',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'=>'mt-lgbglnk',
      'type' => 'link_color',
      'compiler'    => array(''),
      'title' => __('Light background? (Links)', 'arcadexls'),
      'subtitle' => __('Fix the color of the header & footer if you apply a light background (For example: #fff, #eee, etc...) in your theme. (Default: #fff)', 'arcadexls'),
      'active' => false,
      'default' => array(
        'regular' => '#fff',
        'hover' => '#fff',
        ),
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'=>'mt-lnkscl',
      'type' => 'link_color',
      'compiler'    => array(''),
      'title' => __('Links Color', 'arcadexls'),
      'subtitle' => __('Pick a color for links (Default: Regular #333333 / Hover #23A96E)', 'arcadexls'),
      'active' => false,
      'default' => array(
        'regular' => '#333',
        'hover' => '#2BA4D6',
        ),
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-gc1',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('General Color 1', 'arcadexls'),
      'subtitle'  => __('Header/Footer text & links (default: #fff)', 'arcadexls'),
      'default'  => '#fff',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-gc2',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('General Color 2', 'arcadexls'),
      'subtitle'  => __('Small Buttons (default: #F2C510)', 'arcadexls'),
      'default'  => '#F2C510',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-gc3',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('General Color 3', 'arcadexls'),
      'subtitle'  => __('Small text (post info) (Default: #aaa)', 'arcadexls'),
      'default'  => '#aaa',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-frmrtfb',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Forms: Regular Background Fields', 'arcadexls'),
      'subtitle'  => __('BACKGROUND (Default: #F2F3F7)', 'arcadexls'),
      'default'  => '#F2F3F7',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-frmftfb',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Forms: Focus Background Fields', 'arcadexls'),
      'subtitle'  => __('Background (Default: #fff)', 'arcadexls'),
      'default'  => '#fff',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-frmftxtr',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Forms: Regular Text Fields', 'arcadexls'),
      'subtitle'  => __('Text (Default: #999)', 'arcadexls'),
      'default'  => '#999',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-frmftxtrf',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Forms: Focus Text Fields', 'arcadexls'),
      'subtitle'  => __('BACKGROUND (Default: #666)', 'arcadexls'),
      'default'  => '#666',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-delclnks',
      'type'      => 'color',
      'compiler'    => array(''),
      'title'     => __('Delete/Close Links', 'arcadexls'),
      'subtitle'  => __('Choose a color (default: #EC5465)', 'arcadexls'),
      'default'  => '#EC5465',
      'transparent' => false,
      'required' => array('custom-css-status','equals','1')
    ),
    array(
      'id'        => 'mt-css-custom',
      'type'      => 'ace_editor',
      'title'     => __('Custom CSS', 'arcadexls'),
      'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'arcadexls'),
      'mode'      => 'css',
      'theme'     => 'monokai',
      'default'   => "",
      'compiler' => array('')
    ),

  )
));

// Social Networks
Redux::setSection( $opt_name, array(
  'icon'      => 'el-icon-link',
  'title'     => __('Social Networking', 'arcadexls'),
  'fields'    => array(
   array(
      'id'=>'mtfacebook',
      'type' => 'text',
      'title' => __('Facebook', 'arcadexls'),
      'default' => '#',
    ),
    array(
      'id'=>'mttwitter',
      'type' => 'text',
      'title' => __('Twitter', 'arcadexls'),
      'default' => '#',
    ),
    array(
      'id'=>'mtyoutube',
      'type' => 'text',
      'title' => __('Youtube', 'arcadexls'),
      'default' => '',
    ),
    array(
      'id'=>'mtgoogleplus',
      'type' => 'text',
      'title' => __('Google Plus', 'arcadexls'),
      'default' => '',
    ),
    array(
      'id'=>'mttumblr',
      'type' => 'text',
      'title' => __('Tumblr', 'arcadexls'),
      'default' => '',
    ),
   array(
      'id'=>'mtreddit',
      'type' => 'text',
      'title' => __('Reddit', 'arcadexls'),
      'default' => '',
    ),
   array(
      'id'=>'mtinstagram',
      'type' => 'text',
      'title' => __('Instagram', 'arcadexls'),
      'default' => '#',
    ),
   array(
      'id'=>'mtpinterest',
      'type' => 'text',
      'title' => __('Pinterest', 'arcadexls'),
      'default' => '',
    ),
   array(
      'id'=>'mtvimeo',
      'type' => 'text',
      'title' => __('Vimeo', 'arcadexls'),
      'default' => '',
    ),
   array(
      'id'=>'mtweibo',
      'type' => 'text',
      'title' => __('Weibo', 'arcadexls'),
      'default' => '',
    ),
   array(
      'id'=>'mtfeed',
      'type' => 'text',
      'title' => __('Feed', 'arcadexls'),
      'default' => get_bloginfo('rss2_url'),
    ),
  )
));