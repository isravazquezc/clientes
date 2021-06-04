<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\components\GhostNav;
use webvimark\modules\UserManagement\UserManagementModule;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
        'brandLabel' => 'Clientes',
       'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

        $opciones_menu=array();
        $opciones_menu[]=[
            'label'=>'Usuarios',
            'items'=>UserManagementModule::menuItems()
        ];
     
        $opciones_menu[]=['label'=>'Acerca de','url'=>['/site/about'], 'visible'=>true ];
        $opciones_menu[]=['label'=>'Clientes','url'=>['/clientes/index'] ];
        $opciones_menu[]=['label'=>'Productos','url'=>['/productos/index']];
        $opciones_menu[]=['label'=>'Cotizaciones','url'=>['/cotizaciones/index'] ];
        $opciones_menu[]=['label'=>'Contacto', 'url'=>['/site/contact'],'visible'=>true];
    
        if(Yii::$app->user->isGuest)
        {

        $opciones_menu[]=[
        'label'=>'Iniciar Sesion',
        'url'=>['user-management/auth/login'],
        'visible'=>true

        ];
        
        $opciones_menu[]=[
            'label'=>'Registro',
            'url'=>['user-management/auth/registration'],
            'visible'=>true
            ];
        }

        else
        {
            $opciones_menu[]=[
                'label'=>'Salir',
                'url'=>['user-management/auth/logout']
                ];
        }

       
    
    echo GhostNav::widget([
    'encodeLabels'=>false,
    'activateParents'=>true,
    'options'=>['class'=>'navbar-nav'],
    'items'=> $opciones_menu
           
    ]);

  
    
    

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Clientes <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
