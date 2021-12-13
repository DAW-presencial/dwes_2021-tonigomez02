<?php

class DBUtils
{

    public function create($db, $nombre, $apellido, $telefono)
    {
        $id = rand(8,500);
        $stmt = $db->prepare("insert into usuarios values (:id, :nombre,:apellido,:telefono)");
        $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':telefono' => $telefono
        ]);
    }

    public function read($db)
    {
        $stmt = $db->prepare("select * from usuarios");
        $stmt->execute();

        $salida = "<table>";
        $salida .= "<th>Id</th><th>Nombre</th> <th>Apellido</th> <th>Telefono</th>";

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $salida .= "<tr>";
            $salida .= '<td>' . $row["id"] . '</td>';
            $salida .= '<td>' . $row["nombre"] . '</td>';
            $salida .= '<td>' . $row["apellido"] . '</td>';
            $salida .= '<td>' . $row["telefono"] . '</td>';
            $salida .= "</tr>";
        }

        $salida .= "</table>";
        echo $salida;
    }

    public function update($db, $nombre, $apellido, $telefono)
    {
        $stmt = $db->prepare("update usuarios set apellido = :apellido, telefono = :telefono where nombre = :nombre");
        $stmt->execute([
            ':apellido' => $apellido,
            ':telefono' => $telefono,
            ':nombre' => $nombre
        ]);
    }

    public function delete($db, $nombre)
    {
        $stmt = $db->prepare("DELETE FROM usuarios WHERE nombre = :nombre");
        $stmt->execute([':nombre' => $nombre]);
    }

    public function find($db, $nombre)
    {
        $stmt = $db->prepare("select * from usuarios where nombre = :nombre");
        $stmt->execute([
            ':nombre' => $nombre
        ]);

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if ($row["nombre"] === $nombre) {
                return true;
            } else {
                return false;
            }

        }

    }

}