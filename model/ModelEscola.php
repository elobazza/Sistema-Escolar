<?php

/**
 * Classe de Modelo de Escola.
 * 
 * @author  Eloísa Bazzanella, Maria Eduarda Buzana
 * @package model
 * @sinse   29/12/2020
 */
class ModelEscola {
    
    /** @var ModelUsuario $usuario */
    private $usuario;
    
    private $nome;
    private $contato;
    
    /**
     * @return ModelUsuario
     */
    function getUsuario() {
        if(empty($this->usuario)) {
            $this->usuario = new ModelUsuario();
        }
        return $this->usuario;
    }

    function getNome() {
        return $this->nome;
    }

    function getContato() {
        return $this->contato;
    }

    function setUsuario(ModelUsuario $usuario) {
        $this->usuario = $usuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }
    
}