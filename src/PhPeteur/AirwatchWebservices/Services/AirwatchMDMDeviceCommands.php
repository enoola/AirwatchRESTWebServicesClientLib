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

use PhPeteur\AirwatchWebservices\Exception\AirwatchCmdException;

class AirwatchMDMDeviceCommands extends AirwatchServicesChange
{
    const URI_MDM_DEVICE_DELETE = AirwatchMDMDevices::URI_MDM_DEVICES ;
    const CLASS_SENTENCE_AIM = 'Delete the device identified by device ID.';

    public function __construct($cfg)
    {
        $this->szPossibleCommands = 'Lock, EnterpriseWipe, DeviceWipe, DeviceQuery, ClearPasscode, ';
        $this->szPossibleCommands .= 'SyncDevice, StopAirPlay, ScheduleOsUpdate, CustomMdmCommand, ';
        $this->szPossibleCommands .= 'InstallPackagedMacOSXAgent, SoftReset, Shutdown, EnterpriseReset, ';
        $this->szPossibleCommands .= 'SyncSensors, OsUpdateStatus, RotateFileVaultKey, RotateDEPAdminPassword';

        $arPossibleParams = [ 'id'=> 'Device Id',
            'command'=>'The command to execute ['.$this->szPossibleCommands.'].'] ;

        parent::__construct($cfg,'default_devicesecurity_fields_to_show','possible_devicesecurity_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICE_DELETE;
    }


    //we do overload Change
    public function Change( $arParams = null, $bParamToBePutInBody = false): array
    {
        $arPossibleCommands = explode (', ', $this->szPossibleCommands);

        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        if (is_null($arParams) || !array_key_exists('command',$arParams)) {
            die ("wrong Parameters provided 'command' is mandatory" . PHP_EOL);
            return (null);
        }


        $bCommandFound = false;
        if (array_key_exists('command', $arParams)) {
            foreach ($arPossibleCommands as $OnePossibleCommand) {
                if (strcmp($arParams['command'], $OnePossibleCommand) == 0 ) {
                    $bCommandFound = true;
                    break;
                }
            }
        }
        if ( !$bCommandFound ) {
            die('Error command not recognized parameters should be : '.$this->szPossibleCommands);
            //throw new AirwatchCmdException('Error command not recognized parameters should be : '.$this->szPossibleCommands);
        }
        //$arParams['customCommandModel'] = ' "CommandXml": "<'.$arParams['command'].'/>" ';
        //will be converted to json
        $arParams['CommandXml'] = '<'.$arParams['command'].'/>';
            // uri : https://host/api/mdm/devices/{id}/commands
        $id = $arParams['id'];
        unset($arParams['id']);

        $this->_uri = self::URI_MDM_DEVICE_DELETE . '/' . $id . '/commands?command='.$arParams['command'] ;
        unset($arParams['command']);

        $res = $this->query_post($this->_uri, $arParams);

        return ($res);
    }
}