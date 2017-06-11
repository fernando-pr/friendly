<?php

/* @var $this yii\web\View */


$this->title = 'Sobre nosotros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row caja_principal">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad">
            <div class="panel panel-info caja_perfil">
                <div class="panel-heading">

                    <h4 class="panel-title">Sobre nosotros:</h4>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class=" col-md-9 col-lg-9 ">
                                <div itemscope itemtype="http://schema.org/Organization">
                                    <br>
                                    <fieldset>
                                        <legend><h4>Descripcion</h4></legend>
                                        <span itemprop="legalName">
                                            Friendly
                                        </span>
                                        <span itemprop="alternateName">
                                            (Red social Friendly)
                                        </span>

                                        <span itemprop="description">
                                            Es una red social en la que podrás encontrar personas cerca de
                                            donde te encuentras, encontrar amigos y hacer nuevos amigos.
                                            Friendly es un proyecto en el que estamos orgullosos de trabajar y
                                            en el que hemos puesto mucho esfuerzo y entusiasmo.
                                            Nuestra aplicación web es totalmente gratuita y es uno de los
                                            proyectos integrados del IES Doñana en el año 2017.
                                        </span>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend><h4>Datos de la empresa</h4></legend>
                                        Logo:<span itemprop="image"> <img src="/logo.png" alt="Logo" title="Logo" width="20"></span>
                                        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                            Ubicado en
                                            <span itemprop="streetAddress"> avenida de huelva s/n, </span>
                                            <br>
                                            población:
                                            <span itemprop="addressLocality">Sanlúcar de Barrameda, </span>
                                            <br>
                                            C.P:
                                            <span itemprop="postalCode"> 11540, </span>
                                            <br>
                                            Tlf:
                                            <span itemprop="telephone">956123123.</span>
                                            <br>
                                            <p>
                                                Te puedes poner en contacto con nosotros por email (<span itemprop="email">soportefriendly@gmail.com</span>).
                                            </p>
                                            Nuestra web en la nube:
                                            <span itemprop="url">
                                                <a href="https://friendly-fernando3287.herokuapp.com"><code>https://friendly-fernando3287.herokuapp.com</code></a>
                                            </span>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend><h4>Datos de Interés</h4></legend>
                                        <div itemprop="founder" itemscope itemtype="http://schema.org/Person">
                                            Fundado por:
                                            <span itemprop="name"> Fernando</span>
                                        </div>


                                        <div itemprop="employee" itemscope itemtype="http://schema.org/Person">
                                            Colaboradores:
                                            <span itemprop="name">Fernando</span>
                                        </div>
                                    </fieldset>

                                </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
