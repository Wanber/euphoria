<?php

// ==================================================================
// Theme stylesheets
// ==================================================================
function adelle_theme_styles() { 
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'jquery-ui-widget' );
  wp_enqueue_style( 'adelle-style', get_stylesheet_uri(), '14.03', array(), 'all' );
  wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic|Muli:400,400italic|Montserrat:400,700', null, array(), 'all' );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
  wp_enqueue_script( 'adelle-respond', get_template_directory_uri() . '/js/respond.min.js', array( 'jquery' ), '1.0.1', true );
  wp_enqueue_script( 'adelle-fitvids', get_template_directory_uri() . '/js/fitvids.min.js', array( 'jquery' ), '1.0', true );
  wp_enqueue_script( 'adelle-tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array( 'jquery' ), null, true );
  wp_enqueue_script( 'adelle-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'adelle_theme_styles' );

// ==================================================================
// Conditional scripts
// ==================================================================
function conditional_scripts() {
  ?>
  <!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/IE9.js" type="text/javascript"></script><![endif]-->
  <!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script><![endif]-->
  <?php
}
add_action( 'wp_head', 'conditional_scripts' );

// ==================================================================
// Heading
// ==================================================================
function adelle_theme_heading() {
  if( get_header_image() == true ) { ?>
    <a href="<?php echo esc_url( home_url() ); ?>">
      <img src="<?php header_image(); ?>" class="header-title" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" />
    </a>
  <?php } elseif( is_home() || is_front_page() ) { ?>
      <h1><a href="<?php echo esc_url( home_url() ); ?>" class="header-title"><?php bloginfo( 'name' ); ?></a></h1>
      <p class="header-desc"><?php bloginfo( 'description' ); ?></p>
  <?php } else { ?>
      <h5><a href="<?php echo esc_url( home_url() ); ?>" class="header-title"><?php bloginfo( 'name' ); ?></a></h5>
      <p class="header-desc"><?php bloginfo( 'description' ); ?></p>
  <?php }
}

// ==================================================================
// Content width
// ==================================================================
if ( ! isset( $content_width ) ) $content_width = 640;

// ====================================================================================================================================
// Innit
// ====================================================================================================================================
function adelle_setup() {

  // ==================================================================
  // Custom header
  // ==================================================================
  add_theme_support( 'custom-header', array(
    'default-image'          => '',
    'random-default'         => false,
    'width'                  => 400,
    'height'                 => 100,
    'flex-height'            => true,
    'flex-width'             => true,
    'default-text-color'     => 'ff8f85',
    'header-text'            => true,
    'uploads'                => true,
    'wp-head-callback'       => '',
    'admin-head-callback'    => 'ace_admin_header_style',
    'admin-preview-callback' => 'ace_admin_header_image',
  ));

  function ace_admin_header_style() { ?>
    <link href="//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic|Muli:400,400italic|Montserrat:400,700" rel="stylesheet" type="text/css">
    <style type="text/css" id="ace-admin-header-css">
    .appearance_page_custom-header #headimg {
      background-color: #fff;
      padding: 30px 0;
      text-align: left;
    }
    #headimg h1 {
      font-family: 'Montserrat', Sans-serif;
      font-weight: 400;
      font-size: 48px;
      text-transform: uppercase;
      margin: 0;
    }
    #headimg h1 a {
      text-decoration: none;
    }
    #headimg h1 a:hover {
      color: #000;
    }
    #headimg .displaying-header-desc {
      font-family: 'Muli', Lucida Sans Unicode, Lucida Grande, Verdana, Tahoma, Arial, Sans-serif;
      font-weight: 400;
      margin: 0;
      color: #777;
    }
    #headimg img {
      vertical-align: middle;
      display: block;
      margin: 0 auto;
    }
    </style>
  <?php }

  function ace_admin_header_image() { ?>
    <div id="headimg">
      <?php if ( get_header_image() ) : ?>
      <img src="<?php header_image(); ?>" alt="">
      <?php else : ?>
      <h1 class="displaying-header-text"><a id="name"<?php echo sprintf( ' style="color:#%s;"', get_header_textcolor() ); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
      <p class="displaying-header-text displaying-header-desc"><?php bloginfo( 'description' ); ?></p>
      <?php endif; ?>
    </div>
  <?php }

  function header_image_text() {
  $text_color = get_header_textcolor();
  // If no custom color for text is set, let's bail.
  if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
  return;
  // If we get this far, we have custom styles.
  ?>
    <style type="text/css">
    <?php if ( ! display_header_text() ) : ?>
      .header-title,
      .header-desc {display: none;}
    <?php elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) : ?>
      .header-title {color: #<?php echo esc_attr( $text_color ); ?>;}
    <?php endif; ?>
    </style>
  <?php
  }
  add_action( 'wp_head', 'header_image_text' );

  // ==================================================================
  // Language
  // ==================================================================
  load_theme_textdomain( 'adelle-theme', get_template_directory() . '/languages' );

  // ==================================================================
  // Add default posts and comments RSS feed links to head
  // ==================================================================
  add_theme_support( 'automatic-feed-links' );

  // ==================================================================
  // Post thumbnail
  // ==================================================================
  add_theme_support( 'post-thumbnails' );
    add_image_size( 'post_thumb', 300, 200, true );

  // ==================================================================
  // Menu location
  // ==================================================================
  register_nav_menu( 'top_menu', __( 'Top Menu','adelle-theme' ) );

  // ==================================================================
  // Custom background
  // ==================================================================
  add_theme_support( 'custom-background', array( 'default-color' => 'ffffff',) );

  // ==================================================================
  // Visual editor stylesheet
  // ==================================================================
  add_editor_style( 'editor.css' );

  // ==================================================================
  // Shortcode in excerpt
  // ==================================================================
  add_filter( 'the_excerpt', 'do_shortcode' );

  // ==================================================================
  // Shortcode in widget
  // ==================================================================
  add_filter( 'widget_text', 'do_shortcode' );

  // ==================================================================
  // Clickable link in content
  // ==================================================================
  add_filter( 'the_content', 'make_clickable' );

  // ==================================================================
  // Add "Home" in menu
  // ==================================================================
  function adelle_theme_home_page_menu( $args ) {
    $args['show_home'] = true;
    return $args;
  }
  add_filter( 'wp_page_menu_args', 'adelle_theme_home_page_menu' );

// ====================================================================================================================================
// Innit
// ====================================================================================================================================
}
add_action( 'after_setup_theme', 'adelle_setup' );

// ==================================================================
// Comment spam, prevention
// ==================================================================
function adelle_theme_check_referrer() {
  if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == "" ) {
    wp_die( __( 'Please enable referrers in your browser.','adelle-theme' ) );
  }
}
add_action( 'check_comment_flood', 'adelle_theme_check_referrer' );

// ==================================================================
// Comment time
// ==================================================================
function adelle_theme_time_ago( $type = 'comment' ) {
  $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
  return human_time_diff($d( 'U' ), current_time( 'timestamp' )) . " " . __( 'ago','adelle-theme' );
}

// ==================================================================
// Custom comment style
// ==================================================================
function adelle_theme_comment_style($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?>>
  <article class="comment-content" id="comment-<?php comment_ID(); ?>">
    <div class="comment-meta">
    <?php echo get_avatar($comment, $size = '32' ); ?>
    <?php printf(__( '<h6>%s</h6>','adelle-theme' ), get_comment_author_link()) ?>
    <small><?php printf( __( '%1$s at %2$s','adelle-theme' ), get_comment_date(), get_comment_time()) ?> (<?php printf( __( '%s','adelle-theme' ), adelle_theme_time_ago() ) ?>)</small>
    </div>
  <?php if ($comment->comment_approved == '0' ) : ?><em><?php _e( 'Your comment is awaiting moderation.','adelle-theme' ) ?></em><br /><?php endif; ?>
  <?php comment_text() ?>
  <?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
  </article>
<?php }

// ==================================================================
// Header title
// ==================================================================
function adelle_theme_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'adelle' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'adelle_theme_wp_title', 10, 2 );

// ==================================================================
// Post/page pagination
// ==================================================================
function adelle_theme_get_link_pages() {
  wp_link_pages(
    array(
    'before'           => '<p class="page-pagination"><span class="page-pagination-title">' . __( 'Pages:','adelle-theme' ) . '</span>',
    'after'            => '</p>',
    'link_before'      => '<span class="page-pagination-number">',
    'link_after'       => '</span>',
    'next_or_number'   => 'number',
    'nextpagelink'     => __( 'Next page','adelle-theme' ),
    'previouspagelink' => __( 'Previous page','adelle-theme' ),
    'pagelink'         => '%',
    'echo'             => 1
    )
  );
}

// ==================================================================
// Pagination (WordPress)
// ==================================================================
function adelle_theme_pagination_links() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
    return;
	}
    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );
      if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
      }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    $links = paginate_links( array(
      'base'			=> @add_query_arg( 'paged','%#%' ),
      'format'		=> '?paged=%#%',
      'current'		=> $paged,
      'total'			=> $GLOBALS['wp_query']->max_num_pages,
      'prev_next'	=> true,
      'prev_text'	=> __( 'Previous','ace' ),
      'next_text'	=> __( 'Next','ace' ),
    ) );
    if ( $links ) :
    ?>
      <section class="pagination">
        <p><?php echo $links; ?></p>
      </section>
    <?php endif;
}

// ==================================================================
// Widget - Sidebar
// ==================================================================
function adelle_widgets_init() {
  register_sidebar(array(
    'name' => __( 'Right Widget 1','adelle-theme' ),
    'id' => 'right-widget',
    'description' => 'Right side widget area',
    'before_widget' => '<article id="%1$s" class="side-widget %2$s">',
    'after_widget' => '</article>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
}


add_action( 'widgets_init', 'adelle_widgets_init' );

/*EXIBINDO O CAMPO ID DOS ARQUIVOS DE MIDIA*/
function getFileExt($file) {
     return strtolower(substr(strrchr($file,'.'),1));
}
function mediaColumnsHeader($columns) {
    $columns['medID'] = __('ID');
    return $columns;
}
add_filter( 'manage_media_columns', 'mediaColumnsHeader' );
 
function mediaColumnsRow($columnName, $columnID){
    if($columnName == 'medID'){
        echo $columnID;
    }
}
add_filter( 'manage_media_custom_column', 'mediaColumnsRow', 10, 2 );


/*EXIBINDO O CAMPO ID DOS POSTs*/
function postsColumnsHeader($columns) {
    $columns['postID'] = __('ID');
    return $columns;
}
add_filter( 'manage_posts_columns', 'postsColumnsHeader' );
 
function postsColumnsRow($columnTitle, $postID){
    if($columnTitle == 'postID'){
        echo $postID;
    }
}
add_filter( 'manage_posts_custom_column', 'postsColumnsRow', 10, 2 );

/*EXIBINDO O CAMPO ID DAS PAGINAS*/
function pagesColumnsHeader($columns) {
$columns['pageID'] = __('ID');
return $columns;
}
add_filter( 'manage_pages_columns', 'pagesColumnsHeader' );
 
function pagesColumnsRow($columnName, $pageID){
if($columnName == 'pageID'){
echo $pageID;
}
}
add_filter( 'manage_pages_custom_column', 'pagesColumnsRow', 10, 2 );

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function removelink($link)
{
    $server = $_SERVER['SERVER_NAME'];

    $endereco = $_SERVER ['REQUEST_URI'];

    $url = "http://" . $server . $endereco;
    $enderecoAtual = str_replace($url, "", $link);
    return $enderecoAtual;
}