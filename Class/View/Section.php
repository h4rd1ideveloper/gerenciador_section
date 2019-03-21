<?php
require_once( dirname(__FILE__) .'/PureComponents.php');
    /**
     *@Description Classe base para gerar views
     *@Ver 1.0.0
     <a href="<?= bloginfo('url'); ?>"  class="">
                                    <div class="section__footer--logo"></div>
                                </a>
     */
    class Section extends PureComponents {

        public function __construct() {
            //_init();
        }
        private function _init() {
        }
    
        public function navbar_variation( $data = array() ) {
            if( $data['variation'] == 1):?>
                <div <?php parent::Apply_class_with_default( $data['navbar-wrap-class'], array('navbar--wrap') );?> >
            <?php endif;?>
                    <div <?php parent::Apply_data_attr( array( 'data-collapse' => 'medium', 'data-animation' => 'default', 'data-duration' => '400' ) );
                    parent::Apply_class_with_default( $data['navbar-class'] , array( 'navbar', 'w-nav' ) );?> >
                        <div class="navbar__container w-container">
                            <?php
                                parent::link( '', get_home_url(), array( 'brand', $data['variation'] == 1?'white--color logo--white':'', 'w-nav-brand' ), ! empty( $data['data-attrs'] ) ?$data['data-attrs']:'' );
                            ?>
                            <nav role="navigation" class="nav-menu <?=$data['variation'] == 1?'white--color':''?> w-nav-menu">
                                <?php
                                    parent::link('quem somos', get_permalink( get_page_by_path( 'sobre' ) ), array( 'navbar__link', $data['variation'] == 1?'white--color':'', 'w-nav-link') );
                                ?>
                                <div data-delay="0" class="navbar__link <?=$data['variation'] == 1?'white--color':''?> w-dropdown">
                                    <div class="w-dropdown-toggle">
                                        <?php
                                            parent::singleDiv( array('icon', $data['variation'] == 1?'white--color':'', 'w-icon-dropdown-toggle' ) );
                                            parent::content_text( 'Cursos', array( 'text-block', $data['variation'] == 1?'white--color':'', 'm-0' ) );
                                        ?>
                                    </div>
                                    <nav class="dropdown-list w-dropdown-list">
                                        <?php
                                            parent::link('endodontia', get_permalink( get_page_by_path( 'endodontia' ) ),  array( 'dropdown-link', 'w-dropdown-link' ) );
                                            parent::link('implantodontia', get_permalink( get_page_by_path( 'implantodontia' ) ), array( 'dropdown-link', 'w-dropdown-link' ) );
                                        ?>
                                    </nav>
                                </div>
                                <?php
                                    parent::link('contato', 'http://192.168.29.250/sites/verthos/#contato', array( 'navbar__link', $data['variation'] == 1?'white--color':'', 'w-nav-link' ) );
                                    parent::link('Agende sua consulta', get_permalink( get_page_by_path( 'consulta' ) ), array( 'navbar__link', $data['variation'] == 1?'white--color':'', 'w-nav-link' ) );
                                ?>
                                </nav>
                            <div class="w-nav-button">
                                <? parent::singleDiv( array( 'w-icon-nav-menu' ) ); ?>
                            </div>
                        </div>
                        <?php
                            if( $data['variation'] != 1 ):
                        ?>
                        <div class="navbar__sub">
                            <?php
                                parent::link('(32) 99198-6861', '#', array('navbar__sub--link phone--icon') );
                                parent::link('verthosodontologia@gmail.com', '#', array('navbar__sub--link email--icon') );
                            ?>
                        </div>
                        <?php
                            endif;
                        ?>
                    </div>
                <?php if( $data['variation'] == 1):?>
                    <?php parent::Title($data['title'], $data['title-class'])?>
                </div>
                <?php endif;?>

        <?php }
        public function navbar() {?>
            <div data-collapse="medium" data-animation="default" data-duration="400" class="navbar w-nav">
                <div class="navbar__container w-container">
                    <a href="<?= bloginfo('url'); ?>" data-w-id="1b50b9fc-829c-8174-ee31-dc53bc3e6099" class="brand w-nav-brand w--current"></a>
                    <nav role="navigation" class="nav-menu w-nav-menu">
                        <a href="<?= get_permalink( get_page_by_path( 'sobre' ) ); ?>"  class="navbar__link ">quem somos</a>
                        <div data-delay="0" class="navbar__link w-dropdown">
                            <div class="w-dropdown-toggle">
                                <div class="icon w-icon-dropdown-toggle"></div>
                                <div class="text-block">Cursos</div>
                            </div>
                            <nav class="dropdown-list w-dropdown-list">
                                <a href="<?= get_permalink( get_page_by_path( 'endodontia' ) ); ?>" class="dropdown-link w-dropdown-link">endodontia</a>
                                <a href="<?= get_permalink( get_page_by_path( 'implantodontia' ) ); ?>" class="dropdown-link w-dropdown-link">PERIODONTIA</a>
                            </nav>
                        </div>
                        <a href="<?= bloginfo('url'); ?>/#contato" class="navbar__link ">contato</a>
                        <a href="<?= get_permalink( get_page_by_path( 'consulta' ) ); ?>" class="navbar__link ">Agende sua consulta</a>
                    </nav>
                    <div class="menu-button w-nav-button">
                        <div class="w-icon-nav-menu"></div>
                    </div>
                </div>
                <div class="navbar__sub">
                    <a href="#" class="navbar__sub--link">(32) 99198-6861</a>
                    <a href="#" class="navbar__sub--link">verthosodontologia@gmail.com</a>
                </div>
            </div>
        <?php
        }
        public function section_main_matricula() {?>
            <section class="section__contatos">
                <div class="form__wrap form__matricula">
                <?php parent::Title('Os melhores profissionais', array( 'section__main__content--title', 'centred' )); ?>
                <?php parent::SubTitle('Atendimento com qualidade e compromisso.', array( 'section__main__content--sub', 'centred' ) ); ?>
                <div class="form__icon--row"></div>
                <div class="w-form">
                    <?php echo do_shortcode('[contact-form-7 id="133" title="matricula"]'); ?> 
                </div>
            </section>
        <?php }
        public function section_main_consulta() {?>
             <section class="section__contatos">
                <div class="form__wrap">
                    <?php parent::Title('Os melhores profissionais', array( 'section__main__content--title', 'centred' ) ); ?>
                    <?php parent::SubTitle('Atendimento com qualidade e compromisso.', array( 'section__main__content--sub', 'centred' ) ); ?>
                    <div class="form__icon--row"></div>
                    <div class="form-block w-form">
                        <?php echo do_shortcode('[contact-form-7 id="135" title="consulta"]'); ?> 
                    </div>
                </div>
            </section>
        <?php }
        public function section_main_default() {?>
            <div class="section__main with__bg">
                <div class="container-3 w-container">
                    <?php
                    parent::Title('Faça já sua matricula!', array( 'section__main__content--title', 'centred' ) ); 
                    parent::SubTitle('O melhor da odontologia para o seu escritório.', array( 'section__short__content--sub', 'centred' ) );
                    parent::link('Realizar matricula', get_permalink( get_page_by_path( 'matricula' ) ), array( 'vwp-btn', 'w-button' ) );
                    ?>
                </div>
            </div>
        <?php }
        public function sectio_main_ementa( $data ) {?>
            <div class="section__main">
                <div class="w-container">
                <?php  
                    parent::Title( $data['title'], $data['title-class'], array( 'section__cursos--title', 'centred' ) );
                    foreach( $data['text-content-list'] as $data_list ): ?>
                        <div <?php parent::Apply_classes( $data_list['content-wrap-class'] ) ?> >
                            <?php foreach( $data_list['text-content'] as $data_content ): ?>
                                <div class="w-clearfix w-col w-col-4">
                                    <div class="icon__div bg-orange"></div>
                                    <?php
                                     parent::content_SubTitle( $data_content['sub-title'], array( 'section__cursos--sub' ) );
                                     parent::content_text( $data_content['content'], array( 'section__cursos--text' )); 
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php }
        public function section_main_about( $data ){?>
            <div <?php parent::Apply_classes( $data['section-class'] ); parent::Apply_data_attr( $data['data-attrs'] );?>  >
                <div class="w-container">
                    <?php
                        parent::SubTitle( $data['title'], $data['title-class'], array('section__main__content--title', 'centred') );
                        parent::content_SubTitle( $data['sub-title'], $data['sub-title-class'], array('section__main__content--sub', 'centred') );
                        parent::singleDiv( $data['banner-class'],'', array('section__about__banner') );
                    ?>
                    <div class="row">
                        <?php foreach( $data['sub-banners'] as $sub_banner ):
                            parent::singleDiv( $sub_banner['banner-class'],'', array('col banner__about--2') );
                         endforeach; ?>
                    </div>
                </div>
            </div>
        <?php }
        public function section_main_cursos(){?>
            
                <section  <?php parent::Apply_data_attr( array( 'data-w-id' => '03c15b65-5ec0-f9b3-b35c-8c8d5e1cf2f5', 'id' => 'cursos' ) ); parent::Apply_classes( array( 'section__main', 'bg-v2' ) ); ?>>
                    <div class="section__main--container w-container">
                        
                        <?php
                            parent::Title('Nossos cursos', array( 'section__main__content--title', 'centred' ) );
                        ?>
                        <div data-animation="slide" data-duration="500" data-infinite="1" class="slider--cursos w-slider">
                            <div class="slider__cursos--mask w-slider-mask">
                                <div class="slider__curso--item w-slide">
                                    <?php
                                        parent::img( 
                                            get_template_directory_uri().'/images/Webp.net-resizeimage-7.png',
                                            array(
                                                'srcset' => get_template_directory_uri().'/images/Webp.net-resizeimage-7-p-500.png 500w, '.get_template_directory_uri().'/images/Webp.net-resizeimage-7.png 574w',
                                                'sizes' => '(max-width: 479px) 92vw, (max-width: 767px) 44vw, (max-width: 991px) 200.90625px, 192.40625px'
                                            ),
                                            array( 'slider__curso--image' )
                                        );
                                        parent::SubTitle('Endodonotia', array('slider__curso--title') );
                                        parent::content_text('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.', array( 'slider__curso--text' ) );
                                        parent::link( 'Button Text', get_permalink( get_page_by_path( 'endodontia' ) ), array( 'slider__curso--btn', 'w-button' ) );
                                    ?>
                                </div>
                                <div  class="slider__curso--item w-slide">
                                    <?php
                                        parent::img( 
                                            get_template_directory_uri().'/images/Webp.net-resizeimage-7.png',
                                            array(
                                                'srcset' => get_template_directory_uri().'/images/Webp.net-resizeimage-7-p-500.png 500w, '.get_template_directory_uri().'/images/Webp.net-resizeimage-7.png 574w',
                                                'sizes' => '(max-width: 479px) 92vw, (max-width: 767px) 44vw, (max-width: 991px) 200.90625px, 192.40625px'
                                            ),
                                            array( 'slider__curso--image' )
                                        );
                                        parent::SubTitle('Endodonotia', array('slider__curso--title') );
                                        parent::content_text('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.', array( 'slider__curso--text' ) );
                                        parent::link( 'Button Text', get_permalink( get_page_by_path( 'endodontia' ) ), array( 'slider__curso--btn', 'w-button' ) );
                                    ?>
                                </div>
                                <div class="slider__curso--item w-slide">
                                    <?php
                                        parent::img( 
                                            get_template_directory_uri().'/images/Webp.net-resizeimage-7.png',
                                            array(
                                                'srcset' => get_template_directory_uri().'/images/Webp.net-resizeimage-7-p-500.png 500w, '.get_template_directory_uri().'/images/Webp.net-resizeimage-7.png 574w',
                                                'sizes' => '(max-width: 479px) 92vw, (max-width: 767px) 44vw, (max-width: 991px) 200.90625px, 192.40625px'
                                            ),
                                            array( 'slider__curso--image' )
                                        );
                                        parent::SubTitle('Endodonotia', array('slider__curso--title') );
                                        parent::content_text('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.', array( 'slider__curso--text' ) );
                                        parent::link( 'Button Text', get_permalink( get_page_by_path( 'implantodontia' ) ), array( 'slider__curso--btn', 'w-button' ) );
                                    ?>
                                </div>
                            </div>
                            <div class="left-arrow w-slider-arrow-left">
                                <div class="icon-2 w-icon-slider-left"></div>
                            </div>
                            <div class="right-arrow w-slider-arrow-right">
                                <div class="icon-3 w-icon-slider-right"></div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php //endif; ?>
        <?php }
        public function section_main_pure_map() {?>
            <section id="contato" class="section__main">
                <div class="section__main--container w-container">
                    <div class="w-row">
                        <div class="w-col w-col-6">
                            <div class="w-form">
                                <?php echo do_shortcode('[contact-form-7 id="134" title="contato"]'); ?>
                            </div>
                        </div>
                        <div class="w-col w-col-6">
                            <?php parent::singleDiv( array('map', 'w-widget', 'w-widget-map' ), array( 'data-widget-latlng' => '-21.7624237,-43.3433999', 'data-widget-zoom' => '11', 'data-widget-style' => 'hybrid' ) ); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php }
        private function section_main_centred_short( $data ) {?>
            <?php if( !empty( $data ) ): ?>
                <section class="section__short">
                    <div class="w-container">
                        <?php
                            parent::Title( $data['title'], array( 'section__short__content--title' ) );
                            parent::SubTitle( $data['sub-title'], array( 'section__short__content--sub' ) );
                        ?>
                        <div <?php parent::Apply_class_with_default( $data['text-class'], array( 'columns-8', 'w-row' ) ); ?> >
                            <?php foreach( $data['text-content']  as $data_content ): ?>
                                <div class="section__short__content--item w-col w-col-4 w-col-small-4">
                                    <?php
                                        parent::singleDiv( array('icon__div') );
                                        parent::content_text( $data_content['sub-title'], array( 'section__short__content--text' ) );
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif;?>
        <?php }
        public function section_main_centred( $data ) {?>
            <?php if( !empty( $data ) ): ?>
                <?php if( !empty( $data['variation'] ) && $data['variation'] == 'short' ):
                   $this->section_main_centred_short( $data );
                 else:
                 ?>
                    <div class="section__main">
                        <div class="section__main--container w-container">
                            <?php
                                parent::Title( $data['title'], array( 'section__main__content--title', 'centred' ) );
                            ?>
                            <div <?php parent::Apply_class_with_default( $data['text-class'], array( 'columns-8', 'w-row' ) ); ?> >
                                <?php foreach( $data['text-content'] as $data_content ): ?>
                                    <div class="w-col w-col-4">
                                        <div <?php parent::Apply_class_with_default( $data_content['sub-title-wrap-class'], array( 'row' ) ); ?> >
                                            <?php
                                                parent::singleDiv(array('icon__div'));
                                                parent::content_text( $data_content['sub-title'], array( 'section__main__content--sub', 'text-small' ) );
                                            ?>
                                        </div>
                                        <?php
                                            parent::content_text( $data_content['content'], array( 'section__main--content', 'mt-10' ) );
                                        ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php  endif; ?>
            <?php endif; ?>
        <?php }
        public function section_main( $data ) {?>
            <!--Start call function Section main -->
            <section <?php parent::Apply_classes( $data['section-class'] ); parent::Apply_data_attr( $data['data-attrs'] ); ?> >
                <div class="section__main--container w-container">
                    <div class="w-row">
                        <?php if( !$data['text-left'] ): ?>
                            <div <?php parent::Apply_classes( $data['banner-wrap-class'] ); ?> >
                                <?php
                                    parent::singleDiv( $data['banner-class'] );
                                ?>
                            </div>
                            <div <?php parent::Apply_classes( $data['text-class'] ); ?> >
                                <?php
                                    parent::Title( $data['title'], array( 'section__main__content--title' ) );
                                ?>
                                <?php
                                    foreach($data['text-content'] as $data_content):
                                        parent::content_SubTitle( $data_content['sub-title'], $data['sub-title-class'], array( 'section__main__content--sub' ) );
                                        parent::content_text( $data_content['content'], $data['content-class'], array('section__main--content') );
                                        parent::link( $data_content['btn-text'], $data_content['btn-url'], $data_content['btn-class']);
                                ?>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        <?php else: ?>
                            <div <?php parent::Apply_classes( $data['text-class'] ); ?> >
                                <?php
                                    parent::Title( $data['title'], array( 'section__main__content--title' ) );
                                    foreach($data['text-content'] as $data_content):
                                        parent::content_SubTitle( $data_content['sub-title'], $data['sub-title-class'], array( 'section__main__content--sub' ) );
                                        parent::content_text( $data_content['content'], $data['content-class'], array( 'section__main--content' ) );
                                        parent::link( $data_content['btn-text'], $data_content['btn-url'], $data_content['btn-class']);
                                    endforeach;
                                ?>
                            </div>
                            <div <?php parent::Apply_classes( $data['banner-wrap-class'] ); ?> >
                                <?php
                                    parent::singleDiv( $data['banner-class'] );
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!--End call function Section main -->
        <?php }
        public function footer(){
            ?>
                <footer id="rodape" class="section__footer">
                    <div class="w-container">
                        <div class="w-row">
                            <div class="w-col w-col-6 w-col-small-small-stack">
                                <?php
                                    parent::link_with_childrens('<div class="section__footer--logo"></div>', get_home_url(), array( 'link-block', 'w-inline-block', 'w--current' ));
                                    parent::content_text('Av Barão do Rio Branco, nº 1547<br>Centro de Juiz de fora MG', array('section__footer--text'));
                                    parent::link('(32) 9 9198 6861', 'tel:32991986861', array( 'section__footer--link', 'not-centred' ) );
                                ?>
                            </div>
                            <div class="w-col w-col-6 w-col-small-small-stack">
                                <div class="columns-2 w-row">
                                    <div class="w-col w-col-4"><a href="<?= bloginfo('url'); ?>/#contato" class="section__footer--link">Contato</a></div>
                                    <div class="w-col w-col-4"><a href="<?= get_permalink( get_page_by_path( 'consulta' ) ); ?>" class="section__footer--link">Agende sua consulta</a></div>
                                    <div class="w-col w-col-4"><a href="<?= get_permalink( get_page_by_path( 'sobre' ) ); ?>" class="section__footer--link w--current">Quem somos</a></div>
                                </div>
                                <div class="columns w-row">
                                    <div class="column-6 w-col w-col-4">
                                        <a href="<?= get_permalink( get_page_by_path( 'implantodontia' ) ); ?>" class="section__footer--link">Cursos</a>
                                    </div>
                                    <div class="column-4 w-col w-col-8">
                                        <a href="#" class="icon-fb w-inline-block"></a>
                                        <a href="#" class="icon-tw w-inline-block"></a>
                                        <a href="#" class="icon-inst w-inline-block"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            <?php
        }
    }