<div id = "banner" style = "width:100%">
        <img id = "LPLogo" src = "https://www.lphs.org/cms/lib/IL01904769/Centricity/Template/GlobalAssets/images///logos/_default.png">
        
        <h1 class = "baseText" style = "padding-bottom: 0px; margin-bottom:0px; color: #005da3;  font-size:48px;"><span id = "LPNHS" onclick = "location.href='index.php'" title = "NHS Test - Home">Lake Park National Honor Society</span></h1>
        <h2 class = "baseText" style = "padding-top: 0px; margin-top:0px; color: #bbb; font-size:18px;">Scholarship | Leadership | Character | Service</h2>
<<<<<<< HEAD
		<div id = "login"><button class = "classicColor">Sign In</button></div>
        
=======
                
>>>>>>> ac149d0196eab79c6ff23306ba16859cd1b46102
    </div>
    
    <div id = "navBarWrapper">
        <nav id = "navBar" class = "topnav">
            <a class = "baseText" id = "homeLink" href = "index.php">Home</a>
            <a class = "baseText" id = "eventsLink" href = "events.php">Volunteer Events</a>
            <a class = "baseText" id = "members" href = "index.php">Members</a>
            <?php if(isset($_Session["StudentID"])) : ?>
            <a class = "baseText" id = "whatItTakes" href = "index.php">What it Takes</a>
            <?php else :?>
            <a class = "baseText" id = "userProfile" href = "index.php">User Profile</a>
            <?php endif; ?>
        </nav>
    </div>