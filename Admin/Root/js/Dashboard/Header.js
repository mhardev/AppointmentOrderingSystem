$(document).ready(function(){
    $('#themeSwitch').change(function(){
        const notif = $("#notif");
        const profile = $("#profile");
        if (this.checked) {
            document.body.classList.toggle('dark-mode-variables');
            notif.removeClass("btn-light");
            notif.addClass("btn-dark");
            profile.removeClass("btn-light");
            profile.addClass("btn-dark");
        }else{
            document.body.classList.toggle('dark-mode-variables');
            notif.removeClass("btn-dark");
            notif.addClass("btn-light");
            profile.removeClass("btn-dark");
            profile.addClass("btn-light"); 
        }
        
    })
})