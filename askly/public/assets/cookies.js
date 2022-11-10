function accept() {
    document.cookie = "consent=true; SameSite=None; Secure";
    location.reload();
}

function deny () {
    document.cookie = "consent=false; SameSite=None; Secure";
    location.reload();
}