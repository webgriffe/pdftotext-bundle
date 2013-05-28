<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com> 
 */

namespace Webgriffe\PdfToTextBundle\Service;

use Alchemy\BinaryDriver\Configuration;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Webgriffe\PdfToTextBundle\BinaryDriver\PdfToTextDriver;

class PdfToTextConverter
{
    const TIMEOUT = 60;

    public function convert($file)
    {
        $configuration = new Configuration(array('timeout' => self::TIMEOUT));
        $pdfToTextDriver = PdfToTextDriver::load('pdftotext', null, $configuration);

        if (!file_exists($file)) {
            throw new FileNotFoundException($file);
        }

        return $pdfToTextDriver->command(array($file, '-'));
    }
}