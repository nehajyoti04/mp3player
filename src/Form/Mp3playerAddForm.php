<?php
/**
 * @file
 * Contains \Drupal\mp3player\Form\ExampleForm.
 */

namespace Drupal\mp3player\Form;

use Drupal\Core\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;
use Drupal\mp3player\Controller\Mp3playerController;

/**
 * Implements an Mp3playerAddForm form.
 */
class Mp3playerAddForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mp3player_player_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $pid = NULL) {
    $player = Mp3playerController::mp3player_players($pid);

    if(!$pid) {
      $player = $player[1];
      $player['pid'] = '';
      $player['name'] = '';
    }else{
      $player = $player[$pid];
    }

    $form['namegroup'] = array(
      '#type' => 'fieldset',
      '#title' => t('Player Name'),
      '#weight' => -2,
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    );

    $form['namegroup']['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#default_value' => Html::escape($player['name']),
      '#required' => TRUE,
      '#size' => '20',
      '#description' => t('Unique name of player. Please use alphanumeric characters, and underscores (_).'),
    );

    if($player['name'] == 'Default') {
      $form['namegroup']['name']['#disabled'] = TRUE;
    }
    if($pid) {
      $form['pid'] = array(
        '#type' => 'hidden',
        '#value' => $pid,
      );
    }

    $form['options'] = array(
      '#type' => 'fieldset',
      '#title' => t('Player Options'),
      '#weight' => -1,
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    );

    $form['options']['autostart'] = array(
      '#type' => 'select',
      '#title' => t('Auto-start'),
      '#default_value' => $player['autostart'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('If yes, player starts automatically.'),
    );
    $form['options']['loopaudio'] = array(
      '#type' => 'select',
      '#title' => t('Loop Audio'),
      '#default_value' => $player['loopaudio'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('If yes, player loops audio.'),
    );
    $form['options']['animation'] = array(
      '#type' => 'select',
      '#title' => t('Animate'),
      '#default_value' => $player['animation'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('If no, player is always open.'),
    );
    $form['options']['remaining'] = array(
      '#type' => 'select',
      '#title' => t('Time Remaining'),
      '#default_value' => $player['remaining'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('If yes, shows remaining track time rather than elapsed time.'),
    );
    $form['options']['noinfo'] = array(
      '#type' => 'select',
      '#title' => t("Don't display information"),
      '#default_value' => $player['noinfo'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('If yes, disables the track information display.'),
    );
    $form['options']['initialvolume'] = array(
      '#type' => 'textfield',
      '#title' => t('Initial Volume'),
      '#default_value' => $player['initialvolume'],
      '#default_value' => Html::escape($player['initialvolume']),
      '#required' => TRUE,
      '#size' => '10',
      '#description' => t('Initial volume level (from 0 to 100).'),
    );
    $form['options']['buffer'] = array(
      '#type' => 'textfield',
      '#title' => t('Buffer Time'),
      '#default_value' => $player['buffer'],
      '#default_value' => Html::escape($player['buffer']),
      '#required' => TRUE,
      '#size' => '10',
      '#description' => t('Buffering time in seconds.'),
    );
    $form['options']['encode'] = array(
      '#type' => 'select',
      '#title' => t('Encode'),
      '#default_value' => $player['encode'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('Indicates that the mp3 file urls are encoded.'),
    );
    $form['options']['checkpolicy'] = array(
      '#type' => 'select',
      '#title' => t('Check Policy'),
      '#default_value' => $player['checkpolicy'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('Tells Flash to look for a policy file when loading mp3 files (this allows Flash to read ID3 tags from files hosted on a different domain.'),
    );
    $form['options']['rtl'] = array(
      '#type' => 'select',
      '#title' => t('Text Right-to-Left'),
      '#default_value' => $player['rtl'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('Switches the layout to RTL (right to left) for Hebrew and Arabic languages.'),
    );
    $form['options']['width'] = array(
      '#type' => 'textfield',
      '#title' => t('Player Width'),
      '#default_value' => $player['width'],
      '#default_value' => Html::escape($player['width']),
      '#required' => TRUE,
      '#size' => '10',
      '#description' => t('Width of the player. e.g. 290 (290 pixels) or 100%.'),
    );

    $form['colours'] = array(
      '#type' => 'fieldset',
      '#title' => t('Player Colour Scheme'),
      '#weight' => 0,
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    );
    $form['colours']['transbg'] = array(
      '#type' => 'fieldset',
      '#title' => 'Player Background',
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    );
    $form['colours']['transbg']['transparentpagebg'] = array(
      '#type' => 'select',
      '#title' => t('Transparent Player Background'),
      '#default_value' => $player['transparentpagebg'],
      '#options' => array('no' => t('No'), 'yes' => t('Yes')),
      '#description' => t('If yes, the player background is transparent (matches the page background).'),
    );
    $form['colours']['transbg']['pagebg'] = array(
      '#type' => 'textfield',
      '#title' => t('Player Background Colour'),
      '#default_value' => Html::escape($player['pagebg']),
      '#required' => FALSE,
      '#size' => '10',
      '#field_prefix' => '#',
      '#description' => t("Player background colour (set it to your page background when transparentbg is set to 'no')."),
    );

    $form['colours']['bg'] = array(
      '#type' => 'textfield',
      '#title' => t('Background'),
      '#default_value' => $player['bg'],
      '#default_value' => Html::escape($player['bg']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['leftbg'] = array(
      '#type' => 'textfield',
      '#title' => t('Left Background'),
      '#default_value' => $player['leftbg'],
      '#default_value' => Html::escape($player['leftbg']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
      '#description' => t('Speaker icon/Volume control background.'),
    );
    $form['colours']['lefticon'] = array(
      '#type' => 'textfield',
      '#title' => t('Speaker Icon'),
      '#default_value' => $player['lefticon'],
      '#default_value' => Html::escape($player['lefticon']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['voltrack'] = array(
      '#type' => 'textfield',
      '#title' => t('Volume Track Background'),
      '#default_value' => $player['voltrack'],
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['volslider'] = array(
      '#type' => 'textfield',
      '#title' => t('Volume Track Slider'),
      '#default_value' => $player['volslider'],
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['rightbg'] = array(
      '#type' => 'textfield',
      '#title' => t('Right Background'),
      '#default_value' => $player['rightbg'],
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
      '#description' => t('Play/Pause button background.'),
    );
    $form['colours']['rightbghover'] = array(
      '#type' => 'textfield',
      '#title' => t('Right Background Hover'),
      '#default_value' => $player['rightbghover'],
      '#default_value' => Html::escape($player['rightbghover']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
      '#description' => t('Play/Pause button background (hover state).'),
    );
    $form['colours']['righticon'] = array(
      '#type' => 'textfield',
      '#title' => t('Play/Pause Icon'),
      '#default_value' => $player['righticon'],
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['righticonhover'] = array(
      '#type' => 'textfield',
      '#title' => t('Play/Pause Icon (hover state)'),
      '#default_value' => Html::escape($player['righticonhover']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['loader'] = array(
      '#type' => 'textfield',
      '#title' => t('Loading Bar'),
      '#default_value' => Html::escape($player['loader']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['track'] = array(
      '#type' => 'textfield',
      '#title' => t('Track Backgrounds'),
      '#default_value' => Html::escape($player['track']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
      '#description' => t('Loading/Progress bar track background.'),
    );
    $form['colours']['tracker'] = array(
      '#type' => 'textfield',
      '#title' => t('Progress Track'),
      '#default_value' => Html::escape($player['tracker']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['border'] = array(
      '#type' => 'textfield',
      '#title' => t('Progress Track Border'),
      '#default_value' => Html::escape($player['border']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['skip'] = array(
      '#type' => 'textfield',
      '#title' => t('Previous/Next Buttons'),
      '#default_value' => Html::escape($player['skip']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );
    $form['colours']['text'] = array(
      '#type' => 'textfield',
      '#title' => t('Text'),
      '#default_value' => Html::escape($player['text']),
      '#required' => TRUE,
      '#size' => '10',
      '#field_prefix' => '#',
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save changes to player'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    if(isset($values['pid'])) {
      $keys = array('pid' => $values['pid']);

    } else {
      $keys = array('name' => $values['name']);
    }

    \Drupal::database()->merge('mp3player_players')
      ->key($keys)
      ->fields(array(
        'name' => $values['name'],
        'autostart' => $values['autostart'],
        'loopaudio' => $values['loopaudio'],
        'animation' => $values['animation'],
        'remaining' => $values['remaining'],
        'noinfo' => $values['noinfo'],
        'initialvolume' => $values['initialvolume'],
        'buffer' => $values['buffer'],
        'encode' => $values['encode'],
        'checkpolicy' => $values['checkpolicy'],
        'rtl' => $values['rtl'],
        'width' => $values['width'],
        'transparentpagebg' => $values['transparentpagebg'],
        'pagebg' => $values['pagebg'],
        'bg' => $values['bg'],
        'leftbg' => $values['leftbg'],
        'lefticon' => $values['lefticon'],
        'voltrack' => $values['voltrack'],
        'volslider' => $values['volslider'],
        'rightbg' => $values['rightbg'],
        'rightbghover' => $values['rightbghover'],
        'righticon' => $values['righticon'],
        'righticonhover' => $values['righticonhover'],
        'loader' => $values['loader'],
        'track' => $values['track'],
        'tracker' => $values['tracker'],
        'border' => $values['border'],
        'skip' => $values['skip'],
        'text' => $values['text'],
      ))->execute();

    $form_state->setRedirect('mp3player.player_list');
  }
}
