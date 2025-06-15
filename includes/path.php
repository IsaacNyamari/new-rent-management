<?php
/**
 * Loads an asset using document root as base
 * @param string $assetPath Relative path to the asset from document root
 * @return string Absolute path to the asset
 */
function loadAsset($assetPath) {
    // Remove any leading/trailing slashes
    $cleanPath = trim($assetPath, '/\\');
    
    // Get base URL (you might need to configure this)
    $baseUrl = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $baseUrl .= $_SERVER['HTTP_HOST'];
    
    // If your assets are in a subdirectory, add it here
    $assetsBase = ''; // e.g., 'myapp/public'
    
    return $baseUrl . '/' . $assetsBase . '' . $cleanPath;
}  return $fullPath;