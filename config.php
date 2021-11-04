<?php 
define('DB_SERVER','127.0.0.1'); // 호스트 주소
define('DB_USERNAME','root'); // MySQL 사용자 계정
define('DB_PASSWORD','111111'); // MySQL 사용자 비밀번호
define('DB_NAME','tutorials'); // 사용할 데이터베이스 이름

// 데이터 베이스 연결
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// 연결 체크 
if($link === false){
    die("에러: 연결할 수 없습니다. " . mysqli_connect_error());
}
?>