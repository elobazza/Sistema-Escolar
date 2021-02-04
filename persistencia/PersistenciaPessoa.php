<?php
/**
 * Persistência da Pessoa
 *
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class PersistenciaPessoa extends PersistenciaPadrao {
    
    /** @var ModelPessoa $ModelPessoa */
    private $ModelPessoa;
    
    function getModelPessoa() {
        return $this->ModelPessoa;
    }

    function setModelPessoa($ModelPessoa) {
        $this->ModelPessoa = $ModelPessoa;
    }

        
    public function alterarRegistro() {
        
    }

    public function excluirRegistro($codigo) {
        
    }

    public function inserirRegistro() {
        $aColunas = [
            'nome',
            'cpf',
            'contato',
            'data_nascimento',
            'id_escola'
        ];
        
        $aValores = [
            $this->ModelPessoa->getNome(),
            $this->ModelPessoa->getCpf(),
            $this->ModelPessoa->getContato(),
            $this->ModelPessoa->getData_nascimento(),
            $_SESSION['id']
        ];
        
        
        parent::inserir('pessoa', $aColunas, $aValores);
    }

    public function listarRegistros() {
        
    }

}