<?php
/* Session model
 *
 *
 *
 *
 */

class SecureSessionHandler extends SessionHandler {

  protected $key, $name, $cookie;

  /**
   * Constructor
   *
   *
   */
  public function __construct($key, $name = 'MY_SESSION', $cookie = []) {
    $this->key = $key;
    $this->name = $name;
    $this->cookie = $cookie;

    $this->cookie += [
      'lifetime' => 0,
      'path'     => ini_get('session.cookie_path'),
      'domain'   => ini_get('session.cookie_domain'),
      'secure'   => isset($_SERVER['HTTPS']),
      'httponly' => true,
    ];

    $this->setup();
  }

  /**
   * Setup
   *
   *
   */
  public function setup() {
    ini_set('session.use_cookies', 1);
    ini_set('session.use_only_cookies', 1);

    session_name($this->name);

    session_set_cookie_params(
      $this->cookie['lifetime'],
      $this->cookie['path'],
      $this->cookie['domain'],
      $this->cookie['secure'],
      $this->cookie['httponly'],
    );
  }

}
