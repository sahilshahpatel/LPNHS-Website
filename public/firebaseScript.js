//Authentication
//get essential elements
const emailElement = document.getElementById("loginEmail");
const passwordElement = document.getElementById("loginPassword");
const loginButton = document.getElementById("loginButton");
    
const logoutButton = document.getElementById("logoutButton");
const userGreetingText = document.getElementById("userGreetingText");

firebase.auth().onAuthStateChanged(firebaseUser =>{
    if(firebaseUser){
        document.getElementById("notLoggedIn").classList.add("vanish");
        document.getElementById("loggedIn").classList.remove("vanish");

        document.getElementById("loginSliderText").innerHTML = "Profile";

        userGreetingText.innerHTML =  firebaseUser.displayName;
    } 
    else{
        document.getElementById("notLoggedIn").classList.remove("vanish");
        document.getElementById("loggedIn").classList.add("vanish");
        
        document.getElementById("loginSliderText").innerHTML = "Sign In";
    }
});
    
//sign in
loginButton.addEventListener('click', function(){
    const email = emailElement.value;
    const password = passwordElement.value;

    const promise = firebase.auth().signInWithEmailAndPassword(email, password);
    promise.catch(e => alert(e.message));            
    emailElement.value = "";
    passwordElement.value = "";
    
});
logoutButton.addEventListener('click', function(){
    firebase.auth().signOut();
    window.location.href = "https://nhs-project-test.firebaseapp.com/index.html";
});