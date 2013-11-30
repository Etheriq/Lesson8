<?php
/**
 * Created by PhpStorm.
 * File: MainController.php
 * User: Yuriy Tarnavskiy
 * Date: 30.11.13
 * Time: 15:20
 * To change this template use File | Settings | File Templates.
 */

namespace Etheriq\Lesson8Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function showHomePageAction()
    {
        return $this->render('EtheriqLesson8Bundle:Pages:homePage.html.twig');
    }

} 