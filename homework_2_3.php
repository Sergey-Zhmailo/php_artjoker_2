<?php
/*
 * Создайте класс с именем Logger, реализуйте все необходимые методы для работы с логированием данных:
 *
 * Обеспечьте возможность записи логов в файл
 *
 * ------запись в logs/log.txt
 *
 * Обеспечьте возможность задания уровня логов (TRACE, DEBUG, INFO, WARN, ERROR, FATAL)
 * Файл с логами должен хранить следующую информацию (дата и время, сообщение, уровень), через разделитель  (по умолчанию точка с запятой).
 * Обработать все возможные исключительные ситуации
 * Продумать какие должны быть методы, параметры методов т.е. продумать структуру класса (Возможно это ряд классов… если это будет аргументированно)
 * Реализовать pattern singleton для этого класса, - аргументировать, если считаете что singleton не допустим для этого задания - аргументировать
 * (Задание повышенной сложности, не обязательно но будет плюсом). Реализовать механизм формата хранения логов. К примеру date, level, message. Если задан формат date: level, message В таком случае каждый лог должен быть в файле в таком же формате (2021-01-01 12:12:12: INFO, division by zero). Можно продумать свой вариант формата - здесь на свое усмотрение.
 *
 * */

class Logger {
    private static $instance;
    public static $fileUrl = __DIR__ . '/logs/' . '/log.txt';
    public static $dateFormat = 'Y-m-d H:i:s';

    // Конфиг уровеня логов
    public static $mode = ['error', 'warning', 'debug'];

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function checkLevel($mode, $type) {
        if (in_array($type, $mode)) {
            return true;
        } else {
            return false;
        }
    }

    private function write($level, $message, $file, $line) {
        if (!$message) {
            $message = 'Cообщение не указано';
        }
        if (!$file) {
            $file = 'Файл не указан';
        }
        if (!$line) {
            $line = '-';
        }

        $log = date(self::$dateFormat) . ' [' . $level . '] "' . $message . '" in ' . $file . ' line ' . $line . ';';
        file_put_contents(self::$fileUrl, $log . PHP_EOL, FILE_APPEND);
    }

    public function debug($message, $file, $line) {
        $type = 'debug';
        if (self::checkLevel(self::$mode, $type)) {
            self::write('DEBUG', $message, $file, $line);
        }
    }
    public function info($message, $file, $line) {
        $type = 'info';
        if (self::checkLevel(self::$mode, $type)) {
            self::write('INFO', $message, $file, $line);
        }
    }
    public function warning($message, $file, $line) {
        $type = 'warning';
        if (self::checkLevel(self::$mode, $type)) {
            self::write('WARNING', $message, $file, $line);
        }
    }
    public function error($message, $file, $line) {
        $type = 'error';
        if (self::checkLevel(self::$mode, $type)) {
            self::write('ERROR', $message, $file, $line);
        }
    }

    private function __sleep()
    {

    }

    private function __wakeup()
    {

    }
}

$log = new Logger();
// Вызываем ошибку
try {
    if (true) {
        throw new Exception('Exeption test error');
    }
} catch (Exception $e) {
    $log->debug($e->getMessage(), $e->getFile(), $e->getLine());
    $log->error($e->getMessage(), $e->getFile(), $e->getLine());
}