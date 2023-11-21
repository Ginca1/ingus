
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/input.css">
    <title>Task Management</title>
    <style>


    </style>
</head>
<body>
<?php
include 'header.php';
?>


<!--InputBox-->
  <div class="box">
    <div class="logo">
      <img class="boximg" src="asset/logo.png" href="img"></img>
    </div>
    <div class="int">
        <div class="tasks">
        <h1>Tasks</h1>
        </div>
        <div class="taskName">
        <label  class="boxlable">Task Name:</label>
        <input class="boxinput"  type="text" id="taskName" >
        <p id="taskNameError" class="error"></p>
        <p id="taskNameSuccess" class="success"></p>
        </div>
        <div class="taskDesc">
        <label class="boxlable">Description:</label>
        <input class="boxinput"  id="description" type="text" ></input><br>
        <p id="descriptionError" class="error"></p>
        <p id="descriptionSuccess" class="success"></p>
        </div>
        <div class="taskDate">
        <label class="boxlable">Due Date:</label>
          <input  class="boxinput"   type="date" id="date"><br>
          <p id="dateError" class="error"></p>
          <p id="dateSuccess" class="success"></p>
          </div>
          <div class="taskStatus">
            <label class="boxlable">Status</label>
            <select  class="boxinput"   id="statusDropdown">
                <option value=""></option>

            </select>
            <p id="dropdownError" class="error"></p>
            <p id="dropdownSuccess" class="success"></p>
        
        
          </div>
    </div> 
    
  
  <div class="add"><button  class="pogaadd"  type="submit" id="add">Add  </button></div>

</div>








</div>

<script src="script.js"></script>
<script>

  </script>
  

</body>
</html>