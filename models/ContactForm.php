<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm es el modelo para el formulario de contacto.
 */
class ContactForm extends Model
{
    /**
    * @var string Campo de nombre en el formulario de contacto.
    */
    public $name;

    /**
    * @var string Campo de email en el formulario de contacto.
    */
    public $email;

    /**
    * @var string Campo de subject en el formulario de contacto.
    */
    public $subject;

    /**
    * @var string Campo de cuerpo del mensaje en el formulario de contacto.
    */
    public $body;

    /**
    * @var string Campo de codigo de verificación en el formulario de contacto.
    */
    public $verifyCode;


    /**
    * Reglas de validación.
    * @return array Devuelve las reglas de validación.
    */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }


     /**
     * Son los nombres de los atributos personalizados.
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Envia un email a la dirección de email especificada usando la
     * información recogida en el modelo.
     *
     * @param string $email dirección de email
     * @return bool si el modelo valida.
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
