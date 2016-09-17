<?php

/**
 * @file
 * Contains \Drupal\mp3player\Form.
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
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set values in variables.
    $this->config('mp3player.settings')
      ->set('mp3player_encode', $form_state->getValues()['mp3player_encode'])
      ->save();
    parent::submitForm($form, $form_state);
  }
}

