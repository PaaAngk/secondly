<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wpmag');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', '127.0.0.1');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Bso+0: {Ou9jENT!=@K*M?Ad$>JGb#0y{*~noUSj+d%v!xT!=d@77=xAs0;CH.`3');
define('SECURE_AUTH_KEY',  ']]72Wf?Vj0M]y>EA)?5OG%2z2%+6|>85hR+6 tHR9OD=.s1QIEH(JA8+i|`-R,~N');
define('LOGGED_IN_KEY',    'm^9pOa_A|J7G`|xb@e=M}X7e``?Ft={?l^ff]FUeXdcbzd3vxJ)A|0-b|p%+R=yg');
define('NONCE_KEY',        'YB# X^4@AlWIb}/!%?lTO5sJm8&zvqcMKuvz]iV|JgVBS_WJY&wz*B75 u>87$b|');
define('AUTH_SALT',        '/A mSZW%n7+q|$HcP q&@YSe3yJ/Tt~]#P(L(emrXcg--UflV3[kZO-,q+W+|^SH');
define('SECURE_AUTH_SALT', 'Qaq+#0j/#iZW@&*yT .iAVG@DBv8i [/uS-}yLFQOhO@almJIipj%lyp;x:,y >b');
define('LOGGED_IN_SALT',   '}V(-c(Xi|zyRrb+8eBy9e!)/P5s,>{OHd{i:L54>GQIU]j|oQ~ij@5mOGMB5JO? ');
define('NONCE_SALT',       'Zx8$j<i():VxW+>+rBo1-htB0>7jolj-c3!9<+<2xnk[NnRb;D!&Mg$;u]Bl;/!,');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
