/** con Navigator.onLine*/
/*
var s = document.getElementById('status');

setInterval(function () {
  s.className = navigator.onLine ? 'online' : 'offline';
  s.innerHTML = navigator.onLine ? 'online' : 'offline';  
}, 250);
*/

/** eventos: online, offline */
window.addEventListener('online', function() {    
    document.getElementById("status").innerHTML = "Online";
    document.getElementById("status").classList.add("online");
    document.getElementById("status").classList.remove("offline");
    alert("Conectado");
    alert(isOnline());
    //ChkConnection();
    //res();
}, false);

window.addEventListener('offline', function() {
    document.getElementById("status").innerHTML = "Offline";
    document.getElementById("status").classList.add("offline");
    document.getElementById("status").classList.remove("online");
    alert("No Conectado");
    alert(isOnline());
    //ChkConnection();
    //res();
}, false);

function isOnline(){
    return navigator.onLine;
}




function ChkConnection(){

  var content= UrlFetchApp.fetch("https://www.google.com/", {method: "POST",
          muteHttpExceptions: true});
  var res = content.getResponseCode();
  return res;
 }





const request = async (url) => {
  const response = await fetch(url);
  if (!response.ok)
    throw new Error("WARN", response.status);
  const data = await response.text();
  return data;
}

async function res(){
    const resultOk = await request("www.google.com/robots.txt");
    const resultError = await request("siatinfo.impuestos.gob.bo");
}



