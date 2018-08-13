<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 10/08/2018
 * Time: 06:15
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 *
 * Functionality – Updates the details of a device enrollment user.
 * /!\ when relying on doc it is not obsious to get real invokation parameters, so I went for /API/help
 *
 */
class AirwatchSystemUserUpdate extends AirwatchServicesChange
{

    const URI_MDM_SYSTEMUSER_UPDATE = AirwatchSystemUsers::URI_SYSTEM_USERS ;
    const CLASS_SENTENCE_AIM = 'Updates the details of a device enrollment user';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Enrollment user id',
            'ContactNumber'=> 'Updated contact number of the enrollment user. e.g.+1234567890',
            'DisplayName'=>'Display name of the use',
            'Password'=>'Password for the enrollment user',
            'FirstName'=>'Updated first name of the enrollment user',
            'LastName'=>'Updated last name of the enrollment user',
            'Email'=>'Updated email address of the enrollment user',
            'MobileNumber'=>'Updated mobile number of the enrollment user',
            'Group'=>'Numeric identification of the updated organization group where the user will be created',
            'LocationGroupId'=>'Numeric identification of the updated organization group where the user will be created',
            'Role'=>'Updated role associated with the user. Allowed values are "Basic Access" and "Full Access"',
            'MessageType'=>'Type of the updated message sent to the enrollment User. Allowed Values are : Email, SMS, None',
            'MessageTemplateId'=>'Updated numeric identification of the message template sent to the enrollment user',
            'ExternalID'=>'Track Id of the device enrollment user' ];

        parent::__construct($cfg,'default_user_fields_to_show','possible_user_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_SYSTEMUSER_UPDATE    ;
    }

    /*
     * @arParam to add to query (by default in headers)
     * @bParamToBePutInBody above params will be in body's request
     *
    */
    public function Change( $arParams = null, $bParamToBePutInBody = false): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        if (is_null($arParams) ) {
            echo "/!\ if updating local user, password is mandatory" . PHP_EOL;
        }

        $id = $arParams['id'];

        unset($arParams['id']);

        $this->_uri = self::URI_MDM_SYSTEMUSER_UPDATE.'/'.$id .'/update';

        $resquery = parent::Change($arParams, true);

        return ($resquery);
    }

}