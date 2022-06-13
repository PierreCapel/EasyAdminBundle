#!/usr/bin/env php
<?php

// Webpack Encore doesn't support RTL variants of assets
// See https://github.com/symfony/webpack-encore/issues/1109
// This script fixes the 'manifest.json' contents generated by Webpack Encore
// when assets contain RTL variants.
$manifestJsonPath = __DIR__.'/../public/manifest.json';
if (!file_exists($manifestJsonPath)) {
    return 0;
}

$manifestJsonContents = json_decode(file_get_contents($manifestJsonPath), associative: true, flags: \JSON_THROW_ON_ERROR);
$fixedManifestJsonContents = [];
foreach ($manifestJsonContents as $assetName => $assetPath) {
    if (!str_contains($assetPath, '.rtl.')) {
        $fixedManifestJsonContents[$assetName] = $assetPath;

        continue;
    }

    // if the asset defines an RTL entry, the manifest.json file wrongly points only to it:
    //   'app.css' => '/bundles/easyadmin/app.1e1ba55d.rtl.css'
    //
    // we need to add both RTL and non-RTL variants for the asset:
    //   'app.css' => '/bundles/easyadmin/app.1e1ba55d.css'
    //   'app.rtl.css' => '/bundles/easyadmin/app.1e1ba55d.rtl.css'
    $nonRtlAssetName = $assetName;
    $nonRtlAssetPath = str_replace('.rtl.', '.', $assetPath);
    $rtlAssetName = str_replace(['.css', '.js'], ['.rtl.css', '.rtl.js'], $assetName);
    $rtlAssetPath = $assetPath;

    $fixedManifestJsonContents[$nonRtlAssetName] = $nonRtlAssetPath;
    $fixedManifestJsonContents[$rtlAssetName] = $rtlAssetPath;
}

$newJsonManifestContents = json_encode($fixedManifestJsonContents, flags: \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES);
// the original manifest.json file uses a 2 white space indentation, so keep that
$newJsonManifestContents = str_replace('    ', '  ', $newJsonManifestContents);
file_put_contents($manifestJsonPath, $newJsonManifestContents);