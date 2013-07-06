<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com>
 */

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;
use Webgriffe\PdfToTextBundle\WebgriffePdfToTextBundle;

class AppKernel extends Kernel
{

    /**
     * Returns an array of bundles to registers.
     *
     * @return BundleInterface[] An array of bundle instances.
     *
     * @api
     */
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new WebgriffePdfToTextBundle(),
        );
    }

    /**
     * Loads the container configuration
     *
     * @param LoaderInterface $loader A LoaderInterface instance
     *
     * @api
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir() . '/WebgriffePdfToTextBundle/cache';
    }

    public function getLogDir()
    {
        return sys_get_temp_dir() . '/WebgriffePdfToTextBundle/logs';
    }


}