<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 31/01/2018
 * Time: 14:58
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMDevicesBulkGPSSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_BULKGPS_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/gps/search' ;


    public function __construct($cfg)
    {
        $arPossibleParams = ['ids' => 'Devices ids to sick for',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)'
            //'page' => 'Page number',
            //'pagesize' => 'Maximum Records per page'
        ];


        parent::__construct($cfg, 'default_devicegps_fields_to_show', 'possible_devicegps_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICE_BULKGPS_SEARCH;
    }

    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('ids',$arParams)) {
            die ("wrong Parameters provided 'ids' is mandatory" . PHP_EOL);
            return (null);
        }


        //if we have a search by it's an alternate id search
        if (array_key_exists('searchby',$arParams)) {
            switch ($arParams['searchby']) {
                case "Macaddress" :
                    break;
                case "Udid" :
                    break;
                case "Serialnumber" :
                    break;
                case "EasId" :
                    break;
                default :
                    die ("searchby should be 'Macaddress', 'Udid','Serialnumber', or 'ImeiNumber' .");

            }

        }
        //$resquery = parent::Search($arParams);
        $arPmq = array();
        $arPmq['BulkValues']=['value'=>$arParams['ids']];
        unset($arParams['ids']);

        if (!is_null($arParams) && (count($arParams) > 0)) {
            foreach ($arParams as $k => $val) {
                if (!array_key_exists($k, $this->_arPossibleParams)) {
                    die ("wrong Parameters provided '" . $k . "' isn not accepted as a parameter" . PHP_EOL);
                }
            }
            $this->addParamsToQuery($arParams);
        }

        $resquery = $this->query_post($this->_uri,$arPmq);

        return ($resquery);
    }
}