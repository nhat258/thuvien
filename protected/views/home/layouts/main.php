<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/home/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/home/form.css" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/imageTooltip.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/slides.min.jquery.js');
    ?>
    <style type="text/css">
        #header{
            background: url(<?php echo Yii::app()->request->baseUrl?>/images/header-bg.jpg) repeat 0 0;
        }
        #header h1 a {
            float: left;
            background: url(<?php echo Yii::app()->request->baseUrl?>/images/logo.png) no-repeat;
            background-position: top center;
            display: block;
            margin-top: 20px;
            text-indent: -9999px;
            height: 96px;
            width: 245px;
        }
        #menu li {
            float: left;
        }

        #mainnav li li {
            list-style: url(<?php echo Yii::app()->request->baseUrl?>/images/arrow.png) inside;
        }

        #mainnav li li:hover, #mainnav li li.current {
            background: url(<?php echo Yii::app()->request->baseUrl?>/images/right-title.png) no-repeat;
            list-style: url(<?php echo Yii::app()->request->baseUrl?>/images/arrow-hover.png) inside;
        }

        #main-content h3 {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 18px;
            color: #2f2f2f;
            background: url(<?php echo Yii::app()->request->baseUrl?>/images/heading-bg.png) no-repeat bottom;
            padding-bottom: 15px;
            margin: 15px 0;
        }

        #footer-bg {
            background: url(<?php echo Yii::app()->request->baseUrl?>/images/footer-bg.jpg) repeat-x;
        }

        #othernews h3 {
            background: url("<?php echo Yii::app()->request->baseUrl?>/images/heading-bg.png") no-repeat scroll center bottom transparent;
            color: #2F2F2F;
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 18px;
            margin: 15px 0;
            padding-bottom: 15px;
        }
        #menu-bg {
            background: url("<?php echo Yii::app()->request->baseUrl?>/images/menu.jpg") repeat 0 0;
        }
        #main{
            background: url("<?php echo Yii::app()->request->baseUrl?>/images/body.jpg") repeat
        }
    </style>
</head>
<body>
<div id="fb-root"></div>
<script>
    //-----------------------------------------
    (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=413999868678661";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div id="menu-bg">
    <div id="menu">
        <ul>
            <li class="first"><a href="<?php echo $this->createUrl('/')?>" title="Trang chủ"> Trang chủ</a></li>

<!--            <li><a href="--><?php //echo $this->createUrl('/site/CD')?><!--"-->
<!--                   title="Category"> Thể loại</a></li>-->

            <li><a href="<?php echo $this->createUrl('/site/page', array('view' => 'trogiup'))?>"
                   title="Câu hỏi thường gặp"> Trợ giúp</a></li>

            <li class="last"><a href="<?php echo $this->createUrl('/site/page', array('view' => 'lienhe'))?>"
                                title="Liên hệ"> Liên hệ</a></li>
        </ul>
    </div>
</div>
<!--menu-->
    <div id="header">
        <table width="100%">
            <tbody>
            <tr>
                <td valign="top">
                    <h1>
                        <a href="<?php echo $this->createUrl('/')?>" title="Trang chủ" style="margin-top: 0">Trang chủ</a>
                    </h1>
                </td>
                <td align="center">
                    <div id="support" style="width: auto; margin-left: 0; text-align: center;">
                        <table border="0" cellpadding="8">
                            <tbody>
                            <tr>
                                <td colspan="5">
                                    <h3 style="padding-top: 10px;margin-bottom:5px;color:#0044cc">
                                        TRUNG TÂM THÔNG TIN KHOA HỌC VÀ CÔNG NGHỆ ĐÀ NẴNG</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <h1 style="color:#559192">
                                        THƯ VIỆN KHOA HỌC VÀ CÔNG NGHỆ <br/>PHÁT TRIỂN NÔNG THÔN MỚI</h1>
                                    <br />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--header-->
<div id="main">
    <div id="container">
        <!--slide-->
        <div id="right">
            <div>
                <h3>TÌM KIẾM</h3>
                <form action="<?php echo $this->createUrl('/site/search')?>" method="get" >
                    <input type="text" name="v" id="s" placeholder="Tìm kiếm tài liệu" title="Tìm kiếm theo tên" class="blur">
                </form>
                <a href="<?php echo $this->createUrl('/search/admin')?>"title="Tìm kiếm chi tiết"> <b style="font-size: 13px">Tìm kiếm chi tiết</b> </a>
                <br/>
            </div>
            <hr>
            <div id="mainnav">
                <br/>
                <h3>THỂ LOẠI</h3>
                <?php echo Nako::danhsachchuyenmuc();?>
            </div>
            <br/>
            <br/>

            <div class="fb-like-box" data-href="http://facebook.com/techmartdanang.vn" data-width="184" data-show-faces="true"
                 data-stream="false" data-header="true"></div>
            <br/>
            <br/>
            <!-- Histats.com  (div with counter) -->
            <div id="histats_counter"></div>
            <!-- Histats.com  START  (aync)-->
            <script type="text/javascript">var _Hasync = _Hasync || [];
                _Hasync.push(['Histats.start', '1,2245448,4,9,110,60,00011111']);
                _Hasync.push(['Histats.fasi', '1']);
                _Hasync.push(['Histats.track_hits', '']);
                (function () {
                    var hs = document.createElement('script');
                    hs.type = 'text/javascript';
                    hs.async = true;
                    hs.src = ('/');
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                })();



            </script>
            <noscript><a href="http://www.histats.com" target="_blank"><img
                        src="/" alt="web stats" border="0"></a></noscript>
            <!-- Histats.com  END  -->
        </div>
        <!--left-->
        <div id="main-content">
            <?php echo $content;?>
        </div>
        <!--main-content-->
        <div class="clr"></div>
    </div>
    <!--container-->
    <div id="footer-bg">
        <div id="footer">
            <div id="footermenu">
                <a href="<?php echo $this->createUrl('/')?>" title="Trang chủ">
                    Trang chủ</a>
                <span class="space">/</span>
                <a href="<?php echo $this->createUrl('/site/page', array('view' => 'gioithieu'))?>" title="Giới thiệu">
                    Giới thiệu</a>
                <span class="space">/</span>
                <a href="<?php echo $this->createUrl('/site/page', array('view' => 'lienhe'))?>" title="Hoạt động tài trợ">
                    Liên hệ</a>
                <span class="space">/</span>
            </div>
            <div id="copyright" style="width: 240px;">
            </div>
            <div id="bank">
                <p style="padding-top: 2px;">
                    <b>TRUNG TÂM THÔNG TIN KHOA HỌC VÀ CÔNG NGHỆ ĐÀ NẴNG</b>
                </p>
                <ul>
                    <li>
                        <p>
                            51A Lý Tự Trọng - Hải Châu - Đà Nẵng<br/>
                            Điện thoại/ Fax: (+84) 0511 3.898.133  <br/>
                            Email: <a href="mailto:ttttkhcndanang@gmail.com"/>ttttkhcndanang@gmail.com</a> <br/>
                            Website: <a href="http://kcmdanang.org.vn"/>www.kcmdanang.org.vn </p>

                        <div class="clr"></div>
                    </li>
                </ul>
            </div>
            <div id="map" style="">

                <br/>
                <br/>
                <br/>
                <br/>
                <!--      <li><a href="/" target="_blank" style="color: #2E2F2F; font-size: 10px;">
                        Created by Nako 2014.</a> -->
                </li>
                </ul>
            </div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
    <!--footer-bg-->
</div>

<script type="text/javascript">
    $(function () {
        $('#slides').slides({
            play:2000,
            pause:1000,
            hoverPause:true
        });
    });
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-38998923-1']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

    (function($){
        $('.navigation > li').find('ul').each(function(){
            $(this).parent().addClass('lv2');
        })

        $('.lv2 > a').click(function(e){
            e.preventDefault();
            el = $(this);
            if(!el.hasClass('on')){
                $('.on').removeClass('on').next().stop(false,true).slideUp(400);
                el.addClass('on').next().stop(false,true).slideDown(400);
            }else{
                $('.on').removeClass('on').next().stop(false,true).slideUp(400);
            }
        })

    })(jQuery);

</script>
</body>
</html>