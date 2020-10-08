function O(i) {
    return typeof i == 'object' ? i : document.getElementById(i);
}

function S(i) {
    return O(i).style
}

function C(i) {
    return document.getElementsByClassName(i)
}

function fun(){
  var randomColor = Math.floor(Math.random()*16777215).toString(16);
  document.getElementById('changeItem').style.color= "#" + randomColor;
}

function fun2(){
  var img = document.createElement("img");
  img.src = "./img/cursed_image.png";
  document.body.appendChild(img);
  console.log("Fun #2");
}
