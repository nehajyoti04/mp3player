<?php

namespace Drupal\mp3player\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Authentication\AuthenticationProviderInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Session;


use Drupal\Core\DrupalKernel;
use Drupal\Core\Form\EnforcedResponseException;
use Drupal\Core\Url;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Site\Settings;


class Mp3playerSubscriber implements EventSubscriberInterface {

  protected $started = false;

  public function check_mp3player_files() {

//
//    drupal_set_message(
//      t('%file1 or %file2 were not found in %directory, download the <a href="http://wpaudioplayer.com/download">standalone WordPress Audio Player</a>.',
//        array(
//          '%file1' => 'audio-player.js',
//          '%file2' => 'player.swf',
//          '%directory' => '/'.libraries_get_path('audio-player'))
//      ),
//      'error'
//    );


    if(!file_exists(libraries_get_path('audio-player').'/audio-player.js') ||
      !file_exists(libraries_get_path('audio-player').'/player.swf')) {

$message = "hello";
   $check1 = !file_exists(libraries_get_path('audio-player').'/audio-player.js');
   \Drupal::logger('mp3player')->notice($message . "check1". $check1);
   // drupal_set_message(t("message"), 'error');



      drupal_set_message(
        t('%file1 or %file2 were not found in %directory, download the <a href="http://wpaudioplayer.com/download">standalone WordPress Audio Player</a>.',
          array(
            '%file1' => 'audio-player.js',
            '%file2' => 'player.swf',
            '%directory' => '/'.libraries_get_path('audio-player'))
        ),
        'error'
      );
    }

    // $element['#attached'] = [
    //   'library' => [
    //     'audio-player',
    //   ],
    //   'drupalSettings' => [
    //     'audio-player' => [
    //       'audio-player.' => 'hello world',
    //     ],
    //   ],
    // ];

   $local_js = array(
     '#attached' => array(
       'js' => array(
         libraries_get_path('audio-player').'/audio-player.js' => array(
           'group' => JS_THEME,
           'weight' => 9999),
       ),
     ),
   );
//   dpm("local js");
//   dpm($local_js);
//    drupal_render($local_js);
//    drupal_add_js(libraries_get_path('audio-player').'/audio-player.js');


//    $user = $this->accountProxy;
//
//    if($user->id()) {
//      $account = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
//      $remember_me_value = \Drupal::service('user.data')->get('remember_me', $account->id(), 'remember_me_value');
//      $remember_me_lifetime_value = \Drupal::state()->get('remember_me_lifetime', 604800);
//
//      if ($remember_me_value && \Drupal::state()->get('remember_me_managed', 0) != 0) {
//        // Set lifetime as configured via admin settings.
//        if ($remember_me_lifetime_value != ini_get('session.cookie_lifetime')) {
//          $this->_remember_me_set_lifetime($remember_me_lifetime_value);
//        }
//      }
//      elseif (!isset($remember_me_value)) {
//        // If we have cookie lifetime set already then unset it.
//        if (0 != ini_get('session.cookie_lifetime')) {
//          $this->_remember_me_set_lifetime(0);
//        }
//      }
//    }
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = array('check_mp3player_files');
    return $events;
  }

  public function __construct(AuthenticationProviderInterface $authentication_provider, AccountProxyInterface $account_proxy) {
    $this->authenticationProvider = $authentication_provider;
    $this->accountProxy = $account_proxy;
  }
}
