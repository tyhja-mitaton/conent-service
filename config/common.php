<?php


if (!class_exists('ConfigGenerator')) {
    class ConfigGenerator
    {
        private function baseConfig()
        {
            return [
                'id' => env('PROJECT_NAME'),
                'name' => env('PROJECT_NAME'),
                'timeZone' => 'Europe/Moscow',
                'language' => 'ru-RU',
                'basePath' => dirname(__DIR__),
                'bootstrap' => ['log'],
                'aliases' => [
                    '@bower' => '@vendor/bower-asset',
                    '@npm' => '@vendor/npm-asset',
                    '@webroot' => dirname(dirname(__FILE__)) . '/web',
                    '@data' => dirname(dirname(__FILE__)) . '/data',
                ],
                'components' => [
                    'urlManager' => null,
                    'cache' => null,
                    'formatter' => null,
                    'log' => null,
                    'db' => null,
                    'geo' => null,
                    'authManager' => null,
                    'mailer' => null,
                    'clickhouse' => null,
                    'mutex' => null,
                    'format' => null,
                    'moneyConverter' => null,
                    'redis' => null,
                    'redisCache' => null,
                    'settings' => null,
                    'commandBus' => null,
                    'i18n' => null,
                    'telegram' => null,
                    'queue' => null
                ],
                'params' => null,
            ];
        }

        private $fullConfig;

        public function __construct($config)
        {
            $this->fullConfig = $this->baseConfig();

            $this->fullConfig = yii\helpers\ArrayHelper::merge($this->fullConfig, $config);
        }

        public function getFullConfig()
        {
            foreach (array_keys($this->fullConfig) as $section) {
                $this->mergeSection($section);
            }
            foreach (array_keys($this->fullConfig['components']) as $component) {
                $this->mergeComponent($component);
            }
            foreach (array_keys($this->fullConfig) as $section) {
                $this->mergeSection($section, true);
            }
            foreach (array_keys($this->fullConfig['components']) as $component) {
                $this->mergeComponent($component, true);
            }

            return $this->fullConfig;
        }

        private function mergeComponent($component, $isLocal = false)
        {
            $data = $this->getSectionSettings($component, $isLocal);
            if (!empty($data)) {
                $this->fullConfig['components'][$component] = yii\helpers\ArrayHelper::merge($this->fullConfig['components'][$component], $data);
            }
        }

        private function mergeSection($section, $isLocal = false)
        {
            $data = $this->getSectionSettings($section, $isLocal);
            if (!empty($data)) {
                $this->fullConfig[$section] = yii\helpers\ArrayHelper::merge($this->fullConfig[$section], $data);
            }
        }

        private function getSectionSettings($section, $isLocal = false)
        {
            if ($isLocal) {
                $path = __DIR__ . '/local/' . $section . '.php';
            } else {
                $path = __DIR__ . '/sections/' . $section . '.php';
            }
            if (file_exists($path)) {
                return require $path;
            }
            return [];
        }
    }
}
