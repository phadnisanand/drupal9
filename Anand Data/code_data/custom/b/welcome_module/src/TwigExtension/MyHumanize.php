<?php
/**
 * Created by PhpStorm.
 * User: Zhilevan
 * Date: 1/9/18
 * Time: 23:38
 */

namespace Drupal\welcome_module\TwigExtention;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig\Extension\AbstractExtension;

class MyHumanize extends AbstractExtension  {
    public function getFunctions()
    {
        return [
          new Twig_SimpleFilter('myhumanize', [$this, 'myHumanize']),
        ];
    }

    public function getName()
    {
        return 'welcome_module.twig_extension';
    }

    public static function myHumanize($string)
    {
        $str = trim(strtolower($str));
        $str = preg_replace('/[^a-z0-9\s+]/', '', $str);
        $str = preg_replace('/\s+/', ' ', $str);
        $str = explode(' ', $str);
        $str = array_map('ucwords', $str);
        return implode(' ', $str);
    }
}