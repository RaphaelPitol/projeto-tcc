<?php

namespace App\Validador;

class Validador
{


    /**
     * Valida um CPF.
     * @param string $cpf
     * @return bool
     */
    public static function validarCPF($cpf)
    {
        // Remove caracteres especiais
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (ex.: 11111111111), o que é inválido
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Validação do primeiro dígito verificador
        $soma = 0;
        for ($i = 0, $peso = 10; $i < 9; $i++, $peso--) {
            $soma += $cpf[$i] * $peso;
        }
        $resto = ($soma * 10) % 11;
        $digito1 = $resto == 10 ? 0 : $resto;

        if ($cpf[9] != $digito1) {
            return false;
        }

        // Validação do segundo dígito verificador
        $soma = 0;
        for ($i = 0, $peso = 11; $i < 10; $i++, $peso--) {
            $soma += $cpf[$i] * $peso;
        }
        $resto = ($soma * 10) % 11;
        $digito2 = $resto == 10 ? 0 : $resto;

        if ($cpf[10] != $digito2) {
            return false;
        }

        return true;
    }

    /**
     *  @param string $password
     * @return bool
     */
    public static function validarSenha($password)
    {
        // Expressão regular para validar a senha
        $pattern = '/^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/';

        // Retorna true se a senha corresponder ao padrão, caso contrário, false
        return preg_match($pattern, $password) === 1;
    }
}
