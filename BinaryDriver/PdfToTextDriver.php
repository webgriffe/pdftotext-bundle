<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com> 
 */

namespace Webgriffe\PdfToTextBundle\BinaryDriver;


use Alchemy\BinaryDriver\AbstractBinary;

class PdfToTextDriver extends AbstractBinary
{

    /**
     * Returns the name of the driver
     *
     * @return string
     */
    public function getName()
    {
        return 'PdfToText Driver';
    }
}