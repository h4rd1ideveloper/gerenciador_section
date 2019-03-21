<?php
/**
 * Created by PhpStorm.
 * User: Viewup
 * Date: 18/03/19
 * Time: 08:44
 */

require_once( dirname(__FILE__) .'/../Utils/Helper.class.php');
class PureComponents extends Helper {
	public function Title( $text = '', $classes = array('section__main__content--title'), $default = array() ) {
		if( $text != '' ): ?>
			<h1 <?php parent::Apply_class_with_default( $classes, $default ); ?> > <?= $text ;?> </h1>
		<?php endif;
	}
	public function SubTitle( $text = '', $classes = array(), $default = array() ){
		if( $text != '' ): ?>
			<h2 <?php parent::Apply_class_with_default( $classes, $default ); ?> > <?= $text ;?> </h2>
		<?php endif;
	}
	public function content_SubTitle( $text = '', $classes = array(), $default = array() ){
		if( $text != '' ): ?>
			<h3 <?php parent::Apply_class_with_default( $classes, $default ); ?> > <?= $text ;?> </h3>
		<?php endif;
	}
	public function content_text( $text = '', $classes = array(), $default = array() ){
		if( $text != '' ): ?>
			<p <?php parent::Apply_class_with_default( $classes, $default ); ?> > <?= $text ;?> </p>
		<?php endif;
	}
	public function singleDiv( $classes, $data_attr = array(), $default = array() ){
		if( !empty( $classes )):
		?>
			<div <?php parent::Apply_class_with_default( $classes, $default ); if ( !empty( $data_attr ) ) { parent::Apply_data_attr( $data_attr ); } ?> ></div>	
		<?php
		endif;
	}

	public function img( $src = '', $data_attr = array(), $classes = array(), $default = array() ){
		?>
			<img <?php parent::Apply_data_attr( array_merge( array( 'src' => $src ), $data_attr ) ); parent::Apply_class_with_default( $classes, $default ); ?> />
		<?php
	}
	 /**
     * @description make a link with <a> html tag
     * @param $text Texto a ser exibido 
	 * @param $url Endereço https
	 * @param $classes Classes css
	 * @param $rel Relacionamento do link
	 * @return HTMLelement <a ...@param > $text </a>
     */
	public function link( $text = '', $url = '#', $classes = array(), $data_attr = array(), $target = '_self', $rel ='noopener noreferrer' ){
		?>
		<a <?php parent::Apply_data_attr( array_merge( array( 'href' => $url, 'target' => $target, 'rel' => $rel ), (array) $data_attr ) ); parent::Apply_class_with_default( $classes, $default = array() );?> >
			<?php if($text != ''):?> <?=$text;?> <?php endif;?>
		</a>
		<?php
	}
	/**
	 * @param HTMLelement $children
	 * @param URL $url 
	 * @param CSS $classes
	 * @param HTMprop $target
	 * @param HTMLprop $rel
	 */
	public function link_with_childrens( $children = '', $url = '#', $classes = array(), $target = '_self', $rel ='noopener noreferrer' ){
		?>
			<a <?php parent::Apply_data_attr( array( 'href' => $url, 'target' => $target, 'rel' => $rel ) ); parent::Apply_class_with_default( $classes, $default = array() );?> >
				<?= $children;?>
			</a>
		<?php
	}
}