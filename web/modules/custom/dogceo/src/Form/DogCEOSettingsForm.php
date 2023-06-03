<?php

namespace Drupal\dogceo\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the Dog CEO Breed Settings Form.
 */
class DogCEOSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['dogceo.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dogceo_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('dogceo.settings');

    $default_breed = (!empty($config->get('slug'))) ? $config->get('slug') : 'beagle';
    $form['slug'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dog Block Breed'),
      '#default_value' => $default_breed,
      '#description' => $this->t('Enter the dog breed for the Dog Breed Block. Defaults to "beagle".'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('dogceo.settings');
    $config->set('slug', $form_state->getValue('slug'));
    $config->save();

    parent::submitForm($form, $form_state);
  }

}
