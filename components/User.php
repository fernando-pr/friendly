<?php

namespace app\components;

class User extends \yii\web\User
{
    /**
    * Comprueba si el usuario es administrador.
    * @return bool si el usuario es administrador
    */
    public function getEsAdmin()
    {
        return ($this->identity) ? $this->identity->esAdmin() : false;
    }

    public function getEsMiAmigo($id)
    {
        return $this->identity->esMiAmigo($id);
    }

    public function meHaEnviadoAmistad($id)
    {
        return $this->identity->meHaEnviadoAmistad($id);
    }

    public function estaPeticionEnviada($id)
    {
        return $this->identity->estaPeticionEnviada($id);
    }

    public function numPeticionesUsuario()
    {

        $peticiones = $this->identity->getPeticiones();

        $validas = [];
        foreach ($peticiones as $peticion) {
            $esAmigo = \Yii::$app->user->getEsMiAmigo($peticion->id);
            $soyYo = \Yii::$app->user->id == $peticion->id;
            if (!$esAmigo && !$soyYo && !$peticion->esAdmin()){
                $validas[] = $peticion;
            }
        }

        return count($validas);
    }
}
