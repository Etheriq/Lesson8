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

use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function showHomePageAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('EtheriqLesson8Bundle:Guest')->findDESCGuests();  // Order by DESC
//        $query2 = $em->getRepository('EtheriqLesson8Bundle:Guest')->findAllGuests();  // normal order
        $adapter = new DoctrineORMAdapter($query);
        $pagerFanta = new Pagerfanta($adapter);

        $pagerFanta->setMaxPerPage(5);
        $pagerFanta->setCurrentPage($page);

//        $nbResult = $pagerFanta->getNbResults();
//        $currentPageResult = $pagerFanta->getCurrentPage();
//        $pagerFanta->getNbPages();
//        $pagerFanta->haveToPaginate();
//        $pagerFanta->hasPreviousPage();
//        $pagerFanta->getPreviousPage();
//        $pagerFanta->hasNextPage();
//        $pagerFanta->getNextPage();

        $form = null;

        $pagedata['fanta'] = $pagerFanta;
        $pagedata['form'] = $form;
        return $this->render('EtheriqLesson8Bundle:Pages:homePage.html.twig', $pagedata);

    }
    public function showMoreInfoAction($id)
    {
        return new Response('show '.$id);
    }

    public function deleteItemAction($id)
    {
        return new Response('Delete '.$id);
    }

}