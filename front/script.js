var loginVisible = false
var registerVisible = false
var formBg = document.getElementById("form-background")
var regForm = document.getElementById("register")
var loginForm = document.getElementById("login")
    

function loginShowHide(){
    if(!loginVisible && !registerVisible){
        loginForm.style.display = formBg.style.display = "block"
        loginVisible = true
    } else {
        loginForm.style.display = regForm.style.display = formBg.style.display = "none"
        loginVisible = registerVisible = false
    }
}

function swapForms(){
    if(loginVisible){
        loginForm.style.display = "none"
        loginVisible = !loginVisible
        regForm.style.display = "block"
        registerVisible = !registerVisible
    } else {
        regForm.style.display = "none"
        registerVisible = !registerVisible
        loginForm.style.display = "block"
        loginVisible = !loginVisible
    }
    
}