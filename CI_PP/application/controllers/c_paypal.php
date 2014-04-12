<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once ("paypalfunctions.php");

class C_paypal extends MY_Controller {

    /**
     * Calls first PayPal API method for authorization.
     * 
     * @retval string
     *  HTML page claiming PayPal failed. If succes, redirection is conducted.
     * Redirection is not explicitly called, but it is forwarder from PayPal authorization page.
     */
    public function express_checkout() {

        // ==================================
        // PayPal Express Checkout Module
        // ==================================
        //'------------------------------------
        //' The paymentAmount is the total value of 
        //' the shopping cart, that was set 
        //' earlier in a session variable 
        //' by the shopping cart page
        //'------------------------------------
        $paymentAmount = $this->session->userdata('Payment_Amount');
        if (!$_SESSION["Payment_Amount"]) {
            $_SESSION["Payment_Amount"] = $paymentAmount;
        }

        //$paymentAmount = $this->session->unset_userdata('Payment_Amount');
        //'------------------------------------
        //' The currencyCodeType and paymentType 
        //' are set to the selections made on the Integration Assistant 
        //'------------------------------------
        $currencyCodeType = "EUR";
        $paymentType = "Sale";

        //'------------------------------------
        //' The returnURL is the location where buyers return to when a
        //' payment has been succesfully authorized.
        //'
        //' This is set to the value entered on the Integration Assistant 
        //'------------------------------------
        $returnURL = "http://localhost:8888/CI_PP/index.php/c_paypal/go_to_billing";

        //'------------------------------------
        //' The cancelURL is the location buyers are sent to when they hit the
        //' cancel button during authorization of payment during the PayPal flow
        //'
        //' This is set to the value entered on the Integration Assistant 
        //'------------------------------------
        //TODO:
        $cancelURL = "http://localhost:8888/CI_PP/index.php/c_paypal/not_go_to_billing";

        //'------------------------------------
        //' Calls the SetExpressCheckout API call
        //'
        //' The CallShortcutExpressCheckout function is defined in the file PayPalFunctions.php,
        //' it is included at the top of this file.
        //'------------------------------------------------
        $resArray = CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            // redirection to PayPal. PayPal forwards result either here if fails or to not_go_to_billing(), see below.
            RedirectToPayPal($resArray["TOKEN"]);
        } else {
            //v_paypal_express_checkout_failed
            //Display a user friendly Error on the page using any of the following error information returned by PayPal
            $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
            $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
            $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
            $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

            $error_message = "SetExpressCheckout API call failed. " . "Detailed Error Message: " . $ErrorLongMsg . ". Short Error Message: " . $ErrorShortMsg . ". Error Code: " . $ErrorCode . ". Error Severity Code: " . $ErrorSeverityCode;

            log_message('error', 'c_paypal/express_checkout(): PayPal API CallShortcutExpressCheckout() failed. See message below.');
            log_message('error', $error_message);

            $data['error_message'] = $error_message;

            $template_data = array();
            $this->set_title($template_data, 'PayPal authorization failed.');
            $this->load_header_templates($template_data);

            $this->load->view('templates/header', $template_data);
            $this->load->view('paypal/v_paypal_express_checkout_failed', $data);
            $this->load->view('templates/footer');
        }
    }

    /**
     * After PayPal CallShortcutExpressCheckout called from c_order.express_checkout()
     * is successful, billing page is rendered.
     * 
     * @retval string
     *  HTML billing page.
     */
    public function go_to_billing() {

        log_message('debug', 'returnToBilling()');

        $data['invoice_id'] = $this->session->userdata('invoice_id');
        $data['total'] = $this->session->userdata('Payment_Amount');
        $data['ordered_products'] = $this->session->userdata('ordered_products'); //$this->ordered_product_model->get_ordered_product_full_info_by_cart_id( $this->input->post('cart_id') );
        $data['order_address'] = $this->session->userdata('order_address');
        $data['payment_method'] = $this->session->userdata('payment_method');
        $data['shipping_method'] = $this->session->userdata('shipping_method');

        $template_data = array();
        $this->set_title($template_data, 'Choose payment method');
        $this->load_header_templates($template_data);

        $this->load->view('templates/header', $template_data);
        $this->load->view('paypal/v_paypal_billing', $data);
        $this->load->view('templates/footer');
    }

    public function not_go_to_billing() {

        echo 'Billing canceled';
    }

    public function do_billing() {
        log_message('debug', 'do_billing()');

        $this->session->set_userdata(array('paypal_payment_method' => $this->input->post('paypal_or_card_type')));

        $PaymentOption = $this->input->post('paypal_or_card_type');

        if ($PaymentOption == 'paypal') {
            // ==================================
            // PayPal Express Checkout Module
            // ==================================
            //'------------------------------------
            //' The paymentAmount is the total value of 
            //' the shopping cart, that was set 
            //' earlier in a session variable 
            //' by the shopping cart page
            //'------------------------------------
            $paymentAmount = $_SESSION["Payment_Amount"];

            //'------------------------------------
            //' When you integrate this code 
            //' set the variables below with 
            //' shipping address details 
            //' entered by the user on the 
            //' Shipping page.
            //'------------------------------------
            $order_address = $this->session->userdata('order_address');

            $shipToName = $order_address['oa_name'];
            $shipToStreet = $order_address['oa_address'];
            $shipToStreet2 = ""; //Leave it blank if there is no value
            $shipToCity = $order_address['oa_city'];
            $shipToState = $order_address['oa_country'];
            $shipToCountryCode = "SK"; // Please refer to the PayPal country codes in the API documentation
            $shipToZip = $order_address['oa_zip'];
            $phoneNum = "+421915507714";

            //'------------------------------------
            //' The currencyCodeType and paymentType 
            //' are set to the selections made on the Integration Assistant 
            //'------------------------------------
            $currencyCodeType = "EUR";
            $paymentType = "Sale";

            //'------------------------------------
            //' The returnURL is the location where buyers return to when a
            //' payment has been succesfully authorized.
            //'
            //' This is set to the value entered on the Integration Assistant 
            //'------------------------------------
            //$returnURL = "http://puwel.sk/powporn/index.php/c_paypal/ret";
            $returnURL = "http://localhost:8888/CI_PP/index.php/c_paypal/return_to_review";

            //'------------------------------------
            //' The cancelURL is the location buyers are sent to when they hit the
            //' cancel button during authorization of payment during the PayPal flow
            //'
            //' This is set to the value entered on the Integration Assistant 
            //'------------------------------------
            //$cancelURL = "http://puwel.sk/powporn/index.php/c_paypal/canc";
            $cancelURL = "http://localhost:8888/CI_PP/index.php/c_paypal/cancel_review";

            //'------------------------------------
            //' Calls the SetExpressCheckout API call
            //'
            //' The CallMarkExpressCheckout function is defined in the file PayPalFunctions.php,
            //' it is included at the top of this file.
            //'-------------------------------------------------
            $resArray = CallMarkExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL, $shipToName, $shipToStreet, $shipToCity, $shipToState, $shipToCountryCode, $shipToZip, $shipToStreet2, $phoneNum
            );

            log_message('debug', ' resArray after CallMarkExpressCheckout ');
            log_message('debug', print_r($resArray, true));

            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
                $token = urldecode($resArray["TOKEN"]);
                $_SESSION['reshash'] = $token;
                RedirectToPayPal($token);
            } else {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

                echo "SetExpressCheckout API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
            }
        } else {
            if ((( $PaymentOption == "Visa") || ( $PaymentOption == "MasterCard") || ($PaymentOption == "Amex") || ($PaymentOption == "Discover"))
                    && ( $PaymentProcessorSelected == "PayPal Direct Payment"))

            //'------------------------------------
            //' The paymentAmount is the total value of 
            //' the shopping cart, that was set 
            //' earlier in a session variable 
            //' by the shopping cart page
            //'------------------------------------
                $paymentAmount = $_SESSION["Payment_Amount"];

            //'------------------------------------
            //' The currencyCodeType and paymentType 
            //' are set to the selections made on the Integration Assistant 
            //'------------------------------------
            $currencyCodeType = "EUR";
            $paymentType = "Sale";

            //' Set these values based on what was selected by the user on the Billing page Html form

            $creditCardType = "<<Visa/MasterCard/Amex/Discover>>"; //' Set this to one of the acceptable values (Visa/MasterCard/Amex/Discover) match it to what was selected on your Billing page
            $creditCardNumber = "<<CC number>>"; //' Set this to the string entered as the credit card number on the Billing page
            $expDate = "<<Expiry Date>>"; //' Set this to the credit card expiry date entered on the Billing page
            $cvv2 = "<<cvv2>>"; //' Set this to the CVV2 string entered on the Billing page 
            $firstName = "<<firstName>>"; //' Set this to the customer's first name that was entered on the Billing page 
            $lastName = "<<lastName>>"; //' Set this to the customer's last name that was entered on the Billing page 
            $street = "<<street>>"; //' Set this to the customer's street address that was entered on the Billing page 
            $city = "<<city>>"; //' Set this to the customer's city that was entered on the Billing page 
            $state = "<<state>>"; //' Set this to the customer's state that was entered on the Billing page 
            $zip = "<<zip>>"; //' Set this to the zip code of the customer's address that was entered on the Billing page 
            $countryCode = "<<PayPal Country Code>>"; //' Set this to the PayPal code for the Country of the customer's address that was entered on the Billing page 
            $currencyCode = "<<PayPal Currency Code>>"; //' Set this to the PayPal code for the Currency used by the customer 

            /*
              '------------------------------------------------
              ' Calls the DoDirectPayment API call
              '
              ' The DirectPayment function is defined in PayPalFunctions.php included at the top of this file.
              '-------------------------------------------------
             */

            $resArray = DirectPayment($paymentType, $paymentAmount, $creditCardType, $creditCardNumber, $expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip, $countryCode, $currencyCode);

            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
                //Getting transaction ID from API responce. 
                $TransactionID = urldecode($resArray["TRANSACTIONID"]);

                echo "Your payment has been successfully processed";
            } else {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

                echo "Direct credit card payment API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
            }
        }
    }

    public function return_to_review() {

        log_message('debug', 'return_to_review()');

        log_message('debug', 'return_to_review data:');
        log_message('debug', print_r($_SESSION, true));



        /* ==================================================================
          PayPal Express Checkout Call
          ===================================================================
         */
        // Check to see if the Request object contains a variable named 'token'	
        $token = "";
        if (isset($_REQUEST['token'])) {
            $token = $_REQUEST['token'];
        }

        // If the Request object contains the variable 'token' then it means that the user is coming from PayPal site.	
        if ($token != "") {

            /*
              '------------------------------------
              ' Calls the GetExpressCheckoutDetails API call
              '
              ' The GetShippingDetails function is defined in PayPalFunctions.jsp
              ' included at the top of this file.
              '-------------------------------------------------
             */


            $resArray = GetShippingDetails($token);

            log_message('debug', 'printing result array:');
            log_message('debug', print_r($resArray, true));

            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") {
                /*
                  ' The information that is returned by the GetExpressCheckoutDetails call should be integrated by the partner into his Order Review
                  ' page
                 */
                $email = $resArray["EMAIL"]; // ' Email address of payer.
                $payerId = $resArray["PAYERID"]; // ' Unique PayPal customer account identification number.
                $payerStatus = $resArray["PAYERSTATUS"]; // ' Status of payer. Character length and limitations: 10 single-byte alphabetic characters.
//                $salutation = $resArray["SALUTATION"]; // ' Payer's salutation.
                $firstName = $resArray["FIRSTNAME"]; // ' Payer's first name.
//               $middleName = $resArray["MIDDLENAME"]; // ' Payer's middle name.
                $lastName = $resArray["LASTNAME"]; // ' Payer's last name.
//                $suffix = $resArray["SUFFIX"]; // ' Payer's suffix.
                $countryCode = $resArray["COUNTRYCODE"]; // ' Payer's country of residence in the form of ISO standard 3166 two-character country codes.
//                $business = $resArray["BUSINESS"]; // ' Payer's business name.
                $shipToName = $resArray["PAYMENTREQUEST_0_SHIPTONAME"]; // ' Person's name associated with this address.
                $shipToStreet = $resArray["PAYMENTREQUEST_0_SHIPTOSTREET"]; // ' First street address.
//                $shipToStreet2 = $resArray["PAYMENTREQUEST_0_SHIPTOSTREET2"]; // ' Second street address.
                $shipToCity = $resArray["PAYMENTREQUEST_0_SHIPTOCITY"]; // ' Name of city.
                $shipToState = $resArray["PAYMENTREQUEST_0_SHIPTOSTATE"]; // ' State or province
                $shipToCountryCode = $resArray["PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE"]; // ' Country code. 
                $shipToZip = $resArray["PAYMENTREQUEST_0_SHIPTOZIP"]; // ' U.S. Zip code or other country-specific postal code.
                $addressStatus = $resArray["ADDRESSSTATUS"]; // ' Status of street address on file with PayPal   
//                $invoiceNumber = $resArray["INVNUM"]; // ' Your own invoice or tracking number, as set by you in the element of the same name in SetExpressCheckout request .
//                $phonNumber = $resArray["PHONENUM"]; // ' Payer's contact telephone number. Note:  PayPal returns a contact telephone number only if your Merchant account profile settings require that the buyer enter one. 
                $data['paypal_shipping_data'] = array(
                    'email' => $email,
                    'payer_id' => $payerId,
                    'payer_status' => $payerStatus,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'country_code' => $countryCode,
                    'ship_to_name' => $shipToName,
                    'ship_to_street' => $shipToStreet,
                    'ship_to_city' => $shipToCity,
                    'ship_to_state' => $shipToState,
                    'ship_to_country_code' => $shipToCountryCode,
                    'ship_to_zip' => $shipToZip,
                    'address_status' => $addressStatus,
                );

                $order_id = $this->session->userdata('invoice_id');

                $paypal_shipping_data_instance = new Paypal_shipping_data_model();
                $paypal_shipping_data_instance->instantiate($order_id, $email, $payerId, $payerStatus, $firstName, $lastName, $countryCode, $shipToName, $shipToStreet, $shipToCity, $shipToState, $shipToCountryCode, $shipToZip, $addressStatus);
                try {
                    $inserted_psdi = $paypal_shipping_data_instance->insert_paypal_shipping_data();
                    log_message('debug', 'Inserted PayPal shipping data instance:' . print_r($inserted_psdi, true));
                } catch (Exception $e) {
                    log_message('error', 'Inserting paypal_shipping_data into DB failed.');
                    log_message('error', $e);
                }
            } else {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

                echo "GetExpressCheckoutDetails API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
            }
        }


        $data['invoice_id'] = $this->session->userdata('invoice_id');
        $data['total'] = $this->session->userdata('Payment_Amount');
        $data['ordered_products'] = $this->session->userdata('ordered_products'); //$this->ordered_product_model->get_ordered_product_full_info_by_cart_id( $this->input->post('cart_id') );
        $data['order_address'] = $this->session->userdata('order_address');
        $data['payment_method'] = $this->session->userdata('payment_method');
        $data['shipping_method'] = $this->session->userdata('shipping_method');

        $template_data = array();
        $this->set_title($template_data, 'Choose payment method!');
        $this->load_header_templates($template_data);

        $data['payment_value'] = $this->session->userdata('paypal_payment_method');

        $this->load->view('templates/header', $template_data);
        $this->load->view('v_payment_after_billing_return', $data); // review screen
        $this->load->view('templates/footer');
    }

    public function cancel_review() {

        echo 'Review canceled';
    }

    /**
     * Calls paypal API for making transaction real. Confirms payment.
     * Saves transaction data into DB.
     * Redirects user to succesfull screen if OK.
     */
    public function review_confirm() {

        log_message('debug', 'review_confirm()');

        $PaymentOption = $this->session->userdata('paypal_payment_method');


        /* ==================================================================
          PayPal Express Checkout Call
          ===================================================================
         */

        if ($PaymentOption == "paypal") {
            /*
              '------------------------------------
              ' The paymentAmount is the total value of
              ' the shopping cart, that was set
              ' earlier in a session variable
              ' by the shopping cart page
              '------------------------------------
             */

            $finalPaymentAmount = $this->session->userdata('Payment_Amount');

            /*
              '------------------------------------
              ' Calls the DoExpressCheckoutPayment API call
              '
              ' The ConfirmPayment function is defined in the file PayPalFunctions.jsp,
              ' that is included at the top of this file.
              '-------------------------------------------------
             */

            $resArray = ConfirmPayment($finalPaymentAmount);
            $ack = strtoupper($resArray["ACK"]);
            if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
                /*
                  '********************************************************************************************************************
                  '
                  ' THE PARTNER SHOULD SAVE THE KEY TRANSACTION RELATED INFORMATION LIKE
                  '                    transactionId & orderTime
                  '  IN THEIR OWN  DATABASE
                  ' AND THE REST OF THE INFORMATION CAN BE USED TO UNDERSTAND THE STATUS OF THE PAYMENT
                  '
                  '********************************************************************************************************************
                 */

                $transactionId = $resArray["PAYMENTINFO_0_TRANSACTIONID"]; // ' Unique transaction ID of the payment. Note:  If the PaymentAction of the request was Authorization or Order, this value is your AuthorizationID for use with the Authorization & Capture APIs. 
                $transactionType = $resArray["PAYMENTINFO_0_TRANSACTIONTYPE"]; //' The type of transaction Possible values: l  cart l  express-checkout 
                $paymentType = $resArray["PAYMENTINFO_0_PAYMENTTYPE"];  //' Indicates whether the payment is instant or delayed. Possible values: l  none l  echeck l  instant 
                $orderTime = $resArray["PAYMENTINFO_0_ORDERTIME"];  //' Time/date stamp of payment
                $amt = $resArray["PAYMENTINFO_0_AMT"];  //' The final amount charged, including any shipping and taxes from your Merchant Profile.
                $currencyCode = $resArray["PAYMENTINFO_0_CURRENCYCODE"];  //' A three-character currency code for one of the currencies listed in PayPay-Supported Transactional Currencies. Default: USD. 
//                $feeAmt = $resArray["PAYMENTINFO_0_FEEAMT"];  //' PayPal fee amount charged for the transaction
//                $settleAmt = $resArray["PAYMENTINFO_0_SETTLEAMT"];  //' Amount deposited in your PayPal account after a currency conversion.
                $taxAmt = $resArray["PAYMENTINFO_0_TAXAMT"];  //' Tax charged on the transaction.
//                $exchangeRate = $resArray["PAYMENTINFO_0_EXCHANGERATE"];  //' Exchange rate if a currency conversion occurred. Relevant only if your are billing in their non-primary currency. If the customer chooses to pay with a currency other than the non-primary currency, the conversion occurs in the customer's account.

                /*
                  ' Status of the payment:
                  'Completed: The payment has been completed, and the funds have been added successfully to your account balance.
                  'Pending: The payment is pending. See the PendingReason element for more information.
                 */

                $paymentStatus = $resArray["PAYMENTINFO_0_PAYMENTSTATUS"];

                /*
                  'The reason the payment is pending:
                  '  none: No pending reason
                  '  address: The payment is pending because your customer did not include a confirmed shipping address and your Payment Receiving Preferences is set such that you want to manually accept or deny each of these payments. To change your preference, go to the Preferences section of your Profile.
                  '  echeck: The payment is pending because it was made by an eCheck that has not yet cleared.
                  '  intl: The payment is pending because you hold a non-U.S. account and do not have a withdrawal mechanism. You must manually accept or deny this payment from your Account Overview.
                  '  multi-currency: You do not have a balance in the currency sent, and you do not have your Payment Receiving Preferences set to automatically convert and accept this payment. You must manually accept or deny this payment.
                  '  verify: The payment is pending because you are not yet verified. You must verify your account before you can accept this payment.
                  '  other: The payment is pending for a reason other than those listed above. For more information, contact PayPal customer service.
                 */

                $pendingReason = $resArray["PAYMENTINFO_0_PENDINGREASON"];

                /*
                  'The reason for a reversal if TransactionType is reversal:
                  '  none: No reason code
                  '  chargeback: A reversal has occurred on this transaction due to a chargeback by your customer.
                  '  guarantee: A reversal has occurred on this transaction due to your customer triggering a money-back guarantee.
                  '  buyer-complaint: A reversal has occurred on this transaction due to a complaint about the transaction from your customer.
                  '  refund: A reversal has occurred on this transaction because you have given the customer a refund.
                  '  other: A reversal has occurred on this transaction due to a reason not listed above.
                 */

                $reasonCode = $resArray["PAYMENTINFO_0_REASONCODE"];
                $ack = $resArray["PAYMENTINFO_0_ACK"];

                log_message('debug', 'Payment status follows.....');
                log_message('debug', print_r($resArray, true));

                $order_id = $this->session->userdata('invoice_id');
                $ptdm_instance = new Paypal_transaction_data_model();
                $ptdm_instance->instantiate($order_id, $transactionId, $transactionType, $paymentType, $orderTime, $amt, $currencyCode, $taxAmt, $paymentStatus, $pendingReason, $reasonCode, $ack);
                try {
                    $ptdm_instance->insert_paypal_transaction_data();
                } catch (Exception $e) {
                    log_message('error', 'Inserting paypal_transaction_data into DB failed.');
                    log_message('error', $e);
                }

                $template_data = array();
                $this->set_title($template_data, 'Payment successful');
                $this->load_header_templates($template_data);

                $data['order_id'] = $order_id;

                $this->load->view('templates/header', $template_data);
                $this->load->view('paypal/v_paypal_payment_success', $data); // review screen
                $this->load->view('templates/footer');
            } else {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

                echo "GetExpressCheckoutDetails API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
            }
        }
    }

    public function canc() {

        log_message('debug', 'CANCEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEL');
        echo 'Hopsa lasa :) from canc()';
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/c_welcome.php */