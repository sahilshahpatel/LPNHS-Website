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
            
            var startTime = document.createElement("input");
                startTime.type = "date";
                startTime.id = "startTime" + i;
            var startTimeTD = document.createElement("td");
                startTimeTD.appendChild(startTime);
            
            var endTime = document.createElement("input");
                endTime.type = "date";
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
            
    });
});