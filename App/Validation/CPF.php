<?php 
namespace App\Validation;

//metodo que recebe como argumento   um cpf e valida pra ver se ele é um cpf valido
class Cpf {
    /**
     * Metodo responsavel para verificar se um cpf é valido
     *
     * @param string $cpf
     * @return boolean
     */
    public static function validar($cpf)
    {
        //obtem somente numeros
        $cpf = preg_replace('/\D/', '', $cpf);
 
        //verifica se ele tem 11 digitos quantidade de caracteres
        if (strlen($cpf) != 11) {
            return false;
        }

        //digito verificador, base numerica para calcular os digitos verificadores
        $cpfValidacao = substr($cpf, 0,9);

        //calcula os digitos verificadores e concatena com a base 
        //numerica e verifica o cpf enviado com os digitos verificadores calculado pela classe

        $cpfValidacao .= self::calcularDigitoVerificador($cpfValidacao);
        $cpfValidacao .= self::calcularDigitoVerificador($cpfValidacao);

        //compara o cpf calculado com o cpf enviado
        return $cpfValidacao == $cpf;
        //return true;
    }


    /**
     * Metodo para calcular um digito verificador com base em uma sequencioa de numeros
     *
     * @param string $base
     * @return string
     */
    public static function calcularDigitoVerificador($base) 
    {
        //variaveis auxiliares
        $tamanho = strlen($base);
        $multiplicador = $tamanho + 1;
        
        /**
         * Calculo matematico para se obter o digito verificador
         * ex: se os nove primeiros numeros do cpf fosse 123456789 multiplaca-se por 10 e decrementa a multiplicacao a casa novo numero
         * 1x10 2x9 3x8 4x7 5x6 6x5 7x4 8x3 9x2 dai soma os resultados
         */

         $soma = 0;

         //ITERA OS NUMEROS DO CPF
          for($i = 0; $i < $tamanho; $i++)
          {
            $soma += $base[$i] * $multiplicador;
            $multiplicador--;
          }

          //resto da divisao para saber um dos digitos verificadores usa % para obter o resto da divisao
          $resto = $soma % 11;

          //caso for 0 ou 1 o digito senao subtrai de 11 e retona o digito verificador

          return $resto > 1 ? 11 - $resto : 0;

    }
}

?>