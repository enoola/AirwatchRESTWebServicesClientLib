<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 07/02/2018
 * Time: 15:26
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Reprocess Product
 * Functionality – Initiates reprocessing of a product or product and device(s) by the policy engine. Supports a reprocess
and a forced reprocess.
 */
class AirwatchMDMProductsReprocessAction extends AirwatchServicesSearch
{
    const URI_MDM_PRODUCTS_REPROCESS_ACTION = 'api/mdm/products/reprocessProduct'  ;
    const CLASS_SENTENCE_AIM = 'Initiates reprocessing of a product or product and device(s) by the policy engine. Supports a reprocess
and a forced reprocess.';

    public function __construct($cfg)
    {
        $arPossibleParams = ['DeviceIds' => 'Devices id to which the pl will be reprocessed',
            'ProductID' => 'productlist concerned',
            'ForceFlag' => '(boolean true/false, false by default) shall we force the reprocessing ? ',
        ];


        parent::__construct($cfg, 'default_device_fields_to_show', 'possible_device_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        //parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_MDM_PRODUCTS_REPROCESS_ACTION;
    }

    /*
     * this method will take the action and do the query
     */
    public function Action( $arParams = null): array
    {
        echo PHP_EOL."Warning only one device processing at a time for the moment!!!".PHP_EOL;

        if (is_null($arParams) || !array_key_exists('DeviceIds',$arParams) || !array_key_exists('ProductID', $arParams)) {
            die ("wrong Parameters provided 'DeviceIds' & 'ProductID' are mandatory" . PHP_EOL);
            return (null);
        }
        $fFlag = 'false';
        if (array_key_exists('ForceFlag',$arParams))
            $fFlag = $arParams['ForceFlag'];


        $arPmq = array('ForceFlag'=>$fFlag);

        $arPmq['DeviceIds'] = $arParams['DeviceIds'];
        $arPmq['ProductID'] = $arParams['ProductID'];

        var_dump(json_encode($arPmq,JSON_PRETTY_PRINT));

        //exit;
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