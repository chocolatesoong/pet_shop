<?php

namespace App\Libraries;

use PHPMailer;


class Email
{
  private $mail = null;

  public function __construct()
  {
    log_message('debug', 'PHPMailer class is loaded');
  }

  public function load()
  {
    require_once APPPATH . 'ThirdParty/PHPMailer/class.phpmailer.php';
    require_once APPPATH . 'ThirdParty/PHPMailer/class.smtp.php';

    if ($this->mail == null) {
      $this->mail = new PHPMailer();
    }

    return $this;
  }

  /**
   * Send Email
   *
   * @param [String] $recipient_mail
   * @param [String] $subject
   * @param [String] $body
   *
   * @return boolean
   */
  public function initialize($recipient_mail, $subject, $body)
  {
    $this->mail->isSMTP();

    // Set up DKIM to prevent mail going into spam ..


    $this->mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    $this->mail->Host = 'smtp.gmail.com';
    $this->mail->Port = 587;
    $this->mail->SMTPAuth = true;
    $this->mail->SMTPSecure = 'tls';
    $this->mail->Username = 'queenie@queeniepets.com';
    // $this->mail->Password = 'apivpbxystnniwdi';
    $this->mail->Password = 'mlkhnneasmcwlltu';

    $this->mail->setFrom('queenie@queeniepets.com', 'Queenie Pet');

    $this->mail->addReplyTo('queenie@queeniepets.com');

    $this->mail->addAddress($recipient_mail); //Recipient Address

    $this->mail->isHTML(true);
    $this->mail->Subject = $subject;
    $this->mail->Body = $body;

    return $this;
  }

  public function send()
  {
    if (!$this->mail->send()) {
      return false;
    }

    return true;
  }

  public function getError()
  {
    return $this->mail->ErrorInfo;
  }
}
