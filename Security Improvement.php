//-------------------------------------------------------------------------------------  security

1. Sanitize Data -- Process of securing/cleaning/filtering input data

sanitize_user();
sanitize_url();
sanitize_title();
sanitize_email();
sanitize_file_name();
sanitize_html_class();
sanitize_key();
sanitize_meta();
sanitize_mime_type();
sanitize_option();
sanitize_sql_orderby();
sanitize_term();
sanitize_term_field();
sanitize_text_field();
sanitize_textarea_field();
sanitize_title_for_query();
sanitize_title_with_dashes();
sanitize_hex_color();
sanitize_hex_color_no_hash();
wp_kses();
wp_kses_post();


2. Escaping Data -- Process of securing output data by stripping out unwanted data

esc_html();
esc_js();
esc_url();
esc_url_raw();
esc_textarea();
wp_kses();
wp_kses_post();
wp_kses_data();

Escaping with Localization
---------
esc_html_e( 'Hello World', 'text_domain' );
echo esc_html( __( 'Hello World', 'text_domain' ) );


3. Pass data in url

urlencode(); -- encoding path segment, encodes with +
rawurlencode(); -- encoding query component, encodes with %20


