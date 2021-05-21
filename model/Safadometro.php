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

    /* Definição do método que armazena os valores da classe no banco de dados */
    private function armazena($dataNascimento) {
        /* Cria a instrução SQL de inserção, preparada para receber os valores */
        $stmt = DB::getInstance()->prepare("INSERT INTO `safados` VALUES (:data, :anjo, :vagabundo);");
        /* Atribui os valores a SQL preparada */
        $stmt->bindParam(':data', $dataNascimento);
        $stmt->bindParam(':anjo', $this->anjo);
        $stmt->bindParam(':vagabundo', $this->vagabundo);

        /* Executa a instrução */
        return $stmt->execute();
    }

    /*
        Definição do método que recupera os valores previamente armazenados no banco
        de dados, com base na data de nascimento
    */
    private function recupera($dataNascimento) {
        /* Cria a instrução SQL de busca, preparada para receber os valores */
        $stmt = DB::getInstance()->prepare("SELECT * FROM safados WHERE data = :data;");
        /* Atribui o valor da data a SQL preparada */
        $stmt->bindParam(':data', $dataNascimento);
    
        /* Executa a instrução */
        $stmt->execute();
    
        /* Retorna o array com os resultados */
        return $stmt->fetchAll();
    }

    /* Construtor da classe */
    public function __construct($data) {
        $t = strtotime($data); // Converte a entrada (texto) em uma data válida para o PHP
        // echo date('d/m/Y', $t); // Exemplo de como exibir uma data no padrão brasileiro

        /* Executa a função de recuperação do resultado na base de dados com base na data informada */
        $result = $this->recupera($data);

        /* Caso exista algum resultado com a data de nascimento já cadastrado */
        if ($result) {
            /*
                Atribui os percentuais de anjo e vagabundo de acordo com o valor
                recuperado do banco de dados
            */
            $this->vagabundo = $result[0]['vagabundo'];
            $this->anjo = $result[0]['anjo'];
        }
        /* Caso contrário */
        else {
            $dia = date('d', $t); // Extrai o dia da data informada
            $mes = date('m', $t); // Extrai o mês da data informada (em formato numérico) 
            $ano = date('y', $t); // Extrai o ano da data informada (em formato de dois dígitos, ou seja 2019 seria apenas 19) 

            /* Calcula os percentuais de anjo e vagabundo */
            $this->vagabundo = $this->vagabundo($dia, $mes, $ano); // Calcula o % de vagabundo, usando a função vagabundo
            $this->anjo = $this->anjo($this->vagabundo); // Calcula o % de anjo, usando a função anjo

            /* E armazena o valor no banco de dados */
            $this->armazena($data);
        }
    }
}
