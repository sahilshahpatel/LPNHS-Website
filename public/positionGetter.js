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

function loadData(){
    var temporaries = document.getElementsByClassName("temp");
    while(temporaries[0]){
        temporaries[0].parentElement.removeChild(temporaries[0]);
    }
    
    var today = new Date();
    
    firebase.database().ref("/Events").once("value").then(function(snapshot){
        snapshot.forEach(function(childSnapshot){
            //Load My Events
            if(document.getElementById("chapterEventsTab").classList.contains("inactive")){
                //Is this user in the event?
                var done = false;
                firebase.database().ref("/Events/" + childSnapshot.key + "/Shifts").once("value").then(function(snapshot){
                    snapshot.forEach(function(shiftsSnapshot){
                        shiftsSnapshot.forEach(function(positionsSnapshot){
                            positionsSnapshot.forEach(function(idSnapshot){
                                if(!done && idSnapshot.val() === userId){
                                    var eventName = childSnapshot.val().name;
                                    var description = childSnapshot.val().description;
                                    var startDate = childSnapshot.val().startDate;
                                    var endDate = childSnapshot.val().endDate;
                                    var location = childSnapshot.val().location;
                                    
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

                                    //Check time - upcoming or past?
                                    if(today>getDate(endDate)){
                                        document.getElementById("eventHistoryTable").appendChild(row);
                                    }
                                    else{
                                        document.getElementById("upcomingEventsTable").appendChild(row);
                                    }
                                    
                                    done = true;
                                }
                            });
                        });
                    });
                });
            }
            //Load Chapter Events
            else{            
                //retrieve data
                var eventName = childSnapshot.val().name;
                var description = childSnapshot.val().description;
                var startDate = childSnapshot.val().startDate;
                var endDate = childSnapshot.val().endDate;
                var location = childSnapshot.val().location;
                
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
                
                //Check time - upcoming or past?
                if(today>getDate(endDate)){
                    document.getElementById("eventHistoryTable").appendChild(row);
                }
                else{
                    document.getElementById("upcomingEventsTable").appendChild(row);
                }
            }
        });
    });
}

function getDate(stringDate){
    var month = stringDate.substring(0, stringDate.indexOf('/'));
    var day = stringDate.substring(month.length+1, stringDate.indexOf('/', month.length+1));
    var year = stringDate.substring(month.length + day.length+2);
    
    return new Date(parseInt(year), parseInt(month)-1, parseInt(day)); //Months on a 0-11 scale
}
