<?php

class DBUtils
{

    public function create($db, $nombre, $apellido, $telefono)
    {
        $stmt = $db->prepare("insert into agenda.users (nombre, apellido, telefono) value (?,?,?)");
        $stmt->execute([$nombre, $apellido, $telefono]);
    }

    public function read($db)
    {
        $stmt = $db->prepare("select * from agenda.users");
        $stmt->execute();

        $salida = "<table>";
        $salida .= "<th>Nombre</th> <th>Apellido</th> <th>Telefono</th>";

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $salida .= "<tr>";
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
        $stmt = $db->prepare("update agenda.users set apellido = ?, telefono = ? where nombre = ?");
        $stmt->execute([$apellido, $telefono, $nombre]);
    }

    public function delete($db, $nombre)
    {
        $stmt = $db->prepare("DELETE FROM agenda.users WHERE nombre = ?");
        $stmt->execute([$nombre]);
    }

    public function find($db, $nombre)
    {
        $stmt = $db->prepare("select * from agenda.users where nombre = ?");
        $stmt->execute([$nombre]);

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if ($row["nombre"] === $nombre) {
                return true;
            } else {
                return false;
            }

        }

    }

}