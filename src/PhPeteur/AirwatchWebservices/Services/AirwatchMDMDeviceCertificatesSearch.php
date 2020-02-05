<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 04/02/2018
 * Time: 12:57
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Certificate Details From the Device
 * Functionality – Retrieves the details of the certificates that are present on the device.
 */
class AirwatchMDMDeviceCertificatesSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_CERTIFICATES_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/certificates';
    const CLASS_SENTENCE_AIM = 'Retrieves the details of the certificates that are present on the device.';

    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'Device alternate id',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)',
            'page' => 'The specific page number to get',
            'pagesize' => 'Max records per page'
        ];

        parent::__construct($cfg, 'default_devicecertificate_fields_to_show', 'possible_devicecertificate_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('DeviceCertificates');

        $this->_uri = self::URI_MDM_DEVICE_CERTIFICATES_SEARCH;
    }


    public function Search($arParams = null,$szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || !array_key_exists('id', $arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }
        //if we have a search by it's an alternate id search
        if (array_key_exists('searchby', $arParams)) {
            switch ($arParams['searchby']) {
                case "Macaddress" :
                    break;
                case "Udid" :
                    break;
                case "Serialnumber" :
                    break;
                case "ImeiNumber" :
                    break;
                default :
                    die ("searchby should be 'Macaddress', 'Udid','Serialnumber', or 'ImeiNumber' .");

            }

        } else {         //if searchby isn't set it's an search by id : uri : https://host/api/mdm/devices/{id}/apps?searchb....
            $id = $arParams['id'];
            unset($arParams['id']);
            $this->_uri = AirwatchMDMDevices::URI_MDM_DEVICES . '/' . $id . '/certificates';
        }

        $resquery = parent::Search($arParams, $szContentType);

        return ($resquery);
    }
}