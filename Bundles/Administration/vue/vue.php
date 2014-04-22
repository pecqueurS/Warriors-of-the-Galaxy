<section id="content">
<h1><img src="../../images/titre.png" alt="Warriors of the Galaxy"></h1>

<?php
// NON CONNECTE
if($_SESSION["admin"] == FALSE) {

?>

	<form id="authentification" action="wotg-admin" method="POST">
		<fieldset>
			<legend>Authentification : </legend>
			<label for="admin">User Name :</label><br/>
			<input type="text" id="admin" name="admin" value=""><br/>
			<label for="pwd">Password :</label><br/>
			<input type="text" id="pwd" name="pwd" value="">
		</fieldset>
		<div>
			<a href="<?php echo URL_BASE; ?>" class="auth">Accueil</a>
			<input type="submit" class="auth" name="authentification" value="Se Connecter">
		</div>

	</form>
<?php
// CONNECTE	
} else {
	// ONGLET JOEUURS
	if(isset($onglet) && $onglet=="joueurs") {
?>
<div id="joueurs">
	<table class="tableau">
		<thead>
			<tr>
				<th>Id</th>
				<th>Activ</th>
				<th>Avatar</th>
				<th>Login</th>
				<th>Xp</th>
				<th>En Ligne</th>
				<th>Debut connection</th>
				<th>Fin connection</th>
				<th>ID Partie</th>
				<th>Team</th>
				<th>Race</th>
				<th>Ready</th>
				<th>IP</th>
				<th>Session ID</th>
			</tr>
		</thead>
		<tbody>


<?php
	foreach ($joueurs as $joueur) {
		echo "<tr>";
		foreach ($joueur as $value) {
			echo "<td>".$value."</td>";
		}
		echo "</tr>";
	}
?>








		
		</tbody>

	</table>

</div>




<?php
	}
	// ONGLET parties
	if(isset($onglet) && $onglet=="parties") {
?>
<div id="parties">
	<table class="tableau">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>mdp</th>
				<th>Max</th>
				<th>Fin</th>
				<th>Commencée</th>
				<th>fin</th>
				<th>Créateur</th>
			</tr>
		</thead>
		<tbody>


<?php
	foreach ($parties as $partie) {
		echo "<tr>";
		foreach ($partie as $value) {
			echo "<td>".$value."</td>";
		}
		echo "</tr>";
	}
?>








		
		</tbody>

	</table>

</div>




<?php
	}
	// ONGLET messages
	if(isset($onglet) && $onglet=="messages") {
?>
<div data-info="bugs" class="auth btn">Bugs</div><div data-info="abus" class="auth btn">Abus</div>
<div id="bugs" class="messagesTab">
	<table class="tableau">
		<thead>
			<tr>
				<th>Id</th>
				<th>Login</th>
				<th>Date Message</th>
				<th>Date du Bug</th>
				<th>Message</th>
				
			</tr>
		</thead>
		<tbody>


<?php
	foreach ($bugs as $bug) {
		echo "<tr>";
		foreach ($bug as $value) {
			echo "<td>".$value."</td>";
		}
		echo "</tr>";
	}
?>





		
		</tbody>

	</table>

</div>


<div id="abus" class="messagesTab">
	<table class="tableau">
		<thead>
			<tr>
				<th>Id</th>
				<th>Login</th>
				<th>Date Message</th>
				<th>Date du Bug</th>
				<th>Message</th>
				
			</tr>
		</thead>
		<tbody>


<?php
	foreach ($abus as $abu) {
		echo "<tr>";
		foreach ($abu as $value) {
			echo "<td>".$value."</td>";
		}
		echo "</tr>";
	}
?>





		
		</tbody>

	</table>

</div>




<?php
	}
	if(isset($onglet) && $onglet=="erreurs") {

		echo "<pre>".$erreurs."</pre>";


	}

?>






<?php
} 

?>

</section>




  </body>
</html>
