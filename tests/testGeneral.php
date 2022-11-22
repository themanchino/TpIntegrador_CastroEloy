<?php


class EmpleadosTests extends \PHPUnit\Framework\TestCase
{

    public function crearEventual($nombre = "Jose", $apellido = "Ramirez", $dni = "20333444", $salario = "5000", $montos = [500, 500])
    {
        $t = new \App\EmpleadoEventual($nombre, $apellido, $dni, $salario, $montos);
        return $t;
    }
    public function crearPermanente($fingreso = null, $nombre = "Juan", $apellido = "Gonzalez", $dni = "20333555", $salario = "8000")
    {
        $t = new \App\EmpleadoPermanente($nombre, $apellido, $dni, $salario, $fingreso);
        return $t;
    }

    public function testRecibirNombreApellido()
    {
        $e = $this->crearEventual("Jose", "Ramirez");
        $this->assertEquals("Jose Ramirez", $e->getNombreApellido());
        $p = $this->crearPermanente(new DateTime(), "Juan", "Gonzalez");
        $this->assertEquals("Juan Gonzalez", $p->getNombreApellido());
    }

    public function testRecibirDNI()
    {
        $e = $this->crearEventual();
        $this->assertEquals("20333444", $e->getDNI());
        $p = $this->crearPermanente();
        $this->assertEquals("20333555", $p->getDNI());
    }

    public function testRecibirSalario()
    {
        $e = $this->crearEventual();
        $this->assertEquals("5000", $e->getSalario());
        $p = $this->crearPermanente();
        $this->assertEquals("8000", $p->getSalario());
    }


    public function testSectorMethods()
    {
        $e = $this->crearEventual();
        $e->setSector("A");
        $this->assertEquals("A", $e->getSector());
        $e->setSector("B");
        $this->assertEquals("B", $e->getSector());
        $p = $this->crearPermanente();
        $p->setSector("C");
        $this->assertEquals("C", $p->getSector());
        $p->setSector("D");
        $this->assertEquals("D", $p->getSector());
    }

    public function testToString()
    {
        $e = $this->crearEventual();
        $this->assertEquals("Jose Ramirez 20333444 5000", $e->__toString());
        $p = $this->crearPermanente();
        $this->assertEquals("Juan Gonzalez 20333555 8000", $p->__toString());
    }

    // Probar que si intento construir un empleado con el nombre vacío, lanza una excepción.
    public function testCrearSinNombreEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("");
    }
    public function testCrearSinNombrePermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "");
    }

    // Probar que si intento construir un empleado con el apellido vacío, lanza una excepción.
    public function testCrearSinApellidoEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("Jose", "");
    }
    public function testCrearSinApellidoPermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "Juan", "");
    }

    //Probar que si intento construir un empleado con el dni vacío, lanza una excepción.
    public function testCrearSinDNIEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("Jose", "Ramirez", "");
    }
    public function testCrearSinDNIPermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "Juan", "Gonzalez", "");
    }

    //Probar que si intento construir un empleado con el salario vacío, lanza una excepción.
    public function testCrearSinSalarioEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("Jose", "Ramirez", "20333444", "");
    }
    public function testCrearSinSalarioPermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "Juan", "Gonzalez", "20333555", "");
    }

    //Probar que si intento construir un empleado con el dni vacío, lanza una excepción.
    public function testCrearSinDNICharsEventual()
    {
        $this->expectException(\Exception::class);
        $e = $this->crearEventual("Jose", "Ramirez", "20A333444");
    }
    public function testCrearSinDNICharsPermanente()
    {
        $this->expectException(\Exception::class);
        $p = $this->crearPermanente(new DateTime(), "Juan", "Gonzalez", "20333#555");
    }

    //Probar que si, al intentar construir un empleado, no se especifica el sector, el método getSector debe devolver la cadena “No especificado”.
    public function testInitGetSector()
    {
        $e = $this->crearEventual();
        $this->assertEquals("No especificado", $e->getSector());
        $p = $this->crearPermanente();
        $this->assertEquals("No especificado", $p->getSector());
    }

}

?>