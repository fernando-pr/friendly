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

    /**
     * Devuelve true si el id pasado por parametro pertenece
     *  a un amigo del usuario conectado.
     *
     * @param int $id
     * @return bool
     */
    public function getEsMiAmigo($id)
    {
        return $this->identity->esMiAmigo($id);
    }
    /**
     * Devuelve si se ha recibido una solicitud de amistad del id del usuario
     * pasado por parametro.
     *
     * @param int $id
     * @return bool
     */
    public function meHaEnviadoAmistad($id)
    {
        return $this->identity->meHaEnviadoAmistad($id);
    }

    /**
     * Devuelve si el usuario conectado ha enviado una solicitud al usuario
     * del id pasado por parámetro.
     *
     * @param int $id
     * @return bool
     */
    public function estaPeticionEnviada($id)
    {
        return $this->identity->estaPeticionEnviada($id);
    }

    /**
     * Devuelve el numero de peticiones de amistad que tiene el usuario conectado.
     * @return int
     */
    public function numPeticionesUsuario()
    {

        $peticiones = $this->identity->getPeticiones();

        $validas = [];
        foreach ($peticiones as $peticion) {
            $esAmigo = \Yii::$app->user->getEsMiAmigo($peticion->id);
            $soyYo = \Yii::$app->user->id == $peticion->id;
            if (!$esAmigo && !$soyYo && !$peticion->esAdmin()) {
                $validas[] = $peticion;
            }
        }

        return count($validas);
    }
}
