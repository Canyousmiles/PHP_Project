<?php

date_default_timezone_set('Asia/Bangkok');
include_once "./db-class.php";
$db = new Database("localhost", "db_project", "root", "");
if (isset($_POST['action_type'])) {
    $ACTION = $_POST['action_type'];
    if (isset($_POST['table_name']) && isset($_POST['field_name'])) {
        $FIELD = $_POST['field_name'];
        $TABLE = $_POST['table_name'];
        if ($ACTION == "FETCH") {
            $arrDATA = $db->_SELECT($FIELD, $TABLE);
            echo json_encode($arrDATA);
        }
        if ($ACTION == "ADD") {
            $KEY = $_POST['key_name'];
            $arrDATA = $db->_AUTO_ID($FIELD, $TABLE);
            foreach ($arrDATA as $result) {
                if ($result["result_" . $FIELD] == "") {
                    echo $KEY . "0000001";
                } else {
                    echo $KEY . sprintf("%07d", $result["result_" . $FIELD]);
                }
            }
        }
        if ($ACTION == "INSERT") {
            parse_str($_POST['form_data'], $arrDATA);
            $VALUE = "'" . $arrDATA['user_id'] . "',"
                    . "'" . $arrDATA['username'] . "',"
                    . "'" . $arrDATA['password'] . "',"
                    . "'" . $arrDATA['permission'] . "',"
                    . "'" . date('d-m-y H:i') . "',"
                    . "'" . date('d-m-y H:i') . "'";
            $db->_INSERT($FIELD, $TABLE, $VALUE);
            $VALUE = "'" . date('d-m-y H:i') . "', '" . $arrDATA['username'] . "','" . $ACTION . "', '" . $TABLE . "'";
            $db->_SAVE_LOG($VALUE);
        }
        if ($ACTION == "UPDATE") {
            parse_str($_POST['form_data'], $arrDATA);
            $VALUE = "SET "
                    . "username='" . $arrDATA['username'] . "',"
                    . "password='" . $arrDATA['password'] . "',"
                    . "permission='" . $arrDATA['permission'] . "',"
                    . "modify_date='" . date('d-m-y H:i') . "' "
                    . "WHERE user_id='" . $arrDATA['user_id'] . "'";
            $db->_UPDATE($TABLE, $VALUE);
            $VALUE = "'" . date('d-m-y H:i') . "', 'ADMIN','" . $ACTION . "', '" . $TABLE . "'";
            $db->_SAVE_LOG($VALUE);
        }
        if ($ACTION == "DELETE") {
            $VALUE = "WHERE user_id='" . $_POST['form_data'] . "'";
            $db->_DELETE($TABLE, $VALUE);
            $VALUE = "'" . date('d-m-y H:i') . "', 'ADMIN','" . $ACTION . "', '" . $TABLE . "'";
            $db->_SAVE_LOG($VALUE);
        }
    }
}
