document.querySelectorAll(".dropdown-submenu > a").forEach(function (element) {
    element.addEventListener("click", function (e) {
        e.preventDefault();

        // Fechar todos os outros submenus
        document
            .querySelectorAll(".dropdown-submenu .dropdown-menu")
            .forEach(function (submenu) {
                if (submenu !== element.nextElementSibling) {
                    submenu.style.display = "none";
                }
            });

        // Alternar exibição do submenu clicado
        var nextEl = this.nextElementSibling;
        if (nextEl && nextEl.classList.contains("dropdown-menu")) {
            nextEl.style.display =
                nextEl.style.display === "block" ? "none" : "block";
        }
    });
});

// Evitar que o menu feche quando clicar em um dropdown aninhado
document.querySelectorAll(".dropdown-menu a").forEach(function (element) {
    element.addEventListener("click", function (e) {
        var nextEl = this.nextElementSibling;
        if (nextEl && nextEl.classList.contains("dropdown-menu")) {
            e.stopPropagation(); // Evita o fechamento do dropdown ao abrir o submenu
        }
    });
});

document.querySelectorAll(".dropdown-submenu > a").forEach(function (element) {
    element.addEventListener("click", function (e) {
        e.preventDefault();

        // Fechar outros submenus abertos
        document
            .querySelectorAll(".dropdown-submenu")
            .forEach(function (submenu) {
                if (submenu !== element.parentElement) {
                    submenu.classList.remove("show");
                }
            });

        // Abrir/fechar o submenu clicado
        var parentEl = this.parentElement;
        parentEl.classList.toggle("show");
    });
});

//função para colocar a mascara no cep
document.getElementById("cep").addEventListener("input", function (e) {
    let cep = e.target.value.replace(/\D/g, "");
    cep = cep.replace(/^(\d{2})(\d)/, "$1.$2");
    cep = cep.replace(/(\d{3})(\d{1,3})$/, "$1-$2");
    e.target.value = cep;
});

//Busca os cep na API viacep e preenche o formulario
document.getElementById("cep").addEventListener("blur", function () {
    var cep = this.value.replace(/\D/g, "");
    if (cep.length == 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then((response) => response.json())
            .then((data) => {
                if (!data.erro) {
                    document.getElementById("logradouro").value =
                        data.logradouro;
                    document.getElementById("bairro").value = data.bairro;
                    document.getElementById("cidade").value = data.localidade;
                } else {
                    alert("CEP não encontrado.");
                }
            });
    }
});

//função para colocar a mascara no CNPJ
document.getElementById("cnpj").addEventListener("input", function (e) {
    let cnpj = e.target.value.replace(/\D/g, ""); // Remove caracteres não numéricos
    cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
    e.target.value = cnpj;
});

//Função para buscar dados do CNPJ
document.getElementById("cnpj").addEventListener("blur", function () {
    console.log("blur event fired");
    let cnpj = this.value.replace(/\D/g, ""); // Remove a máscara antes de buscar
    console.log(cnpj)
    if (cnpj.length === 14) {
        // Verifica se o CNPJ tem 14 dígitos
        fetch(`/api/buscar-cnpj/${cnpj}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "OK") {
                    // Preenchendo os campos com os dados retornados
                    document.getElementById("name").value = data.fantasia || "";
                    document.getElementById("razao_social").value =
                        data.nome || "";
                    document.getElementById("logradouro").value =
                        data.logradouro || "";
                    document.getElementById("bairro").value = data.bairro || "";
                    document.getElementById("cidade").value =
                        data.municipio || "";
                    document.getElementById("numero").value = data.numero || "";
                    document.getElementById("cep").value = data.cep || "";
                    document.getElementById("email").value = data.email || "";
                    document.getElementById("telefone").value = data.telefone || "";
                } else {
                    alert("CNPJ não encontrado.");
                }
            })
            .catch((error) => {
                console.log("Erro ao buscar o CNPJ:", error);
                alert("Erro ao buscar o CNPJ.");
            });
    } else {
        alert("Por favor, insira um CNPJ válido.");
    }
});
