<html>
<head><title>Gallery</title>
	<style>
		* {font-family: sans-serif; color:#fff;} 
		a, h1, h2, h3, h4, h5 {text-align:center; color:#eee;}
		body {background:#333;}
	</style>

  
  <!-- nanoGALLERY                                                                                                          -->
  <!-- Plugin for jQuery by Christophe Brisbois                                                                             -->
  <!-- Demo & doc: http://nanogallery.brisbois.fr                                                                           -->
  <!-- Sources: https://github.com/Kris-B/nanoGALLERY                                                                       -->
  <!-- License: For personal, non-profit organizations, or open source projects, you may use nanoGALLERY for free.          -->
  <!-- -------- ALL OTHER USES REQUIRE THE PURCHASE OF A PROFESSIONAL LICENSE.                                              -->

  
  <!-- #################################################################################################################### -->
  <!-- jQuery                                                                                                               -->
  <!--                                                                                                                      -->
  <script type="text/javascript" src="third.party/jquery-1.7.1.min.js"></script>
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  -->
  <!-- #################################################################################################################### -->


  <!-- #################################################################################################################### -->
  <!-- nanoGALLERY CSS files                                                                                                -->
  <!-- only include the css file corresponding to the selected theme                                                        -->
  <!-- include 'nanogallery.css' if no theme is specified                                                                   -->
  <!--                                                                                                                      -->
	<!-- nanoGALLERY - default theme css file                                                                                 -->
	<link href="css/nanogallery.css" rel="stylesheet" type="text/css">
	<!-- nanoGALLERY - css file for the theme 'clean'                                                                         -->
	<link href="css/themes/clean/nanogallery_clean.css" rel="stylesheet" type="text/css">
	<!-- nanoGALLERY - css file for the theme 'light'                                                                         -->
	<link href="css/themes/light/nanogallery_light.css" rel="stylesheet" type="text/css">
  <!-- #################################################################################################################### -->

  <!-- #################################################################################################################### -->
	<!-- nanoGALLERY javascript                                                                                               -->
  <!--                                                                                                                      -->
	<script type="text/javascript" src="jquery.nanogallery.js"></script>
  <!--                                                                                                                      -->
  <!-- #################################################################################################################### -->

  

  
  
  
  <!-- #################################################################################################################### -->
	<!-- nanoGALLERY DEMO PANEL javascript - NOT NEEDED TO USE THE PLUGIN                                                     -->
	<script type="text/javascript" src="jquery.nanogallerydemo.js"></script> 
  <!-- #################################################################################################################### -->


  <!-- #################################################################################################################### -->
  <!-- transit.js animation engine - Optionnal                                                                              -->
  <!-- This plugin is used alternatively for all animations (hover effects et image display animations)                     -->
  <!-- warning: not compatible with IE9-                                                                                    -->
  <!--                                                                                                                      -->
  <!--
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.9/jquery.transit.min.js">
  </script>                                 
  -->
  <!-- #################################################################################################################### -->

  
  <!-- #################################################################################################################### -->
  <!-- velocity animation engine - optionnal - JUST FOR TEST PURPOSES / PLEASE DO NOT USE!!!                                -->
  <!--                                                                                                                      -->
  <!-- <script type="text/javascript" src="third.party/velocity/jquery.velocity.min.js"></script>                           -->
	<!-- <script type="text/javascript" src="http://julian.com/research/velocity/build/jquery.velocity.min.js"></script>      -->
  <!-- #################################################################################################################### -->

  
	<script>
		$(document).ready(function () {
    
      // ##################################################################################################################
      // ##### Sample1 - API method #####
      // ##################################################################################################################
			var myColorScheme = {
				navigationbar : {
					background : '#000',
					border : '0px dotted #555',
					color : '#ccc',
					colorHover:'#fff'
				},
				thumbnail : {
					background:'#000',
					border:'1px solid #000',
					labelBackground:'transparent',
					labelOpacity:'0.8',
					titleColor:'#fff',
					descriptionColor:'#eee'
				}
			};
			var myColorSchemeViewer = {
				background:'rgba(1, 1, 1, 0.75)',
				imageBorder:'12px solid #f8f8f8',
				imageBoxShadow:'#888 0px 0px 20px',
				barBackground:'#222',
				barBorder:'2px solid #111',
				barColor:'#eee',
				barDescriptionColor:'#aaa'
			};

      // custom thumbnail hover effect
      function myThumbnailInit($elt, item) {
      }
      function myThumbnailHoverInit($elt, item, data) {
        //$elt.find('.labelDescription').css({'opacity':'0'});

        var $subCon=$elt.find('.subcontainer');
        var th=$elt.outerHeight(true);
        var $iC=$elt.find('.imgContainer');
        var w=$iC.outerWidth(true)/10;
        var h=$iC.outerHeight(true);
        for(var c=0; c<10; c++ ) {
          var s='rect(0px, '+w*(c+1)+'px, '+h+'px, '+w*c+'px)';
          //var $t=$lI.clone().appendTo($subCon).css({'bottom':-(h+c*4), 'clip':s});
          $iC.clone().appendTo($elt.find('.subcontainer')).css({'bottom':0, 'scale':1, 'clip':s, 'left':0, 'position':'absolute'});
          //$t.css({'top':c*2});
        }
        $iC.remove();
      }
      
      function myThumbnailHover($elt, item, data) {
        //$elt.find('.labelDescription').delay(150)[data.animationEngine]({'opacity':'1'},400);
        //$elt.find('.labelDescription').delay(150).animate({'opacity':'1'},400);
        var w=$elt.find('.imgContainer').outerWidth(true)/10;
        $elt.find('.imgContainer').each(function( index ) {
          $(this)[data.animationEngine]({ 'left':(-w*10)+w*index*3, 'scale':2},20000);
          console.log( index*w + ' ' + index+ '-'+w );
        });
      }
      function myThumbnailHoverOut($elt, item, data) {
        //$elt.find('.labelDescription').animate({'opacity':'0'},300);
        var h=$elt.find('.labelImage').outerHeight(true);
        var w=$elt.find('.labelImage').outerWidth(true)/10;
        $elt.find('.labelImage').each(function( index ) {
          $(this)[data.animationEngine]({'bottom':-(h+index*4)});
        });
      }
      
      // custom info button on viewer toolbar
      function myViewerInfo(item, data) {
        alert('Image URL: '+ item.thumbsrc);
      }

			jQuery("#nanoGallery1").nanoGallery({thumbnailWidth:120,thumbnailHeight:120,
			items: [
				{
					src: 'demonstration/image_01.jpg',		// image url
					srct: 'demonstration/image_01t.jpg',	// thumbnail url
					title: 'image 1', 						        // thumbnail title
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					title_FR: 'image 1 (fr)',
					description_FR : 'description image 1 (fr)'
				},
				{
					src: 'demonstration/image_02.jpg',
					srct: 'demonstration/image_02t.jpg',
					title: 'image 2' ,
					description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
					title_FR: 'image 2 (fr)',
					description_FR : 'description image 2 (fr)'
				},
				{
					src: 'demonstration/image_03.jpg',
					srct: 'demonstration/image_03t.jpg',
					title: 'image 3' ,
					//title: 'image 3 - The quick brown fox jumps over the lazy dog - The quick brown fox jumps over the lazy dog',
					title_FR: 'image 3 (fr)',
					description_FR : 'description image 3 (fr)'
				}
				],
				thumbnailHoverEffect:[{name:'imageScaleIn80'},{'name':'descriptionAppear','delay':300},{'name':'borderLighter'}],				
				thumbnailLabel:{display:true,position:'overImageOnBottom'},
        viewerDisplayLogo:true,
        //thumbnailInit:myThumbnailInit,
        //fnThumbnailHoverInit:myThumbnailHoverInit,
        //fnThumbnailHover:myThumbnailHover,
        //fnThumbnailHoverOut:myThumbnailHoverOut,
        theme:'light',
        fnViewerInfo:myViewerInfo
			});

      
      // ##################################################################################################################
			// ##### Sample1a - API method #####
      // ##################################################################################################################
      var contentGallery1a=[
				{
					src: 'demonstration/image_01.jpg',		// image url
					srct: 'demonstration/image_01ts.jpg',	// thumbnail url
					title: 'image 1' 						          // thumbnail title
				},
				{
					src: 'demonstration/image_02.jpg',
					srct: 'demonstration/image_02ts.jpg',
					title: 'image 2'
				},
				{
					src: 'demonstration/image_03.jpg',
					srct: 'demonstration/image_03ts.jpg',
					title: 'image 3'
				}];
			
			jQuery("#nanoGallery1a").nanoGallery({thumbnailWidth:120,thumbnailHeight:120,
				items:contentGallery1a,
				theme:'clean',
				thumbnailHoverEffect:{'name':'imageFlipHorizontal','duration':500},
				useTags:false,
        viewerDisplayLogo:true,
        theme:'clean',
        i18n:{'thumbnailImageDescription':'View Photo', 'thumbnailAlbumDescription':'Open Album'},
				thumbnailLabel:{display:true,position:'overImageOnMiddle', align:'center'},
        colorSchemeViewer:'default'
			});

     
      // ##################################################################################################################
			// ##### Sample2 - inline elements / HREF #####
      // ##################################################################################################################
 			jQuery("#nanoGallery2").nanoGallery({thumbnailWidth:160,thumbnailHeight:160,
				itemsBaseURL:'demonstration',
				thumbnailHoverEffect:[{'name':'scaleLabelOverImage','duration':300},{'name':'borderLighter'}],				
				colorScheme:'clean',
				thumbnailLabel:{display:true,position:'overImageOnTop', align:'center'},
        viewerDisplayLogo:true
			});

      
      // ##################################################################################################################
			// ##### Sample3 - Picasa/Google+ #####
      // ##################################################################################################################
			jQuery("#nanoGallery3").nanoGallery({
        //thumbnailWidth:'auto', thumbnailHeight:200,

        thumbnailL1Width:'140C XS100 SM100', thumbnailL1Height:'140C XS100 SM100',
        thumbnailWidth:'auto', thumbnailHeight:'200 XS80 SM150 LA250 XL290',

        userID: '111186676244625461692',
        //userID:'103482106723589181634', // --> Cyrilic
        kind: 'picasa',
				//maxItemsPerLine:3,
        //album: '5851968929721015169?authkey=CJSlhdKSgoiXtgE',
				//album: '5851968929721015169&authkey=Gv1sRgCJSlhdKSgoiXtgE',
        //album:'5856259539659194001',
        photoSorting: 'random',
        albumSorting: 'random',
        colorScheme: myColorScheme,
        galleryFullpageButton: true,
        //thumbnailLabel:{title:'%filenameNoExt', itemsCount:'title'},
        viewerDisplayLogo: true,
        photoSorting: 'titleAsc',
  			thumbnailHoverEffect:[{'name':'labelOpacity50','duration':300, 'delay':500},{'name':'imageScaleIn80', 'duration':500}]
				//thumbnailHoverEffect: [{'name':'imageScaleIn80','duration':300},{'name':'borderLighter'}]
			});

    
      // ##################################################################################################################
			// ##### Sample3a - Picasa/Google+ #####
      // ##################################################################################################################
      jQuery("#nanoGallery3a").nanoGallery({
        thumbnailWidth:200, thumbnailHeight:100,
        userID:'111186676244625461692',
        kind:'picasa',
				//maxItemsPerLine:3,
				//album: '5852572882905112961',
        //album:'5856259539659194001',
        //album:'5911347863561293937',
        galleryFullpageButton:true,
        galleryFullpageBgColor : '#fff',
        colorScheme:'lightBackground',
        locationHash:false,
        viewerDisplayLogo:true,
				//thumbnailHoverEffect:[{'name':'labelOpacity50','duration':300, 'delay':500},{'name':'imageScaleIn80', 'duration':500}],
				thumbnailHoverEffect:[{'name':'imageScaleIn80', 'duration':500}],
        theme:'light',
        i18n:{'thumbnailImageDescription':'View Photo', 'thumbnailAlbumDescription':'Open Album'},
				thumbnailLabel:{display:true,position:'onBottom'},
        colorSchemeViewer:'default'
        //fnProcessData: fnDemopProcessData,    // javascript custom extension
        //fnViewerInfo: fnDemoViewerInfo        // javascript custom extension
			});
      
      

      function fnDemopProcessData(item, kind, sourceData) {
        if( kind == 'picasa' && item.kind == 'image' ) {
          console.dir(sourceData);
          item.customData.imgOriginalWidth = sourceData.gphoto$width.$t;
          item.customData.imgOriginalHeight = sourceData.gphoto$height.$t;
          var ex = { model: 'na', iso: 'na' }
          if (typeof sourceData.exif$tags !== "undefined"){
            if (typeof sourceData.exif$tags.exif$model !== "undefined" && typeof sourceData.exif$tags.exif$model.$t !== "undefined"){
              ex.model = sourceData.exif$tags.exif$model.$t;
            }
          }
          item.customData.exif = ex;
        }
      }
      
      function fnDemoViewerInfo( item, data ) {
        var s= 'camera: '+item.customData.exif.model + ' / width: '+item.customData.imgOriginalWidth+' / height: '+item.customData.imgOriginalHeight;
        alert(s);
      }

      // ##################################################################################################################
			// ##### Sample4 - Flickr #####
      // ##################################################################################################################
			// thomashawk - user id="51035555243@N01" - 1900 sets
			// Ray Conrado - user id="76715816@N00" - 700 sets
			// LoadStone - user id="9142293@N06"
      // babasteve - 64749744@N00 / 72157644268331557
			// kris_b - 34858669@N00  / 72157594299597591
			jQuery("#nanoGallery4").nanoGallery({userID:'34858669@N00',kind:'flickr',thumbnailWidth:'auto',thumbnailHeight:160,  //110,
        viewerDisplayLogo:true,
        locationHash:false,
        //photoset:'none',//'72157594299597591',
				//thumbnailDisplayInterval:0,
				//thumbnailDisplayTransition:false,
				thumbnailHoverEffect:[{'name':'labelSlideUp','duration':300},{'name':'borderDarker'}],
				//thumbnailLabel:{display:true,position:'onBottom',descriptionMaxLength:200},
				thumbnailLabel:{display:true,position:'overImageOnBottom',descriptionMaxLength:50},
        thumbnailLazyLoad:true,
        theme:'clean',
        colorScheme:'light',
        level1: { thumbnailWidth: 200, thumbnailHeight: 120 }
			});


      // ##################################################################################################################
			// ##### Multi-level navigation (API method) #####
      // ##################################################################################################################
			var contentGalleryMLN=[
				{
					src: 'demonstration/image_01.jpg',		// image url
					srct: 'demonstration/image_01ts.jpg',	// thumbnail url
					title: 'image 01', 						        // thumbnail title
					ID:101
				},
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 02',
					ID:102 },
				{ src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'album 1',
					ID:103,	kind:'album' },
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'album 2',
					ID:104,	kind:'album' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 03' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 04' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 05' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 06' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 07' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 08' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 09' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 10' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 10' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 11' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 12' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 13' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 14' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 15' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 16' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 17' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 18' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 19' },
				{ src: 'demonstration/image_02.jpg', srct: 'demonstration/image_02ts.jpg', title: 'image 20' },
				{ src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 1a',
					albumID:103	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 1b',
					albumID:103	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 1c',
					albumID:103	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 1d',
					albumID:103	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 1e',
					albumID:103 },
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 1f',
					albumID:103	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2a',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2b',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2c',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2d',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2e',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2f',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2g',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2h',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2i',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2j',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2k',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2l',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2m',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2n',
					albumID:104	},
				{	src: 'demonstration/image_03.jpg', srct: 'demonstration/image_03ts.jpg', title: 'image 2o',
					albumID:104	}
        ];
			
			jQuery("#nanoGalleryMLN").nanoGallery({thumbnailWidth:120,thumbnailHeight:120,
				items:contentGalleryMLN,
				//paginationMaxItemsPerPage:3,
				paginationMaxLinesPerPage:1,
				thumbnailHoverEffect:'imageInvisible,imageScale150',
        viewerDisplayLogo:true,
				useTags:false,
        locationHash:false,
        breadcrumbAutoHideTopLevel:true,
        maxItemsPerLine:5
			});
			

      // ##################################################################################################################
			// ##### DEMO PANEL #####
      // ##################################################################################################################
 			jQuery("#nanoGalleryAnimation1").nanoGalleryDemo({thumbnailWidth:120, thumbnailHeight:120, itemsBaseURL:'demonstration',
        viewerDisplayLogo:true
			});

	
		});
	</script>


</head>
<body>

<?php
session_start();
$email = $_POST["email"];

require 'vendor/autoload.php';
use Aws\Rds\RdsClient;
$client = RdsClient::factory(array(
 'version'=>'latest',
'region'  => 'us-east-1'
));

$result = $client->describeDBInstances([
   'DBInstanceIdentifier' => 'jrxdb',
]);

$endpoint = "";
$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
    echo "============\n". $endpoint . "================";

//echo "begin database";
#$link = mysqli_connect($endpoint,"controller","letmein888","customerrecords") or die("Error " . mysqli_error($link));
$link = mysqli_connect($endpoint,"rjing","mypoorphp","itmo544mp1") or die("Error " . mysqli_error($link));

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//below line is unsafe - $email is not checked for SQL injection -- don't do this in real life or use an ORM instead
echo $email gallery;
?>
	<div id="nanoGallery2">
<?php  $link->real_query("SELECT * FROM items WHERE email = '$email'"); ?>
	</div>	
<?php
$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {
    echo "<img src =\" " . $row['s3rawurl'] . "\" /><img src =\"" .$row['s3finishedurl'] . "\"/>";
echo $row['id'] . "Email: " . $row['email'];
}
$link->close();
?>
</body>
</html>
