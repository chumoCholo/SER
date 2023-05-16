let texto = document.getElementById("contenedor").innerText;
document.getElementById("contenedor").innerText = "";
console.log(texto);
const parser = new DOMParser();
const html = parser.parseFromString(texto, 'text/html');
const body = html.body;

let contenedor = document.getElementById("contenedor").appendChild(body);

