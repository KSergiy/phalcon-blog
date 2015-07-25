<?php

class SitemapController extends ControllerBase
{
    public function initialize()
    {
        $this->view->disable();
    }
    
    public function indexAction()
    {
        $expireDate = new DateTime();
        
        $expireDate->modify('+1 day');
        
        $this->response->setExpires( $expireDate );
        
        $this->response->setHeader( 'Content-Type', "application/xml; charset=UTF-8" );
        
        $sitemap = new DOMDocument('1.0', 'UTF-8');
        
        $urlset = $sitemap->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');

        $url = $sitemap->createElement('url');
        $url->appendChild($sitemap->createElement('loc', 'http://3dfreza.com.ua/'));
        $url->appendChild($sitemap->createElement('changefreq', 'daily'));
        $url->appendChild($sitemap->createElement('priority', '1.0'));
        $urlset->appendChild($url);
        
        $pages = Pages::find(array(
                    'conditions' => " type IN (3, 5, 4, 1) ",
                    "cache"      => array( "key" => 'main', "lifetime" => 3600 )
                ));
        
        $modifiedAt = new DateTime();
        $modifiedAt->setTimezone(new DateTimeZone('UTC'));
        
        if ( !empty( $pages ) )
        {
            $baseUrl = $this->config->application->publicUrl;
            
            foreach ( $pages as $page )
            {
                $modifiedAt->setTimestamp( strtotime($page->updated_at) );
                
                $url = $sitemap->createElement('url');
                
                $href = $baseUrl . '/' . $page->name;
                
                $url->appendChild(
                    $sitemap->createElement('loc', $href)
                );

                $url->appendChild(
                    $sitemap->createElement('priority', '0.8')
                );

                $url->appendChild(
                    $sitemap->createElement('lastmod', $modifiedAt->format('Y-m-d\TH:i:s\Z'))
                );

                $url->appendChild(
                    $sitemap->createElement('changefreq', 'weekly')
                );
                
                $urlset->appendChild($url);
                
            }
            
            $sitemap->appendChild( $urlset );
            
            $this->response->setContent( $sitemap->saveXML() );
            
            return $this->response;
        }
    }
}