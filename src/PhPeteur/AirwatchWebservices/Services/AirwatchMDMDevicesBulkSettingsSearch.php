<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 04/02/2018
 * Time: 11:30
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Device Bulk Settings
 * Functionality – Retrieves the values for bulk management settings done on the AirWatch Console.
 */
class AirwatchMDMDevicesBulkSettingsSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_BULKSETTINGS_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/bulksettings'  ;
    const CLASS_SENTENCE_AIM = 'Retrieves the values for bulk management settings done on the AirWatch Console.';

    public function __construct($cfg)
    {
        $arPossibleParams = [];


        parent::__construct($cfg, 'default_devicebulksettings_fields_to_show', 'default_devicebulksettings_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICE_BULKSETTINGS_SEARCH;
    }


}