<?php
/**
 * _verthos Theme Customizer
 *
 * @package _verthos
 */

/**
 * Customizer Generation
 *
 * @param WPCG_Customizer_Generator $wpcg_customize
 */
function _verthos_customizer_generate( $wpcg_customize ) {

	$wpcg_customize
		->add_panel( __( 'Configurações do Tema', 'verthos' ) )
		->add_section( __( 'SEO', 'verthos' ) )
		// Tag manager head
		->add_code( 'top-head-code', array( __( 'Código do Topo do Site', 'verthos' ), '', 'html' ) )
		->description( __( 'Código HTML a ser inserido no Topo do HEAD (ex: Tag Manager)', 'verthos' ) )
		->add_choice( 'theme', 'monokai' )// monokai theme
		// Tag manager body
		->add_code( 'top-body-code', array( __( 'Código do Topo do Site', 'verthos' ), '', 'html' ) )
		->description( __( 'Código HTML a ser inserido no Topo do BODY (ex: Tag Manager)', 'verthos' ) )
		->add_choice( 'theme', 'monokai' )
		///
		/// General
		///
		->add_section( __( 'Configurações Gerais', 'verthos' ) )
		->add_text( 'copyright', array( __( 'Copyright do Footer', 'verthos' ), 'Copyright 2017' ) )
		///
		/**
		 * comsutmizer her
		 */
		->add_section( 'cabecalho', __( 'Cabeçalho', 'verthos' ) )
		//->add( 'header-logo-default', 
		//	array(
		//		'type'  => 'image',
		//		'label' => __('Logo padrão', 'verthos' )
		//	)
		//)
		->add( 'header-logo-white', 
			array(
				'type'  => 'image',
				'label' => __('Variação da Logo', 'verthos' )
			)
		)
		->add( 'header-drop-links', 
			array(
				'type'      => 'repeater',
				'label'     => __('Link para cada Curso', 'verthos'),
				'row_label' => array(
					'value' => __('Curso nº', 'verthos' ),
				),
				'fields'    => array(
					'title' => array(
						'type'  => 'text',
						'label' => __('Titulo', 'verthos'),
					),
					'url' => array(
						'type'  => 'text',
						'label' => __('Link', 'verthos'),
					)
				)
			)
		)
		->add_text( 'header-sub-link-tel', array( __( 'Numero de contato', 'verthos' ), '(32) 9 9198 6861' ) )
		->add_text( 'header-sub-link-email', array( __( 'Email de contato', 'verthos' ), 'verthosodontologia@gmail.com' ) )
	;
}

add_action( 'wpcg_customize_register', '_verthos_customizer_generate' );

Kirki::add_field( 'header-logo-default', [
	'type'        => 'background',
	'settings'    => 'header-logo-default',
	'label'       => esc_html__( 'Logo Padrão', 'verthos' ),
	'description' => esc_html__( 'LOGO', 'verthos' ),
	'section'     => 'cabecalho',
	'default'     => [
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => '',
	]
] );

Kirki::add_field( 'sizes-to-apply', [
	'type'        => 'dimensions',
	'settings'    => 'sizes-to-apply',
	'label'       => esc_html__( 'Dimension Control', 'kirki' ),
	'description' => esc_html__( 'Description Here.', 'kirki' ),
	'section'     => 'cabecalho',
	'default'     => [
		'min-width'  => '100px',
		'max-width'  => '500px',
		'min-height' => '50px',
		'max-height' => '10em',
	],
	'choices'     => [
		'labels' => [
			'min-width'  => esc_html__( 'Largura minima', 'my-theme' ),
			'max-width'  => esc_html__( 'Largura maima', 'my-theme' ),
			'min-height' => esc_html__( 'Altura minima', 'my-theme' ),
			'max-height' => esc_html__( 'Altura maxima', 'my-theme' ),
		],
	],
] );

Kirki::add_field( 'sizes-to-apply-2', [
	'type'        => 'dimensions',
	'settings'    => 'sizes-to-apply-2',
	'label'       => esc_html__( 'Dimension Control', 'kirki' ),
	'description' => esc_html__( 'Description Here.', 'kirki' ),
	'section'     => 'cabecalho',
	'default'     => [
		'padding-top'    => '1em',
		'padding-bottom' => '10rem',
		'padding-left'   => '1vh',
		'padding-right'  => '10px',
	]
] );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _verthos_customize_preview_js() {
	wp_enqueue_script( '_verthos-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', '_verthos_customize_preview_js' );


/**
 * Fix Theme Title and description
 *
 * @param $wp_customize
 */
function _verthos_customizer_fix( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => function () {
				bloginfo( 'name' );
			},
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => function () {
				bloginfo( 'description' );
			},
		) );
	}
}

add_action( 'customize_register', '_verthos_customizer_fix' );

include_once __DIR__ . '/customizer-generator/wp-customizer-generator.php';



