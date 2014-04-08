<?php

require_once('OEmbed/COEmbedImpl.php');

require_once('ICPinRequiredResponseKeyConstants.php');
require_once('ICPinOptionalResponseKeyConstants.php');

require_once('CPinRequiredKeys.php');
require_once('CPinOptionalKeys.php');

require_once('ICPinGenderValueConstants.php');
require_once('ICPinAvailabilityValueConstants.php');

require_once('ICPinterest.php');

/**
 * Class imeplementing ICPinterest interface. It is responsible for:
 * - embedding Pinterest required key/value pair into response,
 * - embedding Pinterest optional key/value pair into response,
 * - embedding any key/value pair into response.
 * 
 * 
 * @author Pavol Daňo
 * @version 1.0
 * @file
 */
class CPinterestImpl extends COEmbedImpl implements ICPinterest{

    public function __construct($params) {
        parent::__construct($params);
    }

    
    /**
     * Adds required Pinterest keys and assigned values to the response including checking whether the keys
     * are required at all.
     * 
     * @param array $response_array
     *  Actual response array to put keys and values into.
     * @param array $key_value_items_array
     *  Array including required key sand values to be added into the response message.
     * @retval array
     *  Updated response with a new keys and values in a form of an array.
     */    
    public function add_pinterest_required_response_items($response_array, $key_value_items_array) {

        foreach ($key_value_items_array as $key => $value) {
            if (!CPinRequiredKeys::isValidValue('CPinRequiredKeys', $key)) {
                throw new CInvalidRequiredPinKeyException('Key "' . $key . '" does not belong to obligatory keys.');
            }

            $response_array[$key] = $value;
        }

        return $response_array;
    }

    /**
     * Adds optional Pinterest keys and assigned values to the response including checking whether the keys
     * are optional at all.
     * 
     * @param array $response_array
     *  Actual response array to put keys and values into.
     * @param array $key_value_items_array
     *  Array including optional keys and values to be added into the response message.
     * @retval array
     *  Updated response with a new optional keys and values in a form of an array.
     */    
    public function add_pinterest_optional_response_items($response_array, $key_value_items_array) {

        foreach ($key_value_items_array as $key => $value) {
            if (!CPinOptionalKeys::isValidValue('CPinOptionalKeys', $key)) {
                throw new CInvalidOptionalPinKeyException('Key "' . $key . '" does not belong to optional keys.');
            }

            $response_array[$key] = $value;
        }

        return $response_array;
    }

    /**
     * Adds any keys and assigned values to the response.
     * In this case it is just calling parent method.
     * No additional logic needs to be implemented.
     * 
     * @param array $response_array
     *  Actual response array to put keys and values into.
     * @param array $key_value_items_array
     *  Array including any keys and values to be added into the response message.
     * @retval array
     *  Updated response with a new (any) keys and values in a form of an array.
     */    
    public function add_pinterest_any_response_items($response_array, $key_value_items_array) {
        return parent::add_oembed_any_response_items($response_array, $key_value_items_array);
    }
}

?>
