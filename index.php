<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>INDEX</title>
        <link rel="stylesheet" href="assets/css/bootstrap.css" media="screen" title="no title">
        <script type="text/javascript" src="assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    </head>
    <body>
        <div class="modal fade" id="modal-result">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modal-result-title">ข้อความระบบ</h4>
                    </div>
                    <div class="modal-body" id="modal-result-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default hide" id="content-form">
                        <div class="panel-heading">
                            <h5 class="text-center"><strong>USER FORM</strong></h5>
                        </div>
                        <div class="panel-body">
                            <form id="user-form">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>USER ID</label>
                                            <input type="text" name="user_id" id="user_id" value="" placeholder="กรุณาใส่ข้อมูล" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>USERNAME</label>
                                            <input type="text" name="username" id="username" value="" placeholder="กรุณาใส่ข้อมูล" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>PASSWORD</label>
                                            <input type="password" name="password" id="password" value="" placeholder="กรุณาใส่ข้อมูล" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>PERMISSION</label>
                                            <select class="form-control" name="permission" id="permission">
                                                <option value="">SELECT</option>
                                                <option value="ADMIN">ADMIN</option>
                                                <option value="USER">USER</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="button" name="btn-save" id="btn-save" class="btn btn-primary btn-sm">บันทึกข้อมูล</button>
                            <button type="button" name="btn-cancel" id="btn-cancel" class="btn btn-default btn-sm">ยกเลิก</button>
                        </div>
                    </div>
                    <div class="panel panel-default hide" id="content-table">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-3"><button type="button" id="btn-add" class="btn btn-default">เพิ่มข้อมูล</button></div>
                                <div class="col-md-6 text-center"><h5><strong>USER TABLE</strong></h5></div>
                                <div class="col-md-3 text-right">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" id="btn-search" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                        </span>
                                        <input type="text" name="txt_search" id="txt_search" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <td><strong>NO</strong></td>
                                    <td><strong>USER ID</strong></td>
                                    <td><strong>USERNAME</strong></td>
                                    <td><strong>PASSWORD</strong></td>
                                    <td><strong>PERMISSION</strong></td>
                                    <td><strong>CREATE DATE</strong></td>
                                    <td><strong>MODIFY DATE</strong></td>
                                    <td><strong>EDIT</strong></td>
                                    <td><strong>DELETE</strong></td>
                                </tr>
                            </thead>
                            <tbody id="content-table-result"></tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <center class="text-center"><strong>ACTION LOG</strong></center>
                        </div>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <td><strong>DATE</strong></td>
                                    <td><strong>USER</strong></td>
                                    <td><strong>ACTION</strong></td>
                                </tr>
                            </thead>
                            <tbody id="content-update-result"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var _TABLE = "";
            var _FIELD = "";
            var _ACTION = "";
            var _OUTPUT = "";
            var _DATA = "";
            var _KEY = "";
            $(document).ready(function () {
                function _fetchDATA() {
                    _ACTION = "FETCH";
                    _TABLE = "project_user";
                    _FIELD = "*";
                    $.ajax({
                        url: "dbhelper/db-action.php",
                        type: "POST",
                        data: {
                            action_type: _ACTION,
                            table_name: _TABLE,
                            field_name: _FIELD
                        },
                        success: function (data) {
                            if (data != "[]") {
                                _DATA = $.parseJSON(data);
                                _OUTPUT = "";
                                $.each(_DATA, function (_key, _val) {
                                    _OUTPUT += "<tr>";
                                    _OUTPUT += "<td><span>" + (_key + 1) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['user_id']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['username']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['password']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['permission']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['create_date']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['modify_date']) + "</span></td>";
                                    _OUTPUT += "<td><a href='#' user_id='" + (_val['user_id']) + "' id='link-edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                                    _OUTPUT += "<td><a href='#' user_id='" + (_val['user_id']) + "' id='link-delete'><span class='glyphicon glyphicon-trash'></span></a></td>";
                                    _OUTPUT += "</tr>";
                                });
                            } else {
                                _OUTPUT = "<tr><td colspan='10' style='color: red'>ยังไม่มีข้อมูล</td></tr>";
                            }
                        },
                        complete: function () {
                            $("#content-table-result").html(_OUTPUT);
                            $("#content-table").removeClass("hide");
                        }
                    });
                }
                function _fetchUPDATE() {
                    _ACTION = "FETCH";
                    _FIELD = "log_date, username, log_action";
                    _TABLE = "project_log WHERE database_name='project_user' ORDER BY log_date DESC LIMIT 5";
                    $.ajax({
                        url: "dbhelper/db-action.php",
                        type: "POST",
                        data: {
                            action_type: _ACTION,
                            table_name: _TABLE,
                            field_name: _FIELD
                        },
                        success: function (data) {
                            _DATA = $.parseJSON(data);
                            _OUTPUT = "";
                            $.each(_DATA, function (_key, _val) {
                                _OUTPUT += "<tr>";
                                _OUTPUT += "<td><span>" + (_val['log_date']) + "</span></td>";
                                _OUTPUT += "<td><span>" + (_val['username']) + "</span></td>";
                                _OUTPUT += "<td><span>" + (_val['log_action']) + "</span></td>";
                                _OUTPUT += "</tr>";
                            });
                        },
                        complete: function () {
                            $("#content-update-result").html(_OUTPUT);
                        }
                    });
                }
                function _clearVALUE() {
                    $("#user_id").val("");
                    $("#username").val("");
                    $("#password").val("");
                    $("#permission").val("");
                }

                _fetchDATA();
                _fetchUPDATE();

                $("#user_id").attr('readonly', 'true');
                $("#btn-search").on("click", function () {
                    _ACTION = "FETCH";
                    _TABLE = "project_user WHERE user_id LIKE '%" + $("#txt_search").val() + "%'";
                    _FIELD = "*";
                    $.ajax({
                        url: "dbhelper/db-action.php",
                        type: "POST",
                        data: {
                            action_type: _ACTION,
                            table_name: _TABLE,
                            field_name: _FIELD
                        },
                        success: function (data) {
                            if (data != "[]") {
                                _DATA = $.parseJSON(data);
                                _OUTPUT = "";
                                $.each(_DATA, function (_key, _val) {
                                    _OUTPUT += "<tr>";
                                    _OUTPUT += "<td><span>" + (_key + 1) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['user_id']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['username']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['password']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['permission']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['create_date']) + "</span></td>";
                                    _OUTPUT += "<td><span>" + (_val['modify_date']) + "</span></td>";
                                    _OUTPUT += "<td><a href='#' user_id='" + (_val['user_id']) + "' id='link-edit'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                                    _OUTPUT += "<td><a href='#' user_id='" + (_val['user_id']) + "' id='link-delete'><span class='glyphicon glyphicon-trash'></span></a></td>";
                                    _OUTPUT += "</tr>";
                                });
                            } else {
                                _OUTPUT = "<tr><td colspan='10' style='color: red'>ไม่พบข้อมูลที่ท่านค้นหา</td></tr>";
                            }
                        },
                        complete: function () {
                            $("#content-table-result").html(_OUTPUT);
                        }
                    });
                });
                $("#btn-add").on("click", function () {
                    _ACTION = "INSERT";
                    _TABLE = "project_user";
                    _FIELD = "user_id";
                    _KEY = "USE";
                    $.ajax({
                        url: "dbhelper/db-action.php",
                        type: "POST",
                        data: {
                            action_type: "ADD",
                            table_name: _TABLE,
                            field_name: _FIELD,
                            key_name: _KEY
                        },
                        success: function (data) {
                            $("#user_id").val(data);
                            $("#content-table").addClass("hide");
                            $("#content-form").removeClass("hide");
                        }
                    });
                });
                $("#btn-cancel").on("click", function () {
                    _clearVALUE();
                    $("#content-form").addClass("hide");
                    $("#content-table").removeClass("hide");
                });
                $("#btn-save").on("click", function () {
                    _TABLE = "project_user";
                    _FIELD = "user_id, username, password, permission, create_date, modify_date";
                    $.ajax({
                        url: "dbhelper/db-action.php",
                        type: "POST",
                        data: {
                            action_type: _ACTION,
                            table_name: _TABLE,
                            field_name: _FIELD,
                            form_data: $("#user-form").serialize()
                        },
                        success: function (data) {
                            $("#modal-result-body").html("<p>" + data + "</p>");
                        },
                        complete: function () {
                            $("#content-form").addClass("hide");
                            $("#modal-result").modal('toggle');
                            _clearVALUE();
                            _fetchDATA();
                            _fetchUPDATE();
                        }

                    });
                });
                $("#content-table-result").on("click", "#link-edit", function (e) {
                    e.preventDefault();
                    _ACTION = "UPDATE";
                    _TABLE = "project_user WHERE user_id='" + $(this).attr("user_id") + "'";
                    _FIELD = "*";
                    $.ajax({
                        url: "dbhelper/db-action.php",
                        type: "POST",
                        data: {
                            action_type: "FETCH",
                            table_name: _TABLE,
                            field_name: _FIELD
                        },
                        success: function (data) {
                            _DATA = $.parseJSON(data);
                            $.each(_DATA, function (_key, _val) {
                                $("#user_id").val(_val['user_id']);
                                $("#username").val(_val['username']);
                                $("#password").val(_val['password']);
                                $("#permission").val(_val['permission']);
                            });
                        },
                        complete: function () {
                            $("#content-form").removeClass("hide");
                            $("#content-table").addClass("hide");
                        }
                    });
                });
                $("#content-table-result").on("click", "#link-delete", function (e) {
                    e.preventDefault();
                    _ACTION = "DELETE";
                    _TABLE = "project_user";
                    _FIELD = "";
                    $.ajax({
                        url: "dbhelper/db-action.php",
                        type: "POST",
                        data: {
                            action_type: _ACTION,
                            table_name: _TABLE,
                            field_name: _FIELD,
                            form_data: $(this).attr("user_id")
                        },
                        success: function (data) {
                            $("#modal-result-body").html("<p>" + data + "</p>");
                        },
                        complete: function () {
                            $("#modal-result").modal('toggle');
                            _fetchDATA();
                            _fetchUPDATE();
                        }
                    });
                });
            });
        </script>
    </body>
</html>
