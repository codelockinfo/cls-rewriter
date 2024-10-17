<?php
    include "cls_header.php";
    include_once('dashboard_header.php');   
    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';
    $url = $_SERVER['REQUEST_URI'];
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    $store = ($params['store']);
?>
<script>
    var product_id = "<?php echo $product_id; ?>";
    var store = "<?php echo $store;?>"
</script>
<div class="Polaris-Page login-frm max_width_change">
    <div class="Polaris-Page__Content">
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__AnnotatedSection">
                <div class="Polaris-Layout__AnnotationWrapper">
                    <div class="Polaris-Layout__AnnotationContent">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Section">
                                <nav role="navigation" class="product-detail-view">
                                    <a href="products.php?store=<?php echo $store;?>" class="Polaris-Breadcrumbs__Breadcrumb" data-polaris-unstyled="true">
                                        <span class="Polaris-Breadcrumbs__Icon">
                                            <span class="Polaris-Icon">
                                                <svg class="Polaris-Icon__Svg" viewBox="0 0 20 20">
                                                <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16" fill-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <span class="Polaris-Breadcrumbs__Content">Back</span>
                                    </a>
                                </nav>
                                <div>
                                    <h2 class="Polaris-Heading editor-label">Product</h2>
                                </div>
                                <form class="m-t formforparent" id="register_frm" name="register_frm" method="POST"  enctype="multipart/form-data" onsubmit="">
                                    <div class="clsmain_green">
                                        <div class="Polaris-Labelled__LabelWrapper">
                                            <div class="Polaris-Label">
                                                <label id="PolarisTextField11Label" for="PolarisTextField11" class="Polaris-Label__Text">Title</label>
                                            </div>
                                        </div>
                                        <div class="Polaris-Connected"><div class="Polaris-Connected__Item_yiyol Polaris-Connected__Item--primary">
                                                <div class="Polaris-TextField">
                                                    <input id="title"  name="title" placeholder="" class="Polaris-TextField__Input title" maxlength="255" aria-labelledby="PolarisTextField11Label" aria-invalid="false" value="">
                                                    <div class="Polaris-TextField__Backdrop">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Polaris-Card__Header">
                                            <div class="">OR</div>
                                        </div>
                                        
                                        <div class="clsmain_green ">
                                        <input type="hidden"  class="chatGPT_Prerequesttitle" value="Can you write product title for"/>
                                            <div class="Polaris-Connected alignitems-center">
                                                <div class="Polaris-Connected__Item_yiyol Polaris-Connected__Item--primary mr-10">
                                                    <div class="Polaris-TextField">
                                                        <input placeholder="Generate auto title by ChatGPT" class="Polaris-TextField__Input tagforgeneratetitle" maxlength="255" aria-labelledby="" aria-invalid="false" value="">
                                                        <div class="Polaris-TextField__Backdrop">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="Polaris-Button Polaris-Button--success generateTitle generatetitle_loader_show" type="button">
                                                        <span class="Polaris-Button__Content">
                                                            <span class="Polaris-Icon Polaris-Icon--isColored Polaris-Icon--hasBackdrop"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.702 4.253a.625.625 0 0 1 1.096 0l.196.358c.207.378.517.688.895.895l.358.196a.625.625 0 0 1 0 1.097l-.358.196a2.25 2.25 0 0 0-.895.894l-.196.359a.625.625 0 0 1-1.096 0l-.196-.359a2.25 2.25 0 0 0-.895-.894l-.358-.196a.625.625 0 0 1 0-1.097l.358-.196a2.25 2.25 0 0 0 .895-.895l.196-.358Z"></path><path fill-rule="evenodd" d="M12.948 7.89c-.18-1.167-1.852-1.19-2.064-.029l-.03.164a3.756 3.756 0 0 1-3.088 3.031c-1.15.189-1.173 1.833-.03 2.054l.105.02a3.824 3.824 0 0 1 3.029 3.029l.032.165c.233 1.208 1.963 1.208 2.196 0l.025-.129a3.836 3.836 0 0 1 3.077-3.045c1.184-.216 1.12-1.928-.071-2.107a3.789 3.789 0 0 1-3.18-3.154Zm-.944 6.887a5.34 5.34 0 0 1 2.542-2.647 5.305 5.305 0 0 1-2.628-2.548 5.262 5.262 0 0 1-2.488 2.508 5.329 5.329 0 0 1 2.574 2.687Z"></path></svg></span>
                                                            <span class="Polaris-Button__Text">Generate Title</span>
                                                        </span>
                                                </button>
                                            </div>
                                            <span class="error-message chatgpttitleerror"></span> 
                                        </div>
                                        
                                        <div class="sectionchatgpt">
                                            <div class="d-flex-alert-box">
                                                <button class="Polaris-Button Polaris-Button--success get_content_drop" type="button">
                                                    <span class="Polaris-Button__Content">
                                                         <span class="Polaris-Icon Polaris-Icon--isColored Polaris-Icon--hasBackdrop"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.702 4.253a.625.625 0 0 1 1.096 0l.196.358c.207.378.517.688.895.895l.358.196a.625.625 0 0 1 0 1.097l-.358.196a2.25 2.25 0 0 0-.895.894l-.196.359a.625.625 0 0 1-1.096 0l-.196-.359a2.25 2.25 0 0 0-.895-.894l-.358-.196a.625.625 0 0 1 0-1.097l.358-.196a2.25 2.25 0 0 0 .895-.895l.196-.358Z"/><path fill-rule="evenodd" d="M12.948 7.89c-.18-1.167-1.852-1.19-2.064-.029l-.03.164a3.756 3.756 0 0 1-3.088 3.031c-1.15.189-1.173 1.833-.03 2.054l.105.02a3.824 3.824 0 0 1 3.029 3.029l.032.165c.233 1.208 1.963 1.208 2.196 0l.025-.129a3.836 3.836 0 0 1 3.077-3.045c1.184-.216 1.12-1.928-.071-2.107a3.789 3.789 0 0 1-3.18-3.154Zm-.944 6.887a5.34 5.34 0 0 1 2.542-2.647 5.305 5.305 0 0 1-2.628-2.548 5.262 5.262 0 0 1-2.488 2.508 5.329 5.329 0 0 1 2.574 2.687Z"/></svg></span>
                                                        <span class="Polaris-Button__Text">Generate Description</span>
                                                    </span>
                                                </button>
                                                <div class="Polaris-Banner Polaris-Banner--withinPage Polaris-Banner--statusInfo mar_l_padding_change" tabindex="0" role="alert" aria-live="polite" aria-labelledby="Banner7Heading" aria-describedby="Banner7Content">
                                                    <div class="Polaris-Banner__Ribbon">
                                                        <span class="Polaris-Icon Polaris-Icon--isColored Polaris-Icon--hasBackdrop Polaris-Icon--colorTeal">
                                                            <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                            <circle fill="currentColor" cx="10" cy="10" r="9"></circle>
                                                            <path d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8m0-13a1 1 0 0 0-1 1v4a1 1 0 1 0 2 0V6a1 1 0 0 0-1-1m0 8a1 1 0 1 0 0 2 1 1 0 0 0 0-2"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="Polaris-Banner__Heading">
                                                        <p class="Polaris-Heading">Quickly generate blog descriptions by leveraging the power of Chat GPT, saving time and effort for businesses.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content_gtp">
                                            <input type="hidden"  class="chatGPT_Prerequest" value="Can you write product description for"/>
                                                <div class="Polaris-Connected">
                                                    <div class="Polaris-Connected__Item_yiyol Polaris-Connected__Item--primary">
                                                        <div class="Polaris-TextField">
                                                            <input id="chatgptinput" name="" placeholder="Generate auto description by ChatGPT" class="Polaris-TextField__Input" maxlength="255" aria-labelledby="" aria-invalid="false" value="">
                                                            <div class="Polaris-TextField__Backdrop">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div><button class="Polaris-Button Polaris-Button--primary save_loader_show chatGPTBtn" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order">Search</button></div>
                                                </div>
                                                <span class="message chatgpterror"></span> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Polaris-Layout">
                                        <div class="Polaris-Layout__Section">
                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                            <input type="hidden" name="for_data" value="<?php echo 'product'; ?>">
                                            <h2 class="Polaris-Heading text-left text-editer" id="title"></h2>                                          
                                            <textarea class="textdetails" name="description"></textarea>
                                            <button type="submit" name="sign_up" id="register_frm_btn" class="Polaris-Button Polaris-Button--primary save_loader_show saveBtn"  style="float: right; margin-top: 20px;">Save</button>
                                            <button type="cancel" name="cancel" class="Polaris-Button Polaris-Button--destructive cancelRequest" data-page="products" style="float: right; margin-top: 20px; margin-bottom: 10px;">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var routine_name = 'product_select';
    get_textarea_value(routine_name, store, product_id, "product");
    btn_enable_disable(store);
</script>
<?php  include_once('dashboard_footer.php'); ?>
