<?php
/**
 * @file
 * Contains \Drupal\example\Form\ExampleForm.
 */

namespace Drupal\mp3player\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\mp3player\Controller\Mp3playerController;

/**
 * Implements an example form.
 */
class Mp3playerDeleteForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mp3player_player_delete';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $pid = NULL) {
    $player = Mp3playerController::mp3player_players($pid);

//    if (empty($player)) {
//      drupal_set_message(t('The specified player was not found.'), 'error');
//      drupal_goto('admin/settings/mp3player');
//    }
//    if($player['name'] == 'Default') {
//      drupal_set_message(t('You cannot delete the Default player.'), 'error');
//      drupal_goto('admin/settings/mp3player');
//    }
//
//    $form = array();
//    $form['pid'] = array('#type' => 'value', '#value' => $pid);
//    return confirm_form(
//      $form,
//      t('Are you sure you want to delete the player %name?',
//        array('%name' => $player['name'])
//      ),
//      'admin/settings/mp3player',
//      t('This action cannot be undone.'),
//      t('Delete'),  t('Cancel')
//    );
//
//
//    $form['submit'] = array(
//      '#type' => 'submit',
//      '#value' => t('Save changes to player'),
//    );
//    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}