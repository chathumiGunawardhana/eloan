<!DOCTYPE html>
 <html>
  <head>
   <meta charset="utf-8" />
   <title>Page Title</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script> -->
        <link rel="stylesheet" type="text/css" href="css/index.css">

        <script>//if statement to give access rights
                $(document).ready(function(){ //done using js using jquery($) document

                        //   var json=JSON.parse('[{"id":"1","text":"E-Loan","icon":"null","state":{"opened":"true"},"children":[{"id":"2","text":"References","icon":"null","state":{"opened":"false"},"children":[{"id":"4","text":"Loan Types","icon":"null","state":{"opened":"true"},"children":[],"data":{"url":"loantypes.php","info":"","type":""}},{"id":"5","text":"Loan Schemes","icon":"null","state":{"opened":"true"},"children":[],"data":{"url":"loanschemes.php","info":"","type":""}},{"id":"6","text":"Administration division","icon":"null","state":{"opened":"true"},"children":[],"data":{"url":"administrationdivision.php","info":"","type":""}},{"id":"7","text":"User-Group","icon":"null","state":{"opened":"true"},"children":[],"data":{"url":"usergroup.php","info":"","type":""}}],"data":{"url":"","info":"","type":""}},{"id":"3","text":"Front-Office","icon":"null","state":{"opened":"false"},"children":[],"data":{"url":"","info":"","type":""}}],"data":{"url":"","info":"","type":""}}]');
                        // $('#treemenu').jstree({
                        //         'core' :{'data': {
                        //                  "url" : "services/treemenu.php",
                        //                  "dataType" : "json" 
                //     }}
                //         });
                        /*remove add dew*/
                        $("div").last().empty();

                        /*load change password*/
                        $("#changepassword").click(function(){
                                $("changepasswordModal").modal();
                        });
                        //create tree menu
                        $('#treemenu').jstree({
                                'core' :{
                                          'data':{
                                                  "url":"services/treemenu.php",
                                                "dataType":"json"
                                        }
                                }
                        });
                });
                        //even listner for tree menu change
                        $(function () {
                                $('#treemenu').on('changed.jstree', function (e, selectednode) {
                                console.log(selectednode.node);
                                console.log(selectednode.selected);
                                // console.log(selectednode.node.data.url);

                                $("#view").attr("src",selectednode.node.data.url)
                });
                });
       

            function navigateToThePage(page,info){
                    if(page!=null&info!=null){
                            if(page!=""){
                                    $("#urlviewer").attr("src",page);
                            }else{
                                    alert(info);
                            }
                    }
            }
        </script> 
  </head>
  <body>
        <div class="wrapper">
                <div class="header">
                        <div class="projecttitle">
                            <h1>eLoan</h1>
                        </div>

                        <div class="path">
                        path
                        </div>
                        
                        <div class="changepassword">
                        <a href="changepassword.php">Change password</a>    
                        </div>
                </div>    
                <div class="middle">
                        <div class="treemenu" id="treemenu">
                        treemenu
                        </div>

                        <div class="content">
                                <iframe height="550px" width="100%" id="view"></iframe>
                        </div>
                </div>
                <div class="footer">
                <p>footer</p>
                </div>
        </div>
  </body>
 </html>