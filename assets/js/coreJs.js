"USE STRICT"

function getBrowserRootUrl() {
    const location = window.location;
    return location.protocol + '//' + location.host + '/';
}
let q, endPoint = "/api/", target = "requests/", method = "POST";
let originalLocaton = window.location.origin
let root
const rootUrl = getBrowserRootUrl();
const SUBMIT_ENDPOINT = rootUrl + "includes/functions.php";
let xhr = new XMLHttpRequest()
const loginForm = document.getElementById("login")
const registerForm = document.getElementById("register")

loginForm ? loginForm.addEventListener("submit", (e) => {
    e.preventDefault()
    xhr.open("POST", SUBMIT_ENDPOINT);
    const formData = new FormData(loginForm)
    formData.append("action", "login")
    xhr.onload = function () {
        let response = JSON.parse(this.response)
        if (response.status === "success") {
            window.location.href = response.redirectUrl;
        }
    }
    xhr.send(formData)
}) : "";

registerForm ? registerForm.addEventListener("submit", (e) => {
    e.preventDefault()
    xhr.open("POST", SUBMIT_ENDPOINT);
    const formData = new FormData(registerForm)
    formData.append("action", "register")
    xhr.onload = function () {
        let response = JSON.parse(this.response)
        if (response.status == "success") {
            window.location.href = response.redirectUrl;
        }
    }
    xhr.send(formData)
}) : "";
if (window.location.href.includes("landlord")) {
     root = document.getElementById("mainContent");
    fetch(originalLocaton + "/dashboard/landlord/main-area-top.php", {
        method: "GET"
    }).then(res => res.text()).then(data => {
        root.innerHTML = data
    }).catch(error => {
        console.log(error);

    })
}
let navLinks = document.querySelectorAll(".nav-item")
navLinks.forEach(navLink => {
    navLink.addEventListener("click", (e) => {
        e.preventDefault()
        q = navLink.children[0].getAttribute("href");
        fetch(originalLocaton + endPoint + target, {
            method: method,
            body: JSON.stringify({
                query: q
            })
        }).then(res => res.json()).then(data => {
           root = document.getElementById("mainContent");
          let dataResult = root.innerHTML = data.content

          switch (dataResult) {
            case "value":
                
                break;
          
            default:
                break;
          }
        })
    })
})