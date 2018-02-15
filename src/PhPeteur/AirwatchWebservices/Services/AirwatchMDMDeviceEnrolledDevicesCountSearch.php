<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/02/2018
 * Time: 08:20
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Enrolled Device Count
 * Functionality – Retrieves count of all enrolled devices based on any or all of the OG ids, tag names, and devices
 */
class AirwatchMDMDeviceEnrolledDevicesCountSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_ENROLLEDDEVICESCOUNT_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/enrolleddevicescount' ;
    const CLASS_SENTENCE_AIM = 'Retrieves count of all enrolled devices based on any or all of the OG ids, tag names, and devices';

    public function __construct($cfg)
    {
        $arPossibleParams = ['organizationgroupid' => 'Name/String OG id to sick in',
            'tagname' => 'Desired unique name of the device tag',
            'deviceseensince' => 'Page number',
            'deviceseentill' => 'Maximum Records per page',
            'id' => 'id of device'
        ];


        parent::__construct($cfg, 'default_deviceenrolleddevicescount_to_show', 'possible_devicegps_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICE_ENROLLEDDEVICESCOUNT_SEARCH;
    }

    public function Search( $arParams = null): array
    {
         if ( is_null($arParams) || ( !array_key_exists('id',$arParams)  &&
              !array_key_exists('organizationgroupid',$arParams)) )
         {
            die ("wrong Parameters provided at least 'id' or 'organizationgroupid' is mandatory" . PHP_EOL);
            return (null);
        }

        if (!is_null($arParams) && (count($arParams) > 0)) {
            foreach ($arParams as $k => $val) {
                if (!array_key_exists($k, $this->_arPossibleParams)) {
                    die ("wrong Parameters provided '" . $k . "' isn not accepted as a parameter" . PHP_EOL);
                }
            }
            $this->addParamsToQuery($arParams);
        }

        $resquery = $this->query_post($this->_uri,$arParams);

        return ($resquery);
    }
}