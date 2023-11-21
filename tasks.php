

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/tasks.css"></link>
    <title>Document</title>
</head>
<body>
<?php
include 'head.php';
?>

<div class="main">
    <div class="row">
<div class="search-container">
        <img style="height: 50%; width: 6%;"src="asset/search.png" alt="Search Icon" class="search-icon">
        <input type="text" class="search" placeholder="Search...">
    </div>
    </div>
    <div style="margin-top:5%;" class="row">
        <div class="task-box">
           
                
                
            
            <div style="justify-content:space-between; margin-top:15px;" class="row">
            <div class="toDo">
                <div class="row">
            <div class="status">
                    <div style="margin-top: 2%;" class="row">
                        <h1>To Do</h1>
                    </div>
                </div>
                </div>
    <?php
    
    while ($task = mysqli_fetch_assoc($tasks_result)) {
    ?>
        <div style="margin-top: 20px;" class="row">
            <div class="tasks">
                <div class="row">
                    <div class="task-head">
                        <div style="justify-content:space-between;" class="row">
                            <div class="profile">
                                <div class="row">
                                    <?php
                                    $imagePath = $user_data['picture'];
                                    echo '<img style="width:50px; height:50px; border-radius:50%;" src="asset/default.jpg" alt="">';
                                    ?>
                                </div>
                                <div class="row">
                                    <a style="font-size:16px;" class="butt"> <?php echo $user_data['username']; ?> </a>
                                </div>
                            </div>
                             <div class="title">
                                
                            <h3> <?php echo $task['task_name']; ?> </h3>
                            
                            </div>
                            <div class="close">
                                <div style="margin-top:10px;" class="row">
                                    <div class="dot"></div>
                                </div>
                                <div style="margin-top:20px;" class="row">
                                <h1 style="color:red; cursor:pointer;" class="delete-task" data-task-id="<?php echo $task['task_id']; ?>">X</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="line"></div>
                    <div style="margin-top:10px;" class="row">
                        <div class="desc-box">
                            <div class="row">
                                <a class="description" style="font-size:16px;" class="butt"><?php echo $task['description']; ?></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<div class="done">
    <div class="row">
<div style="background: #60A42C;" class="status">
                    <div style="margin-top: 2%;" class="row">
                        <h1>Done</h1>
                    </div>
                </div>
                </div>
    <?php
    
    while ($done_task = mysqli_fetch_assoc($done_tasks_result)) {
    ?>
    
        <div  style="margin-top: 20px;" class="row">
            <div style="border-color:#60A42C;" class="tasks">
                <div class="row">
                    <div class="task-head">
                        <div style="justify-content:space-between;" class="row">
                            <div class="profile">
                                <div class="row">
                                <?php
                                  echo '<img style="width:50px; height:50px; border-radius:50%;" src="asset/default.jpg" alt="">';
                              ?>
                                </div>
                                <div class="row">
                                    <a style="font-size:16px;" class="butt"> <?php echo $user_data['username']; ?> </a>
                                </div>
                            </div>
                            <div class="title">
                               
                            <h3> <?php echo $done_task['task_name']; ?> </h3>
                            
                            </div>
                            <div class="close">
                                <div style="margin-top:10px;" class="row">
                                    <div style="background-color:#02FFD1;" class="dot"></div>
                                </div>
                                <div style="margin-top:20px;" class="row">
                                <h1 style="color:red; cursor:pointer;" class="delete-task" data-task-id="<?php echo $done_task['task_id']; ?>">X</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="line"></div>
                    <div style="margin-top:10px;" class="row">
                        <div class="desc-box">
                            <div class="row">
                                <a style="font-size:16px;" class="butt"><?php echo $done_task['description']; ?></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".delete-task").on("click", function () {
            
            var taskId = $(this).data("task-id");
            var confirmation = confirm("Did you want to delete this task?");

            if (confirmation) {
                
                $.ajax({
                    url: "delete_task.php",
                    method: "POST",
                    data: { task_id: taskId },
                    success: function (response) {
                        console.log(response);
                        location.reload(); 
                    },
                    error: function (error) {
                        console.error("Error deleting task:", error);
                    }
                });
            }
        });
    });


</script>
</body>
</html>