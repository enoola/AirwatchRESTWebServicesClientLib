<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 01/08/2018
 * Time: 10:32
 */


namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Delete Enrollment User
 * Delete the enrollment user defined by id.
 */
class AirwatchSystemUserDelete extends AirwatchServicesDelete
{
    const URI_SYSTEMUSER_DELETE = AirwatchSystemUsers::URI_SYSTEM_USERS ;
    const CLASS_SENTENCE_AIM = 'Delete the enrollment user defined by id.';

    public function __construct( $cfg )
    {

        $arPossibleParams = [ 'id'=> 'Enrollment user id'] ;

        parent::__construct($cfg,'default_user_fields_to_show', 'possible_user_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Users');

        $this->_uri = self::URI_SYSTEMUSER_DELETE;
    }

    public function Delete( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_SYSTEMUSER_DELETE.'/'.$id.'/delete' ;

        $resquery = parent::Delete($arParams);

        return ($resquery);
    }

}

?>