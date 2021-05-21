<?php

class DB extends PDO
{
  private static $instance;

  private function __construct($file = 'db.ini')
  {
      if (!$settings = parse_ini_file($file, TRUE))
        throw new exception('Não foi possível abrir o arquivo ' . $file . '.');

      $dns = "{$settings['database']['driver']}:host={$settings['database']['host']}" .
      (!empty($settings['database']['port']) ? (';port=' . $settings['database']['port']) : '') .
      ";dbname={$settings['database']['base']};charset=utf8";

      parent::__construct($dns, $settings['database']['user'], $settings['database']['pass']);
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
      $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
  }

  public static function getInstance()
  {
    if (!isset(self::$instance))
    {
      self::$instance = new static();
    }

    return self::$instance;
  }
}