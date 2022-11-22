<?php
/**
 * @group empleadoeventual
 *
 */
class EmpleadoEventualTests extends \PHPUnit\Framework\TestCase
{

    public function crear($nombre = "Jose", $apellido = "Ramirez", $dni = "20333444", $salario = "5000", $montos = [500, 800])
    {
        $t = new \App\EmpleadoEventual($nombre, $apellido, $dni, $salario, $montos);
        return $t;
    }

    public function testCalcularComision()
    {
        $e = $this->crear();
        // El 5% de cada monto dividido la cantidad de montos (ventas)
        $this->assertEquals((1300/2) * 0.05, $e->calcularComision());
    }

    public function testCalcularIngresoTotal()
    {
        $e = $this->crear();
        $this->assertEquals($e->getSalario() + $e->calcularComision(), $e->calcularIngresoTotal());
    }

    public function testCalcularConstructConVenta0()
    {
        $this->expectException(\Exception::class);
        $e = $this->crear("Jose", "Ramirez", "20333444", "5000", [500, 0]);
    }

    public function testCalcularConstructConVentaNeg()
    {
        $this->expectException(\Exception::class);
        $e = $this->crear("Jose", "Ramirez", "20333444", "5000", [-50, 100]);
    }


}


?>