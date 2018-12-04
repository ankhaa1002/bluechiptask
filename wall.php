<?php include 'message.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.css" />
    <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="wall.php">Dashboard</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">User Wall</h6>
          <small>BlueChip</small>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded shadow-sm">
      	<?php 
      		if ( isset($_GET['deleteSuccess']) && $_GET['deleteSuccess'] == 1 )
			{
			     echo "<div class=\"alert alert-success\" role=\"alert\">
						  Your message has been successfully deleted!
						</div>";
			}

			if ( isset($_GET['deleteDanger']) && $_GET['deleteDanger'] == 1 )
			{
			     echo "<div class=\"danger alert-danger\" role=\"alert\">
						  Error occured while deleting message!
						</div>";
			}
      	?>
        <h6 class="border-bottom border-gray pb-2 mb-0">Recent messages</h6>
        <?php 
        $messages = isset($_GET["page"]) ? getPaginatedMessages($_GET["page"]) : getPaginatedMessages(1);
  		if ($messages->num_rows > 0) {
  			while($row = $messages->fetch_assoc()){
				echo "<div class=\"media text-muted pt-3\">
			          <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
			            <strong class=\"text-gray-dark\">@". $row["name"] ."</strong>
                  <span class=\"text-gray-dark\">". $row["email"] ."</span>
			            <span class=\"text-gray-dark\">". $row["posteddate"] ."</span> 
			            <a href=\"message.php?message=".$row["id"]."\" style=\"margin-left: 15px;\"  class=\"btn btn-danger btn-sm\">Delete</a>
			            <br/><br/>
			            ". $row["body"] ."
			          </p>
		      		</div>";
		  			}
				}else{
					echo "<div class=\"media text-muted pt-3\"><strong>Wall is Empty</strong></div>";
				}
		  	?>
	  	<small class="d-block text-center mt-3">
	  		<?php
	  			$hasPageVar = isset($_GET["page"]);
	  			$paginations = (int)getPaginations();
	  			if($paginations > 0){
	  				echo "<strong>Paginations</strong>  ";
	  				for($i = 1; $i <= $paginations; $i++){
	  					$url = "wall.php?page=".$i."";

						echo "<a style=\"font-weight: bold; margin-right: 5px;\" href=\"".$url."\">".$i."</a>";
	  				}
	  			}
	  		?>
        </small>
      </div>

      <div style="overflow: hidden;" class="my-3 p-3 bg-white rounded shadow-sm">
      	<?php 
      		if ( isset($_GET['success']) && $_GET['success'] == 1 )
			{
			     echo "<div class=\"alert alert-success\" role=\"alert\">
						  Your message has been successfully posted!
						</div>";
			}

			if ( isset($_GET['danger']) && $_GET['danger'] == 1 )
			{
			     echo "<div class=\"danger alert-danger\" role=\"alert\">
						  Error occured while posting message!
						</div>";
			}
      	?>
        <h6 class="border-bottom border-gray pb-2 mb-0">Post your message</h6>
        <form action="message.php" method="post" class="needs-validation">

            <div class="mb-3">
              <label for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" name="name" placeholder="Username" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required="" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="message">Message</label>
              <textarea class="form-control" id="message" name="message"></textarea>
              
            </div>

            <button type="submit" name="submit" class="float-right btn btn-success">Submit</button>
          </form>
      </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  </body>
</html>