<?php
/**
 * @author Eloísa Bazzanella, Maria Eduarda Buzana
 */
class ViewConsultaNotaTurma extends ViewPadrao {
    
    private $alunos = [];
    private $codProfessorDisciplinaTurma;
    
    function getAlunos() {
        return $this->alunos;
    }

    function setAlunos($alunos) {
        $this->alunos = $alunos;
    }
    
    function getCodProfessorDisciplinaTurma() {
        return $this->codProfessorDisciplinaTurma;
    }

    function setCodProfessorDisciplinaTurma($codProfessorDisciplinaTurma) {
        $this->codProfessorDisciplinaTurma = $codProfessorDisciplinaTurma;
    }    
    
    protected function getConteudo() {        
        switch($_SESSION['tipo']) {
            case 1: {
                return '     
                    <b><p class="titulo">CONSULTA DE NOTAS DA TURMA</p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="consultarNotaAluno(event, '. $this->getCodProfessorDisciplinaTurma() . ')" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Notas</a>
                        </div>
                    </div>
                  ' 
                . $this->montaTabela();
                break;
            }
            case 2: {
                return '     
                    <b><p class="titulo">CONSULTA DE NOTAS DA TURMA </p></b>
                    <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                        <div class="container">
                            <a href="" onclick="consultarNotaAluno(event, '. $this->getCodProfessorDisciplinaTurma() . ')" style="color:white; font-size:18px; margin-right: 20px"> Visualizar Notas</a>
                        </div>
                    </div>
                  ' 
                . $this->montaTabela();
                break;
            }
            case 3: {
             
                break;
            }
        }
    }
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Matricula</th>
                            <th>Aluno</th>
                            <th>Média do Aluno</th>
                        </tr>
                        <tbody>
                        '.$this->createSelect().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelect() {
        $sResult = "";
        
        foreach ($this->alunos as $oAluno) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oAluno->getUsuario()->getCodigo() .'"/></td>
                            <td>' . $oAluno->getMatricula() . '</td>
                            <td>' . $oAluno->getNome() . '</td>
                            <td> 10 </td>
                        </tr>';
        }
        return $sResult;
    }
}
