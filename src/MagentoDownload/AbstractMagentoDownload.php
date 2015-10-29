<?php
/**
 * Magento Download
 *
 * PHP version 5
 *
 * @category  MagentoDownload
 * @package   MagentoDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magento-download
 */

namespace MagentoDownload;

use GuzzleHttp\Client;

/**
 * Abstract class
 *
 * @category  MagentoDownload
 * @package   MagentoDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magento-download
 */
class AbstractMagentoDownload
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
        return $client->get($name . '/' . $additional);
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
