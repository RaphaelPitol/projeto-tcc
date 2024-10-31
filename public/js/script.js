document.querySelectorAll('.dropdown-submenu > a').forEach(function (element) {
    element.addEventListener('click', function (e) {
        e.preventDefault();

        // Fechar todos os outros submenus
        document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(function (submenu) {
            if (submenu !== element.nextElementSibling) {
                submenu.style.display = 'none';
            }
        });

        // Alternar exibição do submenu clicado
        var nextEl = this.nextElementSibling;
        if (nextEl && nextEl.classList.contains('dropdown-menu')) {
            nextEl.style.display = (nextEl.style.display === 'block') ? 'none' : 'block';
        }
    });
});

// Evitar que o menu feche quando clicar em um dropdown aninhado
document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
    element.addEventListener('click', function (e) {
        var nextEl = this.nextElementSibling;
        if (nextEl && nextEl.classList.contains('dropdown-menu')) {
            e.stopPropagation(); // Evita o fechamento do dropdown ao abrir o submenu
        }
    });
});

document.querySelectorAll('.dropdown-submenu > a').forEach(function (element) {
    element.addEventListener('click', function (e) {
        e.preventDefault();

        // Fechar outros submenus abertos
        document.querySelectorAll('.dropdown-submenu').forEach(function (submenu) {
            if (submenu !== element.parentElement) {
                submenu.classList.remove('show');
            }
        });

        // Abrir/fechar o submenu clicado
        var parentEl = this.parentElement;
        parentEl.classList.toggle('show');
    });
});

//função para colocar a mascara no cep
document.getElementById('cep').addEventListener('input', function(e) {
    let cep = e.target.value.replace(/\D/g, "");
    cep = cep.replace(/^(\d{2})(\d)/, "$1.$2");
    cep = cep.replace(/(\d{3})(\d{1,3})$/, "$1-$2");
    e.target.value = cep;
});

//Busca os cep na API viacep e preenche o formulario
document.getElementById('cep').addEventListener('blur', function() {
    var cep = this.value.replace(/\D/g, '');
    if (cep.length == 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('logradouro').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                } else {
                    alert('CEP não encontrado.');
                }
            });
    }
});