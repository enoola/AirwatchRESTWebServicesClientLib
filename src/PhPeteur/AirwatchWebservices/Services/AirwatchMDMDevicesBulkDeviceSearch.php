<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 01/02/2018
 * Time: 17:13
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Bulk Device Information
 * Functionality – Retrieves information about multiple devices identified by the specified Id type.
 */
class AirwatchMDMDevicesBulkDeviceSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_BULKDEVICE_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES  ;
    const CLASS_SENTENCE_AIM = 'Retrieves information about multiple devices identified by the specified Id type.';

    public function __construct($cfg)
    {
        $arPossibleParams = ['ids' => 'Devices ids to sick for',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)'
            //'page' => 'Page number',
            //'pagesize' => 'Maximum Records per page'
        ];


        parent::__construct($cfg, 'default_device_fields_to_show', 'possible_device_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_MDM_DEVICE_BULKDEVICE_SEARCH;
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
                case "Imeinumber" :
                    break;
                default :
                    die ("searchby should be 'Macaddress', 'Udid','Serialnumber', or 'Imeinumber' .");

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