<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use app\models\EntryForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo '<ul class="navbar-nav navbar-right nav">';
 echo \app\components\MenuWidget::widget(['tpl'=>'menu']);
    echo '</ul>';



    NavBar::end();

    ?>

    <div class="container">

        <?= $content ?>

      <?php
        Modal::begin([
            'header' => '<h2 id="text_id"></h2>',

        ]);


      $model=new EntryForm();
 $form = ActiveForm::begin(['action' => ['post/index'],'id'=>'form_c']);


      echo "<h4 id=\"messag\"></h4>";
echo $form->field($model, 'reCaptcha')->widget(
    \himiklab\yii2\recaptcha\ReCaptcha2::className(),
    [
        'siteKey' => '6Ld8uqYUAAAAAGaw6PJzS_8MQSfbJ3R6D1bUKe6-', // unnecessary is reCaptcha component was set up
    ]
);
        ?>
        <div class="form-group">
            <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php
         ActiveForm::end();

        Modal::end();
        $js = <<<JS
    $('#form_c').on('beforeSubmit', function(){
        var data = $(this).serialize();
        var url = $(this).attr('action');
         //console.log(data);
        $.ajax({
            url: url,
            type: 'POST',
            dataType:'json',
            data: data,
            success: function(res){
                $('#'+res.select).html(res.text)
                if(res.rz==true){
                    $('#messag').text(' ')
                   
                }
            },
            error: function(){
                alert('Error!');
            }
        }).done(function() {
                
                    console.log("Wow you commented");
                
            })
            .fail(function() {
                 alert('Error 2!');
            });
        return false;
    });
JS;

        $this->registerJs($js);
        ?>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<script>
$("a[data-toggle=modal] ").on('click',function (e) {
    e.preventDefault()
    var id=$(this).attr("data-id")
    $('#text_id').text(id)
    grecaptcha.reset();

})

</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
