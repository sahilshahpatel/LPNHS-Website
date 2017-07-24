var user;

document.addEventListener("DOMContentLoaded", function(){
    firebase.auth().onAuthStateChanged(firebaseUser => {
        user = firebaseUser;
        loadData();
    });
});

function loadData(){
    var temporaries = document.getElementsByClassName("temp");
    while(temporaries[0]){
        temporaries[0].parentElement.removeChild(temporaries[0]);
    }
    
    var today = new Date();
    
    firebase.database().ref("/Events").orderByChild("startDate").once("value").then(function(snapshot){
        snapshot.forEach(function(childSnapshot){            
            //Load My Events
            if(document.getElementById("chapterEventsTab").classList.contains("inactive")){
                firebase.database().ref("/Events/" + childSnapshot.key + "/Shifts").once("value").then(function(snapshot){
                    snapshot.forEach(function(shiftsSnapshot){
                        shiftsSnapshot.forEach(function(positionsSnapshot){
                            positionsSnapshot.forEach(function(idSnapshot){
                                if(idSnapshot.val() == user.uid){
                                    var eventName = childSnapshot.val().name;
                                    var description = childSnapshot.val().description;
                                    var date = shiftsSnapshot.val().date;
                                    var startTime = shiftsSnapshot.val().startTime;
                                    var endTime = shiftsSnapshot.val().endTime;
                                    var location = childSnapshot.val().location;
                                    
                                    //format data into HTML elements
                                    var row = document.createElement("tr");
                                    row.classList.add("temp");
                                    var nameTD = document.createElement("td");
                                        nameTD.title = description;
                                    var pageLink = document.createElement("a");
                                        pageLink.innerHTML = eventName;
                                        pageLink.href = "volunteer.html?eventId=" + childSnapshot.key;
                                    nameTD.appendChild(pageLink);
                                    var dateTD = document.createElement("td");
                                        dateTD.innerHTML = date;
                                    var timeTD = document.createElement("td");
                                        timeTD.innerHTML = startTime + " to " + endTime;
                                    var locationTD = document.createElement("td");
                                    var locationLink = document.createElement("a");
                                        locationLink.href = "https://www.google.com/maps/place/" + location; 
                                        locationLink.target = "_blank";
                                        locationLink.innerHTML = location;
                                    locationTD.appendChild(locationLink);

                                    row.appendChild(nameTD);
                                    row.appendChild(dateTD);
                                    row.appendChild(timeTD);
                                    row.appendChild(locationTD);
                                    
                                    //Check time - upcoming or past?
                                    var tableBody = document.getElementById("myEventsTBody");
                                    if(today>getDate(date)){
                                        tableBody.appendChild(row);
                                    }
                                    else{
                                        tableBody.insertBefore(row, document.getElementById("myEventsHR"));
                                    }
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
                    row.classList.add("temp");
                var nameTD = document.createElement("td");
                    nameTD.title = description;
                var pageLink = document.createElement("a");
                    pageLink.innerHTML = eventName;
                    pageLink.href = "volunteer.html?eventId=" + childSnapshot.key;
                nameTD.appendChild(pageLink);
                var dateTD = document.createElement("td");
                    if(startDate === endDate){
                        dateTD.innerHTML = startDate;
                    }
                    else{
                        dateTD.innerHTML = startDate + " to " + endDate;
                    }
                var locationTD = document.createElement("td");
                var locationLink = document.createElement("a");
                    locationLink.href = "https://www.google.com/maps/place/" + location; 
                    locationLink.target = "_blank";
                    locationLink.innerHTML = location;
                locationTD.appendChild(locationLink);

                row.appendChild(nameTD);
                row.appendChild(dateTD);
                row.appendChild(locationTD);
                
                //Check time - upcoming or past?
                var tableBody = document.getElementById("chapterEventsTBody");
                if(today>getDate(endDate)){
                    tableBody.appendChild(row);
                }
                else{
                    tableBody.insertBefore(row, document.getElementById("chapterEventsHR"));
                }
            }
        });
    });
}

function getDate(stringDate){
    var year = stringDate.substring(0, stringDate.indexOf('-'));
    var month = stringDate.substring(year.length+1, stringDate.indexOf('-', year.length+1));
    var day = stringDate.substring(year.length + month.length+2);
    
    return new Date(parseInt(year), parseInt(month)-1, parseInt(day)); //Months on a 0-11 scale
}