 <?php

/*
  Início da definição da classe, com a palavra reservada class, seguida do nome
  da classe
*/
class Safadometro {
    /* Definição dos atributos da classe */
    public $anjo;
    public $vagabundo;

    /* Definição do método para cálculo do somatório */
    private function somatorio($num) {
        return ($num + 1) * $num / 2;
    }
    
    /* Definição do método que calcula o percentual de vagabundo */
    private function vagabundo($dia, $mes, $ano) {
        return $this->somatorio($mes) + ($ano / 100) * (50 - $dia);
    }
    
    /* Definição do método que calcula o percentual de anjo */
    private function anjo($vagabundo) {
        return 100 - $vagabundo;
    }

    /* Construtor da classe */
    public function __construct($data) {
        $t = strtotime($data); // Converte a entrada (texto) em uma data válida para o PHP
        // echo date('d/m/Y', $t); // Exemplo de como exibir uma data no padrão brasileiro

        $dia = date('d', $t); // Extrai o dia da data informada
        $mes = date('m', $t); // Extrai o mês da data informada (em formato numérico) 
        $ano = date('y', $t); // Extrai o ano da data informada (em formato de dois dígitos, ou seja 2019 seria apenas 19) 

        /* Calcula os percentuais de anjo e vagabundo */
        $this->vagabundo = $this->vagabundo($dia, $mes, $ano); // Calcula o % de vagabundo, usando a função vagabundo
        $this->anjo = $this->anjo($this->vagabundo); // Calcula o % de anjo, usando a função anjo
    }
}
