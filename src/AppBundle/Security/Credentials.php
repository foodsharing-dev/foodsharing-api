<?php
namespace AppBundle\Security;
use JMS\Serializer\Annotation\Type;
class Credentials
{
  /**
  * @Type("string")
  */
  private $email;
  /**
  * @Type("string")
  */
  private $password;
  public function getEmail()
  {
    return $this->email;
  }
  public function setEmail($email)
  {
    $this->email = $email;
  }
  public function getPassword()
  {
    return $this->password;
  }
  public function setPassword($password)
  {
    $this->password = $password;
  }
}
