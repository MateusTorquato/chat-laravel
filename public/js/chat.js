var mensagens = [];
var usuariosAtivos = [];
var autoScroll = true;
var usuarioLogado = $('#usuario_logado').val();
$(document).ready(function () {
  $("#card-mensagens").scrollTop($("#card-mensagens")[0].scrollHeight);
  $('#btn-enviar-chat').on('click', function() {
    $.ajax({
      type: "POST",
      url: $('#asset').val() + 'chat/enviar',
      data: {mensagem: $('#input-msg').val()},
      dataType: "json",
      success: function (response) {
        $('#input-msg').val('');
        loadMessages();
      }
    });
  });
  loadMessages(true);
  window.setInterval(function(){
    loadMessages();
  }, 5000);

  $('#card-mensagens').scroll(function() {
    autoScroll =  $(this).scrollTop() + $(this).innerHeight() >= ($(this)[0].scrollHeight-10);
  });
});


function loadMessages(loading) {
  if (loading) {
    loadingOpen();
  }
  $.ajax({
    type: "GET",
    url: $('#asset').val() + 'chat/get_messages',
    dataType: "json",
    success: function (response) {
      if (mensagens.length != response.mensagens.length) {
        response.mensagens.splice(0, mensagens.length);
        response.mensagens.forEach(mensagem => {
          mensagens.push(mensagem);
          let cardBody = $('<div>').addClass("chat-body clearfix");
          if (mensagem.user.id == usuarioLogado) {
            cardBody.css('background-color', 'lightgray');
          }
          let userMsg = $('<strong>').addClass("primary-font").text(mensagem.user.name);
          userMsg.appendTo($('<div>').addClass("header").appendTo(cardBody));
          $('<p>').text(mensagem.body).appendTo(cardBody)
          cardBody.appendTo('#card-mensagens');
        });
        if (autoScroll) {
          $("#card-mensagens").scrollTop($("#card-mensagens")[0].scrollHeight);
        }
      }
      if (usuariosAtivos.length != response.usuarios_ativos.length) {
        $('#list-participantes').html('');
        usuariosAtivos = [];
        response.usuarios_ativos.forEach(user => {
          usuariosAtivos.push(user);
          $('<li>').text(user.name).appendTo('#list-participantes');
        });
      }
      loadingClose();
    }
  });
}
