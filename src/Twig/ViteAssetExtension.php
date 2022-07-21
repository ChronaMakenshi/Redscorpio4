<?php

namespace App\Twig;

// use Psr\Cache\CacheItemPoolInterface;

use Psr\Cache\CacheItemPoolInterface;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class ViteAssetExtension extends AbstractExtension
{
    private ?array $manifestData = null;
    const CACHE_KEY ='vite_manifest';

    public function __construct(
        private bool $isDev,
        private string $manifest,
        private CacheItemPoolInterface $cache,
    )
    {
        
    }
    public function getFunctions():array
    {
        return [
            new TwigFunction('vite_asset', [$this, 'asset'], ['is_safe' =>
            ['html']])
        ];
    }

    public function asset(string $entry){
        return $this->assetProd($entry);
    }


    public function assetProd(string $entry): string 
    {
        if($this->manifestData === null) {
            $item = $this->cache->getItem(self::CACHE_KEY);
            if($item->isHit()) {
                $this->manifestData = $item->get();
            }else{
            $this->manifestData = json_decode(file_get_contents($this->manifest), true);
            $item->set($this->manifestData);
            $this->cache->save($item);
            }
        }
        
        $file = $this->manifestData[$entry]['file'];
        $css = $this->manifestData[$entry]['css'] ?? [];
        $imports = $this->manifestData[$entry]['imports'] ?? [];
        $html = <<<HTML
        <script type="module" src="/assets/{$file}" defer></script>
        HTML;

       foreach($css as $cssfile) {
        $html .= <<<HTML
        <link rel="stylesheet" madia="screen" href="/assets/{$cssfile}"/>
        HTML;
       }

       foreach($imports as $import) {
        $html .= <<<HTML
        <link rel="modulepreload"  href="/assets/{$import}"/>
        HTML;
       }


        return $html;
    }
}