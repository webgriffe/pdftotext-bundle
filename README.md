PDF to Text Symfony2 Bundle
===========================

This Symfony2 bundle allows you to convert an input PDF file into plain text.

Conversion is made through `pdftotext` command-line utilty ([http://en.wikipedia.org/wiki/Pdftotext](http://en.wikipedia.org/wiki/Pdftotext)). `pdftotext` is part of [Xpdf](http://www.foolabs.com/xpdf/index.html) software suite, is included in many Linux distributions and that should be available also for Mac OS X and Windows platforms.

Installation
------------
Install this bundle as any other Symfony 2 bundle.

### Symfony >= 2.1.x
Add the following requirement to your `composer.json`:

	"require": {
		…
		"webgriffe/pdftotext-bundle": "dev-master"
	}
Install the bundle with the following command:

	$ composer update webgriffe/pdftotext-bundle


Register the bundle in the `AppKernel`:

	public function registerBundles()
    {
    	…
    	new Webgriffe\PdfToTextBundle\WebgriffePdfToTextBundle(),
    }

### Symfony 2.0.x    	

Add the following requirement in your `deps` file:

	…
	[WebgriffePdfToTextBundle]
		git=git://github.com/webgriffe/pdftotext-bundle.git
		target=bundles/Webgriffe/PdfToTextBundle

Install the bundle with the following command:
	
	$ bin/vendors install
	
Register the bundle in the `AppKernel`:

	public function registerBundles()
    {
    	…
    	new Webgriffe\PdfToTextBundle\WebgriffePdfToTextBundle(),
    }
	
Usage
-----

Simply, you can get the `PdfToTextConverter` from DIC and get the plain text string.

	// Acme\MyBundle\Controller\MyController
	
	public function myAction()
	{
		$pdfFile = '/path/to/file.pdf';
		$pdfToTextConverter = $this->get('webgriffe_pdf_to_text.converter');
		$pdfText = $pdfToTextConverter->convert($pdfFile);
		
		return new \Symfony\Component\HttpFoundation\Response($pdfText);
	}
	
You can also specify the output encoding (default is `UTF-8`).

	$pdfText = $pdfToTextConverter->convert($pdfFile, 'ISO-8859-1');


Credits:
--------

This bundle has been developed by [Webgriffe®](http://www.webgriffe.com). Please, report to us any bug or suggestion by GitHub issues.

