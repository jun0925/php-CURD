<?php 
// 확인 후 삭제 작업 처리
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // config file 포함
    require_once "config.php";

    // 삭제 문 준비
    $sql = "DELETE FROM employees WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // 준비된 명령문에 변수를 매개변수로 바인딩
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // 매개변수 설정
        $param_id = trim($_POST["id"]);

        // 준비된 명령문 실행 시도
        if(mysqli_stmt_execute($stmt)){
            // 레코드가 성공적으로 삭제되었습니다. index 페이지로 이동
            header("location: index.php");
            exit();
        }else{
            echo "문제가 발생했습니다. 나중에 다시 시도하십시오.";
        }
    }

    // statement 닫기
    mysqli_stmt_close($stmt);

    // 접속 닫기
    mysqli_close($link);
}else{
    // id 매개변수의 존재 확인
    if(empty(trim($_GET["id"]))){
        // URL에 id 매개변수가 없습니다. 오류 페이지로 이동
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>레코드 삭제하기</title>
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
                    <h2 class="mt-5 mb-3">레코드 삭제하기</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]);?>" />
                        <p>이 직원 기록을 삭제하시겠습니까?</p>
                        <p>
                            <input type="submit" value="네" class="btn btn-danger">
                            <a href="index.php" class="btn btn-secondary">아니요</a>
                        </p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>