<?php
namespace WPIDE\App\Config;
use const WPIDE\Constants\SLUG;

class Config
{
    protected $config;
    protected $values;
    protected $defaults;
    protected $meta_key;

    public function __construct(array $config = [])
    {

        $this->meta_key = SLUG.'_config';
        $this->config = $config;

        $this->loadDefaults();
        $this->loadValues();
    }

    public function loadDefaults()
    {

        $this->defaults = $this->getConfigDefaults($this->config);
    }

    public function loadValues()
    {

        $this->values = $this->mergeValues($this->defaults, $this->getOption());
    }

    public function getDefaults(): array
    {

        return $this->defaults;
    }

    protected function getConfigDefaults($config): array
    {

        $values = [];

        if(!is_array($config)){
            return $values;
        }

        foreach($config as $key => $conf) {

            $values[$key] = isset($conf['default']) ? $conf['default'] : $this->getConfigDefaults($config[$key]);
        }

        return $values;
    }

    public function getOption()
    {
        $config = get_option($this->meta_key);

        if(empty($config)) {

            $config = $this->defaults;
            $this->saveOption($config);
        }

        return $config;
    }

    public function saveOption($config)
    {
        update_option($this->meta_key, $config);
        $this->loadValues();
    }

    public function updateConfig(object $config): bool
    {
        $_config = $this->getOption();

        if(empty($config)) {
            return false;
        }

        foreach($config as $k => $value) {

            // Check that key exists
            if(!isset($this->values[$k])) {
                return false;
            }

            if(is_object($value)) {
                $value = (array)$value;
            }

            // Check that old and new value are the same type
            $_type = gettype($this->values[$k]);
            $type = gettype($value);

            if($_type !== $type) {
                return false;
            }

            $_config[$k] = $value;
        }

        $this->saveOption($_config);

        return true;
    }

    public function getConfigFields(): array
    {
        return $this->config;
    }

    public function get($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->values;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        $target = $this->values;

        while (! is_null($segment = array_shift($key))) {
            if (is_array($target) && array_key_exists($segment, $target)) {
                $target = $target[$segment];
            } else {
                return $default;
            }
        }

        return $target;
    }

    public function getField($key = null, $fieldKey = null)
    {
        if (is_null($key)) {
            return $this->values;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        $target = $this->config;

        while (! is_null($segment = array_shift($key))) {
            if (is_array($target) && array_key_exists($segment, $target)) {
                $target = $target[$segment];
            } else {
                return null;
            }
        }

        if(!empty($fieldKey)) {
            return $target[$fieldKey] ?? null;
        }

        return $target;

    }

     /**
     * Same as array_merge_recursive, however, without duplicate keys
     *
     * mergeValues(array('key' => 'org value'), array('key' => 'new value'));
     *     => array('key' => array('new value'));
     *
     * @param array $array1
     * @param array $array2
     * @return array
     */
    protected function mergeValues(array $array1, array $array2): array
    {
        $merged = $array1;
        foreach ($array2 as $key => $value)
        {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key]))
            {
                $merged[$key] = $this->mergeValues($merged[$key], $value);
            }
            else
            {
                $merged[$key] = $value;
            }
        }
        return $merged;
    }
}
