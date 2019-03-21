<?php
class Helper {

	/**
	 * @description Apply styles css on Html Element
	 * @author Yan santos Policarpo
	 * @ver 1.0.0
	 *
	 * @param array $styles of the styles rules
	 *
	 * @return Void draw rules
	 */
    public function Apply_style ( $styles = array() ) {
        if( !empty( $styles ) ):?>
        style="
        <?php
            foreach ( $styles as $key => $value ) :
                if(!empty($value)): 
        ?>
                    <?=$key;?>:
                    <?php if( $key == "background-image" ):?>
                        url( <?=$value;?>);
                    <?php else :?>
                        <?=$value;?>;
                    <?php endif;?>
            <?php   
                endif;
            endforeach;
            ?>
        "
    <?php endif;}
    /**
     *@description Apply styles on  HTML element
     *@Author Yan santos Policarpo
     *@Ver 1.0.0
     *@Param array $classes to apply
     *@return void draw class 
     */
	public function Apply_classes( $classes ) {
		if( !empty( $classes ) ): ?>
            class="<?php foreach($classes as $class):?><?=$class.' '; ?><?php endforeach;?>"
		<?php endif;
    }
   
    public function Apply_data_attr( $data_attr ) {
        if( !empty( $data_attr ) ):
            foreach ( $data_attr as $key => $value ) :
                if( !empty( $value ) && !empty( $key )  ): ?>
                    <?=$key;?>="<?=$value;?>"<?=' '?>     
                <?php endif;
            endforeach;
        endif;
    }
    public function Apply_class_with_default( $current = array(), $default = array() ){
        if( !empty( $current ) ):  $this->Apply_classes( $current );  else: $this->Apply_classes( $default ); endif;   
    }
}
