<?php

function SRF_getFilterProductData($productId){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."filter WHERE productId = '" . (int)$productId . "'";
	return $wpdb->get_results($sql);
}

function SRF_getAllModelByMakeId($makeId){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."model where makeId = '" . (int)$makeId . "'";
	return $wpdb->get_results($sql);
}

function SRF_deleteExistProductFilterData($prouctId){
	global $wpdb;
	$sql="DELETE FROM ".$wpdb->prefix ."filter where productId = '".(int)$prouctId."'";
	$wpdb->query($sql);
}

function SRF_getModelsByMakeId($makeId){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."model where makeId = '" . (int)$makeId . "'";
	return $wpdb->get_results($sql);
}

function SRF_getFilterData($product_id){
	global $wpdb;
	$sql = "select ma.MakeName,mo.ModelName,y.Year from ".$wpdb->prefix ."filter ft inner join ".$wpdb->prefix ."make ma on ma.makeId = ft.makeId inner join " . $wpdb->prefix ."model mo on mo.modelId = ft.modelId inner join ".$wpdb->prefix ."year y on y.yearId = ft.yearId WHERE ft.productid = '" . (int)$product_id . "' order by ma.MakeName ASC";
	return $wpdb->get_results($sql);
}

function SRF_getAllYearByMakeModel($makeId,$modelId){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."year where makeId = '" . (int)$makeId . "' AND modelId = '" . (int)$modelId . "' order by Year ASC";
	return $wpdb->get_results($sql);
}

function SRF_getAllMakes(){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."make order by MakeName ASC";
	return $wpdb->get_results($sql);
}

function SRF_getAllYears(){
	global $wpdb;
	$sql = "select *,ma.MakeName,mo.ModelName from ".$wpdb->prefix ."year y inner join ".$wpdb->prefix ."make ma on ma.makeId = y.makeId inner join ".$wpdb->prefix ."model mo on mo.modelId = y.modelId order by y.yearId DESC";
	return $wpdb->get_results($sql);
}

function SRF_getModelByModelId($modelId){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."model where modelId = '" . (int)$modelId . "'";
	return $wpdb->get_row($sql);
}

function SRF_getMakeByMakeId($makeId){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."make where makeId = '" . (int)$makeId . "'";
	return $wpdb->get_row($sql);
}

function SRF_getYearByYearId($yearId){
	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix ."year where yearId = '" . (int)$yearId . "'";
	return $wpdb->get_row($sql);
}

function SRF_updateYearByYearId($yearId,$makeId,$modelId,$year){
	global $wpdb;
	$sql="UPDATE ".$wpdb->prefix ."year set Year = '" .addslashes($year)."', makeId = '" . (int)$makeId . "', modelId = '" . (int)$modelId . "' where yearId = '" . (int)$yearId . "'";
	return $wpdb->query($sql);
}

function SRF_deleteYearByYearId($yearId){
	global $wpdb;
	$sql="DELETE FROM ".$wpdb->prefix ."year where yearId = '".(int)$yearId."'";
	$wpdb->query($sql);
}

function SRF_updateMakeByMakeId($makeId,$makeName){
	global $wpdb;
	$sql="UPDATE ".$wpdb->prefix ."make set MakeName = '" .addslashes($makeName)."' where makeId = '" . (int)$makeId . "'";
	return $wpdb->query($sql);
}

function SRF_updateModelByModelId($modelId,$makeId,$ModelName){
	global $wpdb;
	$sql="UPDATE ".$wpdb->prefix ."model set ModelName = '" .addslashes($ModelName)."', makeId = '" . (int)$makeId . "' where modelId = '" . (int)$modelId . "'";
	return $wpdb->query($sql);
}

function SRF_getAllModels(){
	global $wpdb;
	$sql = "select *,ma.MakeName from ".$wpdb->prefix ."model mo inner join ".$wpdb->prefix ."make ma on mo.makeId = ma.makeId order by ma.MakeName ASC";
	return $wpdb->get_results($sql);
}

function SRF_deleteMakeByMakeId($makeId){
	global $wpdb;
	$sql="DELETE FROM ".$wpdb->prefix ."make where makeId = '".(int)$makeId."'";
	$wpdb->query($sql);
}

function SRF_deleteModelByModelId($modelId){
	global $wpdb;
	$sql="DELETE FROM ".$wpdb->prefix ."model where modelId = '".(int)$modelId."'";
	$wpdb->query($sql);
}
