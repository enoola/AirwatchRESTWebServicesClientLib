<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 05/02/2018
 * Time: 15:01
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Custom Attribute Search
 * Functionality – Searches for device custom attributes.
 */
class AirwatchMDMDeviceCustomAttributesSearch extends AirwatchServicesSearch
{

    const URI_MDM_DEVICE_CUSTOMATTRIBUTES_SEARCH = AirwatchMDMDeviceCustomAttributes::URI_MDM_DEVICE_CUSTOMATTRIBUTES.'/search' ;
    const CLASS_SENTENCE_AIM = 'Functionality – Searches for device custom attributes.';

    public function __construct($cfg)
    {
        $arPossibleParams = [
            'deviceid' => 'Device ID to search for',
            'serialnumber' => 'Device serial number to search for',
            'organizationgroupid' => 'Organization group to be searched',
            'startdatetime' => 'DateTime, filters the custom attributes which are modified by after this datetime',
            'enddatetime' => 'DateTime, filters the custom attributes which are modified by before this datetime'
        ];


        parent::__construct($cfg, 'default_devicecustoattr_fields_to_show', 'possible_devicecustoattr_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_MDM_DEVICE_CUSTOMATTRIBUTES_SEARCH;
    }


    public function Search( $arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || (!array_key_exists('deviceid',$arParams) && !array_key_exists('serialnumber',$arParams)) ) {
            die ("Wrong Parameters provided at least 'deviceid' or 'serialnumber' is mandatory" . PHP_EOL);
            return (null);
        }


        $resquery = parent::Search($arParams, $szContentType);

        return ($resquery);
    }
}