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
                if(displayNameElement.value!=firebaseUser.displayName){
                    firebaseUser.updateProfile({
                        displayName: displayNameElement.value 
                    });
                    statusText.innerHTML = "Done! Refresh to see changes.";
                    statusText.style.color = "green";
                }
                else{
                    statusText.innerHTML = "Information not changed";
                    statusText.style.color = "red";
                }
                statusText.classList.remove("hidden");
            });
        }
    });
});