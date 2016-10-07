<?php

class Database {

    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
    private $MSG_ERROR;

    public function __construct($HOST, $DBNAME, $USER, $PASS) {
        $this->DB_HOST = $HOST;
        $this->DB_NAME = $DBNAME;
        $this->DB_USER = $USER;
        $this->DB_PASS = $PASS;
    }

    protected function _CONNECT_DB() {
        try {
            $db = new PDO("mysql:host={$this->DB_HOST};dbname={$this->DB_NAME}", $this->DB_USER, $this->DB_PASS);
            return $db;
        } catch (PDOException $e) {
            return $this->MSG_ERROR = $e->getMessage();
        }
    }

    public function _AUTO_ID($FIELD, $TABLE) {
        $strQUERY = "SELECT MAX(substr($FIELD,-7))+1 AS result_{$FIELD} FROM  {$TABLE}";
        try {
            $db = $this->_CONNECT_DB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            return $this->MSG_ERROR = $e->getMessage();
        }
    }

    public function _SELECT($FIELD, $TABLE) {
        $strQUERY = "SELECT $FIELD FROM $TABLE";
        try {
            $db = $this->_CONNECT_DB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            $this->MSG_ERROR = $e->getMessage();
        }
    }

    public function _INSERT($FIELD, $TABLE, $VALUE) {
        $strQUERY = "INSERT INTO $TABLE ($FIELD) VALUES ($VALUE)";
        try {
            $db = $this->_CONNECT_DB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                echo "บันทึกข้อมูลเรียบร้อย";
            }
        } catch (PDOException $e) {
            return $this->MSG_ERROR = $e->getMessage();
        }
    }

    public function _UPDATE($TABLE, $VALUE) {
        $strQUERY = "UPDATE $TABLE $VALUE";
        try {
            $db = $this->_CONNECT_DB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                echo "แก้ไขข้อมูลเรียบร้อยครับ";
            }
        } catch (PDOException $e) {
            return $this->MSG_ERROR = $e->getMessage();
        }
    }

    public function _DELETE($TABLE, $VALUE) {
        $strQUERY = "DELETE FROM $TABLE $VALUE";
        try {
            $db = $this->_CONNECT_DB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                echo "ลบข้อมูลเรียบร้อยครับ";
            }
        } catch (PDOException $e) {
            return $this->MSG_ERROR = $e->getMessage();
        }
    }

    public function _SAVE_LOG($VALUE) {
        $strQUERY = "INSERT INTO project_log (log_date, username, log_action, database_name) VALUES ($VALUE)";
        try {
            $db = $this->_CONNECT_DB();
            $result = $db->query($strQUERY);
            if ($result == false) {
                echo $strQUERY;
            } else {
                
            }
        } catch (PDOException $e) {
            return $this->MSG_ERROR = $e->getMessage();
        }
    }

}
