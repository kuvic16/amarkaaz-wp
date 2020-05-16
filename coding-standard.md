# PHP Coding standard

PHP Coding standard for wordpress plugin development

## Naming Conventions

Using lowercase letters in **variable**, **action/filter**, and **function names** (never camelcase). Separate words via underscores. Don't abbreviate variable names unnecessarily. Let the code be unambiguous and self-documenting.

```php
    function some_name( $some_variable ) { [...] }
```

**Class** names should use capitalized words separated by underscores. Any acronyms should be all upper case.

```php
    class Walker_Category extends Walker { [...] }
    class WP_HTTP { [...] }
```

**Constants** should be in all upper-case with underscores separating words:

```php
    define( 'DOING_AJAX', true );
```

**Files** should be named descriptively using lowercase letters. Hypens should separate words.

```php
    my-plugin-name.php
```

class file names should be based on the class name with class- prepended and the underscores in the class name replaced with hyphens, for example WP_Error becomes:

```php
    class-wp-error.php
```

This file-naming standard is for all current and new files with classes. There is one exception for three files that contain code that code that got ported into BackPress: class.wp-dependencies.php, class.wp-scripts.php, class.wp-styles.php. Those files are prepended with **class.**, a dot after the word class instead of a hyphen.

Files containing template tags in **wp-includes** should have **-template** appended to the end of the name so that they are obvious.

```php
    general-template.php
```
