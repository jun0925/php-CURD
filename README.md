# PHP CRUD 연습 GitHub
## Object Oriented 방식으로 코딩해보기

#### MySQL 데이터 베이스 생성
```sql
    CREATE DATABASE tutorials;
```


#### MySQL 테이블 생성
```sql
    CREATE TABLE employees (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        address VARCHAR(255) NOT NULL,
        salary INT NOT NULL
    );
```