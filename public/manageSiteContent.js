document.addEventListener("DOMContentLoaded", function(){
    //Button Expanders
    document.getElementById("indexExpander").addEventListener("click", function(){
        var dropDown = document.getElementById("indexDropdown");
        if(dropDown.classList.contains("vanish")){
            dropDown.classList.remove("vanish");
            this.innerHTML = "Collapse";
        }
        else{
            dropDown.classList.add("vanish");
            this.innerHTML = "Expand";
        }
    });
    document.getElementById("whatItTakesExpander").addEventListener("click", function(){
        var dropDown = document.getElementById("whatItTakesDropdown");
        if(dropDown.classList.contains("vanish")){
            dropDown.classList.remove("vanish");
            this.innerHTML = "Collapse";
        }
        else{
            dropDown.classList.add("vanish");
            this.innerHTML = "Expand";
        }
    });
    
    //fill in inputs
    firebase.database().ref("/Site Content").once("value").then(function(snapshot){
        snapshot.forEach(function(childSnapshot){
            var content = childSnapshot.val();
            
            if(childSnapshot.key === "Index"){
                document.getElementById("alertText").value = content.Alert;
            }
        });
    });
    
    //submits
    document.getElementById("indexSubmit").addEventListener("click", function(){
        var updates = {};
        
        updates["/Site Content/Index"] = {
            Alert: document.getElementById("alertText").value
        };
        firebase.database().ref().update(updates);
        alert("Page Updated");
    });
});