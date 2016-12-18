<?php
/**
 * контент Главной страницы
 * Time: 17:25
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\service\PageItems ;
use yii\bootstrap\Modal ;

?>
<?php
$introTab = PageItems::getItemText(['home-introduction']) ;
$introTitle = $introTab['title'] ;
$introContent = $introTab['content'];
// по направлениям работ
//  список из wd-list
$wdTitle = PageItems::getItemText(['wd-list','title']) ;
$wdItems = PageItems::getItemText(['wd-list','content']) ;
$wdImages = PageItems::getItemAttr('img',['wd-list','content']) ;


$i = 1 ;
?>
<div class="umb-grid">
    <div class="grid-section">
        <div>
            <div class='container'>
                <div class="row clearfix">
                    <div class="col-md-12 column">
                        <div>
                            <h3 class="header-title" ><?=$introTitle?></h3>
                            <?=$introContent?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<br/>
<!--</div>-->
<h3 class="header-title" style="text-align: center;"> <?=$wdTitle['text']?> </h3>
<div class="container">
<?php
  function wdItemBuild($wdId,$wdCap,$wdImg,$wdTextPiece) {
      $pTitle = '<strong>' . $wdCap .'</strong>' ;
      $p = Html::tag('p', $pTitle) ;
      $img = Html::img('@web/images/' . $wdImg ,
          ['class'=>'img-responsive img-thumbnail','alt'=>'this is picture']) ;
      $div=Html::tag('div',$img);

      $p1 = Html::tag('p', $wdTextPiece) ;
      $div1 = Html::beginTag('div') . $p .$img . $p1 . Html::endTag('div') ;
//      $a = Html::beginTag('a',['href'=>'#','class'=>'for-click','title'=>'this is refer','data-toggle'=>"modal",'data-target'=>"#myModal"]) .$div1 . Html::endTag('a') ;
      $a = Html::beginTag('a',['href'=>'#','class'=>'for-click','title'=>'this is refer',
              'onclick' => 'wdOnClick("'. $wdId . '")','data-toggle'=>"modal",'data-target'=>"#myModal"]) .$div1 . Html::endTag('a') ;

      return $a ;
  }
  $totalText = '' ;
  $count = 0 ;
  $block = '' ;
  foreach ($wdItems as $wdId => $wdCap) {
      if ($count % 3 == 0) {
          if ($count) {    // закрыть div - row
              $totalText .= $block . Html::endTag('div') ;
          }
           $block = Html::beginTag('div', ['class' => 'row']) ;

      }
      $wdImg = $wdImages[$wdId]  ;
      $wdTextPiece = PageItems::getItemText(['wd-' . $wdId,'pieceText']) ; ;
      $a = wdItemBuild($wdId,$wdCap,$wdImg,$wdTextPiece['text']) ;
      $block .= Html::beginTag('div',['class' => "col-md-4 block"]) .$a . Html::endTag('div')  ;
      $count++ ;
  }
// закрываем div - col-md-4 block и  div - row
$totalText .=  Html::endTag('div') . Html::endTag('div') ;
echo $totalText ;
?>

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">войти</h4>
            </div>
            <div class="modal-body" id="modal-body">
                <div id="modal-insert">
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>

