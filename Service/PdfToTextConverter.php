<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com> 
 */

namespace Webgriffe\PdfToTextBundle\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class PdfToTextConverter
{
    public function convert($file)
    {
        if (!$this->command_exist()) {
            throw new \RuntimeException(
                'Command pdftotext not found. ' .
                'If you\'re on Mac OS X you can download it from http://www.bluem.net/en/mac/packages/.'
            );
        }

        if (!file_exists($file)) {
            throw new FileNotFoundException($file);
        }

        return shell_exec(sprintf('pdftotext "%s" -', $file));
    }

    private function command_exist()
    {
        $returnVal = shell_exec("which pdftotext");
        return (empty($returnVal) ? false : true);
    }
}