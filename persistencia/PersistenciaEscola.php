<?php

/**
 * Classe de Persistência de Escola.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package persistencia
 * @sinse   29/12/2020
 */
class PersistenciaEscola extends PersistenciaPadrao{
    
    /** @var ModelEscola $ModelEscola */
    private $ModelEscola;
    
    function getModelEscola() {
        return $this->ModelEscola;
    }

    function setModelEscola($ModelEscola) {
        $this->ModelEscola = $ModelEscola;
    }

    public function alterarRegistro() {
        $sUpdate = 'UPDATE ESCOLA
                       SET nome      = \''.$this->ModelEscola->getNome().'\' ,
                           contato   = \''.$this->ModelEscola->getContato().'\' 
                     WHERE id_escola ='.$this->ModelEscola->getUsuario()->getCodigo().' ';
        
         pg_query($this->conexao, $sUpdate); 
    }

    public function excluirRegistro($codigo) {
        $sDelete = 'DELETE FROM ESCOLA WHERE ID_ESCOLA = '.$codigo.'';
        pg_query($this->conexao, $sDelete);
    }

    public function inserirRegistro() {        
        $aColunas = [
            'id_escola',
            'nome',
            'contato'
        ];
        
        $aValores = [
            $this->ModelEscola->getUsuario()->getCodigo(),
            $this->ModelEscola->getNome(),
            $this->ModelEscola->getContato()
        ];
        
        parent::inserir('escola', $aColunas, $aValores);
    }

    public function listarRegistros() {
        $sSelect = 'SELECT *  
                      FROM ESCOLA
                      JOIN USUARIO
                        ON id_escola = id_usuario';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEscolas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEscola  = new ModelEscola();
            $oUsuario = new ModelUsuario();
            
            $oEscola->setContato($aLinha['contato']);
            $oEscola->setNome($aLinha['nome']);
            
            $oUsuario->setCodigo($aLinha['id_escola']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            $oEscola->setUsuario($oUsuario);
            
            $aEscolas[] = $oEscola;
        }
        return $aEscolas;
    }
    
    public function listarComFiltro($sIndice, $sValor) {
        $sSelect = 'SELECT *
                      FROM ESCOLA 
                      JOIN USUARIO
                        ON id_usuario = id_escola
                     WHERE '.$sIndice.' = \''.$sValor.'\';' ;
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEscolas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEscola  = new ModelEscola();
            $oUsuario = new ModelUsuario();
            
            $oEscola->setContato($aLinha['contato']);
            $oEscola->setNome($aLinha['nome']);
            
            $oUsuario->setCodigo($aLinha['id_escola']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            $oEscola->setUsuario($oUsuario);
            
            $aEscolas[] = $oEscola;
        }        
        return $aEscolas;
    }
    
    public function selecionar($codigo) {
        $sSelect = 'SELECT * 
                      FROM ESCOLA 
                     WHERE id_escola = '.$codigo.'';
        
        $oResultadoEscola = pg_query($this->conexao, $sSelect);
        $oEscola          = new ModelEscola();
        $oUsuario         = new ModelUsuario();
        
        while ($aLinha = pg_fetch_array($oResultadoEscola, null, PGSQL_ASSOC)){
            $oEscola->setContato($aLinha['contato']);
            $oEscola->setNome($aLinha['nome']);
            
            $oUsuario->setCodigo($aLinha['id_escola']);
            $oUsuario->setLogin($aLinha['login']);
            $oUsuario->setSenha($aLinha['senha']);
            $oUsuario->setTipo($aLinha['tipo']);
            
            $oEscola->setUsuario($oUsuario);
        }
        return $oEscola;
    }
    
    //FALTANTES
    
    public function listarEscolasPorProfessor($codigo) {
        $sSelect = 'SELECT TBESCOLA.*
                      FROM SISTEMAESCOLA.TBESCOLA 
                      JOIN SISTEMAESCOLA.TBPROFESSORESCOLA ON
                           TBESCOLA.ESCCODIGO = TBPROFESSORESCOLA.ESCCODIGO
                     WHERE TBPROFESSORESCOLA.PROCODIGO = '.$codigo.';';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aEscolas = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){
            $oEscola = new ModelEscola();
            $oCidade = new ModelCidade();
            $oEscola->setCodigo($aLinha['esccodigo']);
            $oEscola->setNome($aLinha['escnome']);
            $oEscola->setEndereco($aLinha['escendereco']);
            $oEscola->setContato($aLinha['esccontato']);
            $oEscola->setLogin($aLinha['esclogin']);
            
            $oCidade->setCodigo($aLinha['cidcodigo']);
            $oEscola->setCidade($oCidade);
            
            $aEscolas[] = $oEscola;
        }
        
        return $aEscolas;
    }
    
}