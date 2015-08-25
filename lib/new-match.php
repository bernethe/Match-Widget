<?php require_once('-globals.php'); ?><div class="wrap">
	<h2>Añadir nuevo partido</h2>
	<form action="admin.php?page=match-inicio" method="POST">
		<input type="hidden" id="is_new_match" name="is_new_match" value="1">
		<table class="form-table"><tbody>
			<tr>
				<th scope="row">Equipo Casa:</th>
				<td><select name="home_team" id="home_team"><?php foreach ($countries as $keyH => $valueH) {
					echo '<option value="'.$keyH.'"';
					if($keyH == 'CR') {
						echo ' selected';
					}
					echo '>'.$valueH.'</option>';
				} ?></select></td>
			</tr>
			<tr>
				<th scope="row">Equipo Visita:</th>
				<td><select name="visit_team" id="visit_team"><?php foreach ($countries as $keyV => $valueV) {
					echo '<option value="'.$keyV.'"';
					if($keyV == 'CR') {
						echo ' selected';
					}
					echo '>'.$valueV.'</option>';
				} ?></select></td>
			</tr>
			<tr>
				<th scope="row">Estadio:</th>
				<td><input type="text" class="regular-text" name="sta_txt" id="sta_txt"></td>
			</tr>
			<tr>
				<th scope="row">Localidad:</th>
				<td><input type="text" class="regular-text" name="local_txt" id="local_txt"></td>
			</tr>
			<tr>
				<th scope="row">Fecha:</th>
				<td>
					<select name="dayMatch_txt" id="dayMatch_txt"><?php for ($iD=1; $iD < 32; $iD++) { 
						echo '<option value="'.$iD.'"';
						if($iD == date("j")) {
							echo ' selected';
						}
						echo '>'.$iD.'</option>';
					} ?></select>
					<select name="monthMatch_txt" id="monthMatch_txt"><?php for ($iM=0; $iM < 12; $iM++) { 
						echo '<option value="'.($iM+1).'"';
						if(($iM+1) == date("n")) {
							echo ' selected';
						}
						echo '>'.$meses[$iM].'</option>';
					} ?></select>
					<select name="yearMatch_txt" id="yearMatch_txt"><?php for ($iY=date('Y'); $iY < (date('Y')+2); $iY++) { 
						echo '<option value="'.$iY.'"';
						if($iY == date("Y")) {
							echo ' selected';
						}
						echo '>'.$iY.'</option>';
					} ?></select>
				</td>
			</tr>
		</tbody></table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios"></p>
	</form>
</div>