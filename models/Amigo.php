<?php

namespace app\models;

use Yii;

/**
* Modelo de la tabla "amigos".
*
* @property integer $id
* @property integer $id_usuario
* @property integer $id_amigo
*/
class Amigo extends \yii\db\ActiveRecord
{
    /**
    * @var string nombre
    */
    public $nombre;

    /**
    * Este método indica el nombre de la tabla que esta asociada al modelo.
    * @return string nombre de la tabla asociada al modelo.
    */
    public static function tableName()
    {
        return 'amigos';
    }

    /**
    * Reglas de validación para el modelo Amigo.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            [['id_usuario', 'id_amigo', 'estado'], 'required'],
            [['id_usuario', 'id_amigo'], 'integer'],
            [['estado'], 'string', 'max' => 30],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado' => 'estado']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_amigo'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_amigo' => 'id']],
        ];
    }

    /**
    * Son los nombres de los atributos del modelo.
    * @return array
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'id_amigo' => 'Id Amigo',
            'estado' => 'Estado',
        ];
    }

    /**
    * Devuelve si un usuario dado por el id es amigo del usuario logueado.
    * @param  int  $id id del posible amigo.
    * @return bool    true si el usuario es amigo.
    */
    public function esMiAmigo($id)
    {
        $usuario = Usuario::findOne(['id' => $id]);
        $usr = new Usuario();
        $amigos = $usr->getAmigosUsuario();

        return in_array($usuario, $amigos);
    }

    /**
    * comprueba si el usuario conectado ha enviado una solicitud de
    * amistad al usuario dado por parametro.
    * @param  int  $id id del usuario que recibe la solicitud.
    * @return bool   true si la petición ya está enviada.
    */
    public function estaPeticionEnviada($id)
    {
        $items = ['id_usuario' => Yii::$app->user->id, 'id_amigo' => $id, 'estado' => 'Solicitado'];
        return self::findOne($items) != null;
    }

    /**
    * Devuelve si un usuario ha enviado una solicitud
    * de amistad al usuario logueado.
    * @param  int  $id     id del usuario que envia la solicitud.
    * @return bool     true si ha enviado solicitud de amistad.
    */
    public function estaPeticionRecibida($id)
    {
        $items = ['id_usuario' => $id, 'id_amigo' => Yii::$app->user->id, 'estado' => 'Solicitado'];
        return self::findOne($items) != null;
    }
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['estado' => 'estado'])->inverseOf('amigos');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('usuarios');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAmigo()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_amigo'])->inverseOf('amigos');
    }
}
