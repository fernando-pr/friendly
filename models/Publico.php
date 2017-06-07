<?php

namespace app\models;

/**
 * TModelo de la tabla "publicos".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property string $mensaje
 * @property string $fecha
 */
class Publico extends \yii\db\ActiveRecord
{
    /**
    * Este método indica el nombre de la tabla que esta asociada al modelo.
    * @return string nombre de la tabla asociada al modelo.
    */
    public static function tableName()
    {
        return 'publicos';
    }

    /**
    * Reglas de validación para el modelo Publico.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            [['id_usuario', 'mensaje'], 'required'],
            [['id_usuario'], 'integer'],
            [['mensaje'], 'string'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
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
            'mensaje' => 'Mensaje',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('publicos');
    }
}
