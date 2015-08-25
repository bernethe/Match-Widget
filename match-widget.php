<?php
/*
Plugin Name: Chope Match Widget
Plugin URI: http://latres.com
Description: Plugin desarrollado para el sitio de Wanchope
Version: 1.0.0
Author: Bernethe
Author URI: http://bernethe.com/
License: GPLv2
*/

function alloc_init() {
	global $wpdb;

	$wpdb->query("CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."chope_matches (
			mid INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			mthomef VARCHAR( 32 ) NOT NULL ,
			mtvisitf VARCHAR( 32 ) NOT NULL ,
			mstadium VARCHAR( 128 ) NOT NULL ,
			mplace VARCHAR( 128 ) NOT NULL ,
			mdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
			mstatus INT NOT NULL DEFAULT 1 )");
}
function gancho_js() {
	echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>';
}
function my_plugin_b_admin() {
	$firstPageMatch = add_object_page('Próximos Partidos', 'Partidos', 'manage_options', 'match-inicio','match_inicio',WP_CONTENT_URL.'/plugins/match-widget/chope-match.png');
	add_submenu_page('match-inicio','Crear Nuevo Partidos','Nuevo Partido','manage_options', 'match-new', 'menu_match_new');
	add_submenu_page($firstPageMatch,'Editar Partidos','Editar Partido','manage_options', 'match-edit', 'menu_match_edit');
}

function match_inicio(){
	include 'lib/init.php';
}
function menu_match_new(){
	include 'lib/new-match.php';
}
function menu_match_edit() {
	include 'lib/edit.php';
}


add_action('activated_plugin','alloc_init');
add_action('wp_head','gancho_js');
add_action('admin_menu', 'my_plugin_b_admin');

?>