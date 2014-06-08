<nav id="navigation">
	<h1>Back Office</h1>
<?php

if($_SESSION["admin"] == TRUE) {

?>

	<form id="deco" action="<?php echo URL_ADMIN; ?>" method="POST">
		<div>
			<input type="submit" id="logout" name="deconnection" value="Deconnexion">
		</div>
	</form>

<div class="menu">
	<h2><a href="<?php echo URL_ADMIN; ?>">Administration</a></h2>
	<ul>
		<li><a href="<?php echo URL_ADMIN; ?>/joueurs">Joueurs</a></li>
		<li><a href="<?php echo URL_ADMIN; ?>/parties">Parties</a></li>
		<li><a href="<?php echo URL_ADMIN; ?>/messages">Messages</a></li>
		<li><a href="<?php echo URL_ADMIN; ?>/erreurs">Erreurs</a></li>
	</ul>
</div>



<?php

}

?>
</nav>

