<?php

function getAllPatients()
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM `patients` INNER JOIN `clients` ON `patients`.`client_id` = `clients`.`client_id` INNER JOIN `species` ON `patients`.`species_id` = `species`.`species_id`";

	$query = $db->prepare($sql);
	$query->execute();

	$db = null;

	return $query->fetchAll();
}

function getPatient($id)
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM patients WHERE patient_id = :id LIMIT 1";

	$query = $db->prepare($sql);
	$query->execute(array(
		":id" => $id
	));

	$db = null;

	return $query->fetch();
}

function createPatient()
{
	$Name = isset($_POST["Name"]) ? $_POST["Name"] : null;
	$Species = isset($_POST["Species"]) ? $_POST["Species"] : null;
	$Status = isset($_POST["Status"]) ? $_POST["Status"] : null;
	$Client = isset($_POST["Client"]) ? $_POST["Client"] : null;
	
	if ($Name === null || $Species === null || $Status === null || $Client === null) {
		return false;
	}
	//Database verbinding maken
	$db = openDatabaseConnection();

	$sql = "INSERT INTO patients (patient_Name, species_id, patient_Status, client_id) VALUES (:Name, :Species, :Status, :Client)";

	$query = $db->prepare($sql);
	$query->execute(array(
		":Name" => $Name,
		":Species" => $Species,
		":Status" => $Status,
		":Client" => $Client  
	));

	//Database verbinding sluiten
	$db = null;

	return true;
}

function deletePatient($id)
{
	if ($id === '') {
		return false;
	}

	$db = openDatabaseConnection();

	$sql = "DELETE FROM patients WHERE patient_id = :id";

	$query = $db->prepare($sql);
	$query->execute(array(
		":id" => $id
	));

	$db = null;

	return true;
}

function editPatient($id = null)
{
	$Name = isset($_POST["Name"]) ? $_POST["Name"] : null;
	$Species = isset($_POST["Species"]) ? $_POST["Species"] : null;
	$Status = isset($_POST["Status"]) ? $_POST["Status"] : null;
	$Client = isset($_POST["Client"]) ? $_POST["Client"] : null;
	
	if ($id === null || $Name === null || $Species === null || $Status === null || $Client === null) {
		return false;
	}

	$db = openDatabaseConnection();

	$sql = "UPDATE patients
			SET patient_Name = :Name, species_id = :Species, patient_Status = :Status, client_id = :Patient
			WHERE patient_id = :id";

	$query = $db->prepare($sql);

	$query->execute(array(
		":id" => $id,
		":Name" => $Name,
		":Species" => $Species,
		":Status" => $Status,
		":Patient" => $Client
	));

	$db = null;

	return true;
}