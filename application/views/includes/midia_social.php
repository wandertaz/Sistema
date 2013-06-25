<div style="border-top:thin solid #9c9c9c;" class="ver-mais-artigos">                    	
     Compartilhar:<br/>
    <!--<a  href="https://www.facebook.com/sharer/sharer.php?
u=http://netmb.com.br/site/noticias/noticias_abertas?id_noticia=2">-->
        
<a onclick="shareFunc('','titulo','descricao','http://mediaserver.almg.gov.br/acervo/328/672328.jpg');" style="cursor:pointer; text-decoration:underline;">
        
         <!--<img src="<? echo base_url(); ?>assets/img/icon-facebook-black.png">-->
    <img src="<? echo base_url(); ?>assets/img/facebook_comp.gif" width="70px">
</a>                       	
    <!-- <a href="#">
         <img src="<? echo base_url(); ?>assets/img/icon-twitter-black.png">
     </a> --> 
    
    
  
    <a href="https://twitter.com/share" class="twitter-share-button" data-text="" data-lang="pt" data-count="none" data-dnt="true">
   
    </a>
    
    
 </div>




<script>
//<![CDATA[
function shareFunc(href, title, desc, img){
        var urlpag= $(location).attr('href');	
        var url1 = "https://www.facebook.com/sharer/sharer.php?u=";
	var url2 = encodeURIComponent(urlpag+"?" + "t=" + title + "&i=" + img + "&d=" + desc + "&u=" + urlpag); 
	var url = url1 + "" + url2;
	//alert(url);
	window.open(url,"Compartilhar","width=550,height=600,left=300,top=200");
}
//]]>
</script>

<script>
!function(d,s,id){

   var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
    if(!d.getElementById(id)){       
        js=d.createElement(s);        
        js.id=id;js.src=p+'://platform.twitter.com/widgets.js';         
        fjs.parentNode.insertBefore(js,fjs);
    }
}
(
document, 'script', 'twitter-wjs'
);
</script>