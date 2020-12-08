<nav class="topnav" id="topnavbar">
  <a href="../index.php" class="navbar no-border"> <i class="fas fa-home"></i> Home </a>
  <a href="../pages/profile.php" class="navbar"> <i class="fas fa-user"></i> Profile </a>
  <a href="../pages/pets.php" class="navbar"> <i class="fas fa-dog"></i> Pets </a>
  <a href="../pages/foundpet.php" class="navbar"> <i class="fas fa-child"></i> Found a pet! </a>

  <?php 
       if(!isset($_SESSION['username'])){

	?>
  <!-- REGISTER -->
  <button onclick="document.getElementById('register-popup').style.display='block'" class="navbar right">
    <i class="fa fa-user-plus"></i> Register
  </button>
  <div id="register-popup" class="overlayLogin">
    <form class="overlayLogin-content animate" action="" method="post">
        <div id="register-popup-errors" style="background-color:red">
        </div>
      <div class="container">
        <span onclick="document.getElementById('register-popup').style.display='none'" class="close"
          title="Close Login Overlay"> &#10006;</span>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter password" name="password" required>
        <button type="submit" class="login">Register</button>
      </div>
      <div class="container bottom">
        <button type="button" onclick="document.getElementById('register-popup').style.display='none'"
          class="cancel-button">Back</button>
      </div>
    </form>
  </div>
  <!-- LOGIN -->
  <button onclick="document.getElementById('login-popup').style.display='block'" class="navbar right">
    <i class="fa fa-sign-in"></i> Login
  </button>
  <div id="login-popup" class="overlayLogin">

    <form class="overlayLogin-content animate" action="" method="post">
      <div class="container top round">
        <div id="login-popup-errors" style="background-color:red">
        </div>

        <span onclick="document.getElementById('login-popup').style.display='none'" class="close"
          title="close overlayLogin">&#10006;</span>
      </div>

      <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="username" required>
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter password" name="password" required>
        <button type="submit" class="login">Login</button>
        <label>
          <input type="checkbox" checked="checked" name="remember">
          Remember me
        </label>
      </div>

      <div class="container bottom round">
        <button type="button" onclick="document.getElementById('login-popup').style.display='none'"
          class="cancel-button">Back
        </button>
        <a href="../assets/img/dog.jpg" class="loginLink"> Forgot Password</a>
      </div>
    </form>
  </div>

  <?php } else { ?>
	  <button onclick="fetch('/actions/action_logout.php').then((e)=> { location.reload();});" class="navbar right">
	    <i class="fa fa-users-slash"></i> Logout
	  </button>
	  <a href="../pages/favorites.php" class=" a-heart right"> <i class="fa fa-heart"> </i> Favorites </a>

  <?php } ?>
  <a href="../pages/seatch.php" class=" a-search right"> <i class="fa fa-search"> </i> Search </a>
  <a href="javascript:void(0);" class="icon" onclick="topnavResponsive()"><i class="fa fa-bars"></i></a>
</nav>

<script>

	function authHandler(type, event){
		event.preventDefault();
		let element = document.getElementById(type+'-errors');
		element.innerHTML = '';
		switch (type){


			case 'register-popup':
			case 'login-popup':

				let children = document.querySelectorAll(`#${type} input`);
				console.dir(children);
				let action = 'action_'+type.split('-')[0];
				fetch(`/actions/${action}.php`, {
					method:'POST',
					headers: {
						'Accept': 'application/json',
						'Content-Type': 'application/json',
					},
					body: JSON.stringify({'username': children[0].value, 'password':children[1].value})
				}).then((text) => {
					return text.json();
					
				}).then( (json) => {

					if('errors' in json){
						element.innerHTML = json['errors'];
						return;
					}

					location.reload();

					
				});
				break;
		}
	}

	function registerListener(id){

		if(document.getElementById(id))
			document.getElementById(id).children[0].addEventListener('submit', (e) => authHandler(id, e));
	}


	
	registerListener('login-popup');
	registerListener('register-popup');


</script>
