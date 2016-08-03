<?php
/* Session model
 *
 * Following this guide: http://eddmann.com/posts/securing-sessions-in-php/
 *
 *
 */

class SecureSessionHandler extends SessionHandler {

  protected $key, $name, $cookie;

  /**
   * Constructor
   *
   * @param {} $key
   * @param {String} $name Name of the session
   * @param {Array} $cookie Array for the cookie parameters
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
      $this->cookie['httponly']
    );
  }

  /**
   * Start
   *
   * @return {String|Boolean} if there isn't a session return session id, or false
   */
  public function start() {
    if (session_id() === '') {
      if (session_start()) {
        return (mt_rand(0, 4) === 0) ? $this->refresh() : true;
      }
    }
    return false;
  }

  /**
   * Forget
   *
   * @return {} session_destroy()
   */
  public function forget() {
    if (session_id() == '') {
      return false;
    }

    $_SESSION = [];
    setcookie(
      $this->name, '', time() - 42000,
      $this->cookie['path'],
      $this->cookie['domain'],
      $this->cookie['secure'],
      $this->cookie['httponly']
    );

    return session_destroy();
  }

  /**
   * Refresh
   *
   * @return {String} New session Id
   */
  public function refresh() {
    return session_regenerate_id(true);
  }

  /**
   * Read
   *
   * This is a rewrite of the SessionHandler::read() implementing mcrypt
   * @param {String} $id
   * @return {String} Decypted session information
   */
  public function read($id) {
    return mcrypt_decrypt(MCRYPT_3DES, $this->key, parent::read($id), MCRYPT_MODE_ECB);
  }

  /**
   * Write
   *
   * This is a rewrite of the SessionHandler::write() implementing mcrypt
   * @param {String} $id Session Id
   * @param {Array} $data Data
   * @return {String} Decypted session information
   */
  public function write($id, $data) {
    return parent::write($id, mcrypt_encrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB));
  }

  /**
   * isExpired
   *
   * Check to see if the session is expired
   * @param {Date} $ttl is the date/time in which the session was set
   * @return {Boolean} true if session is expired, false if not + set new session activity
   */
  public function isExpired($ttl = 30) {
    $activity = isset($_SESSION['_last_activity']) ? $_SESSION['_last_activity'] : false;

    if ($activity != false && time() - $activity > $ttl * 60) {
      return true;
    }

    $_SESSION['_last_activity'] = time();
    return false;

  }

  /**
   * isFingerprint
   *
   * Check if the fingerprint in the session is the same as the current
   * @return {Boolean} if the fingerprint exists match it with the current, or else set it
   */
  public function isFingerprint() {
    // Create an md5 hash that is unique to the user
    $hash = md5(
      $_SERVER['HTTP_USER_AGENT'] . (ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0'))
    );

    if (isset($_SESSION['_fingerprint'])) {
      return $_SESSION['_fingerprint'] === $hash;
    }

    $_SESSION['_fingerprint'] = $hash;

    return true;
  }

  /**
   * isValid
   *
   * Wrapper function to check both isExpires and isFingerprint
   * @param {Date} $ttl is the date/time in which the session was set
   * @return {Boolean} true if the session is valid false if not
   */
  public function isValid($ttl = 30) {
    return ! $this->isExpired($ttl) && $this->isFingerprint();
  }

  /**
   *
   *
   *
   *
   */
  public function get($name) {
    $parsed = explode('.', $name);
    $res = $_SESSION;

    while ($parsed) {
      $next = array_shift($parsed);
      if (isset($res[$next])) {
        $res = $res[$next];
      } else {
        return null;
      }
    }

    return $res;
  }

  /**
   *
   *
   *
   *
   */
  public function put($name, $value) {
    $parsed = explode('.', $name);
    $session =& $_SESSION;

    while (count($parsed) > 1) {
      $next = array_shift($parsed);
      if (!isset($session[$next]) || ! is_array($session[$next])) {
        $session[$next] = [];
      }
      $session =& $session[$next];
    }

    $session[array_shift($parsed)] = $value;
  }

}
