<?php
/**
 * PostLetter
 *
 * PHP version 5
 *
 * @category Class
 * @package  ClickSend
 * @author   ClickSend Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * ClickSend v3 API
 *
 * This is an official SDK for [ClickSend](https://clicksend.com)  Below you will find a current list of the available methods for clicksend.  *NOTE: You will need to create a free account to use the API. You can register [here](https://dashboard.clicksend.com/#/signup/step1/)..*
 *
 * OpenAPI spec version: 3.1
 * Contact: support@clicksend.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * ClickSend Codegen version: 2.4.21-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace ClickSend\Model;

use \ArrayAccess;
use \ClickSend\ObjectSerializer;

/**
 * PostLetter Class Doc Comment
 *
 * @category Class
 * @description PostLetter model
 * @package  ClickSend
 * @author   ClickSend Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PostLetter implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = 'classType';

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PostLetter';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'file_url' => 'string',
        'priority_post' => 'int',
        'recipients' => '\ClickSend\Model\PostRecipient[]',
        'template_used' => 'int',
        'duplex' => 'int',
        'colour' => 'int',
        'source' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'file_url' => null,
        'priority_post' => 'int32',
        'recipients' => null,
        'template_used' => 'int32',
        'duplex' => 'int32',
        'colour' => 'int32',
        'source' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'file_url' => 'file_url',
        'priority_post' => 'priority_post',
        'recipients' => 'recipients',
        'template_used' => 'template_used',
        'duplex' => 'duplex',
        'colour' => 'colour',
        'source' => 'source'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'file_url' => 'setFileUrl',
        'priority_post' => 'setPriorityPost',
        'recipients' => 'setRecipients',
        'template_used' => 'setTemplateUsed',
        'duplex' => 'setDuplex',
        'colour' => 'setColour',
        'source' => 'setSource'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'file_url' => 'getFileUrl',
        'priority_post' => 'getPriorityPost',
        'recipients' => 'getRecipients',
        'template_used' => 'getTemplateUsed',
        'duplex' => 'getDuplex',
        'colour' => 'getColour',
        'source' => 'getSource'
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
        return self::$swaggerModelName;
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
        $this->container['file_url'] = isset($data['file_url']) ? $data['file_url'] : null;
        $this->container['priority_post'] = isset($data['priority_post']) ? $data['priority_post'] : 0;
        $this->container['recipients'] = isset($data['recipients']) ? $data['recipients'] : null;
        $this->container['template_used'] = isset($data['template_used']) ? $data['template_used'] : 0;
        $this->container['duplex'] = isset($data['duplex']) ? $data['duplex'] : 0;
        $this->container['colour'] = isset($data['colour']) ? $data['colour'] : 0;
        $this->container['source'] = isset($data['source']) ? $data['source'] : 'sdk';

        // Initialize discriminator property with the model name.
        $discriminator = array_search('classType', self::$attributeMap, true);
        $this->container[$discriminator] = static::$swaggerModelName;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['file_url'] === null) {
            $invalidProperties[] = "'file_url' can't be null";
        }
        if ($this->container['recipients'] === null) {
            $invalidProperties[] = "'recipients' can't be null";
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
     * Gets file_url
     *
     * @return string
     */
    public function getFileUrl()
    {
        return $this->container['file_url'];
    }

    /**
     * Sets file_url
     *
     * @param string $file_url URL of file to send
     *
     * @return $this
     */
    public function setFileUrl($file_url)
    {
        $this->container['file_url'] = $file_url;

        return $this;
    }

    /**
     * Gets priority_post
     *
     * @return int
     */
    public function getPriorityPost()
    {
        return $this->container['priority_post'];
    }

    /**
     * Sets priority_post
     *
     * @param int $priority_post Whether letter is priority
     *
     * @return $this
     */
    public function setPriorityPost($priority_post)
    {
        $this->container['priority_post'] = $priority_post;

        return $this;
    }

    /**
     * Gets recipients
     *
     * @return \ClickSend\Model\PostRecipient[]
     */
    public function getRecipients()
    {
        return $this->container['recipients'];
    }

    /**
     * Sets recipients
     *
     * @param \ClickSend\Model\PostRecipient[] $recipients Array of PostRecipient models
     *
     * @return $this
     */
    public function setRecipients($recipients)
    {
        $this->container['recipients'] = $recipients;

        return $this;
    }

    /**
     * Gets template_used
     *
     * @return int
     */
    public function getTemplateUsed()
    {
        return $this->container['template_used'];
    }

    /**
     * Sets template_used
     *
     * @param int $template_used Whether using our template
     *
     * @return $this
     */
    public function setTemplateUsed($template_used)
    {
        $this->container['template_used'] = $template_used;

        return $this;
    }

    /**
     * Gets duplex
     *
     * @return int
     */
    public function getDuplex()
    {
        return $this->container['duplex'];
    }

    /**
     * Sets duplex
     *
     * @param int $duplex Whether letter is duplex
     *
     * @return $this
     */
    public function setDuplex($duplex)
    {
        $this->container['duplex'] = $duplex;

        return $this;
    }

    /**
     * Gets colour
     *
     * @return int
     */
    public function getColour()
    {
        return $this->container['colour'];
    }

    /**
     * Sets colour
     *
     * @param int $colour Whether letter is in colour
     *
     * @return $this
     */
    public function setColour($colour)
    {
        $this->container['colour'] = $colour;

        return $this;
    }

    /**
     * Gets source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->container['source'];
    }

    /**
     * Sets source
     *
     * @param string $source Source being sent from
     *
     * @return $this
     */
    public function setSource($source)
    {
        $this->container['source'] = $source;

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
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


