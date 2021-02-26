<?php
namespace WRDSB\Staff\Modules\WP;

class WPCore
{
    public static function currentTime(string $arg = 'mysql'): string {
        return strval(current_time($arg));
    }
    
    public static function wpRemotePost(string $url, array $args = array()) {
        return wp_remote_post($url, $args);
    }

    public static function isWPError($thing): bool {
        return is_wp_error($thing);
    }

    public static function wpEnqueueStyle($handle, $src = '', $deps = array(), $ver = false, $media = 'all'): void {
        wp_enqueue_style($handle, $src, $deps, $ver, $media);
    }

    public static function pluginDirURL(string $file): string {
        return plugin_dir_url($file);
    }

    public static function wpEnqueueScript(string $handle, string $src = '', $deps = array(), $ver = false, bool $in_footer = false) {
        wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
    }

    public static function wpLocalizeScript(string $handle, string $object_name, array $l10n): bool {
        return wp_localize_script($handle, $object_name, $l10n);
    }

    public static function escURLRaw(string $url, $protocols = null) {
        return esc_url_raw($url, $protocols);
    }

    public static function restURL(string $path = '', string $scheme = 'rest'): string {
        return rest_url($path, $scheme);
    }

    public static function wpCreateNonce($action = -1): string {
        return wp_create_nonce($action);
    }

    public static function currentUserCan(string $capability, mixed $args = null): bool {
        return current_user_can($capability, $args);
    }

    public static function wpGetCurrentUser() {
        return wp_get_current_user();
    }

    public static function switchToBlog(int $new_blog_id): bool {
        return switch_to_blog($new_blog_id);
    }

    public static function userCan($user, string $capability): bool {
        return user_can($user, $capability);
    }

    public static function restoreCurrentBlog(): bool {
        return restore_current_blog();
    }

    public static function registerRestRoute( string $namespace, string $route, array $args = array(), bool $override = false ): bool {
        return register_rest_route($namespace, $route, $args, $override);
    }
}
