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
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     *
     * @ORM\Column(name="name_changed", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"nameGuest"})
     */
    protected $nameChanged;

    /**
     *
     * @Assert\Regex(pattern="/^[a-zA-Z]+$/", message="Имя должно содержать только буквы латинского алфавита")
     * @Assert\NotBlank(message = "Имя: Это поле не должно быть пустым")
     * @Assert\Length(min = "5", minMessage = "Имя: Слишком короткое, минимальная длина {{ limit }} символов или больше")
     * @ORM\Column(type="string", length=120, unique=true)
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

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Guest
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Guest
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set nameChanged
     *
     * @param \DateTime $nameChanged
     * @return Guest
     */
    public function setNameChanged($nameChanged)
    {
        $this->nameChanged = $nameChanged;
    
        return $this;
    }

    /**
     * Get nameChanged
     *
     * @return \DateTime 
     */
    public function getNameChanged()
    {
        return $this->nameChanged;
    }
}