<?php

if( !class_exists( 'OpenSpacerApiSettings' ) )
{
    class OpenSpacerApiSettings
    {
        private $_options;

        public function __construct()
        {
            add_action( 'admin_menu', array( $this, 'addPluginPage' ) );
            add_action( 'admin_init', array( $this, 'pageInit' ) );
            add_action( 'admin_post_clear_cache', array( $this, 'clearCache' ) );
        }

        /**
         * Add options page
         */
        public function addPluginPage()
        {
            // This page will be under "Settings"
            add_options_page(
                'OpenSpacer API Settings',
                'OpenSpacer API',
                'administrator',
                'openspacer_api_settings',
                array( $this, 'createAdminPage' )
            );
        }

        /**
         * Options page callback
         */
        public function createAdminPage()
        {
            $this->_options = get_option('openspacer_api_settings_options');
            ?>
            <div class="wrap">
                <?php screen_icon(); ?>
                <h2>OpenSpacer API Settings</h2>
                <form method="post" action="options.php">
                    <?php
                    // This prints out all hidden setting fields
                    settings_fields('openspacer_api_base_settings_group');
                    do_settings_sections('openspacer_api_settings');
                    submit_button();
                    ?>
                </form>

                <form action="<?php echo admin_url('admin-post.php'); ?>" method="post">
                    <input type="hidden" name="action" value="clear_cache">
                    <?php submit_button( 'Clear Cache' ); ?>
                </form>
            </div>
            <?php
        }

        /**
         * Register and add settings
         */
        public function pageInit()
        {
            register_setting(
                'openspacer_api_base_settings_group', // Option group
                'openspacer_api_settings_options',
                array( $this, 'sanitize' ) // Sanitize
            );

            add_settings_section(
                'openspacer_base_settings_section', // ID
                'General Settings', // Title
                array( $this, 'printSectionInfo' ), // Callback
                'openspacer_api_settings' // Page
            );

            add_settings_field(
                'api_key', // ID
                'API Key',
                array($this, 'apiKeyCallback'),
                'openspacer_api_settings',
                'openspacer_base_settings_section'
            );

            add_settings_field(
                'api_url', // ID
                'API URL',
                array($this, 'apiUrlCallback'),
                'openspacer_api_settings',
                'openspacer_base_settings_section'
            );

            add_settings_field(
                'cache_lifetime', // ID
                'Cache Lifetime',
                array($this, 'apiCacheLifetimeCallback'),
                'openspacer_api_settings',
                'openspacer_base_settings_section'
            );
        }

        /**
         * Sanitize each setting field as needed
         *
         * @param array $input Contains all settings fields as array keys
         *
         * @return array()
         */
        public function sanitize($input)
        {
            if(isset($input['api_url']))
            {
                // removing trailing slash from url
                while(substr($input['api_url'], -1) == '/') {
                    $input['api_url'] = substr($input['api_url'], 0, -1);
                }
            }
            return $input;
        }

        /**
         * Print the Section text
         */
        public function printSectionInfo()
        {
            print 'Enter your settings below:';
        }

        /**
         * Key callback
         * */
        public function apiKeyCallback()
        {
            printf(
                '<input type="text" id="api_key" name="openspacer_api_settings_options[api_key]" value="%s" style="width: 100%s;" />',
                isset( $this->_options['api_key'] ) ? esc_attr( $this->_options['api_key']) : '', '%'
            );
        }

        /**
         * Url callback
         * */
        public function apiUrlCallback()
        {
            printf(
                '<input type="text" id="api_url" name="openspacer_api_settings_options[api_url]" value="%s" style="width: 100%s;" />',
                isset( $this->_options['api_url'] ) ? esc_attr( $this->_options['api_url']) : '', '%'
            );
        }

        /**
         * Cache lifetime callback
         * */
        public function apiCacheLifetimeCallback()
        {
            printf(
                '<input type="text" id="cache_lifetime" name="openspacer_api_settings_options[cache_lifetime]" value="%s" style="width: 100%s;" />',
                isset( $this->_options['cache_lifetime'] ) ? esc_attr( $this->_options['cache_lifetime']) : '', '%'
            );
        }

        /**
         * Clear cache
         * */
        public function clearCache()
        {
            $opt = new OpenSpacerApiOptions();
            $cache = new OpenSpacerApiCacheEngine($opt);
            $cache->clearCache();
            if (wp_get_referer())
                wp_safe_redirect(wp_get_referer());
            else
                wp_safe_redirect(get_admin_url());
        }
    }
}