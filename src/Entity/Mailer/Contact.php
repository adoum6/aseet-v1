<?php
namespace App\Entity\Mailer;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    /**
     * @Assert\Length(min="3", minMessage="Le nom doit contenir 3 caractéres au moins")
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    private $subject;

    /**
     * @Assert\Length(min="15", minMessage="Le message doit contenir 15 caractéres au moins")
     */
    private $message;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

}