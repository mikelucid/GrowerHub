<?php

use Illuminate\Support\Facades\Blade;

Blade::directive('md', function ($expression) {
	return "<?php echo md_to_html($expression); ?>";
});

Blade::directive('error', function ($expression) {
	return "<?php echo \$errors->first($expression, '<span class=\"help-block invalid-feedback\">:message</span>'); ?>";
});

Blade::directive('formGroup', function ($expression) {
	return "<div class=\"form-group w-full<?php echo \$errors->has($expression) ? ' is-invalid' : '' ?>\">";
});

Blade::directive('endFormGroup', function ($expression) {
	return "</div>";
});

Blade::directive('title', function ($expression) {
	return "<?php \$title = $expression ?>";
});

Blade::directive('shareImage', function ($expression) {
	return "<?php \$shareImage = $expression ?>";
});

Blade::if('vendor', function () {
	return auth() -> check() && auth() -> user() -> isVendor() ||
		auth() -> check() && auth() -> user() -> isAdmin();
});
Blade::if('moderator', function(){
	return auth() -> check() && auth() -> user() -> isModerator() ||
		auth() -> check() && auth() -> user() -> isAdmin();
});
// check if the logged user is admin
Blade::if('admin', function () {
	return auth() -> check() && auth() -> user() -> isAdmin();
});

Blade::directive('active', function($expression) {
	return '<?php if(is_active('. $expression . '){ }; ?>';
});

Blade::directive('selected', function($expression) {
	return '<?php echo optionSelected('. $expression . '); ?>';
});

Blade::directive('markdown', function($expression) {
	return '<?php echo $converter->convertToHtml('. $expression . '); ?>';
});
