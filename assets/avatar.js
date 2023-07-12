const aSubmit = document.getElementById('avatar_Ajouter');
const aBrowse = document.getElementById('avatar_avatar');
const aTrigger = document.getElementById('userHeader');

aTrigger.addEventListener('click', function(){
    aBrowse.click();
})

aBrowse.addEventListener('change', function(){
    aSubmit.click();
})
