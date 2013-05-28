<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com> 
 */

namespace Webgriffe\PdfToTextBundle\Tests\Functional;


use Webgriffe\PdfToTextBundle\Service\PdfToTextConverter;

class PdfToTextConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testConvert()
    {
        $converter = new PdfToTextConverter();
        $output = $converter->convert(__DIR__ . '/dummy_document.pdf');

        $this->assertContains('THIS IS A DUMMY DOCUMENT', $output);
        $this->assertContains('PHP ROCKS!', $output);
    }

    public function testConvertWithNonExistentFile()
    {
        $this->setExpectedException('Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException');

        $converter = new PdfToTextConverter();
        $converter->convert(__DIR__ . '/nonexistentfile.pdf');
    }

}