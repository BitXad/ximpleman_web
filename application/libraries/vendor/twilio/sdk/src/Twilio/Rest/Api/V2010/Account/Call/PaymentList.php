<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Api
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Api\V2010\Account\Call;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\Serialize;


class PaymentList extends ListResource
    {
    /**
     * Construct the PaymentList
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the [Account](https://www.twilio.com/docs/iam/api/account) that will create the resource.
     * @param string $callSid The SID of the call that will create the resource. Call leg associated with this sid is expected to provide payment information thru DTMF.
     */
    public function __construct(
        Version $version,
        string $accountSid,
        string $callSid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'accountSid' =>
            $accountSid,
        
        'callSid' =>
            $callSid,
        
        ];

        $this->uri = '/Accounts/' . \rawurlencode($accountSid)
        .'/Calls/' . \rawurlencode($callSid)
        .'/Payments.json';
    }

    /**
     * Create the PaymentInstance
     *
     * @param string $idempotencyKey A unique token that will be used to ensure that multiple API calls with the same information do not result in multiple transactions. This should be a unique string value per API call and can be a randomly generated.
     * @param string $statusCallback Provide an absolute or relative URL to receive status updates regarding your Pay session. Read more about the [expected StatusCallback values](https://www.twilio.com/docs/voice/api/payment-resource#statuscallback)
     * @param array|Options $options Optional Arguments
     * @return PaymentInstance Created PaymentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $idempotencyKey, string $statusCallback, array $options = []): PaymentInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'IdempotencyKey' =>
                $idempotencyKey,
            'StatusCallback' =>
                $statusCallback,
            'BankAccountType' =>
                $options['bankAccountType'],
            'ChargeAmount' =>
                $options['chargeAmount'],
            'Currency' =>
                $options['currency'],
            'Description' =>
                $options['description'],
            'Input' =>
                $options['input'],
            'MinPostalCodeLength' =>
                $options['minPostalCodeLength'],
            'Parameter' =>
                Serialize::jsonObject($options['parameter']),
            'PaymentConnector' =>
                $options['paymentConnector'],
            'PaymentMethod' =>
                $options['paymentMethod'],
            'PostalCode' =>
                Serialize::booleanToString($options['postalCode']),
            'SecurityCode' =>
                Serialize::booleanToString($options['securityCode']),
            'Timeout' =>
                $options['timeout'],
            'TokenType' =>
                $options['tokenType'],
            'ValidCardTypes' =>
                $options['validCardTypes'],
        ]);

        $payload = $this->version->create('POST', $this->uri, [], $data);

        return new PaymentInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['callSid']
        );
    }


    /**
     * Constructs a PaymentContext
     *
     * @param string $sid The SID of Payments session that needs to be updated.
     */
    public function getContext(
        string $sid
        
    ): PaymentContext
    {
        return new PaymentContext(
            $this->version,
            $this->solution['accountSid'],
            $this->solution['callSid'],
            $sid
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Api.V2010.PaymentList]';
    }
}