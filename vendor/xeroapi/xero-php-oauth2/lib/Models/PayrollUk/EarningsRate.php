<?php
/**
 * EarningsRate
 *
 * PHP version 5
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Xero Payroll UK
 *
 * This is the Xero Payroll API for orgs in the UK region.
 *
 * Contact: api@xero.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace XeroAPI\XeroPHP\Models\PayrollUk;

use \ArrayAccess;
use \XeroAPI\XeroPHP\PayrollUkObjectSerializer;
use \XeroAPI\XeroPHP\StringUtil;
/**
 * EarningsRate Class Doc Comment
 *
 * @category Class
 * @package  XeroAPI\XeroPHP
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EarningsRate implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'EarningsRate';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'earnings_rate_id' => 'string',
        'name' => 'string',
        'earnings_type' => 'string',
        'rate_type' => 'string',
        'type_of_units' => 'string',
        'current_record' => 'bool',
        'expense_account_id' => 'string',
        'rate_per_unit' => 'double',
        'multiple_of_ordinary_earnings_rate' => 'double',
        'fixed_amount' => 'double'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'earnings_rate_id' => 'uuid',
        'name' => null,
        'earnings_type' => null,
        'rate_type' => null,
        'type_of_units' => null,
        'current_record' => null,
        'expense_account_id' => 'uuid',
        'rate_per_unit' => 'double',
        'multiple_of_ordinary_earnings_rate' => 'double',
        'fixed_amount' => 'double'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'earnings_rate_id' => 'earningsRateID',
        'name' => 'name',
        'earnings_type' => 'earningsType',
        'rate_type' => 'rateType',
        'type_of_units' => 'typeOfUnits',
        'current_record' => 'currentRecord',
        'expense_account_id' => 'expenseAccountID',
        'rate_per_unit' => 'ratePerUnit',
        'multiple_of_ordinary_earnings_rate' => 'multipleOfOrdinaryEarningsRate',
        'fixed_amount' => 'fixedAmount'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'earnings_rate_id' => 'setEarningsRateId',
        'name' => 'setName',
        'earnings_type' => 'setEarningsType',
        'rate_type' => 'setRateType',
        'type_of_units' => 'setTypeOfUnits',
        'current_record' => 'setCurrentRecord',
        'expense_account_id' => 'setExpenseAccountId',
        'rate_per_unit' => 'setRatePerUnit',
        'multiple_of_ordinary_earnings_rate' => 'setMultipleOfOrdinaryEarningsRate',
        'fixed_amount' => 'setFixedAmount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'earnings_rate_id' => 'getEarningsRateId',
        'name' => 'getName',
        'earnings_type' => 'getEarningsType',
        'rate_type' => 'getRateType',
        'type_of_units' => 'getTypeOfUnits',
        'current_record' => 'getCurrentRecord',
        'expense_account_id' => 'getExpenseAccountId',
        'rate_per_unit' => 'getRatePerUnit',
        'multiple_of_ordinary_earnings_rate' => 'getMultipleOfOrdinaryEarningsRate',
        'fixed_amount' => 'getFixedAmount'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const EARNINGS_TYPE_ALLOWANCE = 'Allowance';
    const EARNINGS_TYPE_BACKPAY = 'Backpay';
    const EARNINGS_TYPE_BONUS = 'Bonus';
    const EARNINGS_TYPE_COMMISSION = 'Commission';
    const EARNINGS_TYPE_LUMP_SUM = 'LumpSum';
    const EARNINGS_TYPE_OTHER_EARNINGS = 'OtherEarnings';
    const EARNINGS_TYPE_OVERTIME_EARNINGS = 'OvertimeEarnings';
    const EARNINGS_TYPE_REGULAR_EARNINGS = 'RegularEarnings';
    const EARNINGS_TYPE_STATUTORY_ADOPTION_PAY = 'StatutoryAdoptionPay';
    const EARNINGS_TYPE_STATUTORY_ADOPTION_PAY_NON_PENSIONABLE = 'StatutoryAdoptionPayNonPensionable';
    const EARNINGS_TYPE_STATUTORY_BEREAVEMENT_PAY = 'StatutoryBereavementPay';
    const EARNINGS_TYPE_STATUTORY_MATERNITY_PAY = 'StatutoryMaternityPay';
    const EARNINGS_TYPE_STATUTORY_MATERNITY_PAY_NON_PENSIONABLE = 'StatutoryMaternityPayNonPensionable';
    const EARNINGS_TYPE_STATUTORY_PATERNITY_PAY = 'StatutoryPaternityPay';
    const EARNINGS_TYPE_STATUTORY_PATERNITY_PAY_NON_PENSIONABLE = 'StatutoryPaternityPayNonPensionable';
    const EARNINGS_TYPE_STATUTORY_PARENTAL_BEREAVEMENT_PAY_NON_PENSIONABLE = 'StatutoryParentalBereavementPayNonPensionable';
    const EARNINGS_TYPE_STATUTORY_SHARED_PARENTAL_PAY = 'StatutorySharedParentalPay';
    const EARNINGS_TYPE_STATUTORY_SHARED_PARENTAL_PAY_NON_PENSIONABLE = 'StatutorySharedParentalPayNonPensionable';
    const EARNINGS_TYPE_STATUTORY_SICK_PAY = 'StatutorySickPay';
    const EARNINGS_TYPE_STATUTORY_SICK_PAY_NON_PENSIONABLE = 'StatutorySickPayNonPensionable';
    const EARNINGS_TYPE_TIPS_NON_DIRECT = 'TipsNonDirect';
    const EARNINGS_TYPE_TIPS_DIRECT = 'TipsDirect';
    const EARNINGS_TYPE_TERMINATION_PAY = 'TerminationPay';
    const RATE_TYPE_RATE_PER_UNIT = 'RatePerUnit';
    const RATE_TYPE_MULTIPLE_OF_ORDINARY_EARNINGS_RATE = 'MultipleOfOrdinaryEarningsRate';
    const RATE_TYPE_FIXED_AMOUNT = 'FixedAmount';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEarningsTypeAllowableValues()
    {
        return [
            self::EARNINGS_TYPE_ALLOWANCE,
            self::EARNINGS_TYPE_BACKPAY,
            self::EARNINGS_TYPE_BONUS,
            self::EARNINGS_TYPE_COMMISSION,
            self::EARNINGS_TYPE_LUMP_SUM,
            self::EARNINGS_TYPE_OTHER_EARNINGS,
            self::EARNINGS_TYPE_OVERTIME_EARNINGS,
            self::EARNINGS_TYPE_REGULAR_EARNINGS,
            self::EARNINGS_TYPE_STATUTORY_ADOPTION_PAY,
            self::EARNINGS_TYPE_STATUTORY_ADOPTION_PAY_NON_PENSIONABLE,
            self::EARNINGS_TYPE_STATUTORY_BEREAVEMENT_PAY,
            self::EARNINGS_TYPE_STATUTORY_MATERNITY_PAY,
            self::EARNINGS_TYPE_STATUTORY_MATERNITY_PAY_NON_PENSIONABLE,
            self::EARNINGS_TYPE_STATUTORY_PATERNITY_PAY,
            self::EARNINGS_TYPE_STATUTORY_PATERNITY_PAY_NON_PENSIONABLE,
            self::EARNINGS_TYPE_STATUTORY_PARENTAL_BEREAVEMENT_PAY_NON_PENSIONABLE,
            self::EARNINGS_TYPE_STATUTORY_SHARED_PARENTAL_PAY,
            self::EARNINGS_TYPE_STATUTORY_SHARED_PARENTAL_PAY_NON_PENSIONABLE,
            self::EARNINGS_TYPE_STATUTORY_SICK_PAY,
            self::EARNINGS_TYPE_STATUTORY_SICK_PAY_NON_PENSIONABLE,
            self::EARNINGS_TYPE_TIPS_NON_DIRECT,
            self::EARNINGS_TYPE_TIPS_DIRECT,
            self::EARNINGS_TYPE_TERMINATION_PAY,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRateTypeAllowableValues()
    {
        return [
            self::RATE_TYPE_RATE_PER_UNIT,
            self::RATE_TYPE_MULTIPLE_OF_ORDINARY_EARNINGS_RATE,
            self::RATE_TYPE_FIXED_AMOUNT,
        ];
    }
    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['earnings_rate_id'] = isset($data['earnings_rate_id']) ? $data['earnings_rate_id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['earnings_type'] = isset($data['earnings_type']) ? $data['earnings_type'] : null;
        $this->container['rate_type'] = isset($data['rate_type']) ? $data['rate_type'] : null;
        $this->container['type_of_units'] = isset($data['type_of_units']) ? $data['type_of_units'] : null;
        $this->container['current_record'] = isset($data['current_record']) ? $data['current_record'] : null;
        $this->container['expense_account_id'] = isset($data['expense_account_id']) ? $data['expense_account_id'] : null;
        $this->container['rate_per_unit'] = isset($data['rate_per_unit']) ? $data['rate_per_unit'] : null;
        $this->container['multiple_of_ordinary_earnings_rate'] = isset($data['multiple_of_ordinary_earnings_rate']) ? $data['multiple_of_ordinary_earnings_rate'] : null;
        $this->container['fixed_amount'] = isset($data['fixed_amount']) ? $data['fixed_amount'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['earnings_type'] === null) {
            $invalidProperties[] = "'earnings_type' can't be null";
        }
        $allowedValues = $this->getEarningsTypeAllowableValues();
        if (!is_null($this->container['earnings_type']) && !in_array($this->container['earnings_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'earnings_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['rate_type'] === null) {
            $invalidProperties[] = "'rate_type' can't be null";
        }
        $allowedValues = $this->getRateTypeAllowableValues();
        if (!is_null($this->container['rate_type']) && !in_array($this->container['rate_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'rate_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['type_of_units'] === null) {
            $invalidProperties[] = "'type_of_units' can't be null";
        }
        if ($this->container['expense_account_id'] === null) {
            $invalidProperties[] = "'expense_account_id' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets earnings_rate_id
     *
     * @return string|null
     */
    public function getEarningsRateId()
    {
        return $this->container['earnings_rate_id'];
    }

    /**
     * Sets earnings_rate_id
     *
     * @param string|null $earnings_rate_id Xero unique identifier for an earning rate
     *
     * @return $this
     */
    public function setEarningsRateId($earnings_rate_id)
    {

        $this->container['earnings_rate_id'] = $earnings_rate_id;

        return $this;
    }



    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Name of the earning rate
     *
     * @return $this
     */
    public function setName($name)
    {

        $this->container['name'] = $name;

        return $this;
    }



    /**
     * Gets earnings_type
     *
     * @return string
     */
    public function getEarningsType()
    {
        return $this->container['earnings_type'];
    }

    /**
     * Sets earnings_type
     *
     * @param string $earnings_type Indicates how an employee will be paid when taking this type of earning
     *
     * @return $this
     */
    public function setEarningsType($earnings_type)
    {
        $allowedValues = $this->getEarningsTypeAllowableValues();
        if (!in_array($earnings_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'earnings_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }

        $this->container['earnings_type'] = $earnings_type;

        return $this;
    }



    /**
     * Gets rate_type
     *
     * @return string
     */
    public function getRateType()
    {
        return $this->container['rate_type'];
    }

    /**
     * Sets rate_type
     *
     * @param string $rate_type Indicates the type of the earning rate
     *
     * @return $this
     */
    public function setRateType($rate_type)
    {
        $allowedValues = $this->getRateTypeAllowableValues();
        if (!in_array($rate_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'rate_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }

        $this->container['rate_type'] = $rate_type;

        return $this;
    }



    /**
     * Gets type_of_units
     *
     * @return string
     */
    public function getTypeOfUnits()
    {
        return $this->container['type_of_units'];
    }

    /**
     * Sets type_of_units
     *
     * @param string $type_of_units The type of units used to record earnings
     *
     * @return $this
     */
    public function setTypeOfUnits($type_of_units)
    {

        $this->container['type_of_units'] = $type_of_units;

        return $this;
    }



    /**
     * Gets current_record
     *
     * @return bool|null
     */
    public function getCurrentRecord()
    {
        return $this->container['current_record'];
    }

    /**
     * Sets current_record
     *
     * @param bool|null $current_record Indicates whether an earning type is active
     *
     * @return $this
     */
    public function setCurrentRecord($current_record)
    {

        $this->container['current_record'] = $current_record;

        return $this;
    }



    /**
     * Gets expense_account_id
     *
     * @return string
     */
    public function getExpenseAccountId()
    {
        return $this->container['expense_account_id'];
    }

    /**
     * Sets expense_account_id
     *
     * @param string $expense_account_id The account that will be used for the earnings rate
     *
     * @return $this
     */
    public function setExpenseAccountId($expense_account_id)
    {

        $this->container['expense_account_id'] = $expense_account_id;

        return $this;
    }



    /**
     * Gets rate_per_unit
     *
     * @return double|null
     */
    public function getRatePerUnit()
    {
        return $this->container['rate_per_unit'];
    }

    /**
     * Sets rate_per_unit
     *
     * @param double|null $rate_per_unit Default rate per unit (optional). Only applicable if RateType is RatePerUnit
     *
     * @return $this
     */
    public function setRatePerUnit($rate_per_unit)
    {

        $this->container['rate_per_unit'] = $rate_per_unit;

        return $this;
    }



    /**
     * Gets multiple_of_ordinary_earnings_rate
     *
     * @return double|null
     */
    public function getMultipleOfOrdinaryEarningsRate()
    {
        return $this->container['multiple_of_ordinary_earnings_rate'];
    }

    /**
     * Sets multiple_of_ordinary_earnings_rate
     *
     * @param double|null $multiple_of_ordinary_earnings_rate This is the multiplier used to calculate the rate per unit, based on the employee’s ordinary earnings rate. For example, for time and a half enter 1.5. Only applicable if RateType is MultipleOfOrdinaryEarningsRate
     *
     * @return $this
     */
    public function setMultipleOfOrdinaryEarningsRate($multiple_of_ordinary_earnings_rate)
    {

        $this->container['multiple_of_ordinary_earnings_rate'] = $multiple_of_ordinary_earnings_rate;

        return $this;
    }



    /**
     * Gets fixed_amount
     *
     * @return double|null
     */
    public function getFixedAmount()
    {
        return $this->container['fixed_amount'];
    }

    /**
     * Sets fixed_amount
     *
     * @param double|null $fixed_amount Optional Fixed Rate Amount. Applicable for FixedAmount Rate
     *
     * @return $this
     */
    public function setFixedAmount($fixed_amount)
    {

        $this->container['fixed_amount'] = $fixed_amount;

        return $this;
    }


    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            PayrollUkObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }
}


