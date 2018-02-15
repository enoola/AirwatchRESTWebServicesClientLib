<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 05/02/2018
 * Time: 17:36
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Changes Made To Custom Attribute
 * Searches for changes made to device custom attributes.
 */
class AirwatchMDMDeviceCustomAttributesChangeReportSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_CUSTOMATTRIBUTES_CHANGEREPORT_SEARCH = AirwatchMDMDeviceCustomAttributes::URI_MDM_DEVICE_CUSTOMATTRIBUTES.'/changereport' ;
    const CLASS_SENTENCE_AIM = 'Searches for changes made to device custom attributes.';
    
    public function __construct($cfg)
    {
        $arPossibleParams = [
            'deviceid' => 'Device id to search for',
            'organizationgroupid' => 'Organization group to be searched',
            'startdatetime' => 'DateTime, filters the custom attributes which are modified by after this datetime',
            'enddatetime' => 'DateTime, filters the custom attributes which are modified by before this datetime'
        ];


        parent::__construct($cfg, 'default_devicecustoattrchange_fields_to_show', 'possible_devicecustoattrchange_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse('DeviceCustomAttributeChanges');

        $this->_uri = self::URI_MDM_DEVICE_CUSTOMATTRIBUTES_CHANGEREPORT_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        /*
        if (is_null($arParams) || (!array_key_exists('deviceid',$arParams) && !array_key_exists('serialnumber',$arParams)) ) {
            die ("Wrong Parameters provided at least 'deviceid' or 'serialnumber' is mandatory" . PHP_EOL);
            return (null);
        }
        */

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}