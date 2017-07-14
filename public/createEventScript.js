document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("numShifts").addEventListener("input", function(){
        //remove all former elements
        var temporaries = document.getElementsByClassName("temp");
        while(temporaries[0]){
            temporaries[0].parentElement.removeChild(temporaries[0]);
        }                                                  
        
        //create all input elements
        var n = document.getElementById("numShifts").value;    
        for(var i = 0; i<n; i++){
            var title = document.createElement("p");
                title.innerHTML = "Shift " + (i+1) + ":";
                title.style = "text-align:center;"
            var titleTD = document.createElement("td");
                titleTD.appendChild(title);
            
            var date = document.createElement("input");
                date.type = "date";
                date.id = "date" + i;
            var dateTD = document.createElement("td");
                dateTD.appendChild(date);
            
            var startTime = document.createElement("input");
                startTime.type = "time";
                startTime.id = "startTime" + i;
            var startTimeTD = document.createElement("td");
                startTimeTD.appendChild(startTime);
            
            var endTime = document.createElement("input");
                endTime.type = "time";
                endTime.id   = "endTime" + i;
            var endTimeTD = document.createElement("td");
                endTimeTD.appendChild(endTime);
            
            var numPositions = document.createElement("input");
                numPositions.type = "number";
                numPositions.value = 1;
                numPositions.id = "numPositions" + i;
            var numPositionsTD = document.createElement("td");
                numPositionsTD.appendChild(numPositions);    
            
            var row = document.createElement("tr");
                row.appendChild(titleTD);
                row.appendChild(dateTD);
                row.appendChild(startTimeTD);
                row.appendChild(endTimeTD);
                row.appendChild(numPositionsTD);
                row.classList.add("temp");
            
            var table = document.getElementById("shiftsTableBody");
                table.appendChild(row);
        }
    });
    
    document.getElementById("submitButton").addEventListener("click", function(){
        //TODO: actually create new event! (Issue: how to determine what new id should be [1 or 2 or 54 etc])
        
        //hold updates
        var updates = {};
        
        //get values
        var eventName = document.getElementById("eventName").value;
        var description = document.getElementById("description").value;
        var location = document.getElementById("location").value;
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;
        
        //var shifts = {};
        
        var eventInfo = {
            name: eventName,
            description: description,
            location: location,
            startDate: startDate,
            endDate: endDate,
            Shifts: {}
        };
        
        //create new event and get key
        var newEventKey = firebase.database().ref("/Events").push().key;
        
        updates["/Events/" + newEventKey] = eventInfo;
        firebase.database().ref().update(updates);
        updates = {}; //clear updates
        
        
        //create all shifts
        for(var i = 0; i<document.getElementById("numShifts").value; i++){
            //var positions = {};
            
            //get values
            var shiftInfo = {
                startTime: document.getElementById("startTime" + i).value,
                endTime: document.getElementById("endTime" + i).value,
                positionsAvailable: document.getElementById("numPositions" + i).value,
                date: document.getElementById("date" + i).value,
                Positions: {}
            };
            
            var newShiftKey = firebase.database().ref("/Events/" + newEventKey + "/Shifts").push().key;
            
            updates["/Events/" + newEventKey + "/Shifts/" + newShiftKey] = shiftInfo;
            firebase.database().ref().update(updates);
            updates = {}; //clear updates
            
            //create all positions
            for(var n = 0; n<document.getElementById("numPositions" + i).value; n++){
                var newPosKey = firebase.database().ref("/Events/" + newEventKey + "/Shifts/" + newShiftKey).push().key;
                
                updates["/Events/" + newEventKey + "/Shifts/" + newShiftKey + "/Positions/" + newPosKey] = "";
                firebase.database().ref().update(updates);
                updates = {};
            }
        }
        
        alert("Event Created");
    });
});