<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MB - Pesquisa Online</title>
  <style type="text/css">
    /* Based on The MailChimp Reset INLINE: Yes. */  
    /* Client-specific Styles */
    #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
    body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;} 
    /* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/ 
    .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */  
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
    /* Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */ 
    #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
    /* End reset */

    /* Some sensible defaults for images
    Bring inline: Yes. */
    img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} 
    a img {border:none;} 
    .image_fix {display:block;}

    /* Yahoo paragraph fix
    Bring inline: Yes. */
    p {margin: 1em 0;}

    /* Hotmail header color reset
    Bring inline: Yes. */
    h1, h2, h3, h4, h5, h6 {color: white !important;text-decoration: none !important;}

    h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: white !important;text-decoration: none !important;}

    h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
    color: white !important; /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
	text-decoration: none !important;
    }

    h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
    color: white !important; /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */
	text-decoration: none !important;
    }

    /* Outlook 07, 10 Padding issue fix
    Bring inline: No.*/
    table td {border-collapse: collapse;}

    /* Remove spacing around Outlook 07, 10 tables
    Bring inline: Yes */
    table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

    /* Styling your links has become much simpler with the new Yahoo.  In fact, it falls in line with the main credo of styling in email and make sure to bring your styles inline.  Your link colors will be uniform across clients when brought inline.
    Bring inline: Yes. */
    a {color: #F8931F;}


    /***************************************************
    ****************************************************
    MOBILE TARGETING
    ****************************************************
    ***************************************************/
    @media only screen and (max-device-width: 480px) {
      /* Part one of controlling phone number linking for mobile. */
      a[href^="tel"], a[href^="sms"] {
            text-decoration: none;
            color: blue; /* or whatever your want */
            pointer-events: none;
            cursor: default;
          }

      .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
            text-decoration: default;
            color: orange !important;
            pointer-events: auto;
            cursor: default;
          }

    }

    /* More Specific Targeting */

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
    /* You guessed it, ipad (tablets, smaller screens, etc) */
      /* repeating for the ipad */
      a[href^="tel"], a[href^="sms"] {
            text-decoration: none;
            color: blue; /* or whatever your want */
            pointer-events: none;
            cursor: default;
          }

      .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
            text-decoration: default;
            color: orange !important;
            pointer-events: auto;
            cursor: default;
          }
    }

    @media only screen and (-webkit-min-device-pixel-ratio: 2) {
    /* Put your iPhone 4g styles in here */ 
    }

    /* Android targeting */
    @media only screen and (-webkit-device-pixel-ratio:.75){
    /* Put CSS for low density (ldpi) Android layouts in here */
    }
    @media only screen and (-webkit-device-pixel-ratio:1){
    /* Put CSS for medium density (mdpi) Android layouts in here */
    }
    @media only screen and (-webkit-device-pixel-ratio:1.5){
    /* Put CSS for high density (hdpi) Android layouts in here */
    }
    /* end Android targeting */

  </style>

  <!-- Targeting Windows Mobile -->
  <!--[if IEMobile 7]>
  <style type="text/css">
  
  </style>
  <![endif]-->   

  <!-- ***********************************************
  ****************************************************
  END MOBILE TARGETING
  ****************************************************
  ************************************************ -->

  <!--[if gte mso 9]>
    <style>
    /* Target Outlook 2007 and 2010 */
    </style>
  <![endif]-->
</head>
<body>
<!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable" align="center">
  <tr>
    <td valign="top"> 
    <!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->
    


    <table cellpadding="0" cellspacing="0" border="0" align="center" style="width:600px;margin:0 auto;">
      <tr>
        <td width="300" valign="top" style="text-align:center;padding: 30px 0 25px;"><img src="<?php echo site_url(); ?><?php echo$pesquisa->logo==''? 'assets/img/logo-do-cliente.png':'assets/uploads/logo/'.$pesquisa->logo;?>" alt="" /></td>
        <td width="300" valign="top" style="text-align:center;padding: 25px 0 20px;"><img src="<?php echo site_url(); ?>/assets/img/news-pesquisa-online-logo-mb.jpg" alt="" /></td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" align="center" style="width:600px;margin:0 auto;">
      <tr>
        <td width="600" valign="top"><img src="<?php echo site_url(); ?>assets/img/news-pesquisa-online-figure-one.jpg" alt="" /></td>
      </tr>
	  <tr>
        <td width="600" valign="top"><a href="<?php echo site_url('pesquisa_online/pesquisa_sugestao/'.$pesquisa->id_pesquisas); ?>"><img src="<?php echo site_url(); ?>news-pesquisa-online-figure-one.jpg" alt="">
	        <h2 style="color: white !important; font-family: 'Trebuchet MS', Trebuchet, sans-serif; font-size: 25px; line-height: 1.4em; margin-left: 160px; margin-top: -95px; width: 400px;"><?php echo $pesquisa->titulo;?></a></h2>
        </td>
      </tr>
      <tr>
        <td width="600" valign="top" style="padding: 15px 0 25px;">
          <p style="font-family:Arial, sans-serif; font-size:13px;">Sr(a). *|NAME|*!</p>
          
          <?php echo $pesquisa->mensagem_email;?>

          <p style="font-family:Arial, sans-serif; font-size:13px;"><?php echo 'Clique no link abaixo e um questionário simples se abrirá para preenchimento:';?></p>

          <p style="font-family:Arial, sans-serif; font-size:13px;"><a style="font-family:Arial, sans-serif; font-size:13px;" href="<?php echo site_url('pesquisa_online/pesquisa/'); ?>/*|CHAVE|*"><?php echo utf8_decode('Clique aqui e Participe.'); ?></a></p>
      
           <?php echo $pesquisa->agradecimentos;?>
        </td>
      </tr>
      <tr>
        <td width="600" valign="top" bgcolor="#333333">
	        <div style="background: #333; padding: 20px; width: 100%;">
				<p style="background: #333; color: white; font-family: 'Trebuchet MS', Trebuchet, sans-serif; font-size: 16px; line-height: 1.4em; margin: 0">MB Consultoria<br />
				<a href="tel:9236562452" style="color: white;">+55 (92) 3656-2452</a><br />
				<a href="mailto:mb@netmb.com.br" style="color: white;">mb@netmb.com.br</a><br />
				<a href="<?php echo site_url(); ?>" style="color: white;" target="_blank"><?php echo site_url(); ?></a></p>
	        </div>
        </td>
      </tr>
    </table>





    <!-- End example table -->

    <!-- Yahoo Link color fix updated: Simply bring your link styling inline.
    <a href="http://htmlemailboilerplate.com" target ="_blank" title="Styling Links" style="color: orange; text-decoration: none;">Coloring Links appropriately</a> -->

    <!-- Gmail/Hotmail image display fix
    <img class="image_fix" src="full path to image" alt="Your alt text" title="Your title text" width="x" height="x" /> -->

    <!-- Working with telephone numbers (including sms prompts).  Use the "mobile" class to style appropriately in desktop clients
    versus mobile clients.
    <span class="mobile_link">123-456-7890</span> -->

    </td>
  </tr>
</table>  
<!-- End of wrapper table -->
</body>
</html>
