<?php
/**
 * Plugin Name: Close Shop
 * Plugin URI: https://webgurudesign.com/close-shop
 * Description: A plugin to open or close your woo-commerce shop as and when you want (Toggle add to cart functionality, toggle display messages, change display messages).
 * Version: 1.0
 * Author: WebGuruDesign
 * Author URI: https://webgurudesign.com/
 */


function close_shop_wpdocs_register_my_custom_menu_page() {
    add_menu_page(
        __( 'Close Shop', 'textdomain' ),
        'Close Shop',
        'manage_options',
        'close-shop-settings-page',
        'close_shop_settings_template_callback',
        '',
        6
    );
}

add_action( 'admin_menu', 'close_shop_wpdocs_register_my_custom_menu_page' );

function close_shop_settings_template_callback()
{
    ?>
        <div class="wrap"> <h1> <?php echo esc_html(get_admin_page_title()); ?> </h1> </div>
        <form action="options.php" method="post">
        <?php       
            settings_fields('close-shop-settings-page');
            do_settings_sections('close-shop-settings-page');
            submit_button('Save');
        ?>
            
            
        </form>
    <?php   
}

function close_shop_settings_initialize()
{
    //set up settings
    add_settings_section(
        'close_shop_setting_section',
        'Close Shop Settings Section',
        '',
        'close-shop-settings-page'
        );
        
        
  //registering inputs
    register_setting(
    'close-shop-settings-page',
    'close_shop_settings_input' 
    );
    
     //add input
    add_settings_field(
    'close_shop_settings_input',
    __('Close Shop', 'close-shop'),
    'close_shop_settings_input_callback',
    'close-shop-settings-page',
    'close_shop_setting_section'
    );

    //registering input for DisplayMessageToggle
    register_setting(
    'close-shop-settings-page',
    'close_shop_settings_displayToggleCB'
    );

    //add DisplayToggleCB
    add_settings_field(
    'close_shop_settings_displayToggleCB',
    __('Display Alert Messages?','close-shop'),
    'close_shop_settings_displayToggleCB_input_callback',
    'close-shop-settings-page',
    'close_shop_setting_section'
    );

    //register setting for add to cart disable on shop and product page
    register_setting(
    'close-shop-settings-page',
    'close_shop_settings_addToCartDisplayToggle'
    );

    //add setting for add to cart disable on shop and product page
    add_settings_field(
    'close_shop_settings_addToCartDisplayToggle',
    __('Disable add to cart button on shop and product page','close-shop'),
    'close_shop_settings_addToCartDisplayToggle_input_callback',
    'close-shop-settings-page',
    'close_shop_setting_section'
    );

    //register setting for proceed to checkout disable on on cart page
    register_setting(
    'close-shop-settings-page',
    'close_shop_settings_proceedToCheckoutDisplayToggle'
    );

    //add setting for proceed to checkout disable on on cart page
    add_settings_field(
    'close_shop_settings_proceedToCheckoutDisplayToggle',
    __('Disable proceed to checkout button on cart page','close-shop'),
    'close_shop_settings_proceedToCheckoutDisplayToggle_input_callback',
    'close-shop-settings-page',
    'close_shop_setting_section'
    );

    //registering text input for display
    register_setting( 
    'close-shop-settings-page',
    'close_shop_settings_displayInputText'
    );

    //add displayInput text
    add_settings_field(
    'close_shop_settings_displayInputText',
    __('Display message for shop','close-shop'),
    'close_shop_settings_displayInputText_input_callback',    
    'close-shop-settings-page',
    'close_shop_setting_section'
    );

    //register text input for product page
    register_setting(
     'close-shop-settings-page',
     'close_shop_settings_displayInputTextProductPage'   
    );

    //add text input for product page
    add_settings_field(
    'close_shop_settings_displayInputTextProductPage',
    __('Display message for product page','close-shop'),
    'close_shop_settings_displayInputTextProductPage_input_callback',    
    'close-shop-settings-page',
    'close_shop_setting_section'
    );

    //register text input for cart page
     register_setting(
     'close-shop-settings-page',
     'close_shop_settings_displayInputTextCartPage'   
    );

     //add text input for cart page
     add_settings_field(
    'close_shop_settings_displayInputTextCartPage',
    __('Display message for cart page','close-shop'),
    'close_shop_settings_displayInputTextCartPage_input_callback',    
    'close-shop-settings-page',
    'close_shop_setting_section'
    );

     //register text input for checkout page
     register_setting(
     'close-shop-settings-page',
     'close_shop_settings_displayInputTextCheckoutPage'   
    );

     //add text inpur for checkout page
     add_settings_field(
    'close_shop_settings_displayInputTextCheckoutPage',
    __('Display message for checkout page','close-shop'),
    'close_shop_settings_displayInputTextCheckoutPage_input_callback',    
    'close-shop-settings-page',
    'close_shop_setting_section'
    );
}

add_action('admin_init','close_shop_settings_initialize');

    //define input callback

function close_shop_settings_input_callback()
    {   
        
        ?>
           <input type="checkbox" name="close_shop_settings_input" value="1" <?php checked(1, get_option('close_shop_settings_input'), true); ?> />
        <?php
    }

function close_shop_settings_displayToggleCB_input_callback()
    {   
        
        ?>
           <input type="checkbox" name="close_shop_settings_displayToggleCB" value="1" <?php checked(1, get_option('close_shop_settings_displayToggleCB'), true); ?> />
        <?php
    }

function close_shop_settings_addToCartDisplayToggle_input_callback()
    {   
        
        ?>
           <input type="checkbox" name="close_shop_settings_addToCartDisplayToggle" value="1" <?php checked(1, get_option('close_shop_settings_addToCartDisplayToggle'), true); ?> />
        <?php
    }

function close_shop_settings_proceedToCheckoutDisplayToggle_input_callback()
    {   
        
        ?>
           <input type="checkbox" name="close_shop_settings_proceedToCheckoutDisplayToggle" value="1" <?php checked(1, get_option('close_shop_settings_proceedToCheckoutDisplayToggle'), true); ?> />
        <?php
    }

function close_shop_settings_displayInputText_input_callback()

{
    $alertMessageText= get_option('close_shop_settings_displayInputText');
    $defaultMessageText="We are not able to accept online orders at this time. Please try later.";
    $messageToShow= "";
    if (isset($alertMessageText) && $alertMessageText!="")
        {
            $messageToShow= $alertMessageText; 
        }
    else
        {
            $messageToShow= $defaultMessageText;
        }
       ?> 
             <input type="text" value="<?php echo esc_attr($messageToShow) ?>" name="close_shop_settings_displayInputText">
       <?php 
}  

function close_shop_settings_displayInputTextProductPage_input_callback()

{
    $alertMessageText= get_option('close_shop_settings_displayInputTextProductPage');
    $defaultMessageText="We are not able to accept online orders at this time. Please try later.";
    $messageToShow= "";
    if (isset($alertMessageText) && $alertMessageText!="")
        {
            $messageToShow= $alertMessageText; 
        }
    else
        {
            $messageToShow= $defaultMessageText;
        }
       ?> 
             <input type="text" value="<?php echo esc_attr($messageToShow) ?>" name="close_shop_settings_displayInputTextProductPage">
       <?php 
}

function close_shop_settings_displayInputTextCartPage_input_callback()
{
    $alertMessageText= get_option('close_shop_settings_displayInputTextCartPage');
    $defaultMessageText="We are not able to accept online orders at this time. Please try later.";
    $messageToShow= "";
    if (isset($alertMessageText) && $alertMessageText!="")
        {
            $messageToShow= $alertMessageText; 
        }
    else
        {
            $messageToShow= $defaultMessageText;
        }
       ?> 
             <input type="text" value="<?php echo esc_attr($messageToShow) ?>" name="close_shop_settings_displayInputTextCartPage">
       <?php   
}

function close_shop_settings_displayInputTextCheckoutPage_input_callback()
{
    $alertMessageText= get_option('close_shop_settings_displayInputTextCheckoutPage');
    $defaultMessageText="We are not able to accept online orders at this time. Please try later.";
    $messageToShow= "";
    if (isset($alertMessageText) && $alertMessageText!="")
        {
            $messageToShow= $alertMessageText; 
        }
    else
        {
            $messageToShow= $defaultMessageText;
        }
       ?> 
             <input type="text" value="<?php echo esc_attr($messageToShow) ?>" name="close_shop_settings_displayInputTextCheckoutPage">
       <?php   
}   

add_action('woocommerce_after_shop_loop', 'close_shop_CloseShopPage');


function close_shop_CloseShopPage() // function to disable add to cart button and display closed message on shop page as per users choice 
{
$closeShopSettingsInput=get_option('close_shop_settings_input');
if($closeShopSettingsInput==1)
    {
         $messageToShow="";
         $alertMessageText= get_option('close_shop_settings_displayInputText');
         $defaultMessageText="We are not able to accept online orders at this time. Please try later.";
         if (isset($alertMessageText) && $alertMessageText!="")
            {
                $messageToShow=$alertMessageText;
            } 
            
        else
            {
                $messageToShow=$defaultMessageText;
            } 
         close_shop_DisableBuyforAllPage($messageToShow,"a.button.add_to_cart_button",'ShopOrProduct');

    }
}


add_action('woocommerce_after_single_product','close_shop_CloseProductPage');

   function close_shop_CloseProductPage() // function to disable add to cart button and display closed message text as per users choice 
    {
        $closeShopSettingsInput=get_option('close_shop_settings_input');
        
        if($closeShopSettingsInput==1)
            {
               
                $messageToShow="";
                $alertMessageText= get_option('close_shop_settings_displayInputTextProductPage');
                $defaultMessageText="We are not able to accept online orders at this time. Please try later.";
                if (isset($alertMessageText) && $alertMessageText!="")
                    {
                         $messageToShow=$alertMessageText;
                    } 
            
                else
                    {
                         $messageToShow=$defaultMessageText;
                    } 
                        close_shop_DisableBuyforAllPage($messageToShow,"button.single_add_to_cart_button",'ShopOrProduct');

            }
        
    }

add_action('woocommerce_after_cart_contents','close_shop_CloseCartPage');

    function close_shop_CloseCartPage()        //function to disable proceed to checkout button and display closed message as per users choice
    {
        $closeShopSettingsInput=get_option('close_shop_settings_input');
        
        if($closeShopSettingsInput==1)
            {
               
                $messageToShow="";
                $alertMessageText= get_option('close_shop_settings_displayInputTextCartPage');
                $defaultMessageText="We are not able to accept online orders at this time. Please try later.";
                if (isset($alertMessageText) && $alertMessageText!="")
                    {
                         $messageToShow=$alertMessageText;
                    } 
            
                else
                    {
                         $messageToShow=$defaultMessageText;
                    } 
                        
                        close_shop_DisableBuyforAllPage($messageToShow,"a.checkout-button.button.alt.wc-forward",'cartPage');

            }
        
    }

add_action('woocommerce_after_checkout_form','close_shop_CloseCheckoutPage');

    function close_shop_CloseCheckoutPage()       // function to disable payment option and display appropriate message if user has closed shop
     {
        $closeShopSettingsInput=get_option('close_shop_settings_input');
        
        if($closeShopSettingsInput==1)
            {
               
                $messageToShow="";
                $alertMessageText= get_option('close_shop_settings_displayInputTextCheckoutPage');
                $defaultMessageText="We are not able to accept online orders at this time. Please try later.";
                if (isset($alertMessageText) && $alertMessageText!="")
                    {
                         $messageToShow=$alertMessageText;
                    } 
            
                else
                    {
                         $messageToShow=$defaultMessageText;
                    } 
                        close_shop_DisableBuyforAllPage($messageToShow,"#place_order",'checkoutPage');

            }
        
    } 
    function close_shop_DisableBuyforAllPage($displayPageText, $buttonClass, $pageIdentify) // check for which page the function is called from and perform required actions
{
    
    $close_shop_settings_displayToggleCB=get_option('close_shop_settings_displayToggleCB');
   
    

    if($close_shop_settings_displayToggleCB==1)

        {
            echo "<script>alert('";
            echo esc_html($displayPageText);
            echo "')</script>"; 
        }
    /* if (user has selected display text message)
            {
                remove display alert text
            }

        if(page is shop or product and the user has selected to disable cart buttons)
            {
                remove button
            }
        else if(page is cart page and the user has selected to disable proceed to checkout button)
            {
                remove button
            }
        else if(page is checkout page)
            {
                remove button
            } */ 
    $close_shop_settings_proceedToCheckoutDisplayToggle= get_option('close_shop_settings_proceedToCheckoutDisplayToggle');    
    $close_shop_settings_addToCartDisplayToggle= get_option('close_shop_settings_addToCartDisplayToggle');
    if ($close_shop_settings_addToCartDisplayToggle==1 && $pageIdentify=='ShopOrProduct')
    {
      
        echo "<style>";
        echo esc_html($buttonClass);
        echo "{
            display: none;
        }
        </style>
        
        "; 
    }  

  
   else if ($close_shop_settings_proceedToCheckoutDisplayToggle==1 && $pageIdentify=='cartPage')

   {
        
        echo "<style>";
        echo esc_html($buttonClass);
        echo "{
            display: none;
        }
        </style>
        
        "; 
   }

   else if ($pageIdentify=='checkoutPage')
   {
        echo "<style>";
        echo esc_html($buttonClass);
        echo "{
            display: none;
        }
        </style>
        
        "; 
   }
   //else function is not called from any of the four pages    
}

