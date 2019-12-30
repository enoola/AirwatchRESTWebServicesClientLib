<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 06/08/2018
 * Time: 12:38
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Delete device
 * Functionality - Deletes the device information from the AirWatch Console and un-enrolls the device.
 */
class AirwatchMDMDeviceChangeOrganizationGroup extends AirwatchServicesChange
{
    const URI_MDM_DEVICE_CHANGEOG = AirwatchMDMDevices::URI_MDM_DEVICES ;
    const CLASS_SENTENCE_AIM = 'Change Device Organization groups.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Device Id',
            'newogid'=>'The ogid to put device in'] ;

        parent::__construct($cfg,'default_devicesecurity_fields_to_show','possible_devicesecurity_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICE_CHANGEOG;
    }


    public function ChangePut( $arParams = null, $bParamToBePutInBody = false): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }
        if (!array_key_exists('newogid', $arParams)) {
            die ("wrong Parameters provided 'newogid' is mandatory" . PHP_EOL);
            return (null);

        } else {

            //if searchby isn't set it's an search by id : uri : https://host/api/mdm/devices/{id}
            $id = $arParams['id'];
            unset($arParams['id']);

            $this->_uri = self::URI_MDM_DEVICE_CHANGEOG . '/' . $id . '/commands/changeorganizationgroup/' . $arParams['newogid'];
            unset($arParams['newogid']);
        }
        $resquery = parent::ChangePut($arParams);

        return ($resquery);
    }
}