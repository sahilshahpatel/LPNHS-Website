firebase.auth().onAuthStateChanged(firebaseUser =>{
            var permissions = "";
            if(firebaseUser){
                firebase.database().ref("/Users/" + firebaseUser.uid).once("value").then(function(snapshot){
                    permissions = snapshot.val().permissions;
                    if(permissions!=="admin"){
                        window.location.replace("https://nhs-project-test.firebaseapp.com/index.html");
                    }
                });
            }
            else{
                window.location.replace("https://nhs-project-test.firebaseapp.com/index.html");
            }
        });