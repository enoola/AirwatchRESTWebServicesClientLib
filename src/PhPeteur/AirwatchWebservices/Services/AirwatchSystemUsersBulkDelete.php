<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/08/2018
 * Time: 11:43
 */


namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Deletes a list of enrollment users from the AirWatch Console.
 * Delete the enrollment user defined by id.
 */
class AirwatchSystemUsersBulkDelete extends AirwatchServicesDelete
{
    const URI_SYSTEMUSERS_BULK_DELETE = AirwatchSystemUsers::URI_SYSTEM_USERS . '/delete';
    const CLASS_SENTENCE_AIM = 'Deletes a list of enrollment users from the AirWatch Console';

    public function __construct( $cfg )
    {

        $arPossibleParams = [ 'BulkValues' => 'Enrollment users id, at least one'] ;

        parent::__construct($cfg,'default_user_fields_to_show', 'possible_user_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Users');

        $this->_uri = self::URI_SYSTEMUSERS_BULK_DELETE;
    }

    public function Delete( $arParams = null, $bParamToBePutInBody = false): array
    {
        if (is_null($arParams) || !array_key_exists('BulkValues',$arParams)) {
            die ("wrong Parameters provided 'BulkValues' is mandatory" . PHP_EOL);
            return (null);
        }

        //$newParams = [ 'BulkValues'=> ['value'=>$arParams['ids'] ]];
        //$arNewParam = [];
        //$arNewParam['BulkValues'] = $arParams['ids'];
        //$id = $arParams['ids'];
        //unset($arParams['ids']);
        $this->_uri = self::URI_SYSTEMUSERS_BULK_DELETE ;

        $resquery = parent::DeleteWithPost($arParams, true);

        return ($resquery);
    }

}

?>