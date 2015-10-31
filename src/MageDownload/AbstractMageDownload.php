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

use GuzzleHttp\Client;

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
    protected function action($name, $additional = '')
    {
        $client = new Client([
            'base_uri' => self::ENDPOINT_SCHEMA . '://'
                . $this->id . ':' . $this->token
                . '@' . self::ENDPOINT_URL
        ]);
        $response = $client->get($name . '/' . $additional);
        return $response->getBody()->getContents();
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
