<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com> 
 */

namespace Webgriffe\PdfToTextBundle\Service;

use Alchemy\BinaryDriver\Configuration;
use Alchemy\BinaryDriver\Listeners\DebugListener;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Webgriffe\PdfToTextBundle\BinaryDriver\PdfToTextDriver;

class PdfToTextConverter
{
    const TIMEOUT = 60;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function convert($file, $toEncoding = 'UTF-8')
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException($file);
        }

        $configuration = new Configuration(array('timeout' => self::TIMEOUT));
        $pdfToTextDriver = PdfToTextDriver::load('pdftotext', $this->logger, $configuration);

        $debugListener = new DebugListener('[STDOUT] ', '[STDERR] ', 'stdout', 'stderr');
        $pdfToTextDriver->listen($debugListener);
        $pdfToTextDriver->on('stderr', array($this, 'logStderrLine'));

        $output = $pdfToTextDriver->command(array($file, '-'));
        $fromEncoding = mb_detect_encoding($output);

        if ($fromEncoding) {
            return mb_convert_encoding($output, $toEncoding, $fromEncoding);
        }

        return mb_convert_encoding($output, $toEncoding);
    }

    public function logStderrLine($line)
    {
        if ($line === '[STDERR] ') {
            return;
        }
        $this->logger->debug($line);
    }
}