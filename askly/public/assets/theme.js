function theme () {
    let theme = getCookie("theme")
    return theme;
}

function switch_theme () {
    if (theme() == "dark") {
        document.cookie = "theme=light; SameSite=None; Secure";
        location.reload();
        console.log('dark')
    } else {
        document.cookie = "theme=dark; SameSite=None; Secure";
        location.reload();
        console.log('light')
    }
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}