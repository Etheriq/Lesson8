<?php
/**
 * Created by PhpStorm.
 * File: Guest.php
 * User: Yuriy Tarnavskiy
 * Date: 30.11.13
 * Time: 23:43
 * To change this template use File | Settings | File Templates.
 */

namespace Etheriq\Lesson8Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Guest
 * @package Etheriq\Lesson8Bundle\Entity
 *
 * @ORM\Entity(repositoryClass="Etheriq\Lesson8Bundle\Repository\GuestRepository")
 * @ORM\Table(name="guest")
 */
class Guest
{
    /**
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @Assert\Regex(pattern="/^[a-zA-Z]+$/", message="Имя должно содержать только буквы латинского алфавита")
     * @Assert\NotBlank(message = "Имя: Это поле не должно быть пустым")
     * @Assert\Length(min = "5", minMessage = "Имя: Слишком короткое, минимальная длина {{ limit }} символов или больше")
     * @ORM\Column(type="string", length=120)
     */
    protected $nameGuest;

    /**
     *
     * @Assert\NotBlank(message = "Почта: Это поле не должно быть пустым")
     * @Assert\Email(message = "Почта: Это не корректный адрес")
     * @ORM\Column(type="string", length=150)
     */
    protected $emailGuest;

    /**
     *
     * @Assert\NotBlank(message = "Сообщение: Это поле не должно быть пустым")
     * @Assert\Length(min = "100", minMessage = "Сообщение: Слишком короткое, минимальная длина {{ limit }} символов или больше")
     * @ORM\Column(type="text")
     */
    protected $bodyGuest;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameGuest
     *
     * @param string $nameGuest
     * @return Guest
     */
    public function setNameGuest($nameGuest)
    {
        $this->nameGuest = $nameGuest;
    
        return $this;
    }

    /**
     * Get nameGuest
     *
     * @return string 
     */
    public function getNameGuest()
    {
        return $this->nameGuest;
    }

    /**
     * Set emailGuest
     *
     * @param string $emailGuest
     * @return Guest
     */
    public function setEmailGuest($emailGuest)
    {
        $this->emailGuest = $emailGuest;
    
        return $this;
    }

    /**
     * Get emailGuest
     *
     * @return string 
     */
    public function getEmailGuest()
    {
        return $this->emailGuest;
    }

    /**
     * Set bodyGuest
     *
     * @param string $bodyGuest
     * @return Guest
     */
    public function setBodyGuest($bodyGuest)
    {
        $this->bodyGuest = $bodyGuest;
    
        return $this;
    }

    /**
     * Get bodyGuest
     *
     * @return string 
     */
    public function getBodyGuest()
    {
        return $this->bodyGuest;
    }
}