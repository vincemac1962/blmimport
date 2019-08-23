<?php

/**
 * 
 */
class Property
{
	public $AGENT_REF;
	public $PRICE;
	public $DISPLAY_ADDRESS;
	public $BEDROOMS;
	public $BATHROOMS;
	public $LIVING_ROOMS;
	public $DESCRIPTION;
	public $TOWN;
	public $FEATURE1;
	public $FEATURE2;
	public $FEATURE3;
	public $FEATURE4;
	public $FEATURE5;
	public $FEATURE6;
	public $FEATURE7;
	public $FEATURE8;
	public $FEATURE9;
	public $FEATURE10;
	public $SUMMARY;
	public $BRANCH_ID;
	public $STATUS_ID;
	public $PRICE_QUALIFIER;
	public $PROP_SUB_ID;
	public $CREATE_DATE;
	public $UPDATE_DATE;
	public $LET_DATE_AVAILABLE;
	public $LET_TYPE_ID;
	public $LET_FURN_ID;
	public $LET_RENT_FREQUENCY;
	public $TRANS_TYPE_ID;
	public $MEDIA_IMAGE_00; 
	public $MEDIA_IMAGE_01;
	public $MEDIA_IMAGE_02; 
	public $MEDIA_IMAGE_03; 
	public $MEDIA_IMAGE_04; 
	public $MEDIA_IMAGE_05;
	public $MEDIA_IMAGE_06; 
	public $MEDIA_IMAGE_07; 
	public $MEDIA_IMAGE_08;
	public $MEDIA_IMAGE_09;
	public $MEDIA_DOCUMENT_00;
	public $MEDIA_DOCUMENT_01;
	public $MEDIA_DOCUMENT_TEXT_01;
	public $MEDIA_DOCUMENT_50;
	public $MEDIA_DOCUMENT_TEXT_50;
	public $MEDIA_IMAGE_60;
	public $MEDIA_IMAGE_TEXT_60;



	public function getImages(){
		$imagelist = array();
		for($i = 0; $i < 10; $i++){
			$imagefield = 'MEDIA_IMAGE_0'.$i;
			//echo $imagefield . '<br>';
			if($this->$imagefield != ''){
				//echo $this->$imagefield.'<br>';
				$imagelist[] = $this->$imagefield;
			}
				}
		//var_dump($imagelist);		
		return $imagelist;
	}
	
		public function getFeatures(){
		$featurelist = array();
		for($i = 1; $i < 11; $i++){
			$featurefield = 'FEATURE'.$i;
			//echo $featurefield . '<br>';
			if($this->$featurefield != ''){
				//echo $this->$featurefield.'<br>';
				$featurelist[] = $this->$featurefield;
			}
				}
		//var_dump($imagelist);		
		return $featurelist;
	}
}