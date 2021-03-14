

function autoLoad() {
    $.ajax({
        url: 'load-msg.php',
        success: function(data) {
            $('.content-msg').html(data);
            scrollBar()
        }
    });
}

let box = document.querySelector('.content-msg');
box.scrollTop = box.scrollHeight;

function scrollBar(){
    let box = document.querySelector('.content-msg');
    box.scrollTop = box.scrollHeight;}


    $(document).ready(function() {
    //autoLoad();
    setInterval(() => {
        autoLoad()
    }, 3000);
});

//bouton envoyer bloque l'actualisation form 

function sendMessage() {
    $.post('minichat-post.php',{
        //pseudo: $('#pseudo'). val(),
        msg: $('#message'). val(),
        //color: $('#color'). val()
    }, function(){
        //document.querySelector('#pseudo').value=''
        document.querySelector('#message').value=''
        //document.querySelector('#color').value=''
        autoLoad()
    }
    )
}


//envoyer les donnees du form
//recupérer les données
//et lance la fonction autoload

//si je veux mettre un formulaire
//$("#cpa-form").submit(function(e){
  //  e.preventDefault();
  //});



