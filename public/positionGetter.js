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
var eventid = getParameterByName('eventid');
function loadData(){
    var temporaries = document.getElementsByClassName("temp");
    while(temporaries[0]){
        temporaries[0].parentElement.removeChild(temporaries[0]);
    }
    
    var today = new Date();
    
            //Load My Events
                var done = false;
                var eventName = firebase.database().ref("Events/" + eventid + "/name");
                var description = firebase.database().ref("Events/" + eventid + "/description");
                var startDate = firebase.database().ref("Events/" + eventid + "/startDate");
                var endDate = firebase.database().ref("Events/" + eventid + "/endDate");
                var location = firebase.database().ref("Events/" + eventid + "/location");
                                      //format data into HTML elements
                var row = document.createElement("tr");
                var nameTD = document.createElement("td");
                nameTD.innerHTML = eventName;
                nameTD.title = description;
                nameTD.classList.add("temp");
                var dateTD = document.createElement("td");
                if(startDate === endDate){
                dateTD.innerHTML = startDate;
                }
                else{
                dateTD.innerHTML = startDate + " to " + endDate;
                }
                dateTD.classList.add("temp");
                var locationTD = document.createElement("td");
                locationTD.classList.add("temp");
                var locationLink = document.createElement("a");
                                        locationLink.href = "https://www.google.com/maps/place/" + location; 
                 locationLink.innerHTML = location;
                 locationTD.appendChild(locationLink);

                 row.appendChild(nameTD);
                 row.appendChild(dateTD);
                 row.appendChild(locationTD);

                 done = true;
 }
                

function getDate(stringDate){
    var month = stringDate.substring(0, stringDate.indexOf('/'));
    var day = stringDate.substring(month.length+1, stringDate.indexOf('/', month.length+1));
    var year = stringDate.substring(month.length + day.length+2);
    
    return new Date(parseInt(year), parseInt(month)-1, parseInt(day)); //Months on a 0-11 scale
}
