document.addEventListener("DOMContentLoaded", function(){
    firebase.auth().onAuthStateChanged(firebaseUser => {
        if(firebaseUser){
            var leadershipList = document.getElementById("leadership");
            var studentList = document.getElementById("students");
            var permissions = "";
            
            firebase.database().ref("/Users/" + firebaseUser.uid).once("value").then(function(snapshot){
                permissions = snapshot.val().permissions;
                
                if(permissions==="full"){
                    document.styleSheets[1].insertRule("table th, td{width: 33.33%;}", 0);
                }
                else{
                    document.styleSheets[1].insertRule("table th, td{width: 50%;}", 0);
                }
                
                for(var i = 0; i<2; i++){
                    var thead = document.createElement("thead");
                    var tr = document.createElement("tr");
                    var nameTH = document.createElement("th");
                        nameTH.innerHTML = "Name";
                    var emailTH = document.createElement("th");
                        emailTH.innerHTML = "Email";
                    tr.appendChild(nameTH);
                    tr.appendChild(emailTH);
                    if(permissions==="full"){
                        var hoursTH = document.createElement("th");
                            hoursTH.innerHTML = "Hours";
                        tr.appendChild(hoursTH);
                    }
                    thead.appendChild(tr);
                    if(i===1){
                        leadershipList.appendChild(thead);
                    }
                    else{
                        studentList.appendChild(thead);
                    }
                }
                firebase.database().ref("/Users").once("value").then(function(snapshot){
                    snapshot.forEach(function(childSnapshot){
                        var studentTR = document.createElement("tr");

                        var studentName = document.createElement("td");
                            studentName.innerHTML = childSnapshot.val().firstName + " " + childSnapshot.val().lastName;
                        var studentEmail = document.createElement("td");
                            studentEmail.innerHTML = childSnapshot.val().email;
                        var studentHours = document.createElement("td");
                            studentHours.innerHTML = childSnapshot.val().hoursCompleted;
                        
                        studentTR.appendChild(studentName);
                        studentTR.appendChild(studentEmail);
                        if(permissions==="full"){
                            studentTR.appendChild(studentHours);
                        }
                        
                        if(childSnapshot.val().permissions==="student"){
                            studentList.appendChild(studentTR);
                        }
                        else{
                            leadershipList.appendChild(studentTR);
                        }
                    });
                });
            });
        }
        else{
            //redirect user
            //window.location.replace("https://nhs-project-test.firebaseapp.com");
        }
    });
});