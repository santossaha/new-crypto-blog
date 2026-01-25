<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class ICOOptionHelper
{
    /**
     * Get all stages
     *
     * @return array
     */
    public static function getStages()
    {
        return config('ico_options.stages', []);
    }

    /**
     * Get all project categories
     *
     * @return array
     */
    public static function getProjectCategories()
    {
        return config('ico_options.project_categories', []);
    }

    /**
     * Get all blockchain networks
     *
     * @return array
     */
    public static function getBlockchainNetworks()
    {
        return config('ico_options.blockchain_networks', []);
    }

    /**
     * Add new stage if not exists
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    public static function addStage($key, $value = null)
    {
        $stages = self::getStages();
        
        // If key already exists, return true
        if (isset($stages[$key])) {
            return true;
        }

        // If value is not provided, use key as value
        $displayValue = $value ?? $key;
        
        // Add new stage
        $stages[$key] = $displayValue;
        
        return self::updateConfig('stages', $stages);
    }

    /**
     * Add new project category if not exists
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    public static function addProjectCategory($key, $value = null)
    {
        $categories = self::getProjectCategories();
        
        // If key already exists, return true
        if (isset($categories[$key])) {
            return true;
        }

        // If value is not provided, use key as value
        $displayValue = $value ?? $key;
        
        // Add new category
        $categories[$key] = $displayValue;
        
        return self::updateConfig('project_categories', $categories);
    }

    /**
     * Add new blockchain network if not exists
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    public static function addBlockchainNetwork($key, $value = null)
    {
        $networks = self::getBlockchainNetworks();
        
        // If key already exists, return true
        if (isset($networks[$key])) {
            return true;
        }

        // If value is not provided, use key as value
        $displayValue = $value ?? $key;
        
        // Add new network
        $networks[$key] = $displayValue;
        
        return self::updateConfig('blockchain_networks', $networks);
    }

    /**
     * Update config file
     *
     * @param string $key
     * @param array $data
     * @return bool
     */
    private static function updateConfig($key, $data)
    {
        try {
            $configPath = config_path('ico_options.php');
            $config = include $configPath;
            
            // Update the specific key
            $config[$key] = $data;
            
            // Generate PHP array content
            $content = "<?php\n\nreturn [\n";
            
            // Stages
            $content .= "    'stages' => [\n";
            foreach ($config['stages'] as $k => $v) {
                $content .= "        '" . addslashes($k) . "' => '" . addslashes($v) . "',\n";
            }
            $content .= "    ],\n\n";
            
            // Project Categories
            $content .= "    'project_categories' => [\n";
            foreach ($config['project_categories'] as $k => $v) {
                $content .= "        '" . addslashes($k) . "' => '" . addslashes($v) . "',\n";
            }
            $content .= "    ],\n\n";
            
            // Blockchain Networks
            $content .= "    'blockchain_networks' => [\n";
            foreach ($config['blockchain_networks'] as $k => $v) {
                $content .= "        '" . addslashes($k) . "' => '" . addslashes($v) . "',\n";
            }
            $content .= "    ],\n];\n";
            
            // Write to file
            File::put($configPath, $content);
            
            // Clear config cache
            Artisan::call('config:clear');
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Failed to update ICO options config: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if option exists in stages
     *
     * @param string $key
     * @return bool
     */
    public static function stageExists($key)
    {
        $stages = self::getStages();
        return isset($stages[$key]);
    }

    /**
     * Check if option exists in project categories
     *
     * @param string $key
     * @return bool
     */
    public static function projectCategoryExists($key)
    {
        $categories = self::getProjectCategories();
        return isset($categories[$key]);
    }

    /**
     * Check if option exists in blockchain networks
     *
     * @param string $key
     * @return bool
     */
    public static function blockchainNetworkExists($key)
    {
        $networks = self::getBlockchainNetworks();
        return isset($networks[$key]);
    }
}
