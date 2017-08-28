document.addEventListener("DOMContentLoaded", function(){
    //base constants
    const database = firebase.database();
    
    firebase.auth().onAuthStateChanged(firebaseUser =>{
        if(firebaseUser){
            database.ref("/Users/" + firebaseUser.uid).on("value", function(snapshot){
                document.getElementById("hoursWorked").innerHTML = snapshot.val().hoursCompleted;
                document.getElementById("vicePresident").innerHTML = snapshot.val().vicePresident;
                document.getElementById("fullName").innerHTML = snapshot.val().firstName + " " + snapshot.val().lastName;
            });
            
            const displayNameElement = document.getElementById("displayName");
            displayNameElement.setAttribute("value", firebaseUser.displayName);
            const statusText = document.getElementById("status");
            
            document.getElementById("submitChanges").addEventListener("click", function(){
                firebaseUser.updateProfile({
                    displayName: displayNameElement.value 
                }).then(function(){
                    alert("Updated Display Name");
                    if(document.getElementById("currentPassword").value !== ""){
                        if(document.getElementById("password").value===document.getElementById("confirmPassword").value && document.getElementById("password").value.length>5){
                            var credential = firebase.auth.EmailAuthProvider.credential(firebaseUser.email, document.getElementById("currentPassword").value);
                            firebaseUser.reauthenticateWithCredential(credential).then(function(){
                                firebaseUser.updatePassword(document.getElementById("password").value).then(function(){
                                    alert("Updated Password");
                                    window.location.replace(window.location.href);
                                }); 
                            });
                        }
                        else{
                            alert("Passwords do not match or are too short");
                        }
                    }
                });                
            });
        }
    });
});