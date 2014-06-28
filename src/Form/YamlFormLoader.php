<?php

namespace BZIon\Form;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class YamlFormLoader extends FileLoader
{
    public function load($resource, $type = null)
    {
        $configValues = Yaml::parse(__DIR__.'/../../resources/forms/' . $resource);

        var_dump("what", $resource, $configValues);
    }

    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}
