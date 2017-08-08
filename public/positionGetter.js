var user;
var userId;

document.addEventListener("DOMContentLoaded", function(){
    firebase.auth().onAuthStateChanged(firebaseUser => {
        user = firebaseUser;
        firebase.database().ref("Users/" + user.uid).once("value").then(function(snapshot){
            userId = snapshot.val().id;
        });
        loadData();
    });
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
// Give the parameter a variable name
function loadData(){
    var temporaries = document.getElementsByClassName("temp");
    while(temporaries[0]){
        temporaries[0].parentElement.removeChild(temporaries[0]);
    }

    var today = new Date();
    var eventid = getParameterByName('eventid');
                //Load My Events
                var done = false;
                var EN = firebase.database().ref("Events/" + eventid + "/name");
                    EN.once("value". function(snapshot){
                                   var eventName = snapshot.val().name;
                                   });
                var D = firebase.database().ref("Events/" + eventid + "/description");
                    D.once("value". function(snapshot){
                                   var description = snapshot.val().description;
                                   });
                var SD = firebase.database().ref("Events/" + eventid + "/startDate");
                    SD.on("value". function(snapshot){
                                   var startDate = snapshot.val().startDate;
                                   });
                var ED = firebase.database().ref("Events/" + eventid + "/endDate");
                    ED.on("value". function(snapshot){
                                   var eventDate = snapshot.val().endDate;
                                   });
                var L = firebase.database().ref("Events/" + eventid + "/location");
                    L.on("value". function(snapshot){
                                   var location = snapshot.val().location;
                                   });
                
               var ref = firebase.database().ref("Events/" + eventid + "/Shifts");
                    ref.once("value")
                    .then(function(snapshot) {
                    var positionId = snapshot.child("Shifts").val();
                    });
    
                var PD = firebase.database().ref("Events/" + eventid + "/Shifts/" + positionId + "/date");
                    PD.on("value". function(snapshot){
                                   var positionDate = snapshot.val().date;
                                   });
                var PA = firebase.database().ref("Events/" + eventid + "/Shifts/" + positionId + "/positionsAvailable");
                    PA.on("value". function(snapshot){
                                   var positionAvailable = snapshot.val().positionsAvailable;
                                   });
                var PST = firebase.database().ref("Events/" + eventid + "/Shifts/" + positionId + "/startTime");
                    PST.on("value". function(snapshot){
                                   var positionstartTime = snapshot.val().startTime;
                                   });
                var PET = firebase.database().ref("Events/" + eventid + "/Shifts/" + positionId + "/endTime");
                    PET.on("value". function(snapshot){
                                   var positionendTime = snapshot.val().endtime;
                                   });
    
                var signupB = document.createElement("BUTTON");
                var T = document.createTextNode("SIGN UP");
                signupB.appendChild(T);
    

                //format data into HTML elements
                var namepE = document.getElementById("pE");
                    namepE.innerHTML = eventName;
                    namepE.classList.add("temp");
                var descriptpD = document.getElementById("pD");
                    descriptpD.innerHTML = description;
                    descriptpD.classList.add("temp");
                var datepT = document.getElementById("pT");
                    if(startDate === endDate){
                    datepT.innerHTML = startDate;
                    }
                    else{
                    datepT.innerHTML = startDate + " to " + endDate;
                    }
                    datepT.classList.add("temp");
                var locationpL = document.getElementById("pL");
                    locationpL.classList.add("temp");
                    var locationLink = document.createElement("a");
                    locationLink.href = "https://www.google.com/maps/place/" + location; 
                    locationLink.innerHTML = location;
                    locationpL.appendChild(locationLink);
                var positions = document.getElementById("PositionsTable");
                var listing = table.insertRow(0);
                var dateTD = listing.insertcell(0);
                var timeTD = lising.insertcell(1);
                var signupTD = listing.insertcell(2);
                dateTD.innerHTML = positionDate;
                dateTD.classList.add("temp");
                if(positionstartTime === positionendTime){
                    timeTD.innerHTML = positionstartTime;
                    }
                    else{
                    timeTD.innerHTML = positionstartTime + " to " + positionendTime;
                    }
                    timeTD.classList.add("temp");

                signupTD.appendChild(signupB);
                signupTD.classList.add("temp");
                //Singup management shindigaroo
                var useridP = firebase.database().ref("Events/" + eventid + "/Shifts/" + positionId + "/Positions");
                    useridP.on("value", function(snapshot) {
                                snapshot.forEach(function(PostionSnapshot)){
                                     if(PositionSnapshot.val() === userId && !(PositionSnapshot.val() === null)){
                                    //if in the position
                                        document.getElementById("signupB").value=("PENDING...");
                                    }
                                    else if(!(PositionSnapshot.val() === userId) && !(PositionSnapshot.val() === null)){ 
                                        document.getElementById("signupB").addEventListener("click", signupEL); 
                                            function signupEL(){
                                                document.getElementById("signupB").value=("PENDING...");
                                                //insertinfotransmittancetodatabaseandoradminsIguess
                                                }
                                    }
                                    else{
                                        document.getElementById("signupB").value=("UNAVAILABLE");
                                    }            
                                }
                           });
                
                done = true;
}
                                                                        
                                                                    
                                                                    

function getDate(stringDate){
    var month = stringDate.substring(0, stringDate.indexOf('/'));
    var day = stringDate.substring(month.length+1, stringDate.indexOf('/', month.length+1));
    var year = stringDate.substring(month.length + day.length+2);
    
    return new Date(parseInt(year), parseInt(month)-1, parseInt(day)); //Months on a 0-11 scale
}
