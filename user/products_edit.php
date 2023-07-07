<?php
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';
 $url = $_SERVER['HTTP_REFERER'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$store = ($params['store']);
?>
<script>
    var product_id = "<?php echo $product_id; ?>";
    var store = "<?php echo $store;?>"
</script>
<?php
include "cls_header.php";
include_once('dashboard_header.php');   
?>

<div class="Polaris-Page login-frm">
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
                                           <h2 class="Polaris-Heading" style="    margin-left: 830px; margin-top: -25px;">Product</h2>
                                       </div>
                                <form class="m-t" id="register_frm" name="register_frm" method="POST"  enctype="multipart/form-data" onsubmit="">
                                    <div class="">
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
                                    </div>
                                    </br>

                                    <div class="Polaris-Layout">
                                        <div class="Polaris-Layout__Section">
                                            <input type="hidden" id="" name="product_id" value="<?php echo $product_id; ?>">
                                            <input type="hidden" id="" name="for_data" value="<?php echo 'product'; ?>">
                                            <h2 class="Polaris-Heading text-left text-editer" id="title"></h2>                                          
                                            <textarea class="textdetails" name="description">                                          
                                            </textarea>
                                                <button type="submit" name="sign_up" id="register_frm_btn" class="Polaris-Button Polaris-Button--primary save_loader_show"  style="float: right; margin-top: 20px;">Save</button>
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
