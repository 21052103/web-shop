<?php



class Database{

    public static $connection = NULL;
    private $conn;

    // 1. Tạo kết nối
    public function __construct()
    {
        if (!self::$connection) {
            self::$connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            self::$connection->set_charset('utf8mb4');
        }
        $this->conn = self::$connection;
    }

    // Thực thi cậu lệnh Select
    public function Select($sql){
        $items = [];

        //3. Thực thi câu sql
        $sql->execute();
        //4. Xử lý kết nối
        $items = $sql ->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public static function getConnection() {
        if (!self::$connection) {
            new self();
        }
        return self::$connection;
    }

    // 4. Bắt đầu giao dịch
    public function beginTransaction() {
        return $this->conn->begin_transaction();
    }

    // 5. Commit giao dịch
    public function commit() {
        return $this->conn->commit();
    }

    // 6. Rollback giao dịch
    public function rollback() {
        return $this->conn->rollback();
    }

    // 7. Chuẩn bị câu lệnh SQL
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    

    
}


?>