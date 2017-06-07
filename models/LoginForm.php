<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuario;

/**
 * LoginForm es el modelo para el formulario de login.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    /**
    * @var string Campo de nombre de usuario en el formulario de login.
    */
    public $username;

    /**
    * @var string Campo contraseña en el formulario de login.
    */
    public $password;

    /**
    * @var string Campo remember me en el formulario de login.
    */
    public $rememberMe = true;

    /**
    * @var string usuario $_user.
    */
    private $_user = false;


    /**
    * Reglas de validación.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
    * Son los nombres de los atributos personalizados.
    * @return array
    */
    public function attributeLabels()
    {
        return [
            'username' => 'Nombre',
            'password' => 'Contraseña',
            'rememberMe' => 'Recuérdame',
        ];
    }

    /**
     * Valida la contraseña.
     * Este método valida la contraseña en el formulario de login.
     *
     * @param string $attribute atributo actual a ser validado.
     * @param array $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validarPassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * loguea un usuario usando su nombre y su contraseña.
     * @return bool true si el usuario es logueado correctamente.
     */
    public function login()
    {
        if ($this->validate()) {
            $usuario = $this->getUser();
            if (!$usuario->activado) {
                Yii::$app->session->setFlash(
                    'fracaso',
                    'Usuario aún no validado.'
                );
                return false;
            }
            return Yii::$app->user->login($usuario, $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Busca un usuari por su nombre.
     *
     * @return Usuario|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::buscarPorNombre($this->username);
        }

        return $this->_user;
    }
}
