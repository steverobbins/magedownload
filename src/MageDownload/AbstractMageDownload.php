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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }
}
