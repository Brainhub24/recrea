<?php
    require '../header.php'
?>

<?php
    if (isset($_SESSION['userId'])) {
        
        echo $_SESSION['username'];
    }
    else {
        echo '<h4 class="text-center">You must be logged in to modify your account</h4>';
    }
    echo '<div class="alert alert-primary">hello incorrect password</div>';


?>

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z"></path></svg>


<!-- Modal -->
<div class="modal fade" id="delmsg" tabindex="-1" aria-labelledby="delmsgLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delmsgLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="container">
    <div class="jumbotron">
        <div class="card">
            <h2> PHP popup </h2>
        </div>
        <div class="card">
            <div class="cardbody">
                <!-- Button trigger modal -->
                <button type="button" data-bs-toggle="modal" data-bs-target="#delmsg">
                    Launch demo modal
                </button>
            </div>
        </div>
    </div>
</div>


<?php
    require '../footer.php';
?>
