<style type="text/css">
  <?php
  $background = myfriv_get_option('body_bg');
  if ( ! empty( $background['color'] ) ) {
    echo 'body { background-color: '.$background['color'].'; background-image: url('.$background['image'].'); background-repeat: '.$background['repeat'].'; background-position: '.$background['position'].'; background-attachment: '.$background['attachment'].';  }';
  }

  $logo = myfriv_get_option('logo');
  if ( $logo ) {
    echo 'header.logo a { background-image: url('.$logo.'); }';
  };
  ?>
  a, a:active, a:visited { color: <?php echo myfriv_get_option('link-color'); ?>; }
  a:hover { color: <?php echo myfriv_get_option('sec-color'); ?>; }
  #header, .comments .submit, .description .thumb, .title-special, .games, .single-page .related h3, .single-page .game-space h1 { background-color: <?php echo myfriv_get_option('ppal-color'); ?>; }
  #header, .title-special, .comments .submit, .description .thumb { border-color: <?php echo myfriv_get_option('ppal-color'); ?>; }
  .games:hover, .menu a.btn:hover, .social ul li a:hover, .featbtn ul li a, .btns ul li:hover, .games .play { background-color: <?php echo myfriv_get_option('sec-color'); ?>; }
  .featbtn ul li a { border-color: <?php echo myfriv_get_option('sec-color'); ?>; }
  .menu span, .menu ul.actions a, .menu span.icon:before, .description .tags span { color: <?php echo myfriv_get_option('sec-color'); ?>; }
  .qtip-default { background-color: <?php echo myfriv_get_option('tip-color'); ?>; }
  .qtip-default:after { border-right-color: <?php echo myfriv_get_option('tip-color'); ?>; }
  h1, h2, .description .tags ul li a, .single-page .footer .description, .single-page .footer .description h4, .single-page .game-space .preloader, .header-search input, nav#menu ul li, nav#menu ul li ul li, .social ul a, .featbtn ul a, #footer, #footer a, .single-page .related h3, .single-page .adver h3, .single-page .game-space h2, body { color: <?php echo myfriv_get_option('text-color'); ?>; }
  .single-page .game-space a.skip { background: <?php echo myfriv_get_option('sec-color'); ?>; }
  <?php if (myfriv_get_option('preloader')) { ?>
  .single .player .game { display:block; }
  <?php } ?>
  .single-page .footer .description { background-color: <?php echo myfriv_get_option('ppal-color'); ?>; }
</style>