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
 * Get download info
 *
 * @category  MageDownload
 * @package   MageDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magedownload
 */
class Info extends AbstractMageDownload
{
    /**
     * Send a command to the info api
     *
     * @param string  $command
     * @param string  $id
     * @param string  $token
     * @param boolean $parsed
     *
     * @return string
     */
    public function sendCommand($command, $id, $token, $parsed = false)
    {
        $this->setId($id);
        $this->setToken($token);
        $response = $this->action('info', $command);
        if ($parsed) {
            $response = $this->parseResponse($response);
        }
        return $response;
    }

    /**
     * Turn the response into something readable
     *
     * @param string $response
     *
     * @return array
     */
    protected function parseResponse($response)
    {
        $bits = preg_split('/\-{5,}/', $response);
        if (count($bits) == 1) {
            return array($response);
        }
        $headers = array();
        foreach (preg_split('/ {2,}/', $bits[0]) as $value) {
            $headers[] = trim($value);
        }
        unset($headers[0]);
        $headCount = count($headers);
        $rows = array();
        foreach (explode("\n", $bits[1]) as $row) {
            if (empty($row)) {
                continue;
            }
            $row = preg_split('/ {2,}/', $row);
            unset($row[0]);
            if ($headCount == count($row)) {
                $newRow = array();
                foreach ($row as $key => $value) {
                    $newRow[$headers[$key]] = $value;
                }
                $rows[] = $newRow;
            } else {
                $rows[] = $row;
            }
        }
        return $rows;
    }
}
