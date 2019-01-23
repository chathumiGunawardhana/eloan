<?php
    //include 'libs/libs.php';
?>

<!DOCTYPE html>
 <html>
  <head>
   <meta charset="utf-8" />
    <!-- jquery  -->
    <script type="text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script> -->
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="">
    <script type="text/javascript" language="javascript" class="init">

    /* creating global variables*/
    var selectRecordID;
    var AddModify;

    /* On Load Jquery eady */
    $(document).ready(function(){
        getLoanTypes ();

        $("div").last().empty();
            $("#form_AddModify").submit(function(e) {
                e.preventDefault();
                saveRecord();
                return false;
            });
        
    });

    /* Reading a record */
    function getLoanTypes(){

        var responceJson = "";
        var formData = {"action" :"Get_Table_data_using_JSON"};

        $.ajax({
                type:'post',
                url:'services/getLoantypes.php',
                data        : formData,
                success:function(msg){
                    if ($.trim(msg)){
                        responceJson = msg;
                        $( "#showtable" ).html(json2table(responceJson,"display"));

                        $(document).ready(function(){
                            $('#dt_loantypes').DataTable({
                                "scrollY":  "350px",
                                "scrollCollapse": true,
                                "dom": '<"toolbar">frtip'
                            });
                        });

                        $("div.toolbar").html('<div class="toolbarwrapper"><p>Loan Types</p> <button class="btn btn-primary" type="button" onclick="resetData();" style="margin-left:10px">Reset Loan Types</button><<button class="btn btn-primary" type="button" onclick="prepareAddModel();" style="margin-left:10px">Add New Loan Type</button></div>');
                    }
                }
        });
    }
       

        function json2table(json, classes) {

            var ParsedJSOM = JSON.parse(json);
            var cols = Object.keys(ParsedJSON[0]);
            var headerRow = '';
            var bodyRows = '';
            classes = classes || '';

            cols.map(function(col) {

                if(col=="LoanTypeCode") col = "Loan Type Code";
                // console.log(col);
                headerRow += '<th>' + capitalizeFirstLetter(col) + '</th>';
            });
            headerRow += '<th>Action</th>';

            ParsedJSON.map(function(row) {
                bodyRows += '<tr>';
                var buttons = "";
                
                cols.map(function(colName) {
                    bodyRows += '<td>' + row[colName] + '</td>';
                });

                bottons = "<button class='btn btn-primary btn-xs a-btn-slide-text btnModify' type='button' LoanTypeCode = '"+ row.LoanTypeCode +"' onclick='prepareModifyModel(this)' >Modify</button>&nbsp;<button class='btn btn-primary btn-xs a-btn-slide-text btnDelete' type='button' LoanTypeCode = '"+ row.LoanTypeCode +"' onclick='prepareDeleteModel(this);' >Delete</button>"


                bodyRows += '<td>'+ buttons +'</td>';
                bodyRows += '</tr>';
            });

            return '<table id="dt_loantypes" class="'+ classes + '"><thead><tr>'+ headerRow + '</tr></thead><tbody>'+ bodyRows +'</tbody></table>';
        }
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

      /* delete record */
    function preparingDeleteModal(element){
        selectRecordID = $( element ).attr( "LoanTypeCode" );/*global variable*/

        $('#deletemodalbody').html("Want to delete the Loan Type? &lt" + selectRecordID + "&gt; ?<br><br><div id='deletingresponce'></div>");
        $('#deleteModal').modal('show');
    }
    function deleteRecord(){
        var formData = {
            "LoanTypeCode" :selectRecordID,
            "action" : "Delete"
        };

        $.ajax({
                type:'get',
                url:'services/getLoantypes.php',
                success:function(msg){
                    if($.trim(msg)){
                        ParsedJSON = JSON.parse(msg);

                        if(ParsedJSON.type != "SUCCESS"){
                            $('#deletingresponce').html("<p class='errormsg'>" +ParsedJSON.message +"</p>");
                            $('#deletingresponce').show();
                            $('#deletingresponce').fadeOut(4000);
                        }else{
                            $('#deletingresponce').html("<p class='successmsg'>" +ParsedJSON.message +"</p>");
                            $('#deletingresponce').show();
                            $('#deletingresponce').fadeOut(2500);

                        set timeOut(function(){
                            $('#deleteModal').modal('hide')
                        }, 1200);

                        getLoanTypes();
                        }
                    }
                }
    
        });
    
    }

    /* Modify record */

    function preparingModifyModal(element){
        selectRecordID = $( element ).attr( "LoanTypeCode" );/*global variable*/
        AddModify = "Modify";

        var formData = {
            "LoanTypeCode" :selectRecordID,
            "action" : "recordDetails"
        };

        $.ajax({
            type:'get',
            url:'services/getLoantypes.php',
            success:function(msg){
                 if($.trim(msg)){
                    var ParsedJSON = JSON.parse(msg);

                    if(ParsedJSON.length==1){
                        $('#exampleModalLable').text("Modify Loan Types");
                        $('#LoanTypeCode').val(ParsedJSON[0].LoanTypeCode);
                        $('#Description').val(ParsedJSON[0].Description);
                        $('#Active').val(ParsedJSON[0].Active == 1);
                        $('#LoanTypeCode').prop("readonly", true);
                        $('#AddOrModifyModel').modal("show");

                    }else{
                            
                        }
                    }
                }
    
        });
    }

    /* Add Modal */

    function preparingAddModal(){
        /* global var */
        AddModify = "Add";

        $('#exampleModalLable').text("Add new Loan Types");

        $('#LoanTypeCode').val("");
        $('#Description').val("");
        $('#Active').prop('checked', false);

        $('#LoanTypeCode').prop("readonly", false);
        $('#AddOrModifyModel').modal("show");

    }
    /* save new record */

    function saveRecord(){
        var action;
        if(AddModify=="Add"){
            action = "addRecord";
        }else if(AddModify=="Modify"){
            action = "modifyRecord";
        }

        var formData =  {
            "LoanTypeCode" : $('#LoanTypeCode').val(""),
            "Description"  : $('#Description').val(""),
            "Active"       : $('#Active').prop('checked') ? "1" : "0" ,
            "action"       : action
        };
        var ParsedJSON;

        $.ajax({
            type:'get',
            url:'services/getLoantypes.php',
            data: formData,
            success:function(msg){
                if($.trim(msg)){
                    ParsedJSON = JSON.parse(msg);

                    if(ParsedJSON.type != "SUCCESS"){
                        $('#responce').html("<p class='errormsg'>" +ParsedJSON.message +"</p>");
                        $('#responce').show();
                        $('#responce').fadeOut(4000);
                    }else{
                        $('#responce').html("<p class='successmsg'>" +ParsedJSON.message +"</p>");
                        $('#responce').show();
                        $('#responce').fadeOut(2500);

                }
            }
        });
    }
    /* reset data */
    function resetData(){
        var formData = {
            "action" : "reset"
        };

        $.ajax({
            type:'get',
            url:'services/getLoantypes.php',
            data: formData,
            success:function(msg){
                if($.trim(msg)){
                    getLoanTypes();
                    alert("Data is Reseted!!");
                }
            }
        });
    }
    </script>

    // <style>
    //     body{
    //         width: 90%;
    //         margin: 5% 0 0 5%;
    //         background-color: orange;
    //     }

    //     .toolbar p{
    //         position: relative;
    //         float: left;
    //         font-weight: 900;
    //         font-style: normal;
    //         font-size: 180%;  
    //     }

    //     .toolbar button{
    //         position: relative;
    //         float: right;
    //     }

    //     .toolbarwrapper{
    //         width: 50%;
    //     }

    //     .toolbar{
    //         width: 50%;
    //         position: relative;
    //         float: left;
    //     }

    // </style>

</head>
<body onload="getLoanTypes();">
<h1>Loan Types</h1>

    <div class="wrapper" id="tableviewer">

    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div id="view_responce"></div>
                        <div class="form-group">
                            <label for="LoanTypeCode">Loan Type Code</label>
                            <input type="text" id="LoanTypeCode" placeholder="Loan Type Code" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="Description">Loan Type Description</label>
                            <input type="text" id="Description" placeholder=" Description" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label class="form-check-label" for="Active">Active</label>
                            <input type="checkbox" id="Active" name="Active" class="form-check-input" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="deletemodalbody">
                <input type="hidden" id="hiddenLoanTypeCode" name="hiddenLoanTypeCode" value="">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" 
                onclick = "deleteRecord()">Delete</button>
            </div>
            </div>
        </div>
    </div>

    <!-- modify model -->
    <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modify Record</h4>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="LoanTypeCode_mod">Loan Type Code</label>
                        <input type="text" id="LoanTypeCode_mod" name="LoanTypeCode_mod" placeholder="Loan Type Code" class="form-control" readonly/>
                    </div>

                    <div class="form-group">
                        <label for="Description_mod">Loan Type Description</label>
                        <input type="text" id="Description_mod" placeholder=" Description" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="form-check-label" for="Active">Active</label>
                        <input type="checkbox" id="Active_mod" name="Active_mod" class="form-check-input" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="modifyRecord()">Modify Record</button>
                </div>
            </div>
        </div>
    </div>
    <div id="showjson"> 

</div>