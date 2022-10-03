<?php

namespace WPIDE\App\Controllers;

use WPIDE\App\Config\Config;
use WPIDE\App\Kernel\Request;
use WPIDE\App\Kernel\Response;

class ConfigController
{

    public function getConfig(Response $response, Config $config)
    {

        return $response->json([
            'config' => $config->get(),
            'defaults' => $config->getDefaults()
        ]);
    }

    public function updateConfig(Request $request, Response $response, Config $config)
    {

        if(!$config->updateConfig($request->input('config'))) {

            return $response->json('Cannot save settings!', 422);
        }

        return $response->json('Done');
    }

}
