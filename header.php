<div id = "banner" style = "width:100%">
        <img id = "LPLogo" src = "https://www.lphs.org/cms/lib/IL01904769/Centricity/Template/GlobalAssets/images///logos/_default.png">
        
        <h1 class = "baseText" style = "padding-bottom: 0px; margin-bottom:0px; color: #005da3;  font-size:48px;"><span id = "LPNHS" onclick = "location.href='index.html'" title = "NHS Test - Home">Lake Park National Honor Society</span></h1>
        <h2 class = "baseText" style = "padding-top: 0px; margin-top:0px; color: #bbb; font-size:18px;">Scholarship | Leadership | Character | Service</h2>
        
        <div id = "loginSlider">
            <p id = "loginSliderText" class = "baseText" style = "margin: 5px auto; color: white;">Sign In</p>
        </div>
        
        <div id = "login">
            <!--If NOT logged in-->
            <div id = "notLoggedIn">
                <input id = "loginEmail" placeholder = "Email">
                <input id = "loginPassword" placeholder = "Password" type = "password">
                <button id = "loginButton" class = "classicColor" type = "button">Sign In</button>
            </div>
            
            <!-- If logged in-->
            <div id = "loggedIn" class = "vanish">
                <p>Hello,</p>
                <p id = "userGreetingText">User</p>
                <button id = "myProfileButton" class = "classicColor" type = "button" onclick = "location.href='my-profile.html'">My Profile</button>
                <button id = "logoutButton" class = "reverseColor" type = "button">Sign Out</button>
            </div>
        </div>        
    </div>
    
    <div id = "navBarWrapper">
        <nav id = "navBar" class = "topnav">
            <a class = "baseText" id = "eventsLink" href = "authCheck.html?destination=events.html">Volunteer Events</a>
            <a class = "baseText" id = "Item2Link" href = "index.html">Item 2</a>
            <a class = "baseText" id = "Item3Link" href = "index.html">Item 3</a>
            <a class = "baseText" id = "Item4Link" href = "index.html">Item 4</a>
        </nav>
    </div>