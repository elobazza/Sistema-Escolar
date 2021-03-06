<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ControllerEscola extends ControllerPadrao{
    
    /** @var ModelEscola $ModelEscola */
    private $ModelEscola;
    
    /** @var ModelUsuario $ModelUsuario */
    private $ModelUsuario;
    
    /** @var ModelEndereco $ModelEndereco */
    private $ModelEndereco;
    
    /** @var PersistenciaEscola $PersistenciaEscola */
    private $PersistenciaEscola;
    
    /** @var PersistenciaUsuario $PersistenciaUsuario */
    private $PersistenciaUsuario;
    
    /** @var PersistenciaEndereco $PersistenciaEndereco */
    private $PersistenciaEndereco;
        
    /** @var ViewCadastroEscola $ViewCadastroEscola */
    private $ViewCadastroEscola;
    
    function __construct() {
        $this->ModelEscola          = new ModelEscola();
        $this->ModelEndereco        = new ModelEndereco();
        $this->ModelUsuario         = new ModelUsuario();
        $this->PersistenciaEscola   = new PersistenciaEscola();
        $this->PersistenciaUsuario  = new PersistenciaUsuario();
        $this->PersistenciaEndereco = new PersistenciaEndereco();
        $this->ViewCadastroEscola   = new ViewCadastroEscola();
    }
    public function processaAlterar() {
        if(Redirecionador::getParametro('efetiva') == 1) {
            if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('contato'))
            && !empty(Redirecionador::getParametro('cidade')) && !empty(Redirecionador::getParametro('login'))
            && !empty(Redirecionador::getParametro('senha')) && !empty(Redirecionador::getParametro('estado'))
            && !empty(Redirecionador::getParametro('bairro')) && !empty(Redirecionador::getParametro('rua'))){
                
                $this->ModelUsuario->setLogin(Redirecionador::getParametro('login'));
                $this->ModelUsuario->setSenha(Redirecionador::getParametro('senha'));       

                $this->PersistenciaUsuario->setModelUsuario($this->ModelUsuario);
                $this->PersistenciaUsuario->alterarRegistro();

                $this->ModelEndereco->setCodigo($this->PersistenciaEndereco->getIdEnderecoEscolaLogada());
                $this->ModelEndereco->setEstado(Redirecionador::getParametro('estado'));
                $this->ModelEndereco->setCidade(Redirecionador::getParametro('cidade'));
                $this->ModelEndereco->setBairro(Redirecionador::getParametro('bairro'));
                $this->ModelEndereco->setRua(Redirecionador::getParametro('rua'));
                $this->ModelEndereco->setNumero(Redirecionador::getParametro('numero'));
                $this->ModelEndereco->setComplemento(Redirecionador::getParametro('complemento'));

                $this->PersistenciaEndereco->setModelEndereco($this->ModelEndereco);
                $this->PersistenciaEndereco->alterarRegistro();
                
                $this->ModelEscola->setNome(Redirecionador::getParametro('nome'));
                $this->ModelEscola->setContato(Redirecionador::getParametro('contato'));

                $oUsuario  = $this->PersistenciaUsuario->selecionarLogin($this->ModelUsuario->getLogin(), $this->ModelUsuario->getSenha());
                $oEndereco = $this->PersistenciaEndereco->selecionar($this->ModelEndereco);

                $this->ModelEscola->setUsuario($oUsuario);
                $this->ModelEscola->setEndereco($oEndereco);
                $this->PersistenciaEscola->setModelEscola($this->ModelEscola);
                $this->PersistenciaEscola->alterarRegistro();    
                header('Location:index.php?pg=telaPrincipal');
            }
            $this->processaExibir();
        }
        
        else {
           $oEscola = $this->PersistenciaEscola->selecionar(Redirecionador::getParametro('codigo'));
           $this->ViewCadastroEscola->setEscola($oEscola);
           $this->ViewCadastroEscola->setAlterar(1);
           $this->processaExibir();
        }
    }
    
    public function processaExibir() { 
        $this->ViewCadastroEscola->imprime();
    }

    public function processaExcluir() {
        $this->PersistenciaEscola->excluirRegistro(Redirecionador::getParametro('codigo'));
        header('Location:index.php?pg=escola');
        $this->processaExibir();
    }

    public function processaInserir() {        
        if(!empty(Redirecionador::getParametro('nome')) && !empty(Redirecionador::getParametro('contato'))
        && !empty(Redirecionador::getParametro('cidade')) && !empty(Redirecionador::getParametro('login'))
        && !empty(Redirecionador::getParametro('senha')) && !empty(Redirecionador::getParametro('estado'))
        && !empty(Redirecionador::getParametro('bairro')) && !empty(Redirecionador::getParametro('rua'))){
                            
            $this->ModelUsuario->setLogin(Redirecionador::getParametro('login'));
            $this->ModelUsuario->setSenha(Redirecionador::getParametro('senha'));
            $this->ModelUsuario->setTipo(1);        

            $this->PersistenciaUsuario->setModelUsuario($this->ModelUsuario);
            $this->PersistenciaUsuario->inserirRegistro();

            $this->ModelEndereco->setEstado(Redirecionador::getParametro('estado'));
            $this->ModelEndereco->setCidade(Redirecionador::getParametro('cidade'));
            $this->ModelEndereco->setBairro(Redirecionador::getParametro('bairro'));
            $this->ModelEndereco->setRua(Redirecionador::getParametro('rua'));
            $this->ModelEndereco->setNumero(Redirecionador::getParametro('numero'));
            $this->ModelEndereco->setComplemento(Redirecionador::getParametro('complemento'));
            
            $this->PersistenciaEndereco->setModelEndereco($this->ModelEndereco);
            $this->PersistenciaEndereco->inserirRegistro();
            
            $this->ModelEscola->setNome(Redirecionador::getParametro('nome'));
            $this->ModelEscola->setContato(Redirecionador::getParametro('contato'));
            
            $oUsuario  = $this->PersistenciaUsuario->selecionarLogin($this->ModelUsuario->getLogin(), $this->ModelUsuario->getSenha());
            $oEndereco = $this->PersistenciaEndereco->selecionar($this->ModelEndereco);
            
            $this->ModelEscola->setUsuario($oUsuario);
            $this->ModelEscola->setEndereco($oEndereco);
            $this->PersistenciaEscola->setModelEscola($this->ModelEscola);
            $this->PersistenciaEscola->inserirRegistro();    
            
//            header('Location:index.php?pg=login&acao=logar');
             header('Location:index.php?pg=login');
        }
        $this->processaExibir();
    }

}
