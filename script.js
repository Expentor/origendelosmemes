const buttonMenu = document.querySelector(".icono-del-menu");

let menuAbierto = false;

buttonMenu.addEventListener("click",()=>{
	if (!menuAbierto) {
		document.getElementById("menu").style.marginTop = "44px";
		menuAbierto = true;
	} else {
		document.getElementById("menu").style.marginTop = "-80%";
		menuAbierto = false;
	}
})