const aSubmit = document.getElementById('avatarSubmit');
const aBrowse = document.getElementById('avatarInput');
const aTrigger = document.getElementById('userHeader');

aTrigger.addEventListener('click', function(){
    aBrowse.click();
})

aBrowse.addEventListener('change', function(){
    aSubmit.click();
})
