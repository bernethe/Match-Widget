<?php

require_once('-globals.php');

global $wpdb;

if(isset($_POST['mid_txt'])) {
	$wpdb->update( 
		$wpdb->prefix.'chope_matches', 
		array(
			'mthomef' => $_POST['home_team'],
			'mtvisitf' => $_POST['visit_team'],
			'mstadium' => $_POST['sta_txt'],
			'mplace' => $_POST['local_txt'],
			'mdate' => $_POST['yearMatch_txt'].'-'.$_POST['monthMatch_txt'].'-'.$_POST['dayMatch_txt'].' 23:59:59'
		),
		array( 'mid' => $_POST['mid_txt'] )
	);
}

if(isset($_POST['is_new_match'])) {
	$wpdb->insert( 
		$wpdb->prefix.'chope_matches', 
		array( 
			'mthomef' => $_POST['home_team'],
			'mtvisitf' => $_POST['visit_team'],
			'mstadium' => $_POST['sta_txt'],
			'mplace' => $_POST['local_txt'],
			'mdate' => $_POST['yearMatch_txt'].'-'.$_POST['monthMatch_txt'].'-'.$_POST['dayMatch_txt'].' 23:59:59'
		), 
		array( 
			'%s', 
			'%s', 
			'%s', 
			'%s', 
			'%s' 
		) 
	);
}

$query = $wpdb->get_results("SELECT mid, mthomef, mtvisitf, mstadium, UNIX_TIMESTAMP(mdate) as mfecha FROM ".$wpdb->prefix."chope_matches WHERE mstatus = 1 AND mdate > CURRENT_TIMESTAMP ORDER BY mdate ASC");

?><div class="wrap">
	<h2>Próximos Partidos <a href="admin.php?page=match-new" class="add-new-h2">Añadir nuevo</a></h2>
	<?php if(isset($_POST['mid_txt'])) { ?>
	<div id="message" class="updated notice notice-success is-dismissible below-h2"><p>Partido actualizado.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
	<?php } ?>
	<?php if(isset($_POST['is_new_match'])) { ?>
	<div id="message" class="updated notice notice-success is-dismissible below-h2"><p>Partido insertado.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
	<?php } ?>
</div>
<?php //var_dump($query); ?>
<table class="wp-list-table widefat fixed striped pages">
	<thead>
	<tr>
		<th scope="col" id="title" class="manage-column column-title sortable desc" style="">
			<a href="admin.php?page=match-inicio&amp;orderby=title&amp;order=asc">
				<span>Título</span>
				<span class="sorting-indicator"></span>
			</a>
		</th>
		<th scope="col" id="stadium" class="manage-column column-stadium" style="">Estadio</th>
		<th scope="col" id="date" class="manage-column column-date sortable asc" style="">
			<a href="admin.php?page=match-inicio&amp;orderby=date&amp;order=desc">
				<span>Fecha</span><span class="sorting-indicator"></span>
			</a>
		</th>
	</tr>
	</thead>

	<tbody id="the-list">
		<?php foreach ($query as $kQ => $vQ) { ?>
		<tr id="post-2" class="iedit author-self level-0 post-2 type-page status-publish hentry">
			<td class="post-title page-title column-title">
				<strong>
					<a class="row-title" href="admin.php?page=match-edit&post=<?php echo $vQ->mid; ?>&action=edit" title="Editar"><?php echo $countries[$vQ->mthomef].' - '.$countries[$vQ->mtvisitf]; ?></a>
				</strong>
				<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<div class="row-actions"><span class="edit"><a href="admin.php?page=match-edit&post=<?php echo $vQ->mid; ?>&action=edit" title="Editar este elemento">Editar</a> | </span><span class="inline hide-if-no-js"> </span><span class="trash"><a class="submitdelete" title="Mover este elemento a la papelera" href="#">Borrar</a></span></div>
			</td>
			<td><?php echo $vQ->mstadium; ?></td>
			<td class="date column-date"><?php echo date('d/m/Y',$vQ->mfecha); ?></td>
		</tr>
		<?php } ?>
	</tbody>

	<tfoot>
	<tr>
		<th scope="col" id="title" class="manage-column column-title sortable desc" style="">
			<a href="admin.php?page=match-inicio&amp;orderby=title&amp;order=asc">
				<span>Título</span>
				<span class="sorting-indicator"></span>
			</a>
		</th>
		<th scope="col" id="stadium" class="manage-column column-stadium" style="">Estadio</th>
		<th scope="col" id="date" class="manage-column column-date sortable asc" style="">
			<a href="admin.php?page=match-inicio&amp;orderby=date&amp;order=desc">
				<span>Fecha</span><span class="sorting-indicator"></span>
			</a>
		</th>
	</tr>
	</tfoot>

</table>