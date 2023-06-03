<?php

/**
 * @file
 * Contains \Drupal\dogceo_mail\Controller\MailDogController
 */

namespace Drupal\dogceo_mail\Controller;

class MailDogController {

  /**
   * Fetches the email address for redirection.
   *
   * @return string
   *   The email address for redirection.
   */
  function fetchDogMail() {
    $config = \Drupal::config('dogceo_mail.settings');
    $email = (!empty($config->get('email'))) ? $config->get('email') : 'nope@doesntexist.com';

    return $email;
  }

}
