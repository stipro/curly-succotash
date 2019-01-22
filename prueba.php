<?php
class Conexiones
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
              $DBNAME = 'personas';
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
    protected function ConsultaCompleja(string $where, array $array): array
    {
        $query  = "SELECT * FROM informacion {$where}";
        $result = $this->db->prepare($query);
        $result->execute($array);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
  }

  class tipocargos extends Conexiones
  {

    /*public function __construct()
    {
      parent::__construct();
    }*/
    public function getAll(): array
    {
        $query = "SELECT * FROM informacion ORDER BY nombre ";
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
                            <th>PAÍS</th>
                            <th>EDAD</th>
                            <th>OPCIONES</th>
                        </thead>

                        <tbody>
                     ';
            foreach ($array as $value) {
                $html .= '  <tr>
                        <td class="d-none">' . $value['id'] . '</td>
                        <td>' . $value['nombre'] . '</td>
                        <td>' . $value['pais'] . '</td>
                        <td>' . $value['edad'] . '</td>
                        <td class="text-center">
                            <button title="Editar este usuario" class="editar btn btn-secondary" data-toggle="modal" data-target="#ventanaModal">
                                 <i class="fa fa-pencil-square-o"></i>
                            </button>

                            <button title="Eliminar este usuario" type="button" class="eliminar btn btn-danger" data-toggle="modal" data-target="#ventanaModal">
                                <i class="fa fa-trash-o"></i>
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

$mostrarconexion = new tipocargos();
$data = $mostrarconexion->getAll();
$mostrarconexion->showTable($data); //imprimirá conectado*/
?>
