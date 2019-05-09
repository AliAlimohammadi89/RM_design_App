<?php

namespace App\Http\Controllers\Api\V1\pages_type;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Convert_html;

class ShopifyPageType extends Controller implements Convert_html
{
    public $items_field;

    public function __construct($b2cType, $page)
    {
        switch ($page) {
            case 'collectionPage':
                $fields = $this->collectionPage();
                break;
            case 'page404':
                $fields = $this->page404();
                break;
            case 'articlePage':
                $fields = $this->articlePage();
                break;
            case 'blogPage':
                $fields = $this->blogPage();
                break;
            case 'cartPage':
                $fields = $this->cartPage();
                break;
            case 'customerAccount':
                $fields = $this->customer_account();
                break;
            case 'customerActiveAccount':
                $fields = $this->customer_active_account();
                break;
            case 'CustomerLogin':
                $fields = $this->customer_login();
                break;
            case 'customerAddress':
                $fields = $this->customer_address();
                break;
            case 'customerOrder':
                $fields = $this->customer_order();
                break;
            case 'customerRegister':
                $fields = $this->customer_register();
                break;
            case 'customerResetPassword':
                $fields = $this->customer_reset_password();
                break;
            case 'collectionList':
                $fields = $this->collection_list();
                break;
            case 'pageContact':
                $fields = $this->page_contact();
                break;
            case 'pageSearch':
                $fields = $this->page_search();
                break;
            case 'pageProduct':
                $fields = $this->page_product();
                break;
            default:
                return 'no_page_find';
                break;
        }


        $this->items_field = $fields;
    }

    public function collectionPage()
    {
        $field = [
            '-PRODUCTS' => '{% for product in collection.products    %}',
            'PRODUCTS' => '{% endfor  %}',
            'PRODUCT_METAFIELD_ISNEWARRIVAL' => '{{ product.metafields.specifications.isNewArrival }}',
            'PRODUCT_COMPARE_PRICE' => '{{ product.compare_at_price }}',
            'PRODUCT_PRICE' => '{{ product.price }}',
            'PRODUCT_PRICE_MIN' => '{{ product.price_min | money }}',
            'PRODUCT_PRICE_MAX' => ' {{product.price_max | money }}',
            'PRODUCT_SALE' => '{% if product.compare_at_price > product.price %}{{ product.compare_at_price | minus: product.price | times: 100.0 | divided_by: product.compare_at_price | money_without_currency | times: 100 | remove: ".0"}}%{% endif %} OFF</span}}',
            'PRODUCT_TITLE' => '{{ product.title }}',
            'PRODUCT_URL' => '{{ product.url}}',
            'PRODUCT_ID' => '{{ product.id }}',
            'PRODUCT_IMG_SMALL' => '{{ product.featured_image | product_img_url: "small" }}',
            'PRODUCT_IMG_MEDIUM' => '{{ product.featured_image | product_img_url: "medium" }}',
            'PRODUCT_IMG_LARGE' => '{{ product.featured_image | product_img_url: "large" }}',
            'PRODUCT_IMG_ORIGINAL' => '{{ product.featured_image | product_img_url: "original" }}',
            'PRODUCT_IMG_DATALINK_THUMB' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] | split: ".jpg" }}_T.jpg',
            'PRODUCT_IMG_DATALINK_SMALL' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] | split: ".jpg" }}_S.jpg',
            'PRODUCT_IMG_DATALINK_ORIGINAL' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] }}  ',
            '-PRODUCT_IMGS_DATALINK' => '{% assign image_metafields = product.metafields.images.all   %} {% assign images=image_metafields  | split: "," | reverse  %}  {% for image in images %}',
            'PRODUCT_IMGS_DATALINK' => ' {% endfor %} ',
            'PRODUCT_IMGS_DATALINK_ITEM_THUMB' => '{{ image | remove :".jpg" |append : "_T.jpg"}}',
            'PRODUCT_IMGS_DATALINK_ITEM_SMALL' => '{{ image | remove :".jpg" |append : "_S.jpg"}}',
            'PRODUCT_IMGS_DATALINK_ITEM_ORIGINAL' => '{{ image }}',
            'PRODUCT_DESCRIPTION' => '{{product.description}}'
        ];
        return $field;
    }

    public function page404()
    {
        $field = [
            '-404_PAGE_TITLE' => "{{ 'general.404.title' | t }}",
            '-404_PAGE_SUB_TEXT' => "{{ 'general.404.subtext_html' | t }}",
            '-404_ERROR_IMG' => "{{ 'error-404.png' | asset_img_url: '800x'  }}",
        ];
        return $field;
    }

    public function articlePage()
    {
        $field = [
            '-ARTICLE_TITLE' => "{{ article.title }}",
            '-ARTICLE_AUTHOR' => "{{ article.author }}",
            '-ARTICLE_PUBLISHED' => "{{ article.published_at | date: '%Y-%m-%d' }}",
            '-ARTICLE_CONTENT' => "{{ article.content }}",
            '-ARTICLE_COMMENTS_COUNT' => "{{ article.comments_count }}",
            '-ARTICLE_COMMENTS' => "{% for comment in article.comments %}",
            '-ARTICLE_COMMENT_ID' => "{{ comment.id }}",
            '-ARTICLE_COMMENT_AUTHOR' => "{{ comment.author }}",
            '-ARTICLE_COMMENT_CREATE_AT' => "{{ comment.created_at | date: format: 'month_day_year' }}",
            'ARTICLE_COMMENTS' => "{% endfor %}",
            'ARTICLE_PAGINATE' => "{{ paginate | default_pagination | replace: '&laquo; Previous', '&larr;' | replace: 'Next &raquo;', '&rarr;' }}",
            '-ARTICLE_FORM_COMMENT' => "{% form 'new_comment', article %}",
            '-ARTICLE_FORM_COMMENT_TITLE' => "{{ 'blogs.comments.title' | t }}",
            '-ARTICLE_FORM_COMMENT_ERROR' => "{{ form.errors | default_errors }}",
            '-ARTICLE_FORM_COMMENT_NAME' => "{{ 'blogs.comments.name' | t }}",
            '-ARTICLE_FORM_COMMENT_EMAIL' => "{{ 'blogs.comments.email' | t }}",
            '-ARTICLE_FORM_COMMENT_BODY' => "{{ 'blogs.comments.message' | t }}",
            '-ARTICLE_FORM_COMMENT_POST_SUBMIT' => "{{ 'blogs.comments.post' | t }}",
            'ARTICLE_FORM_COMMENT' => "{{ 'blogs.comments.moderated' | t }}",
            'ARTICLE_BLOG_COMMENTS_MODERATED' => "{{ 'blogs.comments.moderated' | t }}",
            'ARTICLE_PUBLISHED_AT' => "{{ article.published_at | date: format: 'month_day_year' }}",
            'ARTICLE_COMMENT_WITH_COUNT' => "{{ 'blogs.comments.with_count' | t: count: number_of_comments }}",
            'ENDIF' => "{% endif %}  ",
            'ENDFOR' => "{% endfor %}  ",
            'END_FORM' => "{% endform %}",
            'END_PAGINATE' => "{% endpaginate %}",


        ];
        return $field;
    }

    public function blogPage()
    {
        $field = [
            '-ARTICLE_TITLE' => "{{article.title}}",
            '-BLOG_PAGINATE' => "  {% if paginate.pages > 1 %} {{ paginate | default_pagination }} {% endif %} ",
            '-BLOGS' => "{% for article in blog.articles %}",
            'BLOGS' => "{% endfor %}",
            '-BLOG_URL' => "{{ article.url }}",
            '-BLOG_TITLE' => "{{ article.title }}",
            '-BLOG_IMAGE' => "{{ article | img_url: '1024x1024' | img_tag: article.title }}",
            '-BLOG_PUBLISED_AT' => "{{ article.published_at | date: '%Y-%m-%d' }}",
            '-BLOG_CONTENT' => "{{ article.content | strip_html | truncatewords: 50 }}",
            'BLOG_PAGINATES' => " {% endpaginate %} ",
        ];
        return $field;
    }

    public function cartPage()
    {
        $field = [
            'CART_TITLE' => "{{ 'cart.general.title' | t }}",
            'CART_LABEL_PRODUCT' => "{{ 'cart.label.product' | t }}",
            'CART_LABEL_PRICE' => "{{ 'cart.label.price' | t }}",
            'CART_LABEL_QUANTITY' => "{{ 'cart.label.quantity' | t }}",
            '-CART_ITEMS' => " {% for item in cart.items %} ",
            'CART_ITEMS' => " {% endfor %} ",
            'CART_ITEM_URL' => "{{ item.url | within: collections.all }}",
            'CART_ITEM_IMAGE' => "{% if item.variant.metafields.images.all %}
         					 {% assign images = item.variant.metafields.images.all | split: ',' | reverse  %}
                                          {% assign image = images[0] | split: '.jpg' %}
                                        	{{image}}_T.jpg  
                                         {%else%}
                                            {% if item.product.metafields.images.all %}
                                             {% assign images = item.product.metafields.images.all | split: \",\" | reverse  %}
                                          {% assign image = images[0] | split: '.jpg' %}
                                        	{{image}}_T.jpg  
                                            {%else%}
                                         {{ item.variant.featured_image | product_img_url: 'medium' }}
                                            {%endif%}
                                         {% endif %}",
            'CART_ITEM_VARIANT_TITLE' => "{{ item.variant.title | escape  }}",
            'CART_PRODUCT_TITLE' => " {{ item.product.title }} ",
            'CART_ITEM_VENDOR' => " {{ item.vendor }}",
            'CART_ITEM_PRICE' => "{{ item.price | money }}",
            'CART_ITEM_KEY' => "{{ item.key }}",
            'CART_ITEM_QUANTITY' => "{{ item.quantity }}",
            'CART_ITEM_LINE_PRICE' => "{{ item.line_price | money }}",
            'CART_ITEM_DESCOUNT_TITLE' => "{{ discount.title }}",
            'CART_ITEMS_FOR_LOOP_INDEX' => "{{ forloop.index }}",
            'CART_NOT' => "{{ cart.note }}",
            'CART_ITEMS_TOTAL_COUNT' => " {{ cart.item_count }} {{ cart.item_count | pluralize: 'Item', 'Items' }}",
            'CART_ITEMS_TOTAL_PRICE' => "{{ 'cart.general.subtotal' | t }}: {{ cart.total_price | money }}",
            'CART_UPTADE_TITLE' => "{{ 'cart.general.update' | t }}",
            'CART_CHECKOUT_TITLE' => " {{ 'cart.general.checkout' | t }} ",
            'CART_EMPTY_TITLE' => " {{ 'cart.general.empty' | t }} ",
            'CART_CONTINUE_HTML' => " {{ 'cart.general.continue_browsing_html' | t }} ",
        ];
        return $field;
    }

    public function customer_account()
    {
        $field = [
            'FOR_INDEX' => "{{forloop.index}}",
            'CUSTOMER_ACCOUNT_TITLE' => "{{ 'customer.account.title' | t }}",
            'CUSTOMER_ACCOUNT_ORDER_TITLE' => "{{ 'customer.orders.title' | t }}",
            'CUSTOMER_ACCOUNT_PAYMENT_STATUS_TITLE' => "{{ 'customer.orders.payment_status' | t }}",
            'CUSTOMER_ACCOUNT_FULFILLMENT_TITLE' => "{{ 'customer.orders.fulfillment_status' | t }}",
            'CUSTOMER_ACCOUNT_ORDER_TOTAL_TITLE' => "{{ 'customer.orders.total' | t }}",
            '-CUSTOMER_ORDERS' => "{% for order in customer.orders %}",
            'CUSTOMER_ORDERS' => "{% endfor %}",
            'CUSTOMER_ORDER_NAME' => "{{ order.name | link_to: order.customer_url }}",
            'CUSTOMER_ORDER_CREATE_AT' => "{{ order.created_at | date: format: 'month_day_year' }}",
            'CUSTOMER_ORDER_FINANCIAL_STATUS' => "{{ order.financial_status_label }}",
            'CUSTOMER_ORDER_FULFILLMENT_STATUS' => "{{ order.fulfillment_status_label }}",
            'CUSTOMER_ORDER_TOTAL_PRICE' => "{{ order.total_price | money }}",
            'CUSTOMER_ORDER_NONE' => "{{ 'customer.orders.none' | t }}",
            '-CUSTOMER_ORDER_PAGINATION' => "{% paginate customer.orders by 20 %}",
            '-CUSTOMER_ORDER_PAGINATION_LIST' => "{{ paginate | default_pagination | replace: '&laquo; Previous', '&larr;' | replace: 'Next &raquo;', '&rarr;' }}",
            'CUSTOMER_ORDER_PAGINATION' => "{% endpaginate %}",
            'CUSTOMER_NAME' => "{{ customer.name }}",
            'CUSTOMER_EMAIL' => "{{ customer.email }}",
            'CUSTOMER_DEFAULT_ADDRESS1' => "{{ customer.default_address.address1 }}",
            'CUSTOMER_DEFAULT_ADDRESS2' => "{{ customer.default_address.address2 }}",
            'CUSTOMER_DEFAULT_ADDRESS_CITY' => " {{ customer.default_address.city }} ",
            'CUSTOMER_DEFAULT_ADDRESS_PROVINCE_CODE' => "{{ customer.default_address.province_code | upcase }}",
            'CUSTOMER_DEFAULT_ADDRESS_ZIP' => " {{ customer.default_address.zip | upcase }} ",
            'CUSTOMER_DEFAULT_ADDRESS_COUNTRY' => "{{ customer.default_address.country }}  ",
            'CUSTOMER_DEFAULT_ADDRESS_PHONE' => " {{ customer.default_address.phone }}",
            'CUSTOMER_ACCOUNT_ADDRESS_PAGE' => "{{ 'customer.account.view_addresses' | t }} ",
        ];
        return $field;
    }

    public function customer_active_account()
    {
        $field = [
            'CUSTOMER_ACTIVE_ACCOUNT_TITLE' => " {{ 'customer.activate_account.title' | t }} ",
            'CUSTOMER_ACTIVE_ACCOUNT_SUBTEXT' => " {{ 'customer.activate_account.subtext' | t }} ",
            '-CUSTOMER_ACTIVE_ACCOUNT_FORM' => "  {% form 'activate_customer_password' %} ",
            'CUSTOMER_ACTIVE_ACCOUNT_PASSWORD_TEXT' => " {{ 'customer.activate_account.password' | t }}",
            'CUSTOMER_ACTIVE_ACCOUNT_PASSWORD_CONFIRM_TEXT' => " {{ 'customer.activate_account.password_confirm' | t }} ",
            'CUSTOMER_ACTIVE_ACCOUNT_SUBMIT_TEXT' => "{{ 'customer.activate_account.submit' | t }} ",
            'CUSTOMER_ACTIVE_ACCOUNT_CANCEL_TEXT' => "{{ 'customer.activate_account.cancel' | t }} ",
            'CUSTOMER_ACTIVE_ACCOUNT_ERROR' => "  {{ form.errors | default_errors }} ",
            'CUSTOMER_ACTIVE_ACCOUNT_FORM' => " {% endform %} ",
            'FOR_INDEX' => "{{forloop.index}}",
        ];
        return $field;
    }

    public function customer_login()
    {
        $field = [
            'CUSTOMER_LOGIN_RECOVER_PASSWORD' => " {{ 'customer.recover_password.success' | t }} ",
            '-CUSTOMER_LOGIN_FORM' => "  {% form 'customer_login' %} ",
            'CUSTOMER_LOGIN_ERROR' => " {{ form.errors | default_errors }} ",
            'CUSTOMER_LOGIN_TITLE' => " {{ 'customer.login.title' | t }} ",
            'CUSTOMER_LOGIN_EMAIL_TITLE' => " {{ 'customer.login.email' | t }} ",
            'CUSTOMER_LOGIN_PASSWORD_TITLE' => " {{ 'customer.login.password' | t }} ",
            'CUSTOMER_LOGIN_FORGET_PASSWORD_TITLE' => " {{ 'customer.login.forgot_password' | t }} ",
            'CUSTOMER_LOGIN_SING_IN_TITLE' => " {{ 'customer.login.sign_in' | t }} ",
            'CUSTOMER_LOGIN_LOGIN_CANCEL_TITLE' => " {{ 'customer.login.cancel' | t }} ",
            'CUSTOMER_LOGIN_CRETE_ACCOUNT_TITLE' => " {{ 'layout.customer.create_account' | t | customer_register_link }} ",
            'CUSTOMER_LOGIN_PASSWORD_SUB_TITLE' => " {{ 'customer.recover_password.subtext' | t }} ",
            'CUSTOMER_LOGIN_RECOVER_EMAIL' => " {{ 'customer.recover_password.email' | t }} ",
            'CUSTOMER_LOGIN_RECOVER_PASSWORD_SUBMIT_TITLE' => " {{ 'customer.recover_password.submit' | t }} ",
            'CUSTOMER_LOGIN_PASSWORD_CANCEL' => " {{ 'customer.recover_password.cancel' | t }} ",
            'CUSTOMER_LOGIN_GUST_TITLE' => " {{ 'customer.login.guest_title' | t }} ",
            'CUSTOMER_LOGIN_GUST_CONTINUE_TITLE' => " {{ 'customer.login.guest_continue' | t }} ",
            'CUSTOMER_LOGIN_FORM' => "{% endform %}",
            'FOR_INDEX' => "{{forloop.index}}",
        ];
        return $field;
    }

    public function customer_address()
    {
        $field = [
            'CUSTOMER_ADDRESS_FORM' => "  {% form 'customer_address', customer.new_address %} ",
            'CUSTOMER_ADDRESS_ERROR_FORM' => "  {{ form.errors | default_errors }} ",
            'CUSTOMER_ADDRESS_ADD_NEW' => " {{ 'customer.addresses.add_new' | t }} ",
            'CUSTOMER_ADDRESS_FIRST_NAME_TITLE' => " {{ 'customer.addresses.first_name' | t }} ",
            'CUSTOMER_ADDRESS_FIRST_NAME_FORM_VALUE' => " {{ form.first_name }} ",
            'CUSTOMER_ADDRESS_LAST_NAME_TITLE' => " {{ 'customer.addresses.last_name' | t }} ",
            'CUSTOMER_ADDRESS_LAST_NAME_FORM_VALUE' => " {{ form.last_name }} ",
            'CUSTOMER_ADDRESS_COMPANY_TITLE' => " {{ 'customer.addresses.company' | t }} ",
            'CUSTOMER_ADDRESS_COMPANY_FORM_VALUE' => " {{ form.company }} ",
            'CUSTOMER_ADDRESS_ADDRESS1_TITLE' => " {{ 'customer.addresses.address1' | t }} ",
            'CUSTOMER_ADDRESS_ADDRESS1_FORM_VALUE' => " {{ form.address1 }} ",
            'CUSTOMER_ADDRESS_ADDRESS2_TITLE' => " {{ 'customer.addresses.address2' | t }} ",
            'CUSTOMER_ADDRESS_ADDRESS2_FORM_VALUE' => " {{ form.address2 }} ",
            'CUSTOMER_ADDRESS_CITY_TITLE' => " {{ 'customer.addresses.city' | t }} ",
            'CUSTOMER_ADDRESS_CITY_FORM_VALUE' => " {{ form.city }} ",
            'CUSTOMER_ADDRESS_COUNTRY_TITLE' => " {{ 'customer.addresses.country' | t }} ",
            'CUSTOMER_ADDRESS_PROVINCE_TITLE' => " {{ 'customer.addresses.province' | t }} ",
            'CUSTOMER_ADDRESS_FORM_PROVINCE_VALUE' => " {{ form.province }} ",
            'CUSTOMER_ADDRESS_FORM_ID' => " {{ form.id }} ",
            'CUSTOMER_ADDRESS_ZIP' => " {{ 'customer.addresses.zip' | t }} ",
            'CUSTOMER_ADDRESS_FORM_ZIP' => " {{ form.zip }} ",
            'CUSTOMER_ADDRESS_PHONE_TITLE' => " {{ 'customer.addresses.phone' | t }} ",
            'CUSTOMER_ADDRESS_FORM_PHONE' => " {{ form.phone }} ",
            'CUSTOMER_ADDRESS_SET_DEFAULT_TITLE' => " {{ 'customer.addresses.set_default' | t }} ",
            'CUSTOMER_ADDRESS_SET_AS_DEFAULT_ADDRESS' => " {{ form.set_as_default_checkbox }} ",
            'CUSTOMER_ADDRESS_ADD_TITLE' => " {{ 'customer.addresses.add' | t }} ",
            'CUSTOMER_ADDRESS_CANCEL' => " {{ 'customer.addresses.cancel' | t }} ",
            'CUSTOMER_ADDRESS_TITLE_TITLE' => " {{ 'customer.addresses.title' | t }} ",
            '-CUSTOMER_ADDRESS_ADDRESSES' => " {% for address in customer.addresses %} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_EDIT' => " {{ 'customer.addresses.edit' | t | edit_customer_address_link: address.id }} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_DELETE' => " {{ 'customer.addresses.delete' | t | delete_customer_address_link: address.id }} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_COMPANY' => "  {{ address.company }} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_STREET' => " {{ address.street }} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_CITY' => " {{ address.city | capitalize }} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_PROVINCE_CODE' => " {% if address.province_code %}{{ address.province_code | upcase }}{% endif %} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_COUNTRY' => " {{ address.country }} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_PHONE' => " {{ address.phone }} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_PAGINATES' => " {% paginate customer.addresses by 5 %} ",
            '-CUSTOMER_ADDRESS_ADDRESSE_FORM' => " {% form 'customer_address', customer.new_address %} ",
            'CUSTOMER_ADDRESS_ACCOUNT_RETURN' => " {{ 'customer.account.return' | t }} ",
            'CUSTOMER_ADDRESS_ACCOUNT_TITLE' => "{{ 'customer.account.title' | t }}",
            'CUSTOMER_ADDRESS_OPTION_TAGS' => "{{ country_option_tags }}",
            'CUSTOMER_ADDRESS_FORM_COUNTRY' => "{{ form.country }}",
            'CUSTOMER_ADDRESS_EDIT_DEFAULT_TITLE' => "{{ 'customer.addresses.edit_address' | t }}",
            'CUSTOMER_ADDRESS_CUSTOMER_ADDRESSES' => "{% form  'customer_address', address %}",
            'CUSTOMER_ADDRESS_CUSTOMER_ADDRESS_ID' => "{{ address.id }}",
            'CUSTOMER_ADDRESS_CUSTOMER_ADDRESS_UPDATE_TITLE' => "{{ 'customer.addresses.update' | t }}",
            'CUSTOMER_ADDRESS_PAGINATE_IF' => "{% if paginate.pages > 1 %}",
            'CUSTOMER_ADDRESS_PAGINATE' => "{{ paginate | default_pagination | replace: '&laquo; Previous', '&larr;' | replace: 'Next &raquo;', '&rarr;' }}",
            'ENDIF' => "{% endif %}  ",
            'END_FORM' => "{% endif %}  ",
            'ENDFOR' => "{% endfor %}  ",
            'FOR_INDEX' => "{{forloop.index}}",

        ];
        return $field;
    }

    public function customer_order()
    {
        $field = [
            'CUSTOMER_ORDER_ACCOUNT_TITLE' => " {{ 'customer.account.title' | t }} ",
            'CUSTOMER_ORDER_ACCOUNT_RETURN' => " {{ 'customer.account.return' | t }} ",
            'CUSTOMER_ORDER_TITLE' => " {{ 'customer.order.title' | t: name: order.name }} ",
            'CUSTOMER_ORDER_CRETE_AT' => " {% assign cancelled_at = order.cancelled_at | date: '%B %d, %Y %I:%M%p' %} ",
            'CUSTOMER_ORDER_CANCELLED_IF' => " {% if order.cancelled %} ",
            'CUSTOMER_ORDER_CANCELLED' => " {% assign cancelled_at = order.cancelled_at | date: '%B %d, %Y %I:%M%p' %}{{ 'customer.order.cancelled' | t: date: cancelled_at }} ",
            'CUSTOMER_ORDER_CANCELLED_REASON' => " {{ 'customer.order.cancelled_reason' | t: reason: order.cancel_reason }} ",
            'CUSTOMER_ORDER_PRODUCT_TITLE' => " {{ 'customer.order.product' | t }} ",
            'CUSTOMER_ORDER_SKU_TITLE' => " {{ 'customer.order.sku' | t }} ",
            'CUSTOMER_ORDER_PRICE_TITLE' => " {{ 'customer.order.price' | t }} ",
            'CUSTOMER_ORDER_QUANTITY_TITLE' => " {{ 'customer.order.quantity' | t }} ",
            'CUSTOMER_ORDER_TOTAL_TITLE' => " {{ 'customer.order.total' | t }} ",
            '-CUSTOMER_ORDER_LINE_ITEMS' => " {% for line_item in order.line_items %} ",
            'CUSTOMER_ORDER_LINE_ITEM_KEY' => " {{ line_item.key }} ",
            'CUSTOMER_ORDER_ITEM_LINK' => " {{ line_item.title | link_to: line_item.product.url }} ",
            'CUSTOMER_ORDER_LINE_ITEM_CREATE_AT_VALUE' => "{% assign created_at = line_item.fulfillment.created_at | date: format: 'month_day_year' %} ",
            'CUSTOMER_ORDER_FULFILLED_IF' => " {% if line_item.fulfillment %} ",
            'CUSTOMER_ORDER_FULFILLED_AT' => "  {{ 'customer.order.fulfilled_at' | t: date: created_at }} ",
            'CUSTOMER_ORDER_FULFILLMENT_IF' => " {% if line_item.fulfillment %} ",
            'CUSTOMER_ORDER_FULFILLMENT_TRACKING_IF' => " {% if line_item.fulfillment.tracking_number %} ",
            'CUSTOMER_ORDER_FULFILLMENT_TRACKING_URL' => " {{ line_item.fulfillment.tracking_url }} ",
            'CUSTOMER_ORDER_FULFILLMENT_TRACKING_COMPANY' => " {{ line_item.fulfillment.tracking_company }} ",
            'CUSTOMER_ORDER_FULFILLMENT_TRACKING_NUMBER' => " {{ line_item.fulfillment.tracking_number}} ",
            'ENDIF' => "{% endif %}  ",
            'ENDFOR' => "{% endfor %}  ",
            'FOR_INDEX' => "{{forloop.index}}",
            'CUSTOMER_ORDER_LINE_ITEM_SKU' => "{{ line_item.sku }} ",
            'CUSTOMER_ORDER_LINE_ITEM_MONEY' => "{{ line_item.price | money }} ",
            'CUSTOMER_ORDER_LINE_ITEM_QUANTITY' => "{{ line_item.quantity }} ",
            'CUSTOMER_ORDER_LINE_ITEM_QUANTITY_MONEY' => "{{ line_item.quantity | times: line_item.price | money }} ",
            '-CUSTOMER_ORDER_DISCOUNTS' => " {% for discount in order.discounts %} ",
            '-CUSTOMER_ORDER_DISCOUNT_CODE' => " {{ discount.code }} ",
            '-CUSTOMER_ORDER_DISCOUNT_TITLE' => " {{ 'customer.order.discount' | t }} ",
            '-CUSTOMER_ORDER_DISCOUNT_MONEY' => " {{ discount.savings | money }} ",
            '-CUSTOMER_ORDER_SHIPPING_METHODS' => "  {% for shipping_method in order.shipping_methods %} ",
            'CUSTOMER_ORDER_SHIPPING_METHOD_TITLE' => " {{ 'customer.order.shipping' | t }} ({{ shipping_method.title }}) ",
            'CUSTOMER_ORDER_SHIPPING_METHOD_PRICE' => " {{ shipping_method.price | money }}",
            'CUSTOMER_ORDER_SUBTOTAL' => " {{ 'customer.order.subtotal' | t }} ",
            'CUSTOMER_ORDER_PRICE_MONEY' => " {{ order.subtotal_price | money }} ",
            '-CUSTOMER_ORDER_TEXT_LINES' => " {% for tax_line in order.tax_lines %} ",
            'CUSTOMER_ORDER_TAX_TITLE' => " {{ 'customer.order.tax' | t }} ({{ tax_line.title }} {{ tax_line.rate | times: 100 }}%) ",
            'CUSTOMER_ORDER_TAX_PRICE' => " {{ tax_line.price | money }} ",
            'CUSTOMER_ORDER_TAX_TOTAL_PRICE' => " {{ order.total_price | money }} {{ order.currency }} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_TITLE' => " {{ 'customer.order.billing_address' | t }} ",
            'CUSTOMER_ORDER_PAYMENT_STATUS' => " {{ 'customer.order.payment_status' | t }} ",
            'CUSTOMER_ORDER_PAYMENT_STATUS_LABEL' => " {{ order.financial_status_label }} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_NAME' => " {{ order.billing_address.name }} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_COMPANY' => " {% if order.billing_address.company != '' %}{{ order.billing_address.company }} {% endif %} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_STREET' => "  {{ order.billing_address.street }} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_CITY' => "  {{ order.billing_address.city }} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_PROVINCE' => " {% if order.billing_address.province != '' %}{{ order.billing_address.province }}{% endif %} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_ZIP' => " {{ order.billing_address.zip | upcase }} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_COUNTRY' => "  {{ order.billing_address.country }} ",
            'CUSTOMER_ORDER_BILLING_ADDRESS_PHONE' => " {{ order.billing_address.phone }} ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_TITLE' => " {{ 'customer.order.shipping_address' | t }} ",
            'CUSTOMER_ORDER_FULFILLMENT_STATUS_TITLE' => " {{ 'customer.order.fulfillment_status' | t }} ",
            'CUSTOMER_ORDER_FULFILLMENT_STATUS_LABEL' => " {{ order.fulfillment_status_label }} ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_NAME' => " {{ order.shipping_address.name }} ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_COMPANY' => "{% if order.shipping_address.company != '' %}{{ order.shipping_address.company }}{% endif %}  ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_STREET' => " {{ order.shipping_address.street }} ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_CITY' => " {{ order.shipping_address.city }} ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_PROVINCE' => "  {% if order.shipping_address.province != '' %}{{ order.shipping_address.province }}{% endif %} ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_ZIP' => "  {{ order.shipping_address.zip | upcase }} ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_COUNTRY' => " {{ order.shipping_address.country }} ",
            'CUSTOMER_ORDER_SHIPPING_ADDRESS_PHONE' => "  {{ order.shipping_address.phone }} ",

        ];
        return $field;
    }

    public function customer_register()
    {
        $field = [
            'CUSTOMER_REGISTER_PASSWORD_SUCCESS_TITLE' => "  {{ 'customer.recover_password.success' | t }} ",
            'CUSTOMER_REGISTER_RECOVER_PASSWORD_TITLE' => " {{ 'customer.recover_password.title' | t }} ",
            'CUSTOMER_REGISTER_RECOVER_PASSWORD_SUBTITLE' => " {{ 'customer.recover_password.subtext' | t }} ",
            '-CUSTOMER_REGISTER_RECOVER_PASSWORD' => " {% form 'recover_customer_password' %} ",
            'CUSTOMER_REGISTER_RECOVER_PASSWORD_FORM_ERROR' => " {{ form.errors | default_errors }} ",
            'CUSTOMER_REGISTER_RECOVER_PASSWORD_FORM_RECOVER_PASSWORD_EMAIL' => " {{ 'customer.recover_password.email' | t }} ",
            'CUSTOMER_REGISTER_RECOVER_PASSWORD_FORM_SUBMIT_TITLE' => " {{ 'customer.recover_password.submit' | t }} ",
            'CUSTOMER_REGISTER_RECOVER_PASSWORD_FORM_CANCEL_TITLE' => " {{ 'customer.recover_password.cancel' | t }} ",
            'CUSTOMER_REGISTER_CHECKOUT_GUST_LOGIN_IF' => "  {% if shop.checkout.guest_login %} ",
            'CUSTOMER_REGISTER_LOGIN_GUEST_TITLE' => " {{ 'customer.login.guest_title' | t }} ",
            '-CUSTOMER_REGISTER_GUST_LOGIN_FORM' => "  {% form 'guest_login' %} ",
            'CUSTOMER_REGISTER_GUST_LOGIN_FORM_GUEST_CONTINUE_TITLE' => " {{ 'customer.login.guest_continue' | t }} ",
            'CUSTOMER_REGISTER_TITLE_TEXT' => " {{ 'customer.register.title' | t }} ",
            '-CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM' => " {% form 'create_customer' %} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_ERROR' => "  {{ form.errors | default_errors }} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_FIRST_NAME_TITLE' => " {{ 'customer.register.first_name' | t }} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_FIRST_NAME_RETURN_VALUE' => " {% if form.first_name %}{{ form.first_name }}{% endif %} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_FIRST_LAST_NAME_TITLE' => " {{ 'customer.register.last_name' | t }} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_LAST_NAME_RETURN_VALUE' => " {% if form.last_name %}{{ form.last_name }}{% endif %} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_EMAIL_TITLE' => " {{ 'customer.register.email' | t }} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_EMAIL_RETURN_VALUE' => " {% if form.email %}{{ form.email }}{% endif %} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_PASSWORD_TITLE' => " {{ 'customer.register.password' | t }} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_SUBMIT_TITLE' => " {{ 'customer.register.submit' | t }} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_SHOP_URL' => " {{ shop.url }} ",
            'CUSTOMER_REGISTER_CREATE_CUSTOMER_FORM_SHOP_CANCEL_TITLE' => " {{ 'customer.register.cancel' | t }} ",
            'END_FORM' => "{% endform %}",
            'ENDIF' => "{% endif %}  ",
            'FOR_INDEX' => "{{forloop.index}}",
        ];
        return $field;
    }

    public function customer_reset_password()
    {
        $field = [
            '-CUSTOMER_RESET_PASSWORD_FORM' => "  {% form 'reset_customer_password' %} ",
            '-CUSTOMER_RESET_PASSWORD_FORM_TITLE' => "  {{ 'customer.reset_password.title' | t }} ",
            '-CUSTOMER_RESET_PASSWORD_FORM_SUB_TEXT_TITLE' => " {{ 'customer.reset_password.subtext' | t: email: email }} ",
            '-CUSTOMER_RESET_PASSWORD_FORM_ERROR' => " {{ form.errors | default_errors }} ",
            '-CUSTOMER_RESET_PASSWORD_FORM_PASSWORD_TITLE' => " {{ 'customer.reset_password.password' | t }} ",
            '-CUSTOMER_RESET_PASSWORD_FORM_PASSWORD_CONFIRM' => " {{ 'customer.reset_password.password_confirm' | t }} ",
            '-CUSTOMER_RESET_PASSWORD_FORM_SUBMIT' => " {{ 'customer.reset_password.submit' | t }} ",
            'END_FORM' => "{% endform %}",
            'ENDIF' => "{% endif %}  ",
            'FOR_INDEX' => "{{forloop.index}}",
        ];
        return $field;
    }

    public function collection_list()
    {
        $field = [
            '-COLLECTION_LIST_COLLECTIONS' => "{% for collection in collections %}",
            'COLLECTION_LIST_COLLECTION_URL' => "{{collection.url | 'url'}}",
            'COLLECTION_LIST_COLLECTION_TITLE' => "{{collection.title}}",
            '-COLLECTION_LIST_COLLECTION_PRODUCTS' => "{% for product in collection.products  limit :5%}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_URL' => "{{product.url}}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_IMG' => "{% if product.metafields.images.all %}{% assign images = product.metafields.images.all | split: ',' | reverse  %}{% assign image = images[0] | split: '.jpg' %}{{image}}_S.jpg  {%else%}{{ product.featured_image | product_img_url: 'medium' }}{% endif %}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_TITLE' => "{{product.title}}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_PRICE' => "{%- if product.price_min  == product.price_max  -%}{{ product.price_min | money }}{% else %}{{ product.price_min | money }} - {{product.price_max | money }}{% endif %}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_SAIL' => "{% if product.compare_at_price > product.price %}{{ product.compare_at_price | minus: product.price | times: 100.0 | divided_by: product.compare_at_price | money_without_currency | times: 100 | remove: '.0'}}%{% endif %} OFF",
            '-COLLECTION_LIST_COLLECTION_PAGINATE' => "  {% if paginate.pages > 1 %} {{ paginate | default_pagination }} {% endif %} ",
            'END_FORM' => "{% endform %}",
            'ENDIF' => "{% endif %}  ",
            'ENDFOR' => "{% endfor %}  ",
            'FOR_INDEX' => "{{forloop.index}}",
        ];
        return $field;
    }

    public function page_contact()
    {
        $field = [
            'PAGE_CONTACT_PAGE_TITLE' => "{{ page.title }}",
            'PAGE_CONTACT_CONTENT' => "{{ page.content }}",
            'PAGE_CONTACT_FORM' => "{% form 'contact' %}",
            '-PAGE_CONTACT_POST_SUCCESSFULLY_TITLE' => "{% if form.posted_successfully? %}{{ 'contact.form.post_success' | t }}{% endif %}",
            '-PAGE_CONTACT_FORM_ERROR' => " {{ form.errors | default_errors }}",
            '-PAGE_CONTACT_FORM_NAME_TITLE' => "{{ 'contact.form.name' | t }}",
            '-PAGE_CONTACT_FORM_NAME_ATTR' => "{% assign name_attr = 'contact.form.name' | t | handle %}{{ name_attr }}",
            '-PAGE_CONTACT_FORM_PHONE_ATTR' => "{% assign name_attr = 'contact.form.phone' | t | handle %}{{ name_attr }}",
            '-PAGE_CONTACT_FORM_NAME_VALUE' => "{% if form[name_attr] %}{{ form[name_attr] }}{% elsif customer %}{{ customer.name }}{% endif %}",
            '-PAGE_CONTACT_FORM_EMAIL_TITLE' => "{{ 'contact.form.email' | t }}",
            '-PAGE_CONTACT_FORM_EMAIL_VALUE' => "{% if form.email %}{{ form.email }}{% elsif customer %}{{ customer.email }}{% endif %}",
            '-PAGE_CONTACT_FORM_PHONE_TITLE' => "{{ 'contact.form.phone' | t }}",
            '-PAGE_CONTACT_FORM_PHONE_VALUE' => "{% if form[name_attr] %}{{ form[name_attr] }}{% elsif customer %}{{ customer.phone }}{% endif %}",
            '-PAGE_CONTACT_FORM_MESSAGE_TITLE' => "{{ 'contact.form.message' | t }}",
            '-PAGE_CONTACT_FORM_MESSAGE_VALUE' => "{% if form.body %}{{ form.body }}{% endif %}",
            '-PAGE_CONTACT_FORM_SEND' => "{{ 'contact.form.send' | t }}",
            'END_FORM' => "{% endform %}",
            'ENDIF' => "{% endif %}  ",
            'ENDFOR' => "{% endfor %}  ",
            'FOR_INDEX' => "{{forloop.index}}",
        ];
        return $field;
    }

    public function page_search()
    {
        {
            $field = [
                '-PAGE_SEARCH_RESULT' => "{% for item in search.results %}",
                'PAGE_SEARCH_RESULT_ITEM_TITLE' => "{{ item.title  }}",
                'PAGE_SEARCH_RESULT_ITEM_URL' => "{{ item.url }}",
                'PAGE_SEARCH_RESULT_ITEM_CONTENT' => "{{ item.content | strip_html | truncatewords: 20 | highlight: search.terms }}",
                'PAGE_SEARCH_RESULT_ITEM_IMG_URL' => ' {% if item.metafields.images.all %}{% assign images = item.metafields.images.all | split: "," | reverse  %}{% assign image = images[0] | split: ".jpg" %}{{image}}_S.jpg  {%else%}{{ item.featured_image | product_img_url: "medium" }}{% endif %}',
                'PAGE_SEARCH_RESULT_ITEM_PRICE' => ' {{ item.price | money }}',
                'PAGE_SEARCH_RESULT_ITEM_COMPARE_PRICE' => ' {{ item.compare_at_price | money }}',
                'END_FORM' => "{% endform %}",
                'ENDIF' => "{% endif %}  ",
                'ENDFOR' => "{% endfor %}  ",
            ];
            return $field;
        }
    }

    public function page_product()
    {
        {
            $field = [
                'PRODUCT_TITLE' => "{{ product.title}}",
                'PRODUCT_DESCRIPTION' => "{{ product.description }}",
                'PRODUCT_PRICE' => "{{ product.price | money }}",
                '-PRODUCT_IMAGES' => "{% for image in product.images %}",
                'PRODUCT_IMAGES_SMALL' => '{{ image.src | img_url: "small" }}',
                'PRODUCT_IMAGES_MEDIUM' => '{{ image.src | img_url: "medium" }}',
                'PRODUCT_IMAGES_LARGE' => '{{ image.src | img_url: "large" }}',
                'PRODUCT_IMAGES_ORIGINAL' => '{{ image.src | img_url: "original" }}',
                'PRODUCT_IMAGES_DATALINK_THUMB' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] | split: ".jpg" }}_T.jpg',
                'PRODUCT_IMAGES_DATALINK_SMALL' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] | split: ".jpg" }}_S.jpg',
                'PRODUCT_IMAGES_DATALINK_ORIGINAL' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] }}  ',
                '-PRODUCT_IMGS_DATALINK' => '{% assign image_metafields = product.metafields.images.all   %} {% assign images=image_metafields  | split: "," | reverse  %}  {% for image in images %}',
                'PRODUCT_IMGS_DATALINK' => ' {% endfor %} ',
                'PRODUCT_IMGS_DATALINK_ITEM_THUMB' => '{{ image | remove :".jpg" |append : "_T.jpg"}}',
                'PRODUCT_IMGS_DATALINK_ITEM_SMALL' => '{{ image | remove :".jpg" |append : "_S.jpg"}}',
                'PRODUCT_IMGS_DATALINK_ITEM_ORIGINAL' => '{{ image }}',
                'PRODUCT_OPTION_VALUE' => " {% for product_option in product.options_with_values %}",
                'PRODUCT_OPTION_VALUE_NAME' => "{{product_option.name}}",
                'PRODUCT_OPTION_VALUE_OPTION_VALUE' => "{% for value in product_option.values %}",
                'PRODUCT_OPTION_VALUE_OPTION_VALUE_NAME' => "{{ value }}",
                'END_FORM' => "{% endform %}",
                'ENDIF' => "{% endif %}  ",
                'ENDFOR' => "{% endfor %}  ",
                'FOR_INDEX' => "{{forloop.index}}",
            ];
            return $field;
        }
    }
}