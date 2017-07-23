document.addEventListener("DOMContentLoaded", function(){
    //Give options for Event Name
    firebase.database().ref("/Events").once("value").then(function(snapshot){
        snapshot.forEach(function(eventSnapshot){
            var option = document.createElement("option");
                option.value = eventSnapshot.val().name;
                option.dataset.eventId = eventSnapshot.key;
            document.getElementById("eventNameList").appendChild(option);
        });
    });
    
    //Give options for Students
    firebase.database().ref("/Users").once("value").then(function(snapshot){
        snapshot.forEach(function(userSnapshot){
            var option = document.createElement("option");
                option.value = userSnapshot.val().firstName + " " + userSnapshot.val().lastName + " - " + userSnapshot.val().id;
                option.dataset.uid = userSnapshot.key;
            document.getElementById("studentList").appendChild(option);
        });
    });
    
    //When eventName input is changed
    document.getElementById("eventName").addEventListener("input", function(){
        //remove old elements
        var temps = document.getElementsByClassName("temp");
        while(temps[0]){
            temps[0].parentNode.removeChild(temps[0]);
        }
        document.getElementById("description").value = "";
        document.getElementById("location").value = "";
        document.getElementById("startDate").value = "";
        document.getElementById("endDate").value = "";
        
        //get all elements
        var description = document.getElementById("description");
        var location = document.getElementById("location");
        var startDate = document.getElementById("startDate");
        var endDate = document.getElementById("endDate");
        
        //fill in other information
        firebase.database().ref("/Events").once("value").then(function(snapshot){
            var found = false;
            snapshot.forEach(function(eventSnapshot){
                //find eventId
                var eventId = document.querySelector('#eventNameList option[value=' + "'" + document.getElementById("eventName").value + "'" +']').dataset.eventId;
                document.getElementById("eventName").dataset.eventId = eventId;
                
                if(document.getElementById("eventName").dataset.eventId === eventSnapshot.key){
                    found = true;
                    
                    //show delete button
                    document.getElementById("deleteButton").classList.remove("vanish");
                    
                    //document.getElementById("eventName").dataset.eventId = eventSnapshot.key;
                    
                    description.value = eventSnapshot.val().description;
                    location.value = eventSnapshot.val().location;
                    startDate.value = eventSnapshot.val().startDate;
                    endDate.value = eventSnapshot.val().endDate;
                    
                    //fill in shift information
                    var shift = eventSnapshot.val().Shifts;
                    var i = 0;
                    Object.keys(shift).forEach(function(key){
                        var title = document.createElement("p");
                            title.innerHTML = "Shift " + (i+1) + ":";
                            title.style = "text-align:center;"
                            title.id = "title" + i;
                            title.dataset.shiftId = key;
                        var titleTD = document.createElement("td");
                            titleTD.appendChild(title);

                        var date = document.createElement("input");
                            date.type = "date";
                            date.id = "date" + i;
                            date.value = shift[key].date;
                        var dateTD = document.createElement("td");
                            dateTD.appendChild(date);

                        var startTime = document.createElement("input");
                            startTime.type = "time";
                            startTime.id = "startTime" + i;
                            startTime.value = shift[key].startTime;
                        var startTimeTD = document.createElement("td");
                            startTimeTD.appendChild(startTime);

                        var endTime = document.createElement("input");
                            endTime.type = "time";
                            endTime.id   = "endTime" + i;
                            endTime.value = shift[key].endTime;
                        var endTimeTD = document.createElement("td");
                            endTimeTD.appendChild(endTime);

                        var positionsButton = document.createElement("button");
                            positionsButton.classList.add("classicColor");
                            positionsButton.type = "button";
                            positionsButton.id = "positionsButton" + i;
                            positionsButton.classList.add("positionDropdown");
                            positionsButton.innerHTML = "Show Positions";
                            
                        var positionsButtonTD = document.createElement("td");
                            positionsButtonTD.appendChild(positionsButton);    

                        var row = document.createElement("tr");
                            row.id = "row" + i;
                            row.appendChild(titleTD);
                            row.appendChild(dateTD);
                            row.appendChild(startTimeTD);
                            row.appendChild(endTimeTD);
                            row.appendChild(positionsButtonTD);
                            row.classList.add("temp");

                        var table = document.getElementById("shiftsTableBody");
                        
                        //Create (and hide) position data
                        var position = shift[key].Positions;
                        var p = 0;
                        
                        var posTableRow = document.createElement("tr");
                            posTableRow.classList.add("temp");
                            posTableRow.classList.add("vanish");
                            posTableRow.id = "posTR" + i;
                        var posTableTD = document.createElement("td");
                            posTableTD.setAttribute("colspan", "5");
                        var posTable = document.createElement("table");
                            posTable.classList.add("positionTable");
                        
                        Object.keys(position).forEach(function(posKey){                               
                            var studentRow = document.createElement("tr");
                                studentRow.id = "studentRow" + i + "-" + p;
                                studentRow.dataset.posKey = posKey;
                            var idTD = document.createElement("td");
                            var idInput = document.createElement("input");
                                idInput.placeholder = "Empty - Choose a Student";
                                idInput.setAttribute("list", "studentList");
                                idInput.id = "idInput" + i + "-" + p;
                                idInput.dataset.uid = "";
                                //find student
                                if(position[posKey] !== ""){
                                    firebase.database().ref("/Users/" + position[posKey]).once("value").then(function(userSnapshot){
                                        idInput.value = userSnapshot.val().firstName + " " + userSnapshot.val().lastName + " - " + userSnapshot.val().id;
                                        idInput.dataset.uid = userSnapshot.key;
                                    });
                                }
                                idInput.addEventListener("input", function(){                                    
                                    //find uid
                                    var uid = document.querySelector('#studentList option[value=' + "'" + this.value + "'" +']').dataset.uid;
                                    this.dataset.uid = uid;
                                });
                            idTD.appendChild(idInput);
                            studentRow.appendChild(idTD);
                            posTable.appendChild(studentRow);
                            
                            p++;
                        });
                        
                        positionsButton.dataset.numPositions = p;
                        
                        //create click event for positionButton
                        positionsButton.addEventListener("click", function(){
                            //alert(positionsButton.innerHTML === "Show Positions");
                            if(this.innerHTML === "Show Positions"){
                                this.innerHTML = "Hide Positions";
                            }
                            else{
                                this.innerHTML = "Show Positions";
                            }
                            
                            if(posTableRow.classList.contains("vanish")){
                                posTableRow.classList.remove("vanish");
                            }
                            else{
                                posTableRow.classList.add("vanish");
                            }
                        });
                        
                        table.appendChild(row);
                        posTableTD.appendChild(posTable);
                        posTableRow.appendChild(posTableTD);
                        table.appendChild(posTableRow);                
                        
                        i++;
                    });
                    
                    document.getElementById("shiftsTitle").dataset.numShifts = i;
                }
                else if(!found){
                    document.getElementById("eventName").dataset.eventId = "";
                    
                    //hide delete button
                    document.getElementById("deleteButton").classList.add("vanish");
                }
            });
        });
    });
    
    //Submit
    document.getElementById("submitButton").addEventListener("click", function(){
        //update database
        var eventId = document.getElementById("eventName").dataset.eventId;
        
        if(eventId!==""){
            var shiftUpdates = {};
            var eventUpdates = {
                name: document.getElementById("eventName").value,
                description: document.getElementById("description").value,
                location: document.getElementById("location").value,
                startDate: document.getElementById("startDate").value,
                endDate: document.getElementById("endDate").value,
                Shifts: shiftUpdates
            };
            
            //load shift data
            for(var i = 0; i<document.getElementById("shiftsTitle").dataset.numShifts; i++){
                var positionUpdates = {};
                var posAvailable = 0;
                shiftUpdates[document.getElementById("title" + i).dataset.shiftId] = {
                    date: document.getElementById("date" + i).value,
                    startTime: document.getElementById("startTime" + i).value,
                    endTime: document.getElementById("endTime" + i).value,
                    Positions: positionUpdates,
                    positionsAvailable: posAvailable
                };
                
                //load positions data
                for(var p = 0; p<document.getElementById("positionsButton" + i).dataset.numPositions; p++){
                    var uid = document.getElementById("idInput" + i + "-" + p).dataset.uid;
                    positionUpdates[document.getElementById("studentRow" + i + "-" + p).dataset.posKey] = uid;
                    if(uid === ""){
                        posAvailable++;
                    }
                }
            }
            
            var updates = {};
            updates["/Events/" + eventId] = eventUpdates;
            
            firebase.database().ref().update(updates).then(function(){
               alert("Event Updated"); 
            });
        }
    });
    
    //Delete Event
    document.getElementById("deleteButton").addEventListener("click", function(){
        var eventId = document.getElementById("eventName").dataset.eventId;
        if(eventId!=="" && confirm("Do you want to remove " + document.getElementById("eventName").value + "?")){
            
            firebase.database().ref("/Events/" + eventId).remove().then(function(){
                alert("Event Removed")
            });
            //remove old elements
            var temps = document.getElementsByClassName("temp");
            while(temps[0]){
                temps[0].parentNode.removeChild(temps[0]);
            }
            document.getElementById("description").value = "";
            document.getElementById("location").value = "";
            document.getElementById("startDate").value = "";
            document.getElementById("endDate").value = "";
            document.getElementById("eventName").value = "";
        }
    });
});