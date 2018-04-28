<?php

    require_once "./init.php" ;
    $Init = new Init();
    $Init->conn->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script>
    $(document).ready(function(){
    console.log(2222)
    send('GET',{id:0}  ,get)
    });
    edit_ID = 0 ;
    function send(method , data , success){
        $.ajax({
            method: method ,
            url: "controller.php",
            data: data,
            success:success ,
            error: function(){
            }
        });
    }

    function get(res){
        var data = JSON.parse(res) ;
        var HTML = new Array();
        var view = '<table class="table">' ;
        view += '<thead><tr><th>Name</th><th>Username</th><th>Email</th><th></th></tr></thead>' ;
        view += '<tbody>';
        HTML.push(view);
        for(var i in data){
            var key = data[i]['ID'] ;
            var view = '<tr><td id="'+key+'_name" >'+data[i]['name']+'</td><td id="'+key+'_username">'+data[i]['username']+'</td><td id="'+key+'_email">'+data[i]['email']+'</td><td><button  onclick="showedit(\''+data[i]['ID']+'\' , \''+data[i]['name']+'\' , \''+data[i]['username']+'\' , \''+data[i]['email']+'\')" >編輯</button></td></tr>'
            HTML.push(view);
        }
        view += '</tbody></table>';
        HTML.push(view);

        $('#table').html(HTML.join(''))
        console.log(data)
    }

    function showedit(id , name , usr , email){
        edit_ID = id ;
        $('#edit_name').val(name) ;
        $('#edit_username').val(usr) ;
        $('#edit_email').val(email) ;
        $( ".dialog" ).toggle();
    }

    function edit(){
        var data = { 
            ID: edit_ID ,
            name: $('#edit_name').val(),
            username:  $('#edit_username').val() ,
            email:  $('#edit_email').val()
         }
        send('POST' , data , edit_finish );
    }

    function edit_finish(){
        $('#'+edit_ID+'_name').html( $('#edit_name').val()  )
        $('#'+edit_ID+'_username').html( $('#edit_username').val()  )
        $('#'+edit_ID+'_email').html( $('#edit_email').val()  )
    }

  </script>
  <style>
      .dialog{
        width: 500px;
        height: 300px;
        background-color: #ff0000cc;
        position: fixed;
        left: 40%;
        top: 20%;
        display:none ;
      }
      .dialog>div{
        padding: 30px;
      }
      .div-btn{
        display: flex;
        justify-content: space-between;
      }
  </style>
</head>
<body>

<div class="container">
  <h2>Table</h2>
  <div id="table" ></div>        
  
  <div class="dialog" style="display: none" >
    <div >
        <form>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" id="edit_name" >
            </div>
            <div class="form-group">
                <label for="">UserName</label>
                <input type="text" class="form-control" id="edit_username">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="edit_email">
            </div>
            <div class="div-btn">
                <button type="button" onclick="edit()" class="btn btn-primary">修改</button>
                <button type="button" class="btn btn-primary">取消</button>
            </div>
            
        </form>
    </div>
  </div>


</div>
<script>
    $(document).ready(function(){
        $( "button" ).click(function() {
            $( ".dialog" ).toggle();
        });
    });

</script>

</body>
</html>