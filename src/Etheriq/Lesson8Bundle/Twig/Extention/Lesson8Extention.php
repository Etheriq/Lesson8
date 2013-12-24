<?php
/**
 * Created by PhpStorm.
 * File: Lesson8Extention.php
 * User: Yuriy Tarnavskiy
 * Date: 24.12.13
 * Time: 10:22
 */
namespace Etheriq\Lesson8Bundle\Twig\Extention;

class Lesson8Extention extends \Twig_Extension
{
    public function getName()
    {
        return 'lesson8ExtentionStringLimit';
    }

    public function getFilters()
    {
        return array(
            'limitWords' => new \Twig_Filter_Method($this, 'limitWords')
        );
    }

    public function limitWords($string, $limit=5, $link='#')
    {
        $str = explode(' ', $string);
        $countWords = count($str);

        if ($countWords <= $limit)
        {
            $lim = $countWords;
        } else {
            $lim = $limit;
        }

        $strResult = '';
        for ($i = 0; $i < $lim; $i++)
        {
            $strResult = $strResult.$str[$i]. ' ';
        }

        return $strResult.' <a href="'.$link.'"> ..... </a>';
    }

} 