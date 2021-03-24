<?php
/**
 * General utility functions.
 */

namespace App\Libraries;

/**
 * This class keeps all utility functions for all classes.
 * @package App\Libraries
 */
class Utility
{
    /**
     * Get base URL.
     *
     * @return string String Base URL
     */
    public function getBaseUrl()
    {
        $protocol = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http';

        return $protocol . '://' . $_SERVER['HTTP_HOST'];
    }

    /**
     * Get language code.
     *
     * @return string Language code
     */
    public function getLanguageCode()
    {
        $language = $this->getDefaultLanguageCode();

        if( !is_null( request()->route() ) ){

            preg_match( '@^(\w+)-@', request()->route()->getName(), $match );

            $prefix = count( $match ) ? $match[1] : '';

            if( in_array( $prefix, config( 'app.language_codes' ), true ) ){
                $language = $prefix;
            }
        }

        return $language;
    }

    /**
     * Get old language code.
     *
     * @return string Old language code
     */
    private function getOldLanguageCode()
    {
        $oldCodeRegex = '@^' . $this->getBaseUrl() . '/(\w+)@';

        preg_match( $oldCodeRegex, url()->previous(), $match );

        $oldCode = count( $match ) ? $match[1] : '';

        if( !in_array( $oldCode, config( 'app.language_codes' ) ) ){
            $oldCode = '';
        }

        return $oldCode;
    }

    /**
     * Get the default language code.
     *
     * @return string Default language code
     */
    public function getDefaultLanguageCode()
    {
        return config( 'app.fallback_locale' );
    }

    /**
     * Get redirected URL.
     *
     * @param string $languageCode Language code
     *
     * @return string Redirected URL
     */
    public function getRedirectedUrl( string $languageCode )
    {
        $redirectedUrl = url()->previous();

        if( in_array( $languageCode, config( 'app.language_codes' ) ) ){

            $baseUrl       = $this->getBaseUrl();
            $oldCode       = $this->getOldLanguageCode();
            $newCode       = $languageCode !== $this->getDefaultLanguageCode() ? $languageCode : '';
            $regex         = '@^' . $baseUrl . ( $oldCode ? '(/' . $oldCode . '(/.+)|/' . $oldCode . '$)' : '(/.+)?' ) . '@';
            $replacement   = $baseUrl . ( $newCode ? '/' . $newCode : '' ) . ( $oldCode ? '${2}' : '${1}' );
            $redirectedUrl = preg_replace( $regex, $replacement, $redirectedUrl );
        }

        return $redirectedUrl;
    }
}
