<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com> 
 */

namespace Webgriffe\PdfToTextBundle\Tests\Integration;


use Webgriffe\PdfToTextBundle\Service\PdfToTextConverter;

class PdfToTextConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testConvert()
    {
        $logger = $this->createMock('\Psr\Log\LoggerInterface');
        $logger
            ->expects($this->exactly(2))
            ->method('info');

        $converter = new PdfToTextConverter($logger, 'pdftotext');
        $output = $converter->convert(__DIR__ . '/dummy_document.pdf');

        $this->assertContains('THIS IS A DUMMY DOCUMENT', $output);
        $this->assertContains('PHP ROCKS!', $output);
    }

    public function testConvertWithNonExistentFile()
    {
        $logger = $this->createMock('\Psr\Log\LoggerInterface');
        $logger
            ->expects($this->never())
            ->method($this->anything());

        $this->setExpectedException('Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException');

        $converter = new PdfToTextConverter($logger, 'pdftotext');
        $converter->convert(__DIR__ . '/nonexistentfile.pdf');
    }

    public function testWithNonPdfFile()
    {
        $logger = $this->createMock('\Psr\Log\LoggerInterface');
        $logger
            ->expects($this->exactly(1))
            ->method('info');
        $logger
            ->expects($this->exactly(1))
            ->method('error');
        $logger
            ->expects($this->exactly(5))
            ->method('debug');

        $this->expectException('\Alchemy\BinaryDriver\Exception\ExecutionFailureException');

        $converter = new PdfToTextConverter($logger, 'pdftotext');
        $converter->convert(__DIR__ . '/non pdf document.docx');
    }

}
