<?php

function getAllSpecies()
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM species";

	$query = $db->prepare($sql);
	$query->execute();

	$db = null;

	return $query->fetchAll();
}

function getSpecie($id)
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM species WHERE species_id = :id LIMIT 1";

	$query = $db->prepare($sql);
	$query->execute(array(
		":id" => $id
	));

	$db = null;

	return $query->fetch();
}

function createSpecie()
{
	$Description = isset($_POST["Description"]) ? $_POST["Description"] : null;
	
	if ($Description === null) {
		return false;
	}
	//Database verbinding maken
	$db = openDatabaseConnection();

	$sql = "INSERT INTO species (species_Description) VALUES (:Description)";

	$query = $db->prepare($sql);
	$query->execute(array(
		":Description" => $Description
	));

	//Database verbinding sluiten
	$db = null;

	return true;
}

function deleteSpecie($id)
{
	if ($id === '') {
		return false;
	}

	$db = openDatabaseConnection();

	$sql = "DELETE FROM species WHERE species_id = :id";

	$query = $db->prepare($sql);
	$query->execute(array(
		":id" => $id
	));

	$db = null;

	return true;
}

function editSpecie($id=null)
{
	$Description = isset($_POST["Description"]) ? $_POST["Description"] : null;
	
	if ($id == null || $Description == null) {
		return false;
	}

	$db = openDatabaseConnection();

	$sql = "UPDATE species
			SET species_Description = :Description
			WHERE species_id = :id";

	$query = $db->prepare($sql);

	$query->execute(array(
		":id" => $id,
		":Description" => $Description
	));

	$db = null;

	return true;
}