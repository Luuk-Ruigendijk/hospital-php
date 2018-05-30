<?php

require(ROOT . "model/PatientModel.php");
require(ROOT . "model/ClientModel.php");
require(ROOT . "model/SpeciesModel.php");

function index()
{
	$patients = getAllPatients();
	
	render("patient/index", array(
		'patients' => $patients)
	);
}

function create()
{
	$species = getAllSpecies();

	$clients = getAllClients();


	render("patient/create", array(
		"species" => $species ,
		"clients" => $clients
	));

}

function createSave()
{
	if (createPatient()) {
		header("location:" . URL . "patient/index");
		exit();
	} else {
		//er is iets fout gegaan..
		header("location:" . URL . "error/error_db");
		exit();	
	}
}

function read($id)
{
	$patient = getPatient($id);

	render("patient/read", array(
		"patient" => $patient
	));
}

function edit($id)
{
	$patient = getPatient($id);

	$species = getAllSpecies();		

	$clients = getAllClients();

	render("patient/edit", array(
		"patient" => $patient , 
		"species" => $species ,
		"clients" => $clients
	));
}

function editSave($id)
{
	if (editPatient($id)) {
		header("location:" . URL . "patient/index");
		exit();
	} else {
		header("location:" . URL . "error/error_404");
		exit();
	}
}

function delete($id)
{
	if (deletePatient($id)) {
		header("location:" . URL . "patient/index");
		exit();
	} else {
		//er is iets fout gegaan..
		header("location:" . URL . "error/error_delete");
		exit();	
	}
}