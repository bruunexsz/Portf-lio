// sweet-alert.js

// Função para exibir o SweetAlert2 com base na resposta do AJAX
function exibirSweetAlert(response) {
    if (response && response.message) {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: response.message,
        });
    }
}

// Capturar o evento de envio do formulário e enviar via AJAX
$('form').submit(function(event) {
    // Evitar o comportamento padrão do formulário
    event.preventDefault();
    
    // Referência ao formulário atual
    var form = $(this);
    
    // Requisição AJAX para enviar o formulário
    $.ajax({
        url: form.attr('action'), // URL do endpoint do controlador
        type: form.attr('method'), // Método HTTP do formulário
        data: form.serialize(), // Dados do formulário serializados
        success: function(response) {
            // Exibir o SweetAlert2 com a mensagem de sucesso
            exibirSweetAlert(response);
        },
        error: function(xhr, status, error) {
            // Exibir o SweetAlert2 com a mensagem de erro, se houver
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ocorreu um erro ao processar sua solicitação.',
            });
        }
    });
});
