/**
 * Created by HP on 4/9/2019.
 */
const input = document.querySelector('.link input');
const btn = document.querySelector('.link button');
const res = document.querySelector('.res');

btn.disabled = true;

input.addEventListener('keydown', validateInput);
input.addEventListener('paste', validateInput);
btn.addEventListener('click', sendLink);

function validateInput(e){
    const r = /^(ftp|http|https):\/\/[^ "]+$/;
    if(!e.clipboardData) {return;}
    let url = e.target.value || e.clipboardData.getData('text');
    btn.disabled = !r.test(url);
}
function sendLink() {

    var payload = input.value;

    var data = new FormData();
    data.append( "url", JSON.stringify( payload ) );

    fetch("link.php",
        {
            method: "POST",
            body: data
        })
        .then(function(res){ return res.json(); })
        .then(function(data){ res.textContent = 'Your short url: ' +data; });
}