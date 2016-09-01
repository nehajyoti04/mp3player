<?php

/**
 * @file
 * Contains \Drupal\remember_me\Form\Remember_meConfigForm.
 */

namespace Drupal\mp3player\Form;

use Drupal\Core\Datetime\Date;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class Mp3playerSettingsForm extends ConfigFormBase {
  public function getFormId() {
    return 'mp3player_settings';
  }
  public function getEditableConfigNames() {
    return [
      'mp3player.settings',
    ];

  }
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('mp3player.settings');

    $form['mp3player_encode'] = array(
      '#type' => 'select',
      '#title' => t('Encode Audio File URLs'),
      '#default_value' => $config->get('mp3player_encode'),
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('Indicates that the mp3 file urls are encoded.'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * Implements hook_form_submit().
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set values in variables.
    $this->config('mp3player.settings')
    ->set('mp3player_encode', $form_state->getValues()['mp3player_encode'])
//    $config = \Drupal::service('config.factory')->getEditable('remember_me.settings');
//    $config->set('remember_me_managed', $form_state->getValues()['remember_me_managed']);
//    $config->set('remember_me_lifetime', $form_state->getValues()['remember_me_lifetime']);
//    $config->set('remember_me_checkbox', $form_state->getValues()['remember_me_checkbox']);
//    $config->set('remember_me_checkbox_visible', $form_state->getValues()['remember_me_checkbox_visible']);
    ->save();
    parent::submitForm($form, $form_state);
  }
}

