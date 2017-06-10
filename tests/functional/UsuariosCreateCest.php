<?php
use app\models\Usuario;


class UsuariosCreateCest
{
    /**
    * _before ruta en la que m encuentro al comenzar las pruebas
    * @param  FunctionalTester $I
    * @return void
    */
    public function _before(\FunctionalTester $I)
    {
        //$I->amLoggedInAs(Usuario::findIdentity(2));
        $I->amOnRoute('usuarios/create');
    }

    /**
    * Encargado de comprobar si se esta en create
    * @param  FunctionalTester $I
    * @return void
    */
    public function estoyEnCreate(\FunctionalTester $I)
    {
        $I->wantTo('quiero estar en registrarse');
        $I->see('Nombre', 'label');
        $I->see('Registrar', 'button');
    }


    /**
    * Encargado de comprobar si se registra
    * @param  FunctionalTester $I
    * @return void
    */
    public function registroConNombreRepetido(\FunctionalTester $I)
    {
        $I->wantTo('Registro con nombre repetido');
        $I->submitForm('#form-registro', [
            'Usuario[nombre]' => 'admin',
            'Usuario[pass]' => 'admin',
            'Usuario[passConfirm]' => 'admin',
            'Usuario[email]' => 'email@email.com',
            'Usuario[provincia]' => 'Cádiz',
            'Usuario[poblacion]' => 'Rota',
        ]);
        $I->expectTo('see validations errors');
        $I->seeResponseCodeIs(200);
        $I->see('El nombre ya existe, elige otro');
    }

    /**
    * Encargado de comprobar si se registra con campos vacios
    * @param  FunctionalTester $I
    * @return void
    */
    public function registroConCamposVacios(\FunctionalTester $I)
    {
        $I->wantTo('Intento de registro con campos vacios');
        $I->submitForm('#form-registro', []);
        $I->expectTo('see validations errors');
        $I->seeResponseCodeIs(200);
        $I->see('Nombre', 'label');
        $I->see('Registrar', 'button');
        $I->see('No puedes dejar el campo vacio');
    }



    /**
    * Encargado de comprobar si se registra con email incorrecto
    * @param  FunctionalTester $I
    * @return void
    */
    public function registroConEmailIncorrecto(\FunctionalTester $I)
    {
        $I->wantTo('Intento de registro con email incorrecto');
        $I->submitForm('#form-registro', [
            'Usuario[nombre]' => 'admin2',
            'Usuario[pass]' => 'admin',
            'Usuario[passConfirm]' => 'admin',
            'Usuario[email]' => 'email',
            'Usuario[provincia]' => 'Cádiz',
            'Usuario[poblacion]' => 'Rota',
        ]);
        $I->expectTo('see validations errors');
        $I->seeResponseCodeIs(200);
        $I->dontSee('Entendido', 'button');
        $I->dontSee('Algunas sugerencias...', 'h3');
        $I->see('Nombre', 'label');
        $I->see('Registrar', 'button');
        $I->see('Introduce un email valido');
    }

    /**
    * Encargado de comprobar si se registra correctamente
    * @param  FunctionalTester $I
    * @return void
    */
    public function registroCorrecto(\FunctionalTester $I)
    {
        $I->wantTo('Intento de registro con datos correctos');
        $I->submitForm('#form-registro', [
            'Usuario[nombre]' => 'admin2',
            'Usuario[pass]' => 'admin',
            'Usuario[passConfirm]' => 'admin',
            'Usuario[email]' => 'admin@admin.com',
            'Usuario[provincia]' => 'Cádiz',
            'Usuario[poblacion]' => 'Rota',
        ]);

        $I->seeResponseCodeIs(200);
        $I->dontSeeElement('#form-registro');
        $I->dontSee('Nombre', 'label');
        $I->dontSee('Registrar', 'button');
        $I->see('Entendido', 'button');
        $I->see('Algunas sugerencias...', 'h3');
    }
}
