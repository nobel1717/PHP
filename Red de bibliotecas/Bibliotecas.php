<?php
class Biblioteca {
    public $nombre;
    public $colecciones;
    public $consultasPorAño;

    public function __construct($nombre, $colecciones, $consultasPorAño) {
        $this->nombre = $nombre;
        $this->colecciones = $colecciones;
        $this->consultasPorAño = $consultasPorAño;
    }

    public function totalConsultas() {
        return array_sum($this->consultasPorAño);
    }

    public function consultasPorAño($año) {
        return isset($this->consultasPorAño[$año]) ? $this->consultasPorAño[$año] : 0;
    }
}

class RedBibliotecas {
    private $bibliotecas = [];

    public function agregarBiblioteca(Biblioteca $biblioteca) {
        $this->bibliotecas[] = $biblioteca;
    }

    public function totalConsultasPorAño($año) {
        $total = 0;
        foreach ($this->bibliotecas as $biblioteca) {
            $total += $biblioteca->consultasPorAño($año);
        }
        return $total;
    }
    public function promedioConsultas() {
        $totalConsultas = 0;
        $numAños = 3;
        foreach ($this->bibliotecas as $biblioteca) {
            $totalConsultas += $biblioteca->totalConsultas();
        }
        return $totalConsultas / (count($this->bibliotecas) * $numAños);
    }

    public function imprimirMatriz() {
        $resultado = "<table class='table table-bordered'><thead><tr><th>Biblioteca</th><th>Colecciones</th><th>Año 1</th><th>Año 2</th><th>Año 3</th></tr></thead><tbody>";
        foreach ($this->bibliotecas as $biblioteca) {
            $resultado .= "<tr><td>{$biblioteca->nombre}</td><td>{$biblioteca->colecciones}</td><td>{$biblioteca->consultasPorAño[0]}</td><td>{$biblioteca->consultasPorAño[1]}</td><td>{$biblioteca->consultasPorAño[2]}</td></tr>";
        }
        $resultado .= "</tbody></table>";
        return $resultado;
    }
    public function obtenerBibliotecaPorNombre($nombre) {
        foreach ($this->bibliotecas as $biblioteca) {
            if (strcasecmp($biblioteca->nombre, $nombre) === 0) {
                return $biblioteca;
            }
        }
        return null;
    }
}
?>
