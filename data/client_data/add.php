<?php

require_once("../Library/UserRepository.php");
require_once("../Library/Users.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Id = $_POST["Id"];
    $Name = $_POST["Name"];
    $Mail = $_POST["Mail"];
    $Password = $_POST["Password"];
    $Status = (int)$_POST["Status"];

    $repository = new UserRepository();
    $user = new User($Id, $Name, $Mail, $Password, $Status);
     
    $result = $repository->Insert($user);
    
    if ($result)
        $message = "新增成功!";
    else
        $message = "新增失敗!";

    echo $message;
    header('refresh:2; url=index.php');
    exit();
}

?>


<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Web Programming">
    <meta name="author" content="JohnAxer">
    <title> 使用者管理 </title>
    <style>
        table, th, td
        {
            border-style: solid;
            border-width: 1px;
            border-color: lightblue;
            text-align: center;
            border-collapse: collapse;
        }

    </style>

  </head>
  <body>
     <h2> 使用者新增 </h2>
     
     <form id="myform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         <p>
             <label for="Id">帳號*</label>
             <input type="text" id="Id" name="Id" value="">
         </p>

         <p>
             <label for="Name">姓名*</label>
             <input type="text" id="Name" name="Name" value="">
         </p>

         <p>
             <label for="Mail">電子郵件</label>
             <input type="text" id="Mail" name="Mail" value="">
         </p>

         <p>
             <label for="Password">密碼*</label>
             <input type="password" id="Password" name="Password" >
         </p>

         <p>
             <label for="Status">狀態</label>
             <select name="Status" id="Status">
                 <option value="0">未啟用</option>
                 <option value="1">啟用</option>
             </select>
         </p> 
		 <p>
		    <input type="submit" value="確定" name="submit">
		    <input type="button" value="取消" name="cancle" onclick="location.href='index.php'">	 
		 </p>
     </form> 
  
  </body>
</html>