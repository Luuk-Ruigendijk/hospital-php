<div class="container">
	<table border="1">
		<tr>
			<th>#</th>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>Phone</th>
			<th>Email</th>
			<th colspan="2">Actie</th>
		</tr>
		
		<?php foreach ($clients as $client) {
			echo "<tr>";
			echo "<td>" . $client['client_id'] . "</td>";
			echo "<td>" . $client['client_Firstname'] . "</td>";
			echo "<td>" . $client['client_Lastname'] . "</td>";
			echo "<td>" . $client['client_Phone'] . "</td>";
			echo "<td><a href=\"" . $client['client_email'] .  "\">" . $client['client_email'] . "</a></td>";
			echo "<td><a href=\"" . URL . "client/edit/" . $client['client_id'] . "\">Wijzigen</a></td>";
			echo "<td><a href=\"" . URL . "client/delete/" . $client['client_id'] . "\">Verwijderen</a></td>";
			echo "</tr>";
		}
		?>
	</table>
	<a href="<?= URL ?>client/create">Nieuw lied toevoegen</a>
</div>