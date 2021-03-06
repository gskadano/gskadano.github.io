<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => "Bureau of Internal Revenue's Document Workflow Tracking System",
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
			
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
				$roles = Yii::$app->user->identity->position_id;
				if($roles == 2 || $roles == 8){
					
					$menuItems = [
						['label' => 'Employee', 'visible' => !Yii::$app->user->isGuest, 'url' => ['/user']],
					];
					
					$menuItems[]=['label' => 'Document',
					   'visible' => !Yii::$app->user->isGuest,
						'items' => [
							['label' => 'My Document', 'url' => ['/document']],
							['label' => 'Document Workflow', 'url' => ['/docworkflow']],
							['label' => 'Pending Document', 'url' => ['/pendingdoc']],
						],

					];
					
					$menuItems[]=['label' => 'Others',
						'visible' => !Yii::$app->user->isGuest,
						'items' => [
							['label' => 'Priority', 'url' => ['/priority']],
							['label' => 'Type', 'url' => ['/type']],
							['label' => 'Section', 'url' => ['/section']],
							['label' => 'Position', 'url' => ['/position']],
							['label' => 'Status', 'url' => ['/docstatus']],
							['label' => 'Category', 'url' => ['/category']],
						],

					];
					
					$menuItems[]=['label' => "Govn't Agency",
						'visible' => !Yii::$app->user->isGuest,
						'items' => [
							['label' => 'Government Agencies', 'url' => ['/companyagency']],
							['label' => 'Contact Person', 'url' => ['/agencycperson']],
						],

					];
				}else{
					$menuItems = [
					
					];
					//return Yii::$app->getResponse()->redirect('index.php?r=document');
				}
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
