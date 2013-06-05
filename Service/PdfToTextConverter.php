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

    public function convert($file, $toEncoding = 'UTF-8')
    {
        $configuration = new Configuration(array('timeout' => self::TIMEOUT));
        $pdfToTextDriver = PdfToTextDriver::load('pdftotext', null, $configuration);

        if (!file_exists($file)) {
            throw new FileNotFoundException($file);
        }

        $output = $pdfToTextDriver->command(array($file, '-'));
        $fromEncoding = mb_detect_encoding($output);

        if ($fromEncoding) {
            return mb_convert_encoding($output, $toEncoding, $fromEncoding);
        }

        return mb_convert_encoding($output, $toEncoding);
    }
}