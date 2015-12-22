<?php
/**
 * Magedownload
 *
 * PHP version 5
 *
 * @category  MageDownload
 * @package   MageDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magedownload
 */

namespace MageDownload;

/**
 * Abstract class
 *
 * @category  MageDownload
 * @package   MageDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magedownload
 */
class AbstractMageDownload
{
    const ENDPOINT_URL    = 'www.magentocommerce.com/products/downloads/';
    const ENDPOINT_SCHEMA = 'https';

    private $id;
    private $token;

    /**
     * Hit api with specified action
     *
     * @param string $name
     * @param string $additional
     *
     * @return string
     */
    public function action($name, $additional = '')
    {
        return file_get_contents($this->getBaseUri() . $name . '/' . $additional);
    }

    /**
     * Get the base uri
     *
     * @return string
     */
    public function getBaseUri()
    {
        return self::ENDPOINT_SCHEMA . '://'
                . $this->id . ':' . $this->token
                . '@' . self::ENDPOINT_URL;
    }

    /**
     * ID setter
     *
     * @param string $id
     *
     * @return AbstractMageDownload
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Token setter
     *
     * @param string $token
     *
     * @return AbstractMageDownload
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
