<?php require_once('header.php'); ?>
<div class="add-task-container">
  <input type="text" maxlength="30" id="taskText" placeholder="New Task..." onkeydown="if (event.keyCode == 13)
                        document.getElementById('add').click()">
  <button id="add" class="button add-button" onclick="addTask()">Add New Task</button>
</div>

<div class="main-container">
  <ul class="columns">

    <li class="column to-do-column">
      <div class="column-header">
        <h4>To Do</h4>
      </div>
      <ul class="task-list" id="to-do">
        <li class="task">
          <p> Plan next Sprint</p>
        </li>
      </ul>
    </li>

    <li class="column doing-column">
      <div class="column-header">
        <h4>In Progress</h4>
      </div>
      <ul class="task-list" id="doing">
        <li class="task">
          <p>Code Review</p>
        </li>
      </ul>
    </li>

    <li class="column done-column">
      <div class="column-header">
        <h4>Done</h4>
      </div>
      <ul class="task-list" id="done">
        <li class="task">
          <p>Sign Up page</p>
        </li>
        <li class="task">
          <p>Sign In page</p>
        </li>
      </ul>
    </li>

    <li class="column trash-column">
      <div class="column-header">
        <h4>Trash</h4>
      </div>
      <ul class="task-list" id="trash">

      </ul>
      <div class="column-button">
        <button class="button delete-button" onclick="emptyTrash()">Delete</button>
      </div>
    </li>

  </ul>
</div>
<script>
    let drake = dragula([
        document.getElementById("to-do"),
        document.getElementById("doing"),
        document.getElementById("done"),
        document.getElementById("trash")
    ]);
    drake.options.removeOnSpill = false;
    drake.on("drag", function(el) {
        el.className.replace("ex-moved", "");
    })
    .on("drop", function(el) {
        el.className += "ex-moved";
    })
    .on("over", function(el, container) {
        container.className += "ex-over";
    })
    .on("out", function(el, container) {
        container.className.replace("ex-over", "");
    });

    /**
     * Add task function
     */
    function addTask() {
        let inputTask = document.getElementById("taskText").value;
        document.getElementById("to-do").innerHTML +=
            "<li class='task'><p>" + inputTask + "</p></li>";
        document.getElementById("taskText").value = "";
    }

    /**
     * Empty trash function
     */
    function emptyTrash() {
        document.getElementById("trash").innerHTML = "";
    }
</script>
<?php require_once('footer.php'); ?>