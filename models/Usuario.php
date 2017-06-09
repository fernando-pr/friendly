<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
* Modelo de la tabla "usuarios".
*
* @property integer $id
* @property string $nombre
* @property string $password
* @property string $email
* @property string $token
* @property string $activacion
* @property string $created_at
*/
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /**
    * @var string Escenario para cuando se crea un usuario
    */
    const ESCENARIO_CREATE = 'create';

    /**
    * @var string Campo de contraseña en el formulario de alta y modificación de usuarios
    */
    public $pass;

    /**
    * @var string Campo de confirmación de contraseña en el formulario de alta y
    * modificación de usuarios
    */
    public $passConfirm;

    /**
    * @var string Campo de archivo de imagen usado para imagen de perfil.
    */
    public $imageFile;

    /**
    * Este método indica el nombre de la tabla que esta asociada al modelo.
    * @return string nombre de la tabla asociada al modelo.
    */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
    * Reglas de validación para el modelo Usuario.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            [['nombre', 'email'], 'required','message' => 'No puedes dejar el campo vacio'],
            [['pass', 'passConfirm'], 'required','message' => 'No puedes dejar el campo vacio', 'on' => self::ESCENARIO_CREATE],
            [['pass'], 'safe'],
            [['email'], 'required'],
            [['poblacion', 'provincia'],'required','message' => 'No puedes dejar el campo vacio','on' => self::ESCENARIO_CREATE],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 15],
            [['email', 'poblacion', 'provincia'], 'string', 'max' => 255],
            [['token', 'activacion'], 'string', 'max' => 32],
            [['nombre'], 'unique', 'message' => 'El nombre ya existe, elige otro'],
            [['passConfirm'], 'confirmarPassword'],
            [['email'], 'email','message' => 'Introduce un email valido'],
            [['imageFile'], 'file', 'extensions' =>  ['png', 'jpg']],
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
    * Busca un Usuario por su id.
    * @param  int  $id id del usuario
    * @return Usuario   el usuario que tenga ese id.
    */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
    * Busca una identidad por un token y un tipo.
    * @param  string  $token
    * @param  string  $type
    * @return mixed
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
    * Devuelve el id del usuario del modelo.
    * @return int id del usuario
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Devuelve la población del usuario.
    * @return string población del usuario
    */
    public function getPoblacion()
    {
        return $this->poblacion;
    }
    /**
    * Devuelve el token del usuario.
    * @return string token del usuario
    */
    public function getAuthKey()
    {
        return $this->token;
    }

    /**
    * Da token nuevos a todos los usuarios de forma aleatoria.
    * @return void.
    */
    public function regenerarToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    /**
    * Devuelve si el token coincide con el token del usuario.
    * @param  string $authKey token dado.
    * @return bool.
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
    * Confirmar contraseña.
    * @param  string  $attribute contraseña a confirmar.
    * @param  array  $params
    * @return void   comprueba que las contraseñas coinciden.
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

    /**
    * Devuelve la ruta a la imagen del usuario si existe,
    * si no existe devuelve la ruta por defecto.
    * @return string la ruta a la imagen.
    */
    public function getImageUrl()
    {
        $uploads = Yii::getAlias('@uploads');
        $ruta = "$uploads/{$this->id}.png";
        return file_exists($ruta) ? "/$ruta" : "/$uploads/default.png";
    }

    /**
    * Compueba si el usuario ya está activado
    * @return bool si esta activado.
    */
    public function getActivado()
    {
        return $this->activacion === null;
    }

    /**
    * Acciones a ejecutar justo el momento antes de
    * registrar un nuevo usuario en la base de datos.
    * @param  bool $insert
    * @return bool    devuelve si se ha guardado los datos correctamente.
    */
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

    /**
    * Devuelve las peticiones de amistad recibidas y no aceptadas todavía.
    * @return mixed devuelve las peticiones recibidas.
    */
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

    /**
    * Devuelve si un usuario dado por el id es amigo del usuario logueado.
    * @param  int  $id id del posible amigo.
    * @return bool    true si el usuario es amigo.
    */
    public function esMiAmigo($id)
    {
        $usuario = self::findOne(['id' => $id]);
        $amigos = self::getAmigosUsuario();

        return in_array($usuario, $amigos);
    }

    /**
    * Devuelve si un usuario ha enviado una solicitud
    * de amistad al usuario logueado.
    * @param  int  $id     id del usuario que envia la solicitud.
    * @return bool     true si ha enviado solicitud de amistad.
    */
    public function meHaEnviadoAmistad($id)
    {
        $cond = ['id_usuario' => $id , 'id_amigo' => Yii::$app->user->id, 'estado' => 'Solicitado'];
        return Amigo::findOne($cond) != null;
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
        return Amigo::findOne($items) != null;
    }

    /**
    * Busca los amigos del usuario logueado y los devuelve
    * @return array array con los amigos del usuario.
    */
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
    * Busca un amigo del usuario logueado según el id dado por parámetro.
    * @param  int  $id_amigo id del amigo a buscar.
    * @return Usuario    usuario amigo.
    */
    public function getAmigoUsuario($id_amigo)
    {
        $id = Yii::$app->user->id;
        $amigo = Amigo::findBySql('select * from amigos where ((id_usuario = ' . $id . ' and id_amigo = ' . $id_amigo . ' ) or (id_usuario = ' . $id_amigo . ' and id_amigo = ' . $id . ')) and estado =' . "'Aceptado'")->one();

        $user_id= null;

        if ($amigo->id_usuario == $id) {
            $user_id = $amigo->id_amigo;
        } else {
            $user_id= $amigo->id_usuario;
        }

        return self::findOne($user_id);
    }

    /**
    * Se encarga de devolver el registro en la tabla amigos entre el usuario
    * logueado y el pasado por paramentro.
    * @param  int  $id_amigo id usuario amigo
    * @return Amigo.
    */
    public function getAmistad($id_amigo)
    {
        $id = Yii::$app->user->id;
        $amigo = Amigo::findBySql('select * from amigos where ((id_usuario = ' . $id . ' and id_amigo = ' . $id_amigo . ' ) or (id_usuario = ' . $id_amigo . ' and id_amigo = ' . $id . ')) and estado =' . "'Aceptado'")->one();


        return $amigo;
    }

    /**
    * Devuelve usuarios.
    *
    * @return \yii\db\ActiveQuery
    */
    public function getUsuarios()
    {
        return $this->hasMany(Amigo::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }

    /**
    * Devuelve amigos del usuario.
    *
    * @return \yii\db\ActiveQuery
    */
    public function getAmigos()
    {
        return $this->hasMany(Amigo::className(), ['id_amigo' => 'id'])->inverseOf('Amigo');
    }

    /**
    * Devuelve conectado.
    *
    * @return \yii\db\ActiveQuery
    */
    public function getConectado()
    {
        return $this->hasOne(Conectado::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }

    /**
    * Devuelve mensajes enviados.
    *
    * @return \yii\db\ActiveQuery
    */
    public function getEnviados()
    {
        return $this->hasMany(Privado::className(), ['id_emisor' => 'id'])->inverseOf('emisor');
    }

    /**
    * Devuelve mensajes recibidos.
    *
    * @return \yii\db\ActiveQuery
    */
    public function getRecibidos()
    {
        return $this->hasMany(Privado::className(), ['id_receptor' => 'id'])->inverseOf('receptor');
    }

    /**
    * Devuelve mensajes publicos.
    * @return \yii\db\ActiveQuery
    */
    public function getPublicos()
    {
        return $this->hasMany(Publico::className(), ['id_usuario' => 'id'])->inverseOf('Usuario');
    }
}
