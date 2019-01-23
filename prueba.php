<?php
class Conexion
{
    protected $db;
    public function __construct()
    {
        $this->db = $this->conectar();
    }
    public function conectar()
    {
        try
        {
          $HOST   = '127.0.0.1';
              $DBNAME = 'cural';
              $USER   = 'root';
              $PASS   = '';
              $con    = new PDO("mysql:host={$HOST}; dbname={$DBNAME}", $USER, $PASS);
              $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $con->exec('SET CHARACTER SET UTF8');
        }
        catch (PDOException $e)
        {
            echo "No se pudo conectar a la BD: " . $e->getMessage();
        }
        return $con;
    }
    protected function ConsultaSimple(string $query): array
    {
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function ConsultaCompleja(array $array): array
    {
        $query  = "SELECT * FROM T002TIPO";
        $result = $this->db->prepare($query);
        $result->execute($array);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function CSCargo(string $query): array
    {
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function CCCargo(array $array): array
    {
        $query  = "SELECT * FROM T002TIPO";
        $result = $this->db->prepare($query);
        $result->execute($array);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

class tipocargos extends Conexion
{
  /*public function __construct()
    {
      parent::__construct();
    }*/
    public function getAll(): array
    {
        $query = "SELECT * FROM T002TIPO ORDER BY nIdTipo ";
        return $this->ConsultaSimple($query);
    }
    public function showTable(array $array): string
    {
        $html = '';
        if (count($array)) {
            $html = '   <table class="table table-striped" id="table">
                        <thead>
                            <th class="d-none"></th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCION</th>
                            <th>OPCIONES</th>
                        </thead>
                        <tbody>
                     ';
            foreach ($array as $value) {
                $html .= '  <tr>
                        <td class="d-none">' . $value['nIdTipo'] . '</td>
                        <td>' . $value['cNomTipo'] . '</td>
                        <td>' . $value['cDesTipo'] . '</td>
                        <td class="text-center">
                            <button title="Editar este usuario" class="editar btn btn-secondary" data-toggle="modal" data-target="#ventanaModal">
                                 Editar USUARIO<i class="fa fa-pencil-square-o"></i>
                            </button>
                            <button title="Eliminar este usuario" type="button" class="eliminar btn btn-danger" data-toggle="modal" data-target="#ventanaModal">
                                Eliminar Usuario<i class="fa fa-trash-o"></i>
                            </button>
                        </td>
                        </tr>
                         ';
            }
            $html .= '  </tbody>
                    </table>';
        } else {
            $html = '<h4 class="text-center">No hay datos...</h4>';
        }
        return $html;
    }
}

class Cargo extends Conexion
{
    public function getSelect(): array
    {
        $query = "SELECT * FROM T002TIPO";
        return $this->CSCargo($query);
        
    }
    public function showSelect(array $array): string
    {
        $listas = '<option value="0">Elige una opción</option>';
        while($row = $array->fetch_array(MYSQLI_ASSOC))
        {
            $listas .= "<option value='$row[nIdTipo]'>$row[cNomTipo]</option>";
        }
        return $listas;
    }
  
}

$mostrarcargo = new Cargo();
$select = $mostrarcargo->getSelect();

echo $mostrarcargo->showSelect($select);

$mostrarconexion = new tipocargos();
$data = $mostrarconexion->getAll();

echo $mostrarconexion->showTable($data); //imprimirá conectado*/

?>
