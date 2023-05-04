function registration() {
    fetch(`${window.location.origin}/api/v1/registration`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            login: document.querySelector("#login").value,
            password: document.querySelector("#password").value,
            repeatPassword: document.querySelector("#repeatPassword").value
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (resp["response"] === "OK") {
                window.location = "/";
            } else {
                if (resp["response"] === "User already exists") {
                    resp["response"] = "Пользователь уже существует";
                }
                alert(resp["response"]);
            }
        });
    });
}

function login() {
    fetch(`${window.location.origin}/api/v1/login`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            login: document.querySelector("#login").value,
            password: document.querySelector("#password").value
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (resp["response"] === "Password and repeat password do not match") {
                resp["response"] = "Пароль и повтор пароля не совпадают";
            }
            if (resp["response"] === "Вы успешно вошли в аккаунт") {
                window.location = "/";
            } else {
                alert(resp["response"]);
            }
        });
    });
}

function isAdminPanel() {
    return window.location.pathname.startsWith("/admin");
}

function logout() {
    fetch(`${window.location.origin}/api/v1/logout`, {
        method: 'POST'
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (!isAdminPanel()) {
                location.reload();
            } else {
                window.location = '/';
            }
        });
    });
}

function closeAddPostModal() {
    let modal = document.querySelector(".modal");
    modal.classList.remove("show");
    modal.style.display = "none";
    document.body.classList.remove("modal-open");
    document.body.style.overflow = null;
    document.body.style.paddingRight = null;
    document.body.removeChild(document.querySelector(".modal-backdrop"));
    clearAddPostForm();
}

function clearAddPostForm() {
    document.querySelector("#postTitle").value = "";
    document.querySelector("#postBody").value = "";
    document.querySelector("#postImage").value = "";
}

function addPost() {
    let date = new Date();
    let hours = date.getHours() > 9 ? date.getHours() : `0${date.getHours()}`;
    let minutes = date.getMinutes() > 9 ? date.getMinutes() : `0${date.getMinutes()}`; 
    let image = document.querySelector("#postImage").files[0];
    let formData = new FormData();
    formData.append("title", document.querySelector("#postTitle").value);
    formData.append("body", document.querySelector("#postBody").value);
    formData.append("image", image, image.name);
    fetch(`${window.location.origin}/api/v1/addPost`, {
        method: 'POST',
        body: formData
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (resp["response"] === "Пост успешно создан") {
                closeAddPostModal();
            }
            fetch(`${window.location.origin}/api/v1/getLastPostId`, {
                method: 'POST'
            }).then(function (response) {
                return response.json().then(function (resp) {
                    createPostCard(
                        formData.get("title"), 
                        resp["id"], 
                        `/pages/post_images/${image.name}`
                    );
                })
            });
        });
    });
}

function getPosts() {
    let args = window.location.search;
    if (args.length === 0) {
        redirectToSecurityNews();
    }
    args = args.split("&");
    if (args.length > 1) {
        redirectToSecurityNews();
    }
    args[0] = args[0].substring(1, args[0].length);
    args.map(function (arg) {
        if (!(arg.startsWith("id=") || arg.startsWith("tag="))) {
            redirectToSecurityNews();
        }

        if (arg.startsWith("tag=")) {
            let tag = arg.substring(arg.indexOf("=") + 1, arg.length);
            if (["security", "administration", "social", "healthcare", "education"].indexOf(tag) === -1) {
                redirectToSecurityNews();
            }
            getPostsByTag(tag);
        } else if (arg.startsWith("id=")) {
            let id = arg.substring(arg.indexOf("=") + 1, arg.length);
            getPostById(id);
        }
    })
}

function isAdmin() {
    fetch(`${window.location.origin}/api/v1/isAdmin`, {
        method: 'POST'
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (resp["response"] === "admin") {
                if (window.location.pathname === "/admin") {
                    window.location = '/admin/news';
                }
            }
        });
    });
}

function isAuthorized() {
    fetch(`${window.location.origin}/api/v1/isAuthorized`, {
        method: 'POST'
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (!isAdminPanel()) {
                let button = document.querySelector("#authButton");
                if (resp["response"]) {
                    button.innerHTML = "<button onclick='logout()'>Выйти</button>";
                } else {
                    button.innerHTML = "Войти";
                    button.href = "/login";
                }
            } else {
                if (!resp["response"]) {
                    window.location = '/';
                }
            }
        })
    });
}

function getPostById(id) {
    fetch(`${window.location.origin}/api/v1/getPostById`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: id
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (!resp["response"] && Object.keys(resp).length > 0) {
                let key = Object.keys(resp)[0];
                let body = resp[key].body.replaceAll("\n", "<br>");
                createFullPost(resp[key].title, body, resp[key].image);
            }
        });
    });
}

function redirectToSecurityNews() {
    window.location = "/posts/?tag=security";
    return;
}

function getAllPosts() {
    fetch(`${window.location.origin}/api/v1/getAllPosts`, {
        method: 'POST'
    }).then(function(response) {
        return response.json().then(function(resp) {
            if (!resp["response"] && Object.keys(resp).length > 0) {
                Object.keys(resp).map(function(key) {
                    createPostCard(resp[key].title, resp[key].id, resp[key].image);
                });
            }
        });
    });
}

function createPostCard(title, id, image) {
    let divBodyNews = document.createElement("div");
    divBodyNews.classList.add("col-lg-4");
    let aBodyNews = document.createElement("a");
    aBodyNews.href = "#";
    let divBody = document.createElement("div");
    divBody.classList.add("news", "h-100");

    let divImgNews = document.createElement("div");
    divImgNews.classList.add("img-news", "m-auto");
    let imgNews = document.createElement("img");
    imgNews.alt = "image";
    imgNews.src = image;
    imgNews.width = 150;
    imgNews.height = 150;
    divImgNews.appendChild(imgNews);

    let aTitle = document.createElement("a");
    aTitle.innerHTML = title;
    aTitle.classList.add("title-block");
    aTitle.href = `/posts/?id=${id}`;

    divBody.appendChild(divImgNews);
    divBody.appendChild(aTitle);
    aBodyNews.appendChild(divBody);
    divBodyNews.appendChild(aBodyNews);

    document.querySelector("#news").appendChild(divBodyNews);
}

function createFullPost(title, body, image) {
    let titleNews = document.querySelector(".title-news");
    let bgPosts = document.querySelector(".bg-posts");
    let textPosts = document.querySelector(".text-post");
    
    titleNews.innerHTML = title;
    bgPosts.style.backgroundImage = `url('${image}')`;
    textPosts.innerHTML = body;

    titleNews.style.display = null;
    bgPosts.style.display = null;
    textPosts.style.display = null;
}

function addFeedback() {
    fetch(`${window.location.origin}/api/v1/addFeedback`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            fio: document.querySelector("#feedbackFio").value,
            email: document.querySelector("#feedbackEmail").value,
            message: document.querySelector("#feedbackMessage").value
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            alert(resp["response"]);
            if (resp["response"] === "Обращение успешно отправлено") {
                location.reload();
            }
        });
    });
}

function getAllFeedbacks() {
    fetch(`${window.location.origin}/api/v1/getAllFeedbacks`, {
        method: 'POST'
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (!resp["response"] && Object.keys(resp).length > 0) {
                Object.keys(resp).map(function(key) {
                    createFeedback(resp[key].fio, resp[key].email, resp[key].message);
                });
            }
        });
    });
}

function createFeedback(fio, email, message) {
    let divFeedback = document.createElement("div");
    divFeedback.classList.add("col-lg-6");
    let divCardCar = document.createElement("div");
    divCardCar.classList.add("card-car");
    let divInfo = document.createElement("div");
    divInfo.classList.add("charackteristic", "row");
    let divFio = document.createElement("div");
    divFio.classList.add("charackteristic-car", "col-lg-6", "col-md-6", "col-6");
    
    let divIconFio = document.createElement("div");
    divIconFio.classList.add("icon-block");
    let iconFio = document.createElement("img");
    iconFio.src = "/pages/admin/img/people.svg";
    iconFio.alt = "people";

    let divLabelFio = document.createElement("div");
    divLabelFio.classList.add("text-charackteristik");
    divLabelFio.innerHTML = `<h1>ФИО</h1>\n<p>${fio}</p>`;

    divIconFio.appendChild(iconFio);
    divFio.appendChild(divIconFio);
    divFio.appendChild(divLabelFio);

    let divEmail = document.createElement("div");
    divEmail.classList.add("charackteristic-car", "col-lg-6", "col-md-6", "col-6");

    let divIconEmail = document.createElement("div");
    divIconEmail.classList.add("icon-block");
    let iconEmail = document.createElement("img");
    iconEmail.src = "/pages/admin/img/mail.svg";
    iconEmail.alt = "mail";

    let divLabelEmail = document.createElement("div");
    divLabelEmail.classList.add("text-charackteristik");
    divLabelEmail.innerHTML = `<h1>Email</h1>\n<p>${email}</p>`;

    divIconEmail.appendChild(iconEmail);
    divEmail.appendChild(divIconEmail);
    divEmail.appendChild(divLabelEmail);

    let divMessage = document.createElement("div");
    divMessage.classList.add("charackteristic-car", "col-lg-12", "col-md-6", "col-6");

    let divIconMessage = document.createElement("div");
    divIconMessage.classList.add("icon-block");
    let iconMessage = document.createElement("img");
    iconMessage.src = "/pages/admin/img/letter.svg";
    iconMessage.alt = "letter";

    let divLabelMessage = document.createElement("div");
    divLabelMessage.classList.add("text-charackteristik");
    divLabelMessage.innerHTML = `<h1>Сообщение</h1>\n<p>${message}</p>`;
    
    divIconMessage.appendChild(iconMessage);
    divMessage.appendChild(divIconMessage);
    divMessage.appendChild(divLabelMessage);

    divInfo.appendChild(divFio);
    divInfo.appendChild(divEmail);
    divInfo.appendChild(divMessage);
    divCardCar.appendChild(divInfo);
    divFeedback.appendChild(divCardCar);

    document.querySelector("#feedbacks").appendChild(divFeedback);
}