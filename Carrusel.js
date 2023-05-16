

let img1 = document.getElementById("img1");
let img2 = document.getElementById("img2");
let img3 = document.getElementById("img3");
let img4 = document.getElementById("img4");

if(localStorage.getItem("img1")!= null &&
    localStorage.getItem("img2")!= null&&
    localStorage.getItem("img3")!= null&&
    localStorage.getItem("img4")!= null){
    img1.setAttribute("src","/Proyecto/mediaP/" +localStorage.getItem("img1"));
    img2.setAttribute("src", "/Proyecto/mediaP/" +localStorage.getItem("img2"));
    img3.setAttribute("src", "/Proyecto/mediaP/" +localStorage.getItem("img3"));
    img4.setAttribute("src", "/Proyecto/mediaP/" +localStorage.getItem("img4"));
    }else{
        console.log("No hay nada");
    }



