<?php

namespace app\models;

/**
 * Modelo de la tabla "Conectado".
 *
 * @property integer $id_usuario
 * @property string $instante
 */
class Conectado extends \yii\db\ActiveRecord
{
    /**
    * Este método indica el nombre de la tabla que esta asociada al modelo.
    * @return string nombre de la tabla asociada al modelo.
    */
    public static function tableName()
    {
        return 'conectados';
    }

    /**
    * Reglas de validación para el modelo Conectado.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['instante'], 'safe'],
            [['cookie'], 'safe'],
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
            'id_usuario' => 'Id Usuario',
            'instante' => 'Instante',
            'cookie' => 'Cookie',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario'])->inverseOf('conectado');
    }
}
