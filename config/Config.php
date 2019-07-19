<?php

namespace App\config;

class Config
{
    const DEFAULT_URL = '/provider/index';

    const BASE_DIR = __DIR__ . '/../';

    const VIEWS_DIR = self::BASE_DIR . 'Views/';

    const DEFAULT_CONTROLLER = '\\App\\Controllers\\ProviderController';

    const DEFAULT_ACTION = 'index';

    const SITE_URL = 'http://bars.mysite';
}