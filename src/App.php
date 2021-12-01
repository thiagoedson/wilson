<?php

namespace App;

class App
{
    public $versao = '1.0.0';
    public $app_theme_color = '';
    public $app_logo = '../assets/svg/logo_adisul.svg';

    /**
     * @return string
     */
    public function getVersao()
    {
        return $this->versao;
    }

    /**
     * @param string $versao
     */
    public function setVersao($versao)
    {
        $this->versao = $versao;

    }

    /**
     * @return string
     */
    public function getAppThemeColor()
    {
        return $this->app_theme_color;
    }

    /**
     * @param string $app_theme_color
     */
    public function setAppThemeColor($app_theme_color)
    {
        $this->app_theme_color = $app_theme_color;
    }

    /**
     * @return string
     */
    public function getAppLogo()
    {
        return $this->app_logo;
    }

    /**
     * @param string $app_logo
     */
    public function setAppLogo($app_logo)
    {
        $this->app_logo = $app_logo;
    }








}