<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
* This is the model class for table "usuarios".
*
* @property integer $id
* @property string $nombre
* @property string $password
* @property string $email
* @property string $token
* @property string $activacion
* @property string $created_at
*
* @property Amigos[] $amigos
* @property Amigos[] $amigos0
* @property Conectados $conectados
* @property Privados[] $privados
* @property Privados[] $privados0
* @property Publicos[] $publicos
*/
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /**
    * Escenario para cuando se crea un usuario
    * @var string
    */
    const ESCENARIO_CREATE = 'create';

    /**
    * Campo de contraseña en el formulario de alta y modificación de usuarios
    * @var string
    */
    public $pass;
    /**
    * Campo de confirmación de contraseña en el formulario de alta y
    * modificación de usuarios
    * @var string
    */
    public $passConfirm;

    /**
    * [tableName description]
    * @return {[type] [description]
    */
    public $imageFile;
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['nombre', 'email'], 'required'],
            [['pass', 'passConfirm'], 'required', 'on' => self::ESCENARIO_CREATE],
            [['pass'], 'safe'],
            [['email', 'poblacion', 'provincia'], 'required'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 15],
            [['email', 'poblacion', 'provincia'], 'string', 'max' => 255],
            [['token', 'activacion'], 'string', 'max' => 32],
            [['nombre'], 'unique'],
            [['passConfirm'], 'confirmarPassword'],
            [['email'], 'email'],
            [['imageFile'], 'file', 'extensions' =>  ['png', 'jpg']],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'pass' => 'Contraseña',
            'passConfirm' => 'Confirmar contraseña',
            'email' => 'Email',
            'poblacion' => 'Poblacion',
            'provincia' => 'Provincia',
            'token' => 'Token',
            'activacion' => 'Activacion',
            'created_at' => 'Created At',
            'imageFile' => 'Imagen',
        ];
    }

    /**
    * [find    Identity description]
    * @param  [type]  $id [description]
    * @return {[type]     [description]
    */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
    * [findIdentityByAccessToken description]
    * @param  [type]  $token [description]
    * @param  [type]  $type  [description]
    * @return {[type]        [description]
    */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }
    /**
    * Busca un usuario por su nombre.
    *
    * @param string $nombre
    * @return static|null
    */
    public static function buscarPorNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }
    /**
    * @inheritdoc
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * @inheritdoc
    */
    public function getPoblacion()
    {
        return $this->poblacion;
    }
    /**
    * @inheritdoc
    */
    public function getAuthKey()
    {
        return $this->token;
    }

    public function regenerarToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    /**
    * [validateAuthKey description]
    * @param  [type]  $authKey [description]
    * @return {[type]          [description]
    */
    public function validateAuthKey($authKey)
    {
        return $this->token === $authKey;
    }
    /**
    * Validar contraseña.
    *
    * @param string $password contraseña a validar
    * @return bool si la contraseña es válida para el usuario actual
    */
    public function validarPassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
    * [confirmarPassword description]
    * @param  [type]  $attribute [description]
    * @param  [type]  $params    [description]
    * @return {[type]            [description]
    */
    public function confirmarPassword($attribute, $params)
    {
        if ($this->pass !== $this->passConfirm) {
            $this->addError($attribute, 'Las contraseñas no coinciden');
        }
    }

    /**
    * Comprueba si el usuario es administrador.
    * @return bool si el usuario es administrador
    */
    public function esAdmin()
    {

        return $this->nombre === 'admin';
    }

    public function getImageUrl()
    {
        $uploads = Yii::getAlias('@uploads');
        $ruta = "$uploads/{$this->id}.png";
        return file_exists($ruta) ? "/$ruta" : "/$uploads/default.png";
    }


    public function getActivado()
    {
        return $this->activacion === null;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->pass != '' || $insert) {
                $this->password = Yii::$app->security->generatePasswordHash($this->pass);
            }
            if ($insert) {
                $this->regenerarToken();
            }
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            if ($this->imageFile !== null && $this->validate()) {
                $nombre = Yii::getAlias('@uploads/')
                . $this->id . '.' . $this->imageFile->extension;

                $this->imageFile->saveAs($nombre);
                Image::thumbnail($nombre, 90, null)
                ->save($nombre, ['quality' => 50]);
            }
            return true;
        } else {
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            if ($this->imageFile !== null && $this->validate()) {
                $nombre = Yii::getAlias('@uploads/')
                . $this->id . '.' . $this->imageFile->extension;

                $this->imageFile->saveAs($nombre);
                Image::thumbnail($nombre, 90, null)
                ->save($nombre, ['quality' => 50]);
            }
            return false;
        }
    }


    public function getPeticiones()
    {
        $items = ['id_amigo' => Yii::$app->user->id, 'estado' => 'Solicitado'];

        $ids = [];
        $amigos = Amigo::find()->where($items)->all();
        foreach ($amigos as $amigo) {
            $ids[] = $amigo->id_usuario;
        }
        $model = self::findAll($ids);

        return $model;
    }

    public function esMiAmigo($id)
    {
        $usuario = self::findOne(['id' => $id]);
        $amigos = self::getAmigosUsuario();

        return in_array($usuario, $amigos);
    }

    public function meHaEnviadoAmistad($id)
    {
        $cond = ['id_usuario' => $id , 'id_amigo' => Yii::$app->user->id, 'estado' => 'Solicitado'];
        return Amigo::findOne($cond) == null;
    }

    public function estaPeticionEnviada($id)
    {
        $items = ['id_usuario' => Yii::$app->user->id, 'id_amigo' => $id, 'estado' => 'Solicitado'];
        return Amigo::findOne($items) != null;
    }

    public function getAmigosUsuario()
    {
        $id = Yii::$app->user->id;
        $amigos = Amigo::findBySql('SELECT * FROM amigos where (id_usuario = ' . $id . 'or id_amigo = ' . $id . ') and estado =' . "'Aceptado'")->all();
        $user_id = [];
        foreach ($amigos as $amigo) {
            if ($amigo->id_usuario == $id) {
                $user_id[] = $amigo->id_amigo;
            } else {
                $user_id[] = $amigo->id_usuario;
            }
        }

        return self::findAll($user_id);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUsuarios()
    {
        return $this->hasMany(Amigo::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAmigos()
    {
        return $this->hasMany(Amigo::className(), ['id_amigo' => 'id'])->inverseOf('Amigo');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getConectado()
    {
        return $this->hasOne(Conectado::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEnviados()
    {
        return $this->hasMany(Privado::className(), ['id_emisor' => 'id'])->inverseOf('emisor');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getRecibidos()
    {
        return $this->hasMany(Privado::className(), ['id_receptor' => 'id'])->inverseOf('receptor');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getPublicos()
    {
        return $this->hasMany(Publico::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }
}
