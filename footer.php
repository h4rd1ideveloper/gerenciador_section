<?php
require_once( dirname(__FILE__) .'/Class/View/Section.php');
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package verthos
 */
wp_footer();
$ViewMananger = new Section();
$ViewMananger->footer();
?>

<script src="<?= get_template_directory_uri();?>/js/send_mail.js"></script>
<script src="<?= get_template_directory_uri();?>/js/sweet.js"></script>
</body>
</html>
