<?php
/**
 * Created by PhpStorm.
 * File: GuestListener2.php
 * User: Yuriy Tarnavskiy
 * Date: 09.12.13
 * Time: 0:32
 */

namespace Etheriq\Lesson8Bundle\EventListener;

use Etheriq\Lesson8Bundle\EventListener\GuestEvent;
class GuestListener
{
    protected $mailer;

    public function setMailer(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onGuestShown(GuestEvent $event)
    {
        $guest = $event->getGuest();

        $message = \Swift_Message::newInstance()
            ->setSubject('Данные пользователя '.$guest->getNameGuest().' отредактированы')
            ->setFrom('nobody@example.com')
            ->setTo('emris@uch.net')
            ->setBody("
            Данные пользователя с id=".$guest->getId()." были успешно изменены на ".$guest->getNameGuest()." (".$guest->getEmailGuest().")
            ");

        $this->mailer->send($message);
    }

    public function onGuestCreated(GuestEvent $event)
    {
        $guest = $event->getGuest();

        $message = \Swift_Message::newInstance()
            ->setSubject('Создан новый пользователь '.$guest->getNameGuest())
            ->setFrom('nobody@example.com')
            ->setTo('emris@uch.net')
            ->setBody("
Создан новый пользователь:\n
Login: ".$guest->getNameGuest().";\n
E-mail: ".$guest->getEmailGuest()."
");

        $this->mailer->send($message);
    }

    public function onGuestDelete(GuestEvent $event)
    {
        $guest = $event->getGuest();

        $message = \Swift_Message::newInstance()
            ->setSubject('Был удален пользователь '.$guest->getNameGuest())
            ->setFrom('nobody@example.com')
            ->setTo('emris@uch.net')
            ->setBody("
Данные удаленного пользователя:\n
id: ".$guest->getId().";\n
Login: ".$guest->getNameGuest().";\n
E-mail: ".$guest->getEmailGuest()."
");

        $this->mailer->send($message);
    }
} 