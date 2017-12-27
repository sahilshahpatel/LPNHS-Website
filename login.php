<!Doctype HTML>
<html>
    <head>
    <title>NHS Test - Login</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <link rel="stylesheet" href="baseCSS.css">

        <header id = "header"><?php include "header.php"; ?></header>

        <style>
            body{
                margin: 0px;
                background-color: #005da3;
                text-align: center;
            }
            #login{
                display: inline-block;
                margin: 10% auto;
                padding: 30px;
                background-color: #333;
                border-radius: 15px;
                text-align: left;
            }
            #login div{
                display: inline-block;
                padding: 30px;
            }
            #login button{
                border: none;
                padding: 10px;
                border-radius: 15px;
                font-size: 12px;
                margin-top: 10px;
                margin-bottom: 0px;
                background-color: #005da3;
                color: white;
                
                font-family: Bookman, sans-serif;
                font-size: 24px;
            }

            #login p{
                margin: 5px 0px;
                color: white;
                text-align: left;
                font-family: Bookman, sans-serif;
                font-size: 24px;
            }
            #login input{
                font-family: Bookman, sans-serif;
                font-size: 24px;
            }
        </style>
    </head>
    <body>
       
        <div id = "login">
            <div>
                <p style = "font-size: 30px; text-decoration: underline;">Sign in</p>
                <br/><br/>
                <p>Email</p>
                <input id = "loginEmail" placeholder = "Email">
                <br/><br/>
                <p>Password</p>
                <input id = "loginPassword" placeholder = "Password" type = "password">
                <br/>
                <br/>
                <button id = "loginButton" type = "button">Sign In</button>
            </div>
            <div>
                <img id = "tester" style = "margin: auto;" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
            </div>
        </div>
    </body>
    <footer id = "footer"><?php include "footer.php"; ?></footer>

    <!-- <script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"></script>
        <script>
            // Initialize Firebase
            var config = {
                apiKey: "AIzaSyByQW8Cyp9yAIMm5xCrNZqF-5kqJ-w6g-4",
                authDomain: "nhs-project-test.firebaseapp.com",
                databaseURL: "https://nhs-project-test.firebaseio.com",
                projectId: "nhs-project-test",
                storageBucket: "nhs-project-test.appspot.com",
                messagingSenderId: "239221174231"
            };
            firebase.initializeApp(config);
        </script>
        <script>
            //Authentication
            //get essential elements
            const emailElement = document.getElementById("loginEmail");
            const passwordElement = document.getElementById("loginPassword");
            const loginButton = document.getElementById("loginButton");

            //sign in
            loginButton.addEventListener('click', function(){
                const email = emailElement.value;
                const password = passwordElement.value;

                const promise = firebase.auth().signInWithEmailAndPassword(email, password);
                promise.catch(e => alert(e.message));            
                emailElement.value = "";
                passwordElement.value = "";
            });
            
            // Parse the URL parameter
            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, "\\$&");
                var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, " "));
            }
            
            var destination = getParameterByName("destination");
            
            firebase.auth().onAuthStateChanged(firebaseUser =>{
                if(firebaseUser){
                    window.location.href = "https://nhs-project-test.firebaseapp.com/" + destination;
                }
            });
        </script> -->
</html>