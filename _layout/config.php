<?php
//
define('BASE_PATH', realpath(dirname(__FILE__)));
define('COMMON_PATH', BASE_PATH . '/_commons');
define('MODEL_PATH', BASE_PATH . '/_models');
define('CONTROL_PATH', BASE_PATH . '/_controllers');
define('LANG_PATH', BASE_PATH . '/_languages');
define('UPLOAD_PATH', BASE_PATH . '/var/uploads');
define('HOME_URL', '.');

define('ADMIN_PATH', BASE_PATH . '/adminis2014_term');

// Database connection
define("SYS_MYSQL_CHARSET", "utf8", TRUE);
define("SYS_DB_CONN_HOST", "localhost", TRUE);
define("SYS_DB_CONN_PORT", 3306, TRUE);
define("SYS_DB_CONN_USER", "dichvudi_thynga", TRUE);
define("SYS_DB_CONN_PASS", "trithuc123@", TRUE);
define("SYS_DB_CONN_NAME", "dichvudi_newdb", TRUE);

define("SYS_DEBUG_ENABLED", FALSE);
define('DEFAULT_LANG', 'vn');

$conn1 = @mysql_connect(SYS_DB_CONN_HOST, SYS_DB_CONN_USER, SYS_DB_CONN_PASS) or die("Không thể kết nối cơ sở dữ liệu !");
mysql_select_db(SYS_DB_CONN_NAME, $conn1);
mysql_query("SET NAMES 'utf8'");

// config for application
define('ALLOW_UPLOAD_EXT', 'zip,rar,doc,pdf,xls,gif,jpg,jpeg,png,docx');
// define('PATH_ATTACH_FILE', '../../hosocapphep');
define('DATE_FORMAT_FULL', 'd-m-Y h:i A');
define('DATE_FORMAT', 'd-m-Y');

// comfig mail server --- ko xai phan nay
$config['mail']['host'] = 'smtp.gmail.com'; // localhost
$config['mail']['port'] = 465;
$config['mail']['mailer'] = "smtp"; // Method to send mail: ("mail", "sendmail", or "smtp").

$config['mail']['mail_from'] = ''; // hoangthuat@trithuc.com
$config['mail']['mail_fromname'] = 'Tri Thuc';
$config['mail']['SMTPAuth'] = true; //
$config['mail']['SMTPSecure'] = "ssl"; // * Options are "", "ssl" or "tls"

$config['mail']['acc_name'] = ''; // hoangthuat@trithuc.com
$config['mail']['acc_pass'] = ''; // accout password
                                   
//
$conn = NULL;
$DM_LINHVUC = NULL;
$DM_LOAICAPPHEP = NULL;

?>