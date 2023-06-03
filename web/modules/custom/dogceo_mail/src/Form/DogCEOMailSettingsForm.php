<?php

namespace Drupal\dogceo_mail\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the Dog CEO Mail Settings Form.
 */
class DogCEOMailSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['dogceo_mail.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dogceo_mail_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('dogceo_mail.settings');

    $default_email = (!empty($config->get('email'))) ? $config->get('email') : 'nope@doesntexist.com';
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#default_value' => $default_email,
      '#description' => $this->t('Enter the email for all outgoing messages. Defaults to "nope@doesntexist.com".'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('dogceo_mail.settings');
    $config->set('email', $form_state->getValue('email'));
    $config->save();

    parent::submitForm($form, $form_state);
  }

}
