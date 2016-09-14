<?php

namespace Drupal\mp3player\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Authentication\AuthenticationProviderInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Session;
use Drupal\libraries\ExternalLibrary\Asset;


class Mp3playerSubscriber implements EventSubscriberInterface {

  protected $started = false;

  public function check_mp3player_files() {

    if(!file_exists(libraries_get_path('audio-player').'/audio-player.js') ||
      !file_exists(libraries_get_path('audio-player').'/player.swf')) {

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
