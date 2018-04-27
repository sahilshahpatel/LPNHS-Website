<!--This is PHP to be implemented in all pages-->

<div id = "banner" style = "width:100%">

	<img id = "LPLogo" src = "img/LP_logo.png" style = "opacity: 0; height: 100px;"><!--LPHS Logo-->
        
	<h1 class = "baseText" style = "padding-bottom: 0px; margin-bottom:0px; color: #005da3;"><span id = "LPNHS" style = "cursor: pointer;" onclick = "location.href='index.php'" title = "LPNHS - Home">Lake Park High School National Honor Society</span></h1>
	<h2 class = "baseTextb" style = "padding-top: 0px; margin-top:0px; color: #666;">Scholarship | Leadership | Character | Service</h2>
	<?php if(isset($_SESSION["StudentID"])) : ?><!--Checking if user is logged in for either sign in or sign out button-->
		<div id = "headerLogout" class = "headerSignIn"><button id = "headerLogoutButton">Sign Out</button></div>
	<?php else: ?>
		<div id = "headerLogin" class = "headerSignIn"><button id = "headerLoginButton">Sign In</button></div>
	<?php endif; ?>

</div>
    <script>/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function navBarDD() {
    document.getElementById("navBarDD").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}</script>
<div id = "navBarWrapper">
    <nav id = "navBar" class = "topnav">
        <?php if(isset($_SESSION["StudentID"])) : ?><!--Checking if student is logged in for different nav bar-->
            <div id = "navBarNormal"><a class = "baseText" id = "homeLink" href = "index.php">Home</a><!--Removing spacing
            --><a class = "baseText" id = "eventsLink" href = "events.php">Community Events</a><!--Removing spacing
            --><a class = "baseText" id = "membersLink" href = "members.php">Members</a><!--Removing spacing
			--><a class = "baseText" id = "myProfileLink" href = "my-profile.php">My Profile</a></div><!--Removing spacing
            --><div class="dropdown"><!--Removing spacing
            --><a class = "baseText" href="index.php">Home</a><!--Removing spacing
            --><a class = "baseText" href="my-profile.php">My Profile</a><!--Removing spacing            
            --><button onclick="navBarDD()" class="dropbtn" aria-haspopup="true">&#9776;</button>
                <div id="navBarDD" class="dropdown-content">
                    <a style="padding-left: 10px;border-bottom: .5px solid gray;width:100%;" href="events.php">Community Events</a>
                    <a style="padding-left: 10px;border-bottom: .5px solid gray;width:100%;" href="members.php">Members</a>
                    <a style="padding-left: 10px;border-bottom: .5px solid gray;width:100%;" href="logout.php">Sign Out</a>
                </div></div>
        <?php else :?><!--If not logged in then the nav bar below-->
        <div id = "navBarNormal"><a class = "baseText" id = "homeLink" href = "index.php">Home</a><!--Removing spacing
            --><a class = "baseText" id = "communityInvolvementLink" href = "community-involvement.php">Community Events</a><!--Removing spacing
            --><a class = "baseText" id = "membersLink" href = "members.php">Members</a><!--Removing spacing
			--><a class = "baseText" id = "whatItTakesLink" href = "what-it-takes.php">What It Takes</a></div><!--Removing spacing
            --><div class="dropdown"><a class = "baseText" href="index.php">Home</a><!--Removing spacing
            --><a class = "baseText" href="login.php">Sign In</a><!--Removing spacing
            --><button onclick="navBarDD()" class="dropbtn" aria-haspopup="true">&#9776;</button>
                <div id="navBarDD" class="dropdown-content">
                    <a style="padding-left: 10px;border-bottom: .5px solid gray;width:100%;" href="community-involvement.php">Community Events</a>
                    <a style="padding-left: 10px;border-bottom: .5px solid gray;width:100%;" href="members.php">Members</a>
                    <a style="padding-left: 10px;border-bottom: .5px solid gray;width:100%;" href="what-it-takes.php">What It Takes</a>
                </div></div>
        <?php endif; ?>
    </nav>
</div>