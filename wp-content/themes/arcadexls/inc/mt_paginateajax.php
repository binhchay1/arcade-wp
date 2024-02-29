<?php
  function mt_paginate_init() {
    global $wp_query;

    $path_to_theme = get_template_directory_uri();
    $max = $wp_query->max_num_pages;

    if ( !is_admin() or !is_single() or !is_page() ) {
      $myvars = array(
        'txt' => __('LOADING MORE GAMES...', 'arcadexls')
      );
      wp_enqueue_script('jquery.infinitescroll.min', $path_to_theme.'/js/jquery.infinitescroll.min.js',array('jquery'));
      wp_localize_script( 'jquery.infinitescroll.min', 'MtPagAjax', $myvars );
    }

  }

  if ( !is_admin() and arcadexls_get_option('mt-choose-size', 1) !=2) {
    add_action('wp_print_scripts', 'mt_paginate_init');
  }
?>