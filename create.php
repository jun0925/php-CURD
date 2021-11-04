<?php 
// 설정 파일을 불러옵니다.
require_once "config.php";

// 변수를 초기화 합니다.
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

// form 데이터가 전송됐을 때 처리 로직입니다.
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // 이름 확인
    $input_name = trim($_POST['name']);
    if(empty($input_name)){
        $name_err = "이름을 입력해 주세요.";
    }elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[ㄱ-ㅎ가-힣a-zA-Z\s]+$/")))){
        $name_err = "한글 또는 영어만 입력해 주세요.";
    }else{
        $name = $input_name;
    }

    // 주소 확인
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "주소를 입력해 주세요.";
    }else{
        $address = $input_address;
    }

    // 급여 확인
    $input_salary = trim($_POST['salary']);
    if(empty($input_salary)){
        $salary_err = "급여를 입력해 주세요";
    }elseif(!ctype_digit($input_salary)){
        $salary_err = "숫자만 입력이 가능합니다. 다시 입력해 주세요.";
    }else{
        $salary = $input_salary;
    }

    // 데이터베이스에 삽입하기 전에 입력 오류 확인
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);

            // 매개변수 설정
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            // 준비된 명령문 실행
            if(mysqli_stmt_execute($stmt)){
                // 레코드가 생성에 성공했을 경우
                header("Location: index.php");
                exit();
            }else{
                echo "레코드 생성에 실패했습니다. 잠시 후에 다시 시도해 주세요.";
            }
        }
        // statement 종료
        mysqli_stmt_close($stmt);
    }
    // 접속 종료
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>등록하기</title>
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
                    <h2 class="mt-5">등록하기</h2>
                    <p>아래 내용을 작성하여 데이터베이스에 직원을 등록해주세요.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>이름</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>주소</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>급여</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="등록하기">
                        <a href="index.php" class="btn btn-secondary ml-2">취소하기</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>