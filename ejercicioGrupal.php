<?php
// Se necesitan crear las validaciones de los campos de registro de una aplicación bancaria.

// Sabemos que los campos de ese registro son:

// nombre
// apellidos
// dirección (con CP)
// email y campo de confirmación
// dni
// contraseña
// Los campos requieren las siguientes comprobaciones:

// nombre: todos los nombres deben empezar por mayúscula y el campo no admite número o símbolos, únicamente letra.
// apellidos: todos los apellidos deben empezar por mayúsculas y el campo no admite números o símbolos.
// dirección (con CP): el formato es tipo vía/nombre vía, número, resto de datos, código postal, población y país (se parados por comas).
// email y campo de confirmación: el email y la confirmación de email deben contener los mismos caracteres.
// dni: debe ser un DNI válido
// contraseña: Mínimo 8 caracteres y máximo 20, debe contener al menos una mayúscula, al menos una minúscula, al menos dos números y al menos un símbolo.
// Todos los campos son obligatorios, por tanto debería proporcionar un mensaje de error en el caso de que cualquiera de los campos esté vacío.

// IMPORTANTE: Usa git/github para realizar el trabajo en grupo.

// PISTAS:

// Ya existe un algoritmo para saber si un DNI es válido.
// La función predefinida ord devuelve el valor ASCII de una caracter.
// Las funciones count o sizeof te devuelven la longitud de un array.
// La función strlen te devuelve la longitud de una cadena de caracteres.
//___________________________________________________________________________________________________________________________________________

class Bank {
    // Propiedades
    protected $name;
    protected $lastname;
    protected $address;
    protected $email;
    protected $emailConfirmed;
    protected $dni;
    protected $password;

    // Constructor
    public function __construct($name, $lastname, $address, $email, $emailConfirmed, $dni, $password) {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->address = $address;
        $this->email = $email;
        $this->emailConfirmed = $emailConfirmed;
        $this->dni = $dni;
        $this->password = $password;
    }

    // Función para validar nombre
    public function validateName($name) {
        if (ctype_alpha($name) && ctype_upper(substr($name, 0, 1))) {
            return true;
        } else {
            return false;
        }
    }

    // Función para validar apellidos
    public function validateLastname($lastname) {
        if (ctype_alpha($lastname) && ctype_upper(substr($lastname, 0, 1))) {
            return true;
        } else {
            return false;
        }
    }

    // Función para validar dirección
    public function validateAddress($address) {
        $pattern = '/^[A-Za-z\s\/]+,\s*\d+\s*,\s*[A-Za-z\s\d\/]+,\s*\d{5},\s*[A-Za-z\s]+,\s*[A-Za-z\s]+$/';

        if (preg_match($pattern, $address)) {
            return true;
        } else {
            return false;
        }
    }

    // Función para validar email y confirmación
    public function validateEmail($email, $emailConfirmed) {
        return ($email === $emailConfirmed);
    }

    // Función para validar DNI
    public function validarDNI($dni) {
        $dni = strtoupper($dni);

        if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            return false;
        }

        $numero = substr($dni, 0, 8);
        $letra = substr($dni, 8, 1);

        $letrasValidas = "TRWAGMYFPDXBNJZSQVHLCKE";

        $indice = $numero % 23;
        $letraEsperada = $letrasValidas[$indice];

        return ($letra === $letraEsperada);
    }

    // Función para validar contraseña
    public function validatePassword($password) {
        // Verificar longitud
        if (strlen($password) < 8 || strlen($password) > 20) {
            return false;
        }

        // Verificar mayúsculas, minúsculas, números y símbolos
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d.*\d/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            return false;
        }

        return true;
    }
}




