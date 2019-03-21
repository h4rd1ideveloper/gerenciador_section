<?php
/**
 * _verthos functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _verthos
 */

if ( ! function_exists( '_verthos_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _verthos_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'verthos' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'verthos', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top'    => esc_html__( 'Menu do Topo', 'verthos' ),
			'bottom' => esc_html__( 'Menu do Rodapé', 'verthos' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( '_verthos_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			//'height'      => 250,
			//'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add WYSIWYG style
		 */
		add_editor_style( 'css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', '_verthos_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _verthos_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_verthos_content_width', 1200 );
}

add_action( 'after_setup_theme', '_verthos_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _verthos_widgets_init() {
	$sidebars = array(
		'sidebar-1' => 'Barra Lateral',
		'sidebar-2' => 'Widgets do Rodapé',
	);
	foreach ( $sidebars as $id => $name ) {
		register_sidebar( array(
			'name'          => esc_html__( $name, 'verthos' ),
			'id'            => $id,
			'description'   => esc_html__( 'Adicione Widgets aqui.', 'verthos' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}

add_action( 'widgets_init', '_verthos_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _verthos_scripts() {
	/// styles
	// Fonts : Mude para a do projeto
	wp_register_style( '_verthos-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Playfair+Display:400i' );
	// Base
	wp_enqueue_style( '_verthos-style', get_stylesheet_uri(), array( '_verthos-fonts' ) );

	//wp_register_style('_verthos-style-sweet', get_template_directory_uri().'/css/sweet.css');
	//wp_enqueue_style('_verthos-style-sweet');
//
	//wp_register_style('_verthos-style-webflow', get_template_directory_uri().'/css/webflow.css');
	//wp_enqueue_style('_verthos-style-webflow');
//
//
	//wp_register_style('_verthos-style-webflow-component', get_template_directory_uri().'/css/verthos-vwp.webflow.css');
	//wp_enqueue_style('_verthos-style-webflow-component');
	/// Scripts
	/// wp_enqueue_script( '_verthos-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );

	// JQuery Upgrade (FOR WEBFLOW)
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', "http://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js", array(), '2.2.4' );

	// Webflow Script (REMOVE IF NEEDED)
	wp_enqueue_script( '_verthos-webflow', get_template_directory_uri() . '/js/webflow.js', array( 'jquery' ), '2.0.0', true );

	// Main Script
	wp_register_script( '_verthos-scripts', get_template_directory_uri() . '/js/index.js', array( 'jquery' ), '1.0.0', true );

	//Script Arguments
	//wp_localize_script( '_verthos-scripts', '__theme_arguments__', array() );

	wp_enqueue_script( '_verthos-scripts' );

	// Comment scripts
	//if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	//	wp_enqueue_script( 'comment-reply' );
	//}
}
add_action( 'wp_enqueue_scripts', '_verthos_scripts' );

function ajax_login_init() {
    wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax_login.js', array('jquery'), '1.0.0', true ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
	));
}
// Execute the action only if the user isn't logged in
add_action('init', 'ajax_login_init');

function custom_login_user() {
	// First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    // Nonce is checked, get the POST data and sign user on
    $info = array();
	$info['user_login'] = !empty( isset($_POST['username']) )? filter_var($_POST['username'], FILTER_SANITIZE_STRING):false;
	$info['user_password'] = !empty( isset($_POST['password']) )? $_POST['password']:false;
    $info['remember'] = !empty( isset($_POST['checkbox_remember']) )? filter_var($_POST['checkbox_remember'], FILTER_VALIDATE_BOOLEAN):false;


	$user_signon = wp_signon( $info, false );
	if ( is_wp_error( $user_signon ) ) {
        echo json_encode( array('loggedin'=>false, 'message'=>__('Wrong username or password.') ) );
    } else {
        echo json_encode( array('loggedin'=>true, 'message'=>__('Login successful, redirecting...') ) );
    }
    die();
}
function custom_register_user() {
	  // First check the nonce, if it fails the function will break
	  check_ajax_referer( 'ajax-register-nonce', 'sign_security' );
	
	  $new_user_name = !empty( isset($_POST['new_user_name']) )? filter_var($_POST['new_user_name'], FILTER_SANITIZE_STRING):false; //stripcslashes($_POST['new_user_name']);
	  $new_user_email = !empty( isset($_POST['new_user_email']) )? filter_var($_POST['new_user_email'], FILTER_SANITIZE_EMAIL):false; //stripcslashes($_POST['new_user_email']);
	  $new_user_password = $_POST['new_user_password']; //hashado
	  $user_nice_name = $new_user_email;
	  $user_data = array(
	      'user_login' => $new_user_name,
	      'user_email' => $new_user_email,
	      'user_pass' => $new_user_password,
	      'user_nicename' => $user_nice_name,
	      'display_name' => $new_user_name,
	      'role' => 'subscriber'
	  	);
	  $user_id = wp_insert_user($user_data);
	  	if (!is_wp_error($user_id)) {
			__update_user_meta( $user_id, 'cupom', '#'.$new_user_name.'-'.md5( $user_id.'VWP'.$new_user_name, false ).'*' );
	      echo json_encode( array( 'loggedin' => true, 'message' => __('we have Created an account for you') ) );
	  	} else {
	    	if (isset($user_id->errors['empty_user_login'])) {
	          echo json_encode( array( 'loggedin' => false, 'message' => __('User Name and Email are mandatory') ) );
	      	} elseif (isset($user_id->errors['existing_user_login'])) {
			  echo json_encode( array( 'loggedin' => false, 'message' => __('User name already exixts') ) );
	      	} else {
			  echo json_encode( array( 'loggedin' => false, 'message' => __('Error Occured please fill up the sign up form carefully') ) );
	      	}
	  	}
	die();
}
function __update_post_meta( $post_id, $field_name, $value = '' )
  {
	  if ( empty( $value ) OR ! $value )
	  {
		  delete_post_meta( $post_id, $field_name );
	  }
	  elseif ( ! get_post_meta( $post_id, $field_name ) )
	  {
		  add_post_meta( $post_id, $field_name, $value );
	  }
	  else
	  {
		  update_post_meta( $post_id, $field_name, $value );
	  }
  }
  function __update_user_meta( $user_id, $field_name, $value = '' )
  {
	  if ( empty( $value ) OR ! $value )
	  {
		  delete_user_meta( $user_id, $field_name );
	  }
	  elseif ( ! get_user_meta( $user_id, $field_name ) )
	  {
		  add_user_meta( $user_id, $field_name, $value );
	  }
	  else
	  {
		  update_user_meta( $user_id, $field_name, $value );
	  }
  }

function create_post_pedido() {
	
	// First check the nonce, if it fails the function will break
	//check_ajax_referer( 'ajax-upload-nonce', 'upload_security'  );
	$title = !empty( isset($_POST['email']) )? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL):false;//$_POST['email'];
	$post_content = !empty( isset($_POST['data_checkout']) )? filter_var($_POST['data_checkout'], FILTER_SANITIZE_STRING):false;//$_POST['data_checkout'];
	$author = !empty( isset($_POST['id_user']) )? filter_var($_POST['id_user'], FILTER_VALIDATE_INT):false; //$_POST['id_user'];
	$referenciaLocal = md5($author.$title.'VWP'.$post_content, false);
	//require the needed files
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	//then loop over the files that were sent and store them using  media_handle_upload();
    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                echo json_encode("upload error : " . $_FILES[$file]['error']);
                die();
            }
            $attach_id = media_handle_upload( $file, $post_id );
        }   
	}
	//cria post com os campos
	$my_post = array(
		'post_title'    => $title.' / user_id: '.$author,
		'post_status'   => 'draft',
		'post_author'   => $author,
		'post_type'     => 'pedidos'
		);
	$postId = wp_insert_post( $my_post );
	if ( !is_wp_error( $postId ) ) {
			
	
	//and if you want to set that image as Post  then use:
	__update_post_meta($postId,'estampa_personalizada', $attach_id );
	//insere acf de referencia
	__update_post_meta($postId,'referencia', $referenciaLocal );
	//insere acf de dados_do_checkout
	__update_post_meta($postId,'dados_do_checkout', $post_content );

  	//update_post_meta(,'_thumbnail_id',$attach_id);
		echo json_encode(array("message"  => 'Post publish', "status" => true ));
	}
	else{
		echo json_encode(array("message" => $postId->get_error_message(), "status" => false ));
	}
  	die();
	} 
	class AjaxSearch
	{

		private function _AuxGetOptions($acfs, $id ) {
			
			if( !id ) {
		
				return (object)  array('status'=> false, 'message' => 'empyt id');
			}
			/** Initial state of object result */
			$obj = array();
			/** search field names and values */
			foreach( $acfs as $acf => $acfValue ) {
				/** Get value of the current field */
				$value = get_field( $acfValue, 'categoria_do_produto_'. $id );
				/** Check if value id not null */
				if( $value != NULL ) {
					/** Merge initial state with key acf name and value like result field */
					$obj = (object)  array_merge(  (array) $obj,   array( $acfValue => $value ) );    
				}
			}
			/** Merge the status in obj */
			$obj = empty($obj)? array( 'status' => false, 'message' => 'Not found customizer options from this product type' ) : (object)  array_merge( (array)   $obj,  array( 'status'=> true) ); 
		
			return $obj;
		}
		/**
		 *@Description revice ID from ajax, and return all option's taxonomy
		 *Author Yan Santos Policarpo
		 *@Ver 1.0.0
		 *@return json object { status, message, ...rest }
		 *@Var $_id $_post->ID filterd
		 */
		public function getOptions() {
			$_id = $_POST['ID_term'];
			$res = self::_AuxGetOptions( array('capuz', 'mangas', 'regata', 'gola'), $_id );
			echo json_encode( $res );
			die();
		}
		/**
		 * Feedier constructor.
		 *@Description Insert method getPost on wp - AjaxHook 
		* The main plugin actions registered for WordPress
		*/
		public function __construct() {
			add_action('wp_ajax_getPost', array($this, 'getPost'));
			add_action('wp_ajax_nopriv_getPost', array($this, 'getPost'));
			add_action('wp_ajax_getOptions', array($this,'getOptions'));
			add_action('wp_ajax_nopriv_getOptions', array($this,'getOptions'));
			
		}
		
		public function getPost() {

			$number = filter_var($_POST['nb_ppg'], FILTER_SANITIZE_NUMBER_INT);
			$cat = filter_var($_POST['cat'], FILTER_SANITIZE_STRING);
			$orderBy = filter_var($_POST['orderBy'], FILTER_SANITIZE_STRING);
			$describleOrder = filter_var($_POST['order'], FILTER_SANITIZE_STRING);
			/**Change to post_type when need */
			$typeQuery = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
			$postId = filter_var($_POST['postID'], FILTER_SANITIZE_NUMBER_INT);
			$result = $typeQuery == 's'? 
				get_posts(
					array(
						'numberposts'      => $number,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'post_type'        => 'pedidos',
						'post_status'      => 'any',
					)
				)
			:get_post(
				1,
				ARRAY_A
			);
			echo json_encode($result);
			die();
		}
		

			
	}
new AjaxSearch();



add_action('wp_ajax_custom_login_user', 'custom_login_user');
//for none logged-in users
add_action('wp_ajax_nopriv_custom_login_user', 'custom_login_user');
////////////////////////////////////////////////////////////////////////////
add_action('wp_ajax_custom_register_user', 'custom_register_user');
//for none logged-in users
add_action('wp_ajax_nopriv_custom_register_user', 'custom_register_user');
///////////////////////////////////////////////////////////////////////////////
add_action('wp_ajax_create_post_pedido', 'create_post_pedido');
//for none logged-in users
add_action('wp_ajax_nopriv_create_post_pedido', 'create_post_pedido');

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Plugins Dependencies.
 */
require get_parent_theme_file_path( '/inc/plugins.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_parent_theme_file_path( '/inc/jetpack.php' );