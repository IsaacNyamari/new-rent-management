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
        e.preventDefault();
        q = navLink.children[0].getAttribute("href");
        fetch(originalLocaton + endPoint + target, {
            method: method,
            body: JSON.stringify({
                query: q
            })
        })
        .then(res => res.json())
        .then(data => {
            root = document.getElementById("mainContent");
            if (data.apartments) {
                let tableHTML = `
                    <table class="table table-bordered table-striped table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Rent (KES)</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                  `;
                data.apartments.forEach(apartment => {
                    tableHTML += `
                      <tr>
                        <td>${apartment.id}</td>
                        <td>${apartment.apartment_name}</td>
                        <td>${apartment.address}</td>
                        <td>${apartment.rent_amount}</td>
                        <td>${apartment.status}</td>
                      </tr>
                    `;
                });
                tableHTML += `
                      </tbody>
                    </table>
                  `;
                root.innerHTML = tableHTML;
            } else if (data.houses) {
                let tableHTML = `
                    <table class="table table-bordered table-striped table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Apartment</th>
                          <th>Address</th>
                          <th>Rent (KES)</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                  `;
                data.houses.forEach(house => {
                    tableHTML += `
                      <tr>
                        <td>${house.house_id}</td>
                        <td>${house.house_no}</td>
                        <td>${house.apartment_name}</td>
                        <td>${house.address}</td>
                        <td>${house.rent_amount}</td>
                        <td>${house.status}</td>
                      </tr>
                    `;
                });
                tableHTML += `
                      </tbody>
                    </table>
                  `;
                root.innerHTML = tableHTML;
            } else if (data.tenants) {
                let tableHTML = `
                    <table class="table table-bordered table-striped table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Apartment</th>
                          <th>House Number</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                  `;
                data.tenants.forEach(tenant => {
                    tableHTML += `
                      <tr>
                        <td>${tenant.id}</td>
                        <td>${tenant.name}</td>
                        <td>${tenant.email}</td>
                        <td>${tenant.phone}</td>
                        <td>${tenant.apartment_name}</td>
                        <td>${tenant.house_no}</td>
                        <td>${tenant.user_status}</td>
                      </tr>
                    `;
                });
                tableHTML += `
                      </tbody>
                    </table>
                  `;
                root.innerHTML = tableHTML;
            } else if (data.caretakers) {
                let tableHTML = `
                    <table class="table table-bordered table-striped table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                  `;
                data.caretakers.forEach(caretaker => {
                    tableHTML += `
                      <tr>
                        <td>${caretaker.id}</td>
                        <td>${caretaker.name}</td>
                        <td>${caretaker.email}</td>
                        <td>${caretaker.phone}</td>
                        <td>${caretaker.status}</td>
                      </tr>
                    `;
                });
                tableHTML += `
                      </tbody>
                    </table>
                  `;
                root.innerHTML = tableHTML;
            } else if (data.content) {
                root.innerHTML = data.content;
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    });
});