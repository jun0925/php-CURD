<?php 
// get parameter 확인
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // config 파일 불러오기
    require_once "config.php";

    // select문 준비
    $sql = "SELECT * FROM employees WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // 준비된 명령문에 변수를 매개변수로 바인딩
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // parameters 셋팅
        $param_id = trim($_GET['id']);

        // 준비된 명령문 실행시도
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                // 열과 행을 연관 배열로 가져옵니다.
                // id로 조회하기 때문에 하나의 행만 포함하므로 while 루프를 사용할 필요가 없습니다.
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // 개별 필드 값 검색
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            }else{
                // 유효한 ID 매개변수가 없는 경우 오류 페이지로 이동
                header("location: error.php");
                exit();
            }
        }else{
            echo "문제가 발생했습니다. 나중에 다시 시도해 주세요.";
        }
    }
    // prepare statement를 닫습니다.
    mysqli_stmt_close($stmt);

    // 열어둔 데이터베이스 접속을 종료합니다.
    mysqli_close($link);
}else{
    // URL에 id 매개변수가 없습니다. 오류 페이지로 이동
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label for="">이름</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label for="">주소</label>
                        <p><b><?php echo $row["address"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label for="">급여</label>
                        <p><b><?php echo $row["salary"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>