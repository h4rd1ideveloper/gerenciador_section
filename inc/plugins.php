<?php
/**
 * TGM Plugin Activation setting File
 *
 * @link http://tgmpluginactivation.com/
 *
 * @package _verthos
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
include_once get_parent_theme_file_path( '/inc/plugin-activation/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', '_verthos_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function _verthos_register_required_plugins() {
	// required plugins
	$required = array(
		'kirki'                             => __( 'Ferramenta de customização', 'verthos' ),
		'wordpress-seo'                     => __( 'Ferramenta de SEO', 'verthos' ),
		'google-analytics-dashboard-for-wp' => __( 'Google Analytics', 'verthos' ),
		'aryo-activity-log'                 => __( 'LOG de Atividades', 'verthos' ),
		'wps-hide-login'                    => __( 'Ocultação de Login (segurança)', 'verthos' ),
		'customize-login-image'             => __( 'Imagem de Login', 'verthos' ),
		'bcc-everything'                    => __( 'Segurança de Email', 'verthos' ),

		// Avaliar obrigatoriedade dos plugins abaixo (remover ou mover para opcionais):

		'easy-wp-smtp'            => __( 'Configurações de Emails (segurança)', 'verthos' ),
		'email-templates'         => __( 'Templates de Email', 'verthos' ),
		'contact-form-7'          => __( 'Formulários de Contato', 'verthos' ),
		'invisible-recaptcha'     => __( 'Captcha para Formulários (segurança)', 'verthos' ),
		'custom-post-type-ui'     => __( 'Posts Personalizados', 'verthos' ),
		'post-types-order'        => __( 'Ordenação de Posts', 'verthos' ),
		'advanced-custom-fields'  => __( 'Campos Personalizados', 'verthos' ),
		'navz-photo-gallery'      => __( 'Campo Personalizado de Galeria', 'verthos' ),

//		'quick-and-easy-post-creation-for-acf-relationship-fields' => __( 'Criador de Posts em Campo Personalizado', 'verthos' ),
//		'jetpack'                 => __( 'Rolagem Infinita', 'verthos' ),
//		'jetpack-dev-mode'        => __( 'Ativador Jetpack', 'verthos' ),
		'codepress-admin-columns' => __( 'Admin de colunas', 'verthos' ),
		'adminimize'              => __( 'Adminimize', 'verthos' ),
		'user-role-editor'        => __( 'User Role Editor', 'verthos' ),
		'taxonomy-terms-order'    => __( 'Ordenador de Categorias', 'verthos' ),


		// Avaliar o uso dos plugins abaixo e retirar dos comentários se necessários:

//		'wp-google-maps' => __( 'Mapas', 'verthos' ),
//		'search-filter'  => __( 'Pesquisa e Filtragem', 'verthos' ),
//		'up-wp-cart'     => __( 'Carrinho de Compras', 'verthos' ),
	);

	// optional plugins
	$optional = array(
		'flamingo'          => __( 'Backup de Emails e Contatos', 'verthos' ),
		'customize-posts'   => __( 'Editor Rápido de Conteúdo', 'verthos' ),
		'tinymce-advanced'  => __( 'Editor de Texto Melhorado', 'verthos' ),
		'meta-theme-colour' => __( 'Cor do Tema', 'verthos' )
	);
	// array of plugins - insert other plugins here
	$plugins = array();

	// insert required plugins
	foreach ( $required as $slug => $name ) {
		$plugins[] = _verthos_fix_dependency( $name, array(
			'name'             => $name,
			'slug'             => $slug,
			'required'         => true,
			'force_activation' => true
		) );
	}

	// insert optional plugins
	foreach ( $optional as $slug => $name ) {
		$plugins[] = _verthos_fix_dependency( $name, array(
			'name'     => $name,
			'slug'     => $slug,
			'required' => false
		) );
	}

	/*
	 * Array of configuration settings.
	 */
	$config  = array(
		'id'          => 'verthos',
		'dismiss_msg' => __( 'Instale os plugins informados para continuar', 'verthos' ),
		'message'     => __( 'Instale os plugins informados para continuar', 'verthos' ),
	);
	$plugins = apply_filters( '_verthos_required_plugins', $plugins, $config );
	tgmpa( $plugins, $config );
}

/// plugins configuration and defaults
/**
 * Parse short dependency to fixed array
 *
 * @param array $plugin
 * @param array $default
 *
 * @return array
 */
function _verthos_fix_dependency( $plugin = array(), $default = array() ) {
	return array_merge( $default, is_array( $plugin ) ? $plugin : array( 'name' => $plugin ) );
}

/**
 * Change the default filter values
 *
 * @param mixed $value
 *
 * @return mixed
 */
function _verthos_default_filters( $value = false ) {
	switch ( current_filter() ) {
		case 'default_option_whl_page':
			$value = 'up-restrito';
			break;
		case 'pre_option_bcce_recipient':
			$value = 'emails@viewup.com.br';
			break;
		case 'pre_option_cli_logo_url':
			$value = get_site_url();
			break;
		case 'wpseo_breadcrumb_separator':
			$value = '/';
			break;
		case 'pre_option_cli_logo_file':
			$value = get_theme_mod( 'custom_logo' ) ?
				wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ) : false;
			break;
	}

	return $value;
}

add_filter( 'default_option_whl_page', '_verthos_default_filters', 1, 10000 );
add_filter( 'pre_option_bcce_recipient', '_verthos_default_filters', 1, 10000 );
add_filter( 'pre_option_cli_logo_url', '_verthos_default_filters', 1, 10000 );
add_filter( 'wpseo_breadcrumb_separator', '_verthos_default_filters', 1, 10000 );
add_filter( 'pre_option_cli_logo_file', '_verthos_default_filters', 1, 10000 );

/**
 * Update the taxonomy meta when ACF sets it
 *
 * @param mixed $value
 * @param string $id
 * @param array $field
 *
 * @return mixed $value
 */
function _verthos_taxonomy_meta_fix( $value = '', $id = '', $field = array() ) {
	$term_id = absint( filter_var( $id, FILTER_SANITIZE_NUMBER_INT ) );
	if ( $term_id > 0 ) {
		update_term_meta( $term_id, $field['name'], $value );
	}

	return $value;
}

add_filter( 'acf/update_value', '_verthos_taxonomy_meta_fix', 10000, 3 );

/**
 * Fix CF7 Field
 *
 * @param string $value the current value
 * @param string|array $field the field name
 * @param string|array $replace the new field name
 *
 * @return string
 */
function _verthos_cf7_replace( $value, $field = '', $replace = '' ) {
	if ( ! is_array( $field ) ) {
		$field   = array( $field );
		$replace = array( $replace );
	}

	foreach ( $field as $i => $item ) {
		$value = str_replace( 'your-' . $item, $replace[ $i ], $value );
	}

	return $value;
}

/**
 * Contact Form Default Properties
 *
 * @param WPCF7_ContactForm $form
 *
 * @return WPCF7_ContactForm
 */
function _verthos_cf7_default_form( $form ) {

	$properties = $form->get_properties();

	if ( $properties['additional_settings'] ) {
		return $form;
	}

	/**
	 * Fix Form
	 */
	$properties['form'] = _verthos_cf7_replace( $properties['form'],
		array( 'name', 'subject', 'message', '' ),
		array( 'nome', 'assunto', 'mensagem', '' ) );

	/**
	 * Fix Mails
	 */
	$mails = array(
		'mail'   => $properties['mail'],
		'mail_2' => $properties['mail_2'],
	);
	foreach ( $mails as $field => $mail ) {
		$mail['subject']            = _verthos_cf7_replace( $mail['subject'], 'subject', 'assunto' );
		$mail['sender']             = _verthos_cf7_replace( $mail['sender'], 'name', 'nome' );
		$mail['recipient']          = _verthos_cf7_replace( $mail['recipient'] );
		$mail['additional_headers'] = _verthos_cf7_replace( $mail['additional_headers'] );

		$mail['body'] = _verthos_cf7_replace( $mail['body'],
			array( 'name', 'subject', 'message', '' ),
			array( 'nome', 'assunto', 'mensagem', '' ) );

		$properties[ $field ] = $mail;
	}

	/**
	 * Fix Flamingo
	 */
	$properties['additional_settings'] = implode( "\n", array(
		'flamingo_email: "[email]"',
		'flamingo_name: "[nome]"',
		'flamingo_subject: "[assunto]"',
	) );

	$form->set_properties( $properties );

	return $form;
}

add_filter( 'wpcf7_contact_form_default_pack', '_verthos_cf7_default_form' );

/**
 * Popula Formulários de Contato.
 */
function _verthos_cf7_install() {
	/**
	 * Detect if the default form was inserted
	 */
	if ( 1 < count( get_posts( array( 'post_type' => 'wpcf7_contact_form' ) ) ) ) {
		return;
	}

	$subject_prefix = get_bloginfo( 'name' ) . ' ';
	$sender         = $subject_prefix . '<' . WPCF7_ContactFormTemplate::from_email() . '>';

	$contact_form = WPCF7_ContactForm::get_template( array( 'title' => __( 'Newsletter', 'verthos' ), ) );

	$contact_form->set_properties( array(
		'form'     => sprintf( '[email* email placeholder "%1$s"][submit "%2$s"]',
			__( 'Insira seu e-mail', 'verthos' ),
			__( 'Assinar', 'verthos' )
		),
		'mail'     => array(
			'subject' => $subject_prefix . __( 'Novo inscrito no Newsletter "[email]"', 'verthos' ),
			'sender'  => $sender,
			'body'    => __( 'Você tem um novo inscrito no seu Newsletter.', 'verthos' ) . "\n\n" .
			             sprintf( __( 'Email: %s', 'verthos' ), '[email]' ) . "\n"
		),
		'mail_2'   => array(
			'active'    => true,
			'subject'   => $subject_prefix . __( 'Inscrição no Newsletter Confirmada', 'verthos' ),
			'sender'    => $sender,
			'recipient' => '[email]',
			'body'      => __( 'Sua inscrição no nosso Newsletter foi confirmada!', 'verthos' ) . "\n\n" .
			               __( 'Obrigado por se inscrever no nosso Newsletter.', 'verthos' ) . "\n"
		),
		'messages' => array(
			'mail_sent_ok' => __( 'Inscrição no Newsletter confirmada. Cheque seu e-mail.', 'verthos' )
		)
	) );

	$contact_form->save();
}

add_action( 'activate_' . plugin_basename( 'contact-form-7/wp-contact-form-7.php' ), '_verthos_cf7_install', 15 );
