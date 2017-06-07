<?php

namespace app\models;

use Yii;

/**
 * Modelo de la tabla "privados".
 *
 * @property integer $id
 * @property integer $id_emisor
 * @property integer $id_receptor
 * @property string $mensaje
 * @property string $fecha
 */
class Privado extends \yii\db\ActiveRecord
{
    /**
    * Este método indica el nombre de la tabla que esta asociada al modelo.
    * @return string nombre de la tabla asociada al modelo.
    */
    public static function tableName()
    {
        return 'privados';
    }

    /**
    * Reglas de validación para el modelo Privado.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            [['id_emisor', 'id_receptor', 'mensaje'], 'required'],
            [['id_emisor', 'id_receptor'], 'integer'],
            [['mensaje'], 'string'],
            [['fecha'], 'safe'],
            [['id_emisor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_emisor' => 'id']],
            [['id_receptor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_receptor' => 'id']],
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
            'id_emisor' => 'Id Emisor',
            'id_receptor' => 'Id Receptor',
            'mensaje' => 'Mensaje',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * Devuelve los mensajes privados enviados o recividos entre el usuario
     * logueado y el usuario dado por parámetros.
     * @param  int  $id_amigo id del amigo
     * @return Privado        mensajes privados.
     */
    public function getMensajesUsuario($id_amigo)
    {
        $id_mio = Yii::$app->user->id;
        $mensajes = Privado::findBySql('SELECT * FROM privados where (id_emisor = ' . $id_mio . 'and id_receptor = ' . $id_amigo . ') or (id_emisor = ' . $id_amigo . 'and id_receptor = ' . $id_mio . ')')->all();


        return $mensajes;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmisor()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_emisor'])->inverseOf('enviados');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceptor()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_receptor'])->inverseOf('recibidos');
    }
}
