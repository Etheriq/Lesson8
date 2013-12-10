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

use Etheriq\Lesson8Bundle\Entity\Guest;
use Etheriq\Lesson8Bundle\EventListener\RegisterEvent;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Symfony\Component\HttpFoundation\Request;
use Etheriq\Lesson8Bundle\Form\GuestType;
use Etheriq\Lesson8Bundle\EventListener\GuestListener;
use Etheriq\Lesson8Bundle\EventListener\GuestEvent;

class MainController extends Controller
{
    public function showHomePageAction($page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('EtheriqLesson8Bundle:Guest')->findDESCGuests();  // Order by DESC
//        $query2 = $em->getRepository('EtheriqLesson8Bundle:Guest')->findAllGuests();  // normal order
        $adapter = new DoctrineORMAdapter($query);
        $pagerFanta = new Pagerfanta($adapter);

        $pagerFanta->setMaxPerPage(5);

        try {
            $pagerFanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {

            return $this->render('EtheriqLesson8Bundle:Pages:pageNotFound.html.twig', array('pageNumber' => $page));
        }

//        $nbResult = $pagerFanta->getNbResults();
//        $currentPageResult = $pagerFanta->getCurrentPage();
//        $pagerFanta->getNbPages();
//        $pagerFanta->haveToPaginate();
//        $pagerFanta->hasPreviousPage();
//        $pagerFanta->getPreviousPage();
//        $pagerFanta->hasNextPage();
//        $pagerFanta->getNextPage();

        $guest = new Guest();
        $form = $this->createForm(new GuestType(), $guest);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $guestToDb = $this->getDoctrine()->getManager();

            $guestEvent = new GuestEvent($guest);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(RegisterEvent::GUEST_ADD, $guestEvent);

            $guestToDb->persist($guest);
            $guestToDb->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('EtheriqLesson8Bundle:Pages:homePage.html.twig', array(
            'fanta' => $pagerFanta,
            'form' => $form->createView()
        ));
    }

    public function showMoreInfoAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $guestShow = $em->getRepository('EtheriqLesson8Bundle:Guest')->find($id);
        $guestShow->setNameGuest($guestShow->getNameGuest());
        $guestShow->setEmailGuest($guestShow->getEmailGuest());
        $guestShow->setBodyGuest($guestShow->getBodyGuest());

        $form = $this->createForm(new GuestType(), $guestShow);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $guestToDb = $this->getDoctrine()->getManager();

            $guestEvent = new GuestEvent($guestShow);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(RegisterEvent::GUEST_EDIT, $guestEvent);

            $guestToDb->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('EtheriqLesson8Bundle:Pages:showInfo.html.twig', array('form' => $form->createView()));
    }

    public function deleteItemAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $guestDelete = $em->getRepository('EtheriqLesson8Bundle:Guest')->find($id);

        $guestEvent = new GuestEvent($guestDelete);
        $dispatcher = $this->get('event_dispatcher');
        $dispatcher->dispatch(RegisterEvent::GUEST_DELETE, $guestEvent);

        $em->remove($guestDelete);
        $em->flush();

        return $this->redirect($this->generateUrl('homepage'));
    }
}