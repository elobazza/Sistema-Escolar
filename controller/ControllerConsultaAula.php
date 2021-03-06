<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ControllerConsultaAula extends ControllerPadrao {
    
    /** @var ModelAula $ModelAula */
    private $ModelAula;
    
    /** @var PersistenciaAula $PersistenciaAula */
    private $PersistenciaAula;
    
    /** @var ViewConsultaAula $ViewConsultaAula */
    private $ViewConsultaAula;
    
    function __construct() {
        $this->ModelAula        = new ModelAula();
        $this->PersistenciaAula = new PersistenciaAula();
        $this->ViewConsultaAula = new ViewConsultaAula();
    }

    public function processaExibir() {
        if(Redirecionador::getParametro('indice') && Redirecionador::getParametro('valor')){
            $sIndice = Redirecionador::getParametro('indice');
            $sValor = Redirecionador::getParametro('valor'); 
            $this->ViewConsultaAula->setAulas($this->PersistenciaAula->listarComFiltro($sIndice, $sValor));   
        } else {
            $this->ViewConsultaAula->setAulas($this->PersistenciaAula->listarRegistros());
        }
        $this->ViewConsultaAula->imprime();
    }

    public function processaInserir() {}
    public function processaAlterar() {}
    public function processaExcluir() {}

}