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
    
    <!-- <link rel="stylesheet" type="text/css" href="res/datatables.css"> -->
    
    <script type="text/javascript">
       

        function json2table(json, classes) {

            var ParsedJSOM = JSON.parse(json);
            var cols = Object.keys(ParsedJSOM[0]);
            var headerRow = '';
            var bodyRows = '';
            classes = classes || '';

        cols.map(function(col) {
            console.log(col);
            headerRow += '<th>' + capitalizeFirstLetter(col) + '</th>';
        });
        headerRow += '<th>Action</th>';

        ParsedJSOM.map(function(row) {
            bodyRows += '<tr>';
            
            cols.map(function(colName) {
            bodyRows += '<td>' + row[colName] + '</td>';
        });
            bodyRows += '<td><input type="button" value="Modify">&nbsp<input type="button" value="Delete"></td>';
            bodyRows += '</tr>';
        });
        return '<table id="dt_usergroups" class"'+ classes + '"><thead><tr>'+ headerRow + '</tr></thead><tbody>'+ bodyRows +'</tbody></table>';
    }
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
	    function getTabledata(){ 
            var responceJson = "";           
            $.ajax({
                type:'post',
                    url:'services/getUsergroups.php',
                    success:function(msg){
                        if($.trim(msg)){

                            //  alert(msg);
                            // console.log(msg);
                            responceJson= msg;
                            $("#tableviewer").html(json2table(responceJson,"display"));
                            $(document).ready(function(){
                                $('#dt_usergroups').DataTable();
                            });
                            // $("#tableviewer").text(msg);
                        
                           
                            
                         }
                    }
                });

         }
    </script>

    <title></title>
  </head>
  <body onload="getTabledata();">
         <h1>Table Data</h1>
    <!-- <div class="wrapper" id="tableviewer"> -->
    <div id="tableviewer">
            
    </div>
  </body>
 </html>