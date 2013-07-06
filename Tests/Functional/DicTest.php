<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com>
 */

namespace Webgriffe\PdfToTextBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DicTest extends WebTestCase
{
    public function testServiceLoad()
    {
        /** @var \AppKernel $kernel */
        $kernel = static::createKernel();
        $kernel->boot();

        $converter = $kernel->getContainer()->get('webgriffe_pdf_to_text.converter');
        $this->assertInstanceOf('Webgriffe\PdfToTextBundle\Service\PdfToTextConverter', $converter);
    }

}