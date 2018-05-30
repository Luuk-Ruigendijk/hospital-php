<?php

require(ROOT . "model/SpeciesModel.php");

function index()
{
	$species = getAllSpecies();
	
	render("species/index", array(
		'species' => $species)
	);
}

function create()
{
	render("species/create");
}

function createSave()
{
	if (createSpecie()) {
		header("location:" . URL . "species/index");
		exit();
	} else {
		//er is iets fout gegaan..
		header("location:" . URL . "error/error_db");
		exit();	
	}
}

function read($id)
{
	$specie = getSpecie($id);

	render("species/read", array(
		"specie" => $specie
	));
}

function edit($id)
{
	$specie = getSpecie($id);

	render("species/edit", array(
		"specie" => $specie
	));
}

function editSave($id)
{
	if (editSpecie($id)) {
		header("location:" . URL . "species/index");
		exit();
	} else {
		header("location:" . URL . "error/error_404");
		exit();
	}
}

function delete($id)
{
	if (deleteSpecie($id)) {
		header("location:" . URL . "species/index");
		exit();
	} else {
		//er is iets fout gegaan..
		header("location:" . URL . "error/error_delete");
		exit();	
	}
}