<?php

/**
 * LoginFormCest se encarga de las pruebas relacionadas con el formulario de login
 */
class LoginFormCest
{
    /**
     * _before ruta en la que m encuentro al comenzar las pruebas
     * @param  FunctionalTester $I
     * @return void
     */
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    /**
     * Encargado de comprobar si se esta en login
     * @param  FunctionalTester $I
     * @return void
     */
    public function estoyEnLogin(\FunctionalTester $I)
    {
        $I->wantTo('Estar en login');
        $I->see('Login');
        $I->see('Registrate');
    }

    /**
     * Encargado de comprobar si hace login como admin
     * @param  FunctionalTester $I
     * @return void
     */
    public function loginComoAdmin(\FunctionalTester $I)
    {
        $I->wantTo('login como administrador');
        $I->amLoggedInAs(\app\models\Usuario::findIdentity(1));
        $I->amOnPage('/');
        $I->see('Usuarios');
        $I->see('Conectados');
    }

    /**
     * Encargado de comprobar si hace login como usuario
     * @param  FunctionalTester $I
     * @return void
     */
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        $I->wantTo('login como usuario');
        $I->amLoggedInAs(\app\models\Usuario::findIdentity(2));
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('Personas cerca');
        $I->see('Buscar', 'button');
    }

    /**
     * Encargado de comprobar el resultado de intentar hacer
     * login con credenciales vacias
     * @param  FunctionalTester $I
     * @return void
     */
    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->wantTo('credenciales vacias');
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->seeResponseCodeIs(200);
        $I->see('Nombre no puede estar vacio');
        $I->see('Contraseña no puede estar vacia');
    }

    /**
     * Encargado de comprobar el resultado de intentar hacer
     * login con credenciales falsas
     * @param  FunctionalTester $I
     * @return void
     */
    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->wantTo('Login con datos falsos');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->seeResponseCodeIs(200);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
        $I->see('Login');
        $I->see('Registrate');
        $I->dontSeeElement('usuarios');
    }

    /**
     * Encargado de comprobar el resultado de hacer
     * login con credenciales verdaderas
     * @param  FunctionalTester $I
     * @return void
     */
    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->wantTo('Login con datos validos');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->seeResponseCodeIs(200);
        $I->see('Usuarios');
        $I->see('Conectados');
        $I->dontSeeElement('form#login-form');
    }
}
