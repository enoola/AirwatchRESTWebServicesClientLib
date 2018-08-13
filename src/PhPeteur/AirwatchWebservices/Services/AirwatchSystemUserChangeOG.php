<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/08/2018
 * Time: 09:35
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Enrollment User's Details
 * Functionality – Retrieves enrollment user's details identified by the enrollment user Id.
 */
class AirwatchSystemUserChangeOG extends AirwatchServicesChange
{

    const URI_MDM_SYSTEMUSER_CHANGE_OG = AirwatchSystemUsers::URI_SYSTEM_USERS ;
    const CLASS_SENTENCE_AIM = 'move user from one OG to another one';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Enrollment user id',
            'lgid'=>'location group id'] ;

        parent::__construct($cfg,'default_user_fields_to_show','possible_user_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_SYSTEMUSER_CHANGE_OG    ;
    }


    public function Change( $arParams = null, $bParamToBePutInBody = false ): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }
        if (is_null($arParams) || !array_key_exists('lgid',$arParams)) {
            die ("wrong Parameters provided 'lgid' is mandatory" . PHP_EOL);
            return (null);
        }
        $id = $arParams['id'];
        $lgid = $arParams['lgid'];
        $arParams['targetLG'] = $lgid;
        unset($arParams['id']);
        unset($arParams['lgid']);

        $this->_uri = self::URI_MDM_SYSTEMUSER_CHANGE_OG.'/'.$id .'/changelocationgroup';//?targetLG='. $lgid ;
        //echo "[".$this->_uri."]";
        //exit;
        $resquery = parent::Change($arParams, true);

        return ($resquery);
    }

}