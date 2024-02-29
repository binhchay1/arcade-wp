<?php
/**
 * Arcadexls
 *
 * @package WordPress
 * @subpackage ArcadeXLS
 */

/** Include option panel **/
if ( is_admin() ) {
  if ( class_exists( 'Redux' ) ) {
    include_once( get_template_directory() . '/inc/admin/config.php' );
  }

  /** Include TGM Plugin Activation **/
  include_once ( get_template_directory() . '/inc/admin/plugins/plugins.php' );
}

/** Include paginate ajax scroll **/
include_once( get_template_directory() . '/inc/mt_paginateajax.php' );
/** Include setup theme **/
include_once( get_template_directory() . '/inc/setup.php' );
/** Include theme actions API **/
include_once( get_template_directory() . '/inc/actions.php' );
/** Include MyArcadePlugin Theme API **/
include_once( get_template_directory() . '/inc/myarcade_api.php' );
/** Include MyarcadePlugin template redirect **/
include_once( get_template_directory() . '/inc/template_redirect.php' );
/** Include custom widgets **/
include_once( get_template_directory() . '/inc/myabp_widgets.php' );
/** Include account **/
include_once( get_template_directory() . '/inc/ajax_account.php' );
/** Include buttons social **/
include_once( get_template_directory() . '/inc/buttons_social.php' );

if ( !is_admin() ) {
  add_action('wp_print_scripts', 'arcadexls_scripts_init');
  add_action('wp_print_styles',  'arcadexls_stylesheet_init');
}

function arcadexls_clean_notice() {
  if ( ! class_exists( 'Redux' ) && is_admin() ) {
    // Delete tgmpa dissmiss flag
    delete_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_arcadexls' );
  }
}
add_action( 'init', 'arcadexls_clean_notice' );

function arcadexls_scripts_init() {

  $path_to_theme = get_template_directory_uri();

  if ( !is_admin() ) {
    wp_enqueue_script('jquery');

    wp_enqueue_script('mt-bootstrap', $path_to_theme.'/js/bootstrap.js',array('jquery'));
    wp_enqueue_script('mt-chkbox', $path_to_theme.'/js/chkbox.js',array('jquery'));
    wp_enqueue_script('mt-fileup', $path_to_theme.'/js/fileup.js',array('jquery'));
    wp_enqueue_script('mt-bxsldr', $path_to_theme.'/js/bxsldr.js',array('jquery'));

  if ( arcadexls_get_option( 'lazy_load', 1 ) ) {
    wp_enqueue_script( 'arcadexls-lazy-load', get_template_directory_uri() . '/js/echo.min.js', array('jquery'), '', true );
  }
  if ( arcadexls_get_option( 'sticky_sidebar', 1 ) ) {
    wp_enqueue_script( 'arcadexls-sticky-sidebar', get_template_directory_uri() . '/js/sticky-sidebar.js', array('jquery'), '', true );
  }
  if( function_exists('is_game') && is_game() && is_single() ) {
    if(arcadexls_get_option('progress-bar', 1)=='1'){
      wp_enqueue_script('mt-progrs', $path_to_theme.'/js/progrs.js', array('jquery'));
    }
      wp_enqueue_script('mt-fitvids', $path_to_theme.'/js/fitvids.js', array('jquery'));
      $myvars = array(
        'file' => $path_to_theme.'/js/pagecomments.js',
      );
      wp_enqueue_script('pagecomments', $path_to_theme.'/js/pagecomments.js',array('jquery'));
      wp_localize_script('pagecomments', 'PagecommentsAjax', $myvars );
      wp_enqueue_script('mt-scroll', $path_to_theme.'/js/scrlbr.js',array('jquery'));
      wp_enqueue_script('mt-turn', $path_to_theme.'/js/turn.js',array('jquery'));
      wp_deregister_script('wp-favroite-posts');
      wp_enqueue_script('mt-fav', $path_to_theme.'/js/fav.js',array('jquery'));
  }
  if (is_singular() && comments_open() && get_option('thread_comments') ){
    wp_enqueue_script( 'comment-reply' );
  }
  }
}

function arcadexls_stylesheet_init() {
  wp_enqueue_style( 'arcadexls-style', get_stylesheet_uri() );
  $path_to_theme = get_template_directory_uri();
  if(arcadexls_get_option('mt-select-stylesheet', 1)==2){
    wp_register_style('mt-earth', $path_to_theme.'/css/earth.css');
    wp_enqueue_style( 'mt-earth');
  }elseif(arcadexls_get_option('mt-select-stylesheet', 1)==3){
    wp_register_style('mt-light', $path_to_theme.'/css/light.css');
    wp_enqueue_style( 'mt-light');
  }elseif(arcadexls_get_option('custom-css-status') !=1 ){
    wp_register_style('mt-colors', $path_to_theme.'/css/colors.css');
    wp_enqueue_style( 'mt-colors');
  }
  if(arcadexls_get_option('custom-css-status')==1){
    wp_register_style('mt-create', $path_to_theme.'/create.css');
    wp_enqueue_style( 'mt-create');
  }

  if(arcadexls_get_option('responsiveness', 1)==1){
    wp_register_style('mt-rsp', $path_to_theme.'/css/rsp.css');
    wp_enqueue_style( 'mt-rsp');
  }
  else{
    wp_register_style('mt-norsp', $path_to_theme.'/css/norsp.css');
    wp_enqueue_style( 'mt-norsp');
  }
  wp_register_style('mt-pnt', $path_to_theme.'/css/pnt.css');
  wp_enqueue_style( 'mt-pnt');
  wp_register_style('fontawesome', $path_to_theme.'/css/fa.css');
  wp_enqueue_style( 'fontawesome');
  wp_register_style('mt-opensans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700');
  wp_enqueue_style( 'mt-opensans');
}

function mt_paginacion($tipo=1,$class=NULL,$qc=NULL){
  global $wp_query,$paged;

  if($qc==''){$total=$wp_query->max_num_pages;}else{$total=$qc;}
  if($tipo==1){
    $paginacion=paginate_links( array(
      'base' => str_replace(999999999, '%#%', esc_url( get_pagenum_link(999999999) ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, $paged ),
      'total' => $total,
      'mid_size' => 3,
      'prev_next' => true
    ) );
  }else{
    $paginacion=paginate_comments_links( array('prev_next' => true,'echo' => false) );
  }
  if(!empty($paginacion))echo'<div class="mt-pagnav wp-pagenavi'.$class.'">'.$paginacion.'</div>';
}

function mt_pagination(){
  if(arcadexls_get_option('mt-choose-size', 1)==2){
    if(function_exists('wp_pagenavi')) { wp_pagenavi(); }else{ mt_paginacion(); }
  }else{
    echo '<div style="display:none;" class="wp-pagenavi">'.get_next_posts_link(__('LOADING MORE GAMES...', 'arcadexls')).'</div>';
  }
}

function arcadexls_sidebar($type){
  if(arcadexls_get_option('layout', 2)==2 and $type==1){
    return 'flol';
  }elseif(arcadexls_get_option('layout', 2)==2 and $type==2){
    return 'flor';
  }elseif(arcadexls_get_option('layout', 2)==1 and $type==1){
    return 'flor';
  }elseif(arcadexls_get_option('layout', 2)==1 and $type==2){
    return 'flol';
  }
}

function arcadexls_content(){
  $content = apply_filters('the_content', get_the_content());
  $content = preg_replace("/<img[^>]+\>/i", "", $content);
  return $content;
}

if(function_exists('the_ratings')) {
  function mt_the_ratings_results($post_id, $new_user = 0, $new_score = 0, $new_average = 0) {
    if($new_user == 0 && $new_score == 0 && $new_average == 0) {
      $post_ratings_data = null;
    } else {
      $post_ratings_data = new stdClass();
      $post_ratings_data->ratings_users = $new_user;
      $post_ratings_data->ratings_score = $new_score;
      $post_ratings_data->ratings_average = $new_average;
    }
    // Return Post Ratings Template
    return expand_ratings_template('%RATINGS_IMAGES%', $post_id, $post_ratings_data);
  }
}

/**
 * Display related or random games
 */
function arcadexls_related($tipo=1) {
  if($tipo==1){
  echo '
              <!--<More_games>-->
              <section class="blkcnt bgco2">
                  <div class="bltitl">'.__('More games', 'arcadexls').'</div>
                  <div class="blcnbx scrlbr">
                      <!--<pstgms>-->
                      <ul class="pstgms lstli">
  ';
  }
  if ( function_exists('related_entries') ) {
  echo str_replace('</div>','',str_replace("<div class='yarpp-related'>",'',related_entries($args = array(), $reference_ID = false, $echo = false)));
  } else {
  get_template_part('games', 'random');
  }
  if($tipo==1){
    echo'
                      </ul>
          <!--</pstgms>-->
                  </div>
              </section>
              <!--</More_games>-->
    ';
  }
}


function arcadexls_default_menu() {
  wp_list_categories('sort_column=name&title_li=&depth=1&number=5');
}

class arcadexls_walker_nav_menu extends Walker_Nav_Menu {

  // add classes to ul sub-menus
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
      'sub-menu',
      ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
      ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
      'menu-depth-' . $display_depth
      );
    $class_names = implode( ' ', $classes );

    // build html
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
  }

  // add main/sub classes to li's and links
   function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

    // depth dependent classes
    $depth_classes = array(
      ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
      ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
      ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
      'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '" itemprop="name">';

    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

    $attributes .=' itemprop="url" ';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
      $args->before,
      $attributes,
      $args->link_before,
      apply_filters( 'the_title', $item->title, $item->ID ),
      $args->link_after,
      $args->after
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

add_filter('avatar_defaults', 'mt_gravatar');
function mt_gravatar ($avatar_defaults) {
  $myavatar = get_bloginfo('template_directory').'/img/user_img.png';
  $avatar_defaults[$myavatar] = __('Avatar ArcadeXLS', 'arcadexls');
  return $avatar_defaults;
}

function arcadexls_breadcumb($type=NULL) {
  if ( is_home() || is_front_page() )
  return;

  if(is_single() and $type!=1){
    return '
          <section class="navshr clfl">
            <nav class="brdcrm flol">
      <a title="'.__('Home', 'arcadexls').'" href="'.esc_url( home_url( '/' ) ).'" class="iconb-home">'.__('Home', 'arcadexls').'</a> <span>/</span> <strong>'.get_the_category_list(', ','',get_the_ID()).'</strong> <span>/</span> <strong>'.get_the_title(get_the_ID()).'</strong>
              </nav>
          </section>
    ';
  }elseif(is_single() and $type==1){
    return '
          <section class="navshr clfl">
            <nav class="brdcrm flol">
      <a title="'.__('Home', 'arcadexls').'" href="'.esc_url( home_url( '/' ) ).'" class="iconb-home">'.__('Home', 'arcadexls').'</a> <span>/</span> <strong>'.get_the_category_list(', ','',get_the_ID()).'</strong> <span>/</span> <strong>'.get_the_title(get_the_ID()).'</strong>
              </nav>
              <ul class="shrpst lstli flor">
                <li><span class="iconb-hert">'.sprintf( __('%sSHARE%s THIS GAME:', 'arcadexls'), '<strong>', '</strong>').'</span></li>
                <li><div class="fb-like" data-href="'.get_permalink().'" data-width="123" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
                  <li><a href="//twitter.com/share" class="twitter-share-button" data-url="'.get_permalink().'" data-lang="en">'.__('Twittear', 'arcadexls').'</a></li>
              </ul>
          </section>
    ';
  }elseif(is_page()){
    return '
          <section class="navshr clfl">
            <nav class="brdcrm flol">
      <a title="'.__('Home', 'arcadexls').'" href="'.esc_url( home_url( '/' ) ).'" class="iconb-home">'.__('Home', 'arcadexls').'</a> <span>/</span> <strong>'.get_the_title(get_the_ID()).'</strong>
              </nav>
          </section>
    ';
  }elseif(is_search()){
    return '
          <section class="navshr clfl">
            <nav class="brdcrm flol">
      <a title="'.__('Home', 'arcadexls').'" href="'.esc_url( home_url( '/' ) ).'" class="iconb-home">'.__('Home', 'arcadexls').'</a> <span>/</span> <strong>'.get_search_query().'</strong>
              </nav>
          </section>
    ';
  }elseif(is_category()){
    return '
          <section class="navshr clfl">
            <nav class="brdcrm flol">
      <a title="'.__('Home', 'arcadexls').'" href="'.esc_url( home_url( '/' ) ).'" class="iconb-home">'.__('Home', 'arcadexls').'</a> <span>/</span> <strong>'.single_cat_title("", false).'</strong>
              </nav>
          </section>
    ';
  }elseif(is_tag()){
    return '
          <section class="navshr clfl">
            <nav class="brdcrm flol">
      <a title="'.__('Home', 'arcadexls').'" href="'.esc_url( home_url( '/' ) ).'" class="iconb-home">'.__('Home', 'arcadexls').'</a> <span>/</span> <strong>'.single_tag_title("", false).'</strong>
              </nav>
          </section>
    ';
  }else{
    return '
          <section class="navshr clfl">
            <nav class="brdcrm flol">
      <a title="'.__('Home', 'arcadexls').'" href="'.esc_url( home_url( '/' ) ).'" class="iconb-home">'.__('Home', 'arcadexls').'</a> <span>/</span> <strong>'.wp_title("",false,"right").'</strong>
              </nav>
          </section>
    ';
  }
}

function arcadexls_report(){
  echo'
  <input name="RBL_URL" type="hidden" value="'.get_bloginfo('url').$_SERVER['REQUEST_URI'].'">
  <a onclick="return false;" id="RBL_Element" href="#" role="button" class="ictxt" data-tooltip="tooltip" data-placement="left" title="'.__('Report', 'arcadexls').'">&#xf11d;</a>';
}

function arcadexls_countfav(){
  global $wpdb, $post;
  // Works only when WP Favorite Post is active
  if ( arcadexls_get_option('favorite-button')==1 ) {
    $fav =  $wpdb->get_var("SELECT count(*) FROM ".$wpdb->prefix."usermeta WHERE meta_key='wpfp_favorites' AND meta_value LIKE '%".$post->ID."%'");
    if($fav==0){$fav=0;}
    echo '<span class="iconb-hert">'.__('Favorites:', 'arcadexls').' <strong>'.$fav.'</strong></span> ';
  }
}

if ( !function_exists('arcadexls_favorite') ) {
  function arcadexls_favorite() {
  global $post, $action;

  // Works only when WP Favorite Post is active
  if (arcadexls_get_option('favorite-button')==1 and function_exists('wpfp_link')) {
    if ($action == "remove") {
    $str = myabp_favorite_link($post->ID, wpfp_get_option('remove_favorite'), "remove");
     } elseif ($action == "add") {
    $str = myabp_favorite_link($post->ID, wpfp_get_option('add_favorite'), "add");
     } elseif (wpfp_check_favorited($post->ID)) {
    $str = myabp_favorite_link($post->ID, wpfp_get_option('remove_favorite'), "remove");
     } else {
    $str = myabp_favorite_link($post->ID, wpfp_get_option('add_favorite'), "add");
     }
     echo $str;
  }
  }
}

if ( !function_exists('arcadexls_favorite_link') ) {
  function myabp_favorite_link($post_id, $opt, $action) {
  $link = '<li data-id="'.$post_id.'" data-type="'.$action.'" id="lnkfav" data-tremove="'.wpfp_get_option('remove_favorite').'" data-tadd="'.wpfp_get_option('add_favorite').'">
  <span class="wpfp-span"><img src="'.plugins_url('wp-favorite-posts/img/loading.gif').'" alt="'.__('Loading', 'arcadexls').'" title="'.__('Loading', 'arcadexls').'" class="wpfp-hide wpfp-img">';
  if($action=='remove'){
  $link.='<a data-type="'.$action.'" data-tp="1" data-tooltip="tooltip" data-placement="left" class="wpfp-link wpfp-linkmt ictxt mtfav-'.$action.'" href="?wpfpaction='.$action.'&amp;postid='.$post_id.'" title="'.$opt.'" rel="nofollow">&#xf057;</a>';
  }else{
  $link.='<a data-type="'.$action.'" data-tp="1" data-tooltip="tooltip" data-placement="left" class="wpfp-link wpfp-linkmt ictxt mtfav-'.$action.'" href="?wpfpaction='.$action.'&amp;postid='.$post_id.'" title="'.$opt.'" rel="nofollow">&#xf004;</a>';
  }
  $link.='<a data-type="add" id="mtfavsecadd" style="display:none" data-tooltip="tooltip" data-placement="left" class="wpfp-link ictxt mtfav-add" href="?wpfpaction=add&amp;postid='.$post_id.'" title="'.wpfp_get_option('add_favorite').'" rel="nofollow">&#xf004;</a>';
  $link.='<a data-type="remove" id="mtfavsecremove" style="display:none" data-tooltip="tooltip" data-placement="left" class="wpfp-link ictxt mtfav-remove" href="?wpfpaction=remove&amp;postid='.$post_id.'" title="'.wpfp_get_option('remove_favorite').'" rel="nofollow">&#xf057;</a>';
  $link.='</span></li>';
  $link = apply_filters( 'wpfp_link_html', $link );
  return $link;
  }
}

function arcadexls_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case '' :
  ?>
          <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
              <!--<comnt>-->
              <section id="comment-<?php comment_ID(); ?>">
                  <figure><?php echo get_avatar( $comment, 70); ?></figure>
                  <div>
                      <p class="usrcmt"><?php echo get_comment_author_link(); ?> </p>
          <?php if ( $comment->comment_approved == '0' ) : ?>
                          <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'arcadexls' ); ?></em>
                          <br />
                      <?php endif; ?>
                      <div class="comment_txt"><?php comment_text(); ?></div>
                      <div class="infcmt"><span class="iconb-date"><strong><?php echo get_comment_date('d'); ?> <?php echo get_comment_date('M'); ?> , <?php echo get_comment_date('Y'); ?></strong></span> <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
                  </div>
              </section>
              <!--</comnt>-->
  <?php
    break;
    case 'pingback'  :
    case 'trackback' :
  ?>
  <li class="pingback">
    <p><?php _e( 'Pingback:', 'arcadexls'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'arcadexls'), ' ' ); ?></p>
  <?php
      break;
  endswitch;
}

function mt_footer() {

  if (!is_user_logged_in() ) {
    get_template_part('inc/lgt_login');
  }
  if(arcadexls_get_option('custom_footer_code')!=''){echo stripslashes(arcadexls_get_option('custom_footer_code'))."\r";}
}
add_action('wp_footer', 'mt_footer');

add_action('wp_head', 'mt_header');
function mt_header(){
  if(arcadexls_get_option('custom_header_code')!=''){echo stripslashes(arcadexls_get_option('custom_header_code'))."\r";}
  $favicon = arcadexls_get_option('favicon');
  if( isset( $favicon['url'] ) && $favicon['url'] != '' ){echo"<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"".$favicon['url']."\">\r";}

  // Print game schema
  myarcade_schema();

}

function arcadexls_exclude_categories($slug='-'){
  $return='';

  $blog_cats = (array) arcadexls_get_option('blogcat');

  foreach( $blog_cats as $exclude ){
    $return.=$slug.$exclude.',';
  }
  return $return;
}

add_action('widgets_init', 'mt_widgets_init');

function mt_widgets_init() {

  register_sidebar(
  array('name'          => __('Others Sidebar', 'arcadexls'),
      'id'            =>'others-sidebar',
      'description'   => __('This is the sidebar that gets shown on the home page.', 'arcadexls'),
      'before_widget' => '<section id="%1$s" class="blkcnt bgco2 %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<div class="bltitl">',
      'after_title'   => '</div>',
  )
  );

  register_sidebar(
  array('name'          => __('Single Sidebar', 'arcadexls'),
      'id'            =>'single-sidebar',
      'description'   => __('This is your sidebar that gets shown on the game or blog pages.', 'arcadexls'),
      'before_widget' => '<section id="%1$s" class="blkcnt bgco2 %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<div class="bltitl">',
      'after_title'   => '</div>',
  )
  );

  register_sidebar(
  array('name'          => __('Page Sidebar', 'arcadexls'),
      'id'            =>'page-sidebar',
      'description'   => __('This is your sidebar that gets shown on most of your pages.', 'arcadexls'),
      'before_widget' => '<section id="%1$s" class="blkcnt bgco2 %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<div class="bltitl">',
      'after_title'   => '</div>',
  )
  );

  register_sidebar(
  array('name'          => __('Category Sidebar', 'arcadexls'),
      'id'            =>'category-sidebar',
      'description'   => __('This is your sidebar that gets shown on the category pages.', 'arcadexls'),
      'before_widget' => '<section id="%1$s" class="blkcnt bgco2 %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<div class="bltitl">',
      'after_title'   => '</div>',
  )
  );
}

/**
 * Remove query strings from static resources
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  string Cleaned script URL
 */
function arcadexls_script_version( $src ){
  $parts = explode( '?ver', $src );
  return $parts[0];
}
if ( ! is_admin() ) {
  add_filter( 'script_loader_src', 'arcadexls_script_version', 15, 1 );
  add_filter( 'style_loader_src', 'arcadexls_script_version', 15, 1 );
}

/**
 * Handle random game clicks
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  string
 */
function arcadexls_random_game() {
  // Proceed only if random game option is enabled and if a random game has been requested
  if ( filter_input( INPUT_GET, 'randomgame' ) ) {
    $blog =  arcadexls_get_option('blogcat');
    if ( ! empty( $blog ) ) {
      $exclude = '&exclude=' . implode(',', arcadexls_get_option('blogcat') );
    }
    else {
      $exclude = '';
    }

    $random = new WP_Query( 'showposts=1&no_found_rows=1&orderby=rand' . $exclude . arcadexls_mobile_tag() );

    if ( $random->have_posts() ) {
      while ($random->have_posts()) : $random->the_post();
        $url =get_permalink();
      endwhile;
      ?>
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
      <meta http-equiv="Refresh" content="0; url=<?php echo $url; ?>">
      </head>
      <body>
      </body>
      </html>
      <?php
      die();
    }
  }
}
add_action( 'init', 'arcadexls_random_game' );


/**
 * Retrieve a theme option
 *
 * @version 2.0.0
 * @since   2.0.0
 * @param   string $option_name
 * @return  mixed
 */
function arcadexls_get_option( $option_name, $default = false ) {
  global $arcadexlscnf;

  if ( empty( $arcadexlscnf ) ) {
    $arcadexlscnf = get_option( 'arcadexlscnf' );
  }

  if ( ! isset( $arcadexlscnf[ $option_name ] ) ) {
    return $default;
  }

  return $arcadexlscnf[ $option_name ];
}

/**
 * Get mobile query tag is the site is access by a mobile device
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  [type] [description]
 */
function arcadexls_mobile_tag() {

  if ( wp_is_mobile() && arcadexls_get_option( 'mobile' ) ) {
    return '&tag=mobile';
  }

  return false;
}

/**
 *
 * Adds JSON LD MarkUp
 *
 * @version 3.0.0
 * @since   3.0.0
 * @return  void
 */
function myarcade_schema() {

  // Skip if we are not on the single page
  if ( ! is_singular('post') ) {
    return;
  }

  if ( function_exists( 'is_game' ) && is_game() ) {
    if ( ! function_exists( 'the_ratings' ) ) {
      // Skip if WP-PostRatings isn't installed
      return;
    }

    $category = get_the_category();
    ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "type": "VideoGame",
      "aggregateRating": {
        "type": "aggregateRating",
        "ratingValue": "<?php echo get_post_meta( get_the_ID(), 'ratings_average', true ); ?>",
        "reviewCount": "<?php echo get_post_meta( get_the_ID(), 'ratings_users', true ); ?>",
        "bestRating": "5",
        "worstRating": "1"
      },
      "applicationCategory": "Game",
      "description": "<?php myarcade_excerpt(490); ?>",
      "genre": "<?php echo $category[0]->cat_name;?>",
      "image": "<?php echo myarcade_thumbnail_url(); ?>",
      "name": "<?php myarcade_title(); ?>",
      "operatingSystem": "Web Browser",
      "url": "<?php the_permalink(); ?>"
    }
    </script>
    <?php
  }
  else {
    // Regular blog post/page
    $logo = arcadexls_get_option( 'logohd' );
    if ( empty( $logo['url'] ) ) {
      $logo['url'] = get_template_directory_uri() .' /images/arcadexls.png';
    }
    ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
      "headline": "<?php the_title(); ?>",
      "author": {
          "@type": "Person",
          "name": "<?php the_author(); ?>"
      },
      "datePublished": "<?php the_date('Y-n-j'); ?>",
      "dateModified": "<?php the_modified_date('Y-n-j'); ?>",
      "url": "<?php the_permalink(); ?>",
      "image": "<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>",
      "description": "<?php the_excerpt(); ?>",

      "publisher": {
          "@type": "Organization",
          "name": "<?php bloginfo( 'name' ); ?>",
          "logo":" <?php echo $logo['url']; ?>"
      },

      "mainEntityOfPage":{
        "@type":"WebPage",
        "url": "<?php the_permalink(); ?>"
      }
    }
    </script>
    <?php
  }
}

/**
 * Get list of social icons for the header or footer area
 *
 * @version 3.0.0
 * @since   3.0.0
 * @return  string
 */
function arcadexls_get_social_icons( $position = 'header' ) {
  $social_icon_list = '';

  if( arcadexls_get_option('mtfacebook')!='' or arcadexls_get_option('mttwitter')!='' or arcadexls_get_option('mtgoogleplus')!='' or arcadexls_get_option('mtyoutube')!='' or
      arcadexls_get_option('mttumblr')!='' or arcadexls_get_option('mtreddit')!='' or arcadexls_get_option('mtinstagram')!='' or arcadexls_get_option('mtpinterest')!='' or
      arcadexls_get_option('mtvimeo')!='' or arcadexls_get_option('mtweibo')!='' or arcadexls_get_option('mtfeed')!=''){
    if( $position!='header' ){
      $social_icon_list .= '<section class="ftcn2 srcsoc flor-pore-rgba1">';
    }

    $social_icon_list .= '<ul class="socsl flol">';

    if( arcadexls_get_option('mtfacebook')!='' ){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtfacebook') .'"><span class="iconb-face rgba1 rnd5">'. __('Facebook', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mttwitter')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mttwitter') .'"><span class="iconb-twit rgba1 rnd5">'. __('Twitter', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mtgoogleplus')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtgoogleplus') .'"><span class="iconb-goog rgba1 rnd5">'. __('Google+', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mtyoutube')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtyoutube') .'"><span class="iconb-yout rgba1 rnd5">'. __('Youtube', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mttumblr')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mttumblr') .'"><span class="iconb-tumblr rgba1 rnd5">'. __('Tumblr', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mtreddit')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtreddit') .'"><span class="iconb-reddit rgba1 rnd5">'. __('Reddit', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mtinstagram')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtinstagram') .'"><span class="iconb-instagram rgba1 rnd5">'. __('Instagram', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mtpinterest')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtpinterest') .'"><span class="iconb-pinterest rgba1 rnd5">'. __('Pinterest', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mtvimeo')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtvimeo') .'"><span class="iconb-vimeo rgba1 rnd5">'. __('Vimeo', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mtweibo')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtweibo') .'"><span class="iconb-weibo rgba1 rnd5">'. __('Weibo', 'arcadexls') .'</span></a></li>';
    }
    if(arcadexls_get_option('mtfeed')!=''){
      $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtfeed') .'"><span class="iconb-rss rgba1 rnd5">'. __('Feed', 'arcadexls') .'</span></a></li>';
    }


    $social_icon_list .= '<li><a target="_blank" href="'. arcadexls_get_option('mtfeed') .'"><span class="iconb-vk rgba1 rnd5">'. __('Feed', 'arcadexls') .'</span></a></li>';

    if( $position!='header' ){
      $social_icon_list .= '<li><a href="#hd"><span class="iconb-btop rgba1 rnd5" data-tooltip="tooltip" data-placement="top" title="'. __('Back to the top', 'arcadexls') .'">'. __('Up', 'arcadexls') .'</span></a></li>';
    }

    $social_icon_list .= '</ul>';

    if( $position!='header' ){
      $social_icon_list .= '</section>';
    }
    echo $social_icon_list;
  }else return;
}