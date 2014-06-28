<?php

namespace BZIon\Form;

use Service;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;

/**
 * This file contains a class which parses YML files to extract Symfony forms
 *
 * @license    https://github.com/allejo/bzion/blob/master/LICENSE.md GNU General Public License Version 3
 */

/**
 * A form builder from YML files
 */
class FormParser
{
    public function __construct()
    {
        $cachePath = Service::getContainer()->get('kernel')->getCacheDir() . '/appForms.php';

        // the second argument indicates whether or not you want to use debug mode
        $userMatcherCache = new ConfigCache($cachePath, (bool) DEVELOPMENT);

        if (!$userMatcherCache->isFresh() || 1) {
            // fill this with an array of 'users.yml' file paths
            $yamlUserFiles = array(__DIR__ . "/../../resources/forms/Match/create.yml");

            var_dump(file_get_contents(__DIR__ . "/../../resources/forms/Match/create.yml"));

            $resources = array();



            $configDirectories = array(__DIR__.'/../../resources/forms');

            $locator = new FileLocator($configDirectories);
            $loaderResolver = new LoaderResolver(array(new YamlFormLoader($locator)));
            $delegatingLoader = new DelegatingLoader($loaderResolver);

            $delegatingLoader->load('Match/create.yml');

            // foreach ($yamlUserFiles as $yamlUserFile) {
            //     // see the previous article "Loading resources" to
            //     // see where $delegatingLoader comes from
            //     $delegatingLoader->load($yamlUserFile);
            //     $resources[] = new FileResource($yamlUserFile);
            // }
            //
            // // the code for the UserMatcher is generated elsewhere
            // //$code = ...;

            $userMatcherCache->write($code, $resources);
        }

        // you may want to require the cached code:
        require $cachePath;
    }
}
