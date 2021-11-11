<?php 
// DB정보를 상수로 선언합니다.
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '111111');
define('DB_NAME','tutorials');

// MySQL 데이터베이스에 연결 시도
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// 연결을 확인합니다.
if($mysqli === false){
    die("오류 : 연결할 수 없습니다. " . $mysqli->connect_error);
}
?>