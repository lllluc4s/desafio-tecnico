// Define 3 segundos para esconder a mensagem de erro
setTimeout(function () {
    let errorDiv = document.querySelector('.error');
    if (errorDiv) {
        errorDiv.style.display = 'none';
    }
}, 3000);
