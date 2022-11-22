<?php

class EmpleadoPermanenteTests extends \PHPUnit\Framework\TestCase
{

    public function crear($fingreso = null, $nombre = "Juan", $apellido = "Gonzalez", $dni = "20333555", $salario = "8000")
    {
        $t = new \App\EmpleadoPermanente($nombre, $apellido, $dni, $salario, $fingreso);
        return $t;
    }

    public function testFechaIngreso()
    {
        $p = $this->crear(new DateTime('2020-10-10'));
        $this->assertEquals("2020-10-10 00:00:00", $p->getFechaIngreso()->format('Y-m-d H:i:s'));
        $p = $this->crear(new DateTime('2020-09-18'));
        $this->assertEquals("2020-09-18 00:00:00", $p->getFechaIngreso()->format('Y-m-d H:i:s'));
    }

    public function testCalcularComision()
    {
        $p = $this->crear(new DateTime('2021-10-10'));
        $this->assertEquals("1%", $p->calcularComision());
        $p = $this->crear(new DateTime('2013-10-10'));
        $this->assertEquals("9%", $p->calcularComision());
    }

    public function testCalcularIngresoTotal()
    {
        $p = $this->crear(new DateTime('2021-10-10'));
        // salario + (salario * antiguedad) / 100
        $this->assertEquals( 8000 + (8000*1) / 100, $p->calcularIngresoTotal());

    }

    public function testCalcularAntiguedad()
    {
        $p = $this->crear(new DateTime('1999-10-10'));
        $this->assertEquals("23", $p->calcularAntiguedad());
        $p = $this->crear(new DateTime('2012-10-10'));
        $this->assertEquals("10", $p->calcularAntiguedad());
    }

    public function testObtenerFechaIngresoSinProporcionarla()
    {
        $p = $this->crear();
        // Si construyo un empleado sin proporcionar la fecha de ingreso, el método getFechaIngreso() retorna la fecha del día
        $hoy = new DateTime();
        $this->assertEquals($hoy->format('Y-m-d'), $p->getFechaIngreso()->format('Y-m-d'));
        //y el método getAntiguedad retorna 0.
        $this->assertEquals(0, $p->calcularAntiguedad());
    }

    public function testConstructConFechaFutura()
    {
        $this->expectException(\Exception::class);
        $p = $this->crear(new DateTime('2023-10-10'));
    }


}


?>